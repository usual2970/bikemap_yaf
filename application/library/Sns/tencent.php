<?php

require_once("kra_base.php");
require_once("pengyou.class.1.1.0.php");

class tencent extends kra_base {

    private $_user_fds = array(
		'uid' => 'openid',
		'nickname' => 'nickname',
		'thumbnail_url' => 'figureurl',
		'gender' => 'gender',
		'province' => 'province',
		'city' => 'city',
		'vip' => 'is_vip',
		'year_vip' => 'is_year_vip',
		'vip_level' => 'vip_level'
    );

    public function __construct($sns = "xiaoyou", $app_id = "", $app_name = "", $app_key = "")
	{
		$this->_app_id = $app_id;
		$this->_app_name = $app_name;
		$this->_app_key = $app_key;
		$this->pre = $sns == "qzone" ? "qzoapp" : "xyoapp";
		$this->server = '119.147.75.204';
		$this->get_paras();
    }

    private function get_paras()
	{
		if ($_POST['openid']) {
			if ($_POST['openid']) $this->_openid = $_POST['openid'];
			if ($_POST['openkey']) $this->_openkey = $_POST['openkey'];
		}
		elseif ($_GET['openid']) {
			if ($_GET['openid']) $this->_openid = $_GET['openid'];
			if ($_GET['openkey']) $this->_openkey = $_GET['openkey'];
		}
		elseif ($_COOKIE['ssid'])
		{
			$this->_openid = $_COOKIE['ssid'];
			$this->_openkey = $_COOKIE['skey'];
		}

		if($this->_openid && $this->_openkey)
		{
			set_cookie("ssid", $this->_openid);
			set_cookie("skey", $this->_openkey);
			$this->qq = new Pengyou($this->_app_id, $this->_app_key, $this->_app_name);
			$this->qq->setServerName($this->server);
		}

		return true;
    }

	function get_uid()
	{
		if($this->_openid) return $this->_openid;
		else return false;
	}

    public function me($field = array())
	{
		if (!$this->_app_id || !$this->_app_name || !$this->_app_key || !$this->_openid || !$this->_openkey) {
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$result = $this->qq->getUserInfo($this->_openid, $this->_openkey);

		if (!is_array($result) || $result['ret']) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}

		$field = $field ? $field : array_keys($this->_user_fds);

		$this->set_err(0, "");
		$ret = array();
		foreach ($field as $fd)
		{
			if (stripos($this->_user_fds[$fd], ".") !== false)
			{
				$tmp = explode(".", $this->_user_fds[$fd]);
				$p = "";
				if ($tmp)
				{
					$p = $result;
					foreach ($tmp as $t) $p = $p[$t];
				}
				$ret[$fd] = $p;
			}
			elseif ($fd == 'uid') $ret[uid] = $this->_openid;
			elseif ($fd == 'gender')
			{
				$ret[gender] = $result[$this->_user_fds[$fd]] == '男' ? "MALE" :
					($result[$this->_user_fds[$fd]] == '女' ? "FEMALE" : "");
			}
			else $ret[$fd] = $result[$this->_user_fds[$fd]] ? $result[$this->_user_fds[$fd]] : "";
		}

		return $ret;
    }

    public function friends($page = 1, $pagesize = 100, $hasapp = 0, $fullinfo = 0)
	{
		if (!$this->_app_id || !$this->_app_name || !$this->_app_key || !$this->_openid || !$this->_openkey)
		{
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$result = $this->qq->getFriendList($this->_openid, $this->_openkey);
		if (!is_array($result) || $result['ret']) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}

		$this->set_err(0, "");
		if (!$result['items']) return array();

		$ret = array();
		foreach ($result['items'] as $user)
		{
			$uidk = $this->_user_fds[uid];
			$uid = $user[$uidk];
			if (!$uid) continue;

			$ret[$uid] = $uid;
		}

		if ($fullinfo)
		{
			$oids = $ret;
			$ret = array();

			$result = $this->qq->getMultiInfo($this->_openid, $this->_openkey, array('fopenids' => $oids));
			if (!is_array($result) || $result['ret'])
			{
				$this->set_err(104, print_r($result, 1));
				return false;
			}
			$this->set_err(0, "");
			if (!$result['items']) return array();

			foreach ($result['items'] as $user)
			{
				$uidk = $this->_user_fds[uid];
				$uid = $user[$uidk];
				if (!$uid) continue;

				$row[uid] = $uid;
				$row[nickname] = $user[nickname];
				$row[thumbnail_url] = $user[figureurl];

				$ret[$row[uid]] = $row;
			}
		}

		return $ret;
    }

	public function feed($title = "", $content = "", $imgs = "")
	{
		return false;
    }

    public function invite($to_uid = 0, $content = "")
	{
		return false;
    }

	public function isfan()
	{
		return false;
    }

	public function becomefan()
	{
		return false;
    }

}

?>