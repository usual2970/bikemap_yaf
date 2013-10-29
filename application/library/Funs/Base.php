<?php
class Funs_Base{
	/**
 * 获得用户的真实IP地址
 *
 * @return  string
 */
static function real_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}


/**
 * 获得当前格林威治时间的时间戳
 *
 * @return  integer
 */
static function gmtime()
{
    return (time() - date('Z'));
}
/**
 * 获得当前的域名
 *
 * @return  string
 */
static function get_domain()
{
    /* 协议 */
    $protocol = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';

    /* 域名或IP地址 */
    if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
    {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }
    elseif (isset($_SERVER['HTTP_HOST']))
    {
        $host = $_SERVER['HTTP_HOST'];
    }
    else
    {
        /* 端口 */
        if (isset($_SERVER['SERVER_PORT']))
        {
            $port = ':' . $_SERVER['SERVER_PORT'];

            if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol))
            {
                $port = '';
            }
        }
        else
        {
            $port = '';
        }

        if (isset($_SERVER['SERVER_NAME']))
        {
            $host = $_SERVER['SERVER_NAME'] . $port;
        }
        elseif (isset($_SERVER['SERVER_ADDR']))
        {
            $host = $_SERVER['SERVER_ADDR'] . $port;
        }
    }

    return $protocol . $host;
}

/**
 * 获得网站的URL地址
 *
 * @return  string
 */
static function site_url()
{
	$php_self=htmlentities(isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
    return get_domain() . substr($php_self, 0, strrpos($php_self, '/'));
}


/**
 * @显示系统信息
 *
 * @param string $msg 信息
 * @param string $url 返回地址
 * @param boolean $isAutoGo 是否自动返回 true false
 */
static function Umsg($msg, $url='javascript:history.back(-1);', $isAutoGo=false){
	if ($msg == '404') {
		header("HTTP/1.1 404 Not Found");
		$msg = '抱歉，你所请求的页面不存在！';
	}
	echo <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
EOT;
	if($isAutoGo){
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$url\" />";
	}
	echo <<<EOT
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>emlog system message</title>
<style type="text/css">
<!--
body {
	background-color:#F7F7F7;
	font-family: Arial;
	font-size: 12px;
	line-height:150%;
}
.main {
	background-color:#FFFFFF;
	font-size: 12px;
	color: #666666;
	width:650px;
	margin:60px auto 0px;
	border-radius: 10px;
	padding:30px 10px;
	list-style:none;
	border:#DFDFDF 1px solid;
}
.main p {
	line-height: 18px;
	margin: 5px 20px;
}
-->
</style>
</head>
<body>
<div class="main">
<p>$msg</p>
<p><a href="$url">&laquo;点击返回</a></p>
</div>
</body>
</html>
EOT;
	exit;
}

static function us_mkdir($absolute_path, $mode = 0777)
{
    if (is_dir($absolute_path))
    {
        return true;
    }

    $root_path      = UPATH;
    $relative_path  = str_replace($root_path, '', $absolute_path);
    $each_path      = explode('/', $relative_path);
    $cur_path       = $root_path; // 当前循环处理的路径
    foreach ($each_path as $path)
    {
        if ($path)
        {
            $cur_path = $cur_path . '/' . $path;
            if (!is_dir($cur_path))
            {
                if (@mkdir($cur_path, $mode))
                {
                    fclose(fopen($cur_path . '/index.htm', 'w'));
                }
                else
                {
                    return false;
                }
            }
        }
    }

    return true;
}
//格式化手机号码
static function phone_star($phone){
	return preg_replace("/^(\d{3})\d{4}(\d{4})$/", "$1****$2", $phone);
}
//写日志
static function cdlog($str,$display_errors=false,$forceWrite=false)
{
	global $starttime;
	$recordTime=myTime();
	$expend=$recordTime-$starttime;
	$request_slow=0.00001;
	$request_slow?"":$request_slow=1;
	$request_slow=(float)$request_slow;
	$starttime=$recordTime;
	$expend=intval($expend*100000)/100000;
	if($request_slow<$expend||$forceWrite)
	{
		if($expend>1)
		{
			if($expend>3)
			{
				$expend="<font color=red>{$expend}</font>";
			}
			else
			{
				$expend="<font color=#F7A248>{$expend}</font>";
			}
		}
	}
	else
	{
		if(!isset($_GET['debug']) && !$_COOKIE['debug'])
		{
			return;
		}
	}

	$log = UPATH."/data/logs/paylog/access.log";
	if (is_file($log))
	{
		if (filesize($log) > 500 * 1024)
		{
			$log2 = str_replace(".log", "_".date("Ymd H-i").".log", $log);@rename($log, $log2);
		}
	}
	$error_str="^".date("Y-m-d H:i:s")." | ".substr(php_uname(), 0, 20)." | ".($expend>0?"耗时".$expend:"")." | ".$str." <br>访问:<font color=blue>http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."</font> <br>来源:<font color=green>".$_SERVER['HTTP_REFERER']."</font>(".real_ip().")\$\n";
	if(isset($_GET['debug']))
	{
		var_dump($error_str);
	}
	else 
	{   
		file_put_contents($log, $error_str, FILE_APPEND);
	}
	
}

//开始运行时间，用作性能调试。
static function myTime()
{
	$pageStart=explode(' ', microtime());
	return $pageStart[1] + $pageStart[0];
}



/* 请求函数，（连接超时3，请求超时5） */
static function http($url, $method, $postfields = NULL,$timeout = 5,$headers = array()){
    $ci = curl_init();
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_USERAGENT, 'PAY CURL ROOT');
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ci, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ci, CURLOPT_ENCODING, "");
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ci, CURLOPT_HEADER, FALSE);
    switch($method){
        case 'POST':
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if(!empty($postfields)){
                curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
            }
            break;
        case 'DELETE':
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
            if(!empty($postfields)){
                $url      = "{$url}?{$postfields}";
            }
            break;
        case 'GET':
            $url.="?".$postfields;
            break;
    }
    curl_setopt($ci, CURLOPT_URL, $url);
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, false);
    $response = curl_exec($ci);


    curl_close($ci);
    return $response;
}

//根据ip获得城市信息
static function get_cityinfo($ip="",$weather=false){
	if(!$ip) $ip=real_ip();
	if($ip=="127.0.0.1") $ip="112.124.17.181";
	$url="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip={$ip}";
	$rs=http($url,"get");
	preg_match("/{.+}/is", $rs,$match);
	$city_info=json_decode(current($match),true);
	if($weather){
		$rs=modcall("citys","get",array(
			array(
				"condition"=>"city_name like '%{$city_info['city']}%'",
				"fields"=>"weather_id"
			)
		));
		$url="http://m.weather.com.cn/data/{$rs['weather_id']}.html";
		$weather_info=json_decode(http($url,"get"),true);
		$city_info["weather_info"]=$weather_info["weatherinfo"];
		if($city_info["weather_info"]["img1"]<10) $city_info["weather_info"]["img1"]="0".$city_info["weather_info"]["img1"];
	}
	return $city_info;
}
static function set_cookie($name,$key,$expir=3600){
    setcookie($name,$key,time()+$expir,"/",".joneto.com");
}


static function test_email($email){
    return preg_match("/^\w+?\@\w+?\.\w{1,10}$/i",$email);
}

static function test_txt($txt,$len=60){
    $pat="/\w".$len."/";
    return preg_match($pat,$txt);
}
}

?>