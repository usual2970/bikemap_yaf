<?php
class Session_Memcache
{
    var $_memcache = null; // memcache服务器
    var $max_life_time = 1440; // session 过期时间
    var $session_cookie_path = '/'; 
    var $session_cookie_domain = '';
    var $session_cookie_secure = false;
    var $session_name = '';
    var $gmtime = 0;
    var $_ip = '';
    
    function __construct($memcache_servers, $session_name = 'BHB_ID')
    {
        $this->Session_Memcache($memcache_servers, $session_name);
    }
    
    function Session_Memcache($memcache_server, $session_name = 'BHB_ID',$session_id='')
    {
        // Create memcache object
        if ($this->_memcache === null)
        {
            $this->_memcache = new Memcache();
        }
        list($host, $port) = explode(':', $memcache_server);
        $this->_memcache->connect($host, $port);

        session_set_save_handler(   array (& $this, "_sess_open"),
                                    array (& $this, "_sess_close"),
                                    array (& $this, "_sess_read"),
                                    array (& $this, "_sess_write"),
                                    array (& $this, "_sess_destroy"),
                                    array (& $this, "_sess_gc")
                                );
        $conf=Yaf_Registry::get("config")->get("site")->toArray();
        register_shutdown_function('session_write_close');
        $this->max_life_time = defined('SESSION_LIFE_TIME') ? SESSION_LIFE_TIME : 1440;
        $this->session_cookie_path = $conf["cookie_path"];
        $this->session_cookie_domain = $conf["domain"];
        //如果开启二级域名,且未设置COOKIE作用域，则缺省为上级域
        if (defined('ENABLED_SUBDOMAIN') && ENABLED_SUBDOMAIN && !COOKIE_DOMAIN)
        {
            $tmp_arr = parse_url(SITE_URL);
            if (count(explode('.', $tmp_arr['host'])) > 2)
            {
                $cookie_domain = substr($tmp_arr['host'], strpos($tmp_arr['host'], '.'));
            }
            else
            {
                // 形如ecmall.com这样的域名
                $cookie_domain = '.' . $tmp_arr['host'];
            }
            $this->session_cookie_domain = $cookie_domain;
        }
        $this->session_cookie_secure = false;
        $this->session_name       = $session_name;
        $this->gmtime = Funs_Base::gmtime();
        $this->_ip = Funs_Base::real_ip();
        /*处理session id*/
        if ($session_id == '' && !empty($_COOKIE[$this->session_name]))
        {
            $this->session_id = $_COOKIE[$this->session_name];
        }
        else
        {
            $this->session_id = $session_id;
        }

        if ($this->session_id)
        {
            $tmp_session_id = substr($this->session_id, 0, 32);
            if ($this->gen_session_key($tmp_session_id) == substr($this->session_id, 32))
            {
                $this->session_id = $tmp_session_id;
            }
            else
            {
                $this->session_id = '';
            }
        }

        if (!$this->session_id)
        {
            $this->gen_session_id();
            session_id($this->session_id . $this->gen_session_key($this->session_id));
            /*setcookie($this->session_name, $this->session_id . $this->gen_session_key($this->session_id), 0,
                $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);*/
        }
    }
    
    /**
     * open session handler
     *
     * @author wj
     * @param string $save_path
     * @param string $session_name
     * @return boolen
     */
    function _sess_open($save_path, $session_name)
    {
        return true;
    }
    
    /**
     * read session handler
     *
     * @author wj
     * @param string $sesskey
     * @return string
     */
    function _sess_read($sesskey)
    {
        $data = $this->_memcache->get($this->session_id);
        if ($data === false)
        {
            $this->insert_session();
            return '';
        }
        else
        {
            return $data;
        }
    }
    
    /**
     * write session handler
     *
     * @author Garbin
     * @param stirng $sesskey
     * @param string $sessvalue
     * @return boolen
     */
    function _sess_write($sesskey, $sessvalue)
    {
        return $this->_memcache->set($this->session_id, $sessvalue, 0, $this->max_life_time);
    }
    
    /**
     * close session handler
     *
     * @author wj
     * @return boolen
     */
    function _sess_close()
    {
        return true;
    }
    
    /**
     * destory session handler
     *
     * @author wj
     * @param stirng $sesskey
     * @return void
     */
    function _sess_destroy($sesskey)
    {
        $this->destroy_session();
    }
    
    /**
     * gc session handler 清除过期session
     *
     * @author weberliu
     * @param int $maxlifetime
     * @return boolen
     */
    function _sess_gc($maxlifetime)
    {
        // 过期Session数据Memcache会自动清理，相关数据TODO
        return true;
    }
    
    /**
     * 生成session id
     *
     * @author wj
     * @return string
     */
    function gen_session_id()
    {
        $this->session_id = md5(uniqid(mt_rand(), true));

        return $this->insert_session();
    }
    
    /**
     * 生成session验证串
     *
     * @author wj
     * @param string $session_id
     * @return stirng
     */
    function gen_session_key($session_id)
    {
        static $ip = '';

        if ($ip == '')
        {
            $ip = substr($this->_ip, 0, strrpos($this->_ip, '.'));
        }

        return sprintf('%08x', crc32(!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] . APPLICATION_PATH . $ip . $session_id : APPLICATION_PATH . $ip . $session_id));
    }
    
    /**
     * 插入一个新session
     *
     * @author wj
     * @return void
     */
    function insert_session()
    {
        $result = $this->_memcache->set($this->session_id, '', 0, $this->max_life_time);
        if ($result === false)
        {
            exit('Data Cannot be written on memcached');
        }
    }
    
    /**
     * 清除一个session
     *
     * @author wj
     * @return boolen
     */
    function destroy_session()
    {
        $_SESSION = array();

        setcookie($this->session_name, $this->session_id, 1, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);

        return $this->delete_session($this->session_id);
    }
    
    /**
     * 删除指定ID的Session
     *
     * @author Garbin
     * @param  string $session_id
     * @return bool
     **/
    function delete_session($session_id)
    {
        return $this->_memcache->delete($session_id);
    }
    
    /**
     * 获取当前session id
     *
     * @author wj
     * @return string
     */
    function get_session_id()
    {
        return $this->session_id;
    }
    
    /**
     * 获取用户数量
     *
     * @author wj
     * @return int
     */
    function get_users_count()
    {
        $stats = $this->_memcache->getStats();

        return $stats['curr_items'];
    }
    
    /**
     * 打开session
     *
     * @author wj
     * @return void
     */
    function my_session_start()
    {
        session_name($this->session_name); // 自定义session_name
        session_set_cookie_params(0, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);
        return session_start();
    }
}
?>