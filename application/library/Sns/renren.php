<?php

class renren extends Sns_Base {

    private $format = 'json';
    private $_user_fds = array(
		'uid' => 'uid',
		'nickname' => 'name',
		'gender' => 'sex',
		'age' => 'birthday',
		'thumbnail_url' => 'headurl',
		'province' => 'province',
		'city' => 'city',
		'vip' => 'zidou',
		'profile_url' => 'link',
    );

    public function __construct($api_key = "", $api_secret = "") {
		$this->_api_key = $api_key;
		$this->_api_secret = $api_secret;
		$this->_rest_url = 'http://api.renren.com/restserver.do?';

		$this->get_paras();
    }

    public function __destruct() {
	
    }

    private function get_paras() {
		if ($_COOKIE['ssid'])
		{
			$this->_user[uid] = $_COOKIE['ssid'];
			$this->_session_key = $_COOKIE['skey'];
		}
    }

	public function request_permissions($callback_url = "", $perms = array()) {
	
    }

    function get_uid() {
		if ($this->_user[uid]) return $this->_user[uid];

		if (!$this->_api_key)
		{
			echo "No api_key found.";
			exit();
		}

		//$scope = urlencode("publish_feed publish_share send_invitation send_request operate_like");
		$callback_url = urlencode(SNS_AUTH_CALLBACK_URL);

		$code = $_REQUEST["code"];
		if (empty($code))
		{
			echo "<script>window.top.location.href='https://graph.renren.com/oauth/authorize?response_type=code&client_id={$this->_api_key}&redirect_uri={$callback_url}&scope={$scope}';</script>";
			exit();
		}


		$resp = $this->httpRequest("https://graph.renren.com/oauth/token?grant_type=authorization_code&code={$code}&client_id={$this->_api_key}&client_secret={$this->_api_secret}&redirect_uri={$callback_url}", "get");
		
		if (!$resp) {
			echo "<script>window.top.location.href='https://graph.renren.com/oauth/authorize?response_type=code&client_id={$this->_api_key}&redirect_uri={$callback_url}&scope={$scope}';</script>";
			exit();
		}

		$params = json_decode($resp, true);
		if (!$params || $params["error"]) {
			echo "<script>window.top.location.href='https://graph.renren.com/oauth/authorize?response_type=code&client_id={$this->_api_key}&redirect_uri={$callback_url}&scope={$scope}';</script>";
			exit();
		}
		
		$params[access_token] = urlencode($params[access_token]);
		$resp = $this->httpRequest("https://graph.renren.com/renren_api/session_key?oauth_token={$params[access_token]}", "get");
		
		if (!$resp) {
			echo "<script>window.top.location.href='https://graph.renren.com/oauth/authorize?response_type=code&client_id={$this->_api_key}&redirect_uri={$callback_url}&scope={$scope}';</script>";
			exit();
		}

		$params = json_decode($resp, true);
		if (!$params || $params["error"]) {
			echo "<script>window.top.location.href='https://graph.renren.com/oauth/authorize?response_type=code&client_id={$this->_api_key}&redirect_uri={$callback_url}&scope={$scope}';</script>";
			exit();
		}

		$this->_session_key = $params["renren_token"]["session_key"];
		$this->_user[uid] = $params['user']['id'];

		if(!$this->_session_key || !$this->_user[uid]) {
			echo "<script>window.top.location.href='https://graph.renren.com/oauth/authorize?response_type=code&client_id={$this->_api_key}&redirect_uri={$callback_url}&scope={$scope}';</script>";
			exit();
		}

		if ($this->_user[uid]) {
			set_cookie("ssid", $this->_user[uid]);
			set_cookie("skey", $this->_session_key);
		}

		return $this->_user[uid];
    }
/*
 * used to create post string
 */
    protected function create_post_string($method, $params) {
		$params['method'] = $method;
		$params['session_key'] = $this->_session_key;
		$params['api_key'] = $this->_api_key;
		$params['call_id'] = microtime(true);
		if ($params['call_id'] <= $this->last_call_id)
			$params['call_id'] = $this->last_call_id + 0.001;
		$this->last_call_id = $params['call_id'];
		if (!isset($params['v']))
			$params['v'] = '1.0';

		$post_params = array();
		foreach ($params as $key => &$val) {
			if (is_array($val))
			$val = implode(',', $val);
			$post_params[] = $key . '=' . urlencode($val);
		}
		$post_params[] = 'sig=' . $this->generate_sig($params);
		return implode('&', $post_params);
    }
/*
 * used to create sign
 */
    private function generate_sig($params_array) {
		$sign = "";
		ksort($params_array);
		foreach ($params_array as $key => $val) {
			if ($key !== '' && $val !== '') {
			$sign .= "{$key}={$val}";
			}
		}
		$sign .= $this->_api_secret;
		return md5($sign);
    }

    protected function parse_result($result) {
		$oresult = $result;
		$result = json_decode($result, true);
		if (!is_array($result)) {
			$this->set_err(1004, print_r($oresult, 1));
			return false;
		}
		return $result;
    }
/*
 * used to get my own information
 */
    public function me($field = array()) {
		if (!$this->_user[uid]) {
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$field = $field ? $field : array_keys($this->_user_fds);
		$tfield = array();
		foreach ($field as $f) {
			if (!$this->_user_fds[$f])
			continue;

			$tfield[] = $this->_user_fds[$f];
		}

		$method = "users.getInfo";
		$params['uids'] = $this->_user[uid];
		$params['fields'] = $tfield;
		$params['format'] = $this->format;
		$result = $this->post_request($method, $params);

		if (!is_array($result) || isset($result['error_code']) && $result['error_code'] > 0) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}
		$this->set_err(0, "");

		$result = $result[0];

		$ret = array();
		foreach ($field as $fd) {
			if (stripos($this->_user_fds[$fd], ".") !== false) {
			$tmp = explode(".", $this->_user_fds[$fd]);
			$p = "";
			if ($tmp) {
				$p = $result;
				foreach ($tmp as $t) {
				$p = $p[$t];
				}
			}
			$ret[$fd] = $p;
			} elseif ($fd == 'gender') {
			$ret[gender] = $result[$this->_user_fds[$fd]] == '1' ? "MALE" :
				($result[$this->_user_fds[$fd]] == '0' ? "FEMALE" : "");
			} elseif ($fd == 'age') {
			$birth = $result[$this->_user_fds[$fd]] ? strtotime($result[$this->_user_fds[$fd]]) : "";
			if ($birth)
				$ret[$fd] = floor((time() - $birth) / (365 * 86400));
			else
				$ret[$fd] = 0;
			}
			else
			$ret[$fd] = $result[$this->_user_fds[$fd]];
		}
		return $ret;
    }
/*
 * used to get friends list
 */
    public function friends($page = 1, $pagesize = 20, $hasapp = 0, $fullinfo = 0) {
		if (!$this->_user[uid]) {
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$page = intval($page);
		$page = $page ? $page : 1;
		$pagesize = intval($pagesize);
		$pagesize = $pagesize ? $pagesize : 20;

		if ($hasapp) {
			if ($fullinfo) {
			$method = "friends.getAppFriends";
			$params['fields'] = 'name,headurl';
			}
			else
			$method = "friends.getAppFriends";
		}
		else {
			if ($fullinfo)
			$method = "friends.getFriends";
			else
			$method = "friends.getFriends";

			$params['page'] = $page;
			$params['count'] = $pagesize;
		}

		$params['format'] = $this->format;
		$result = $this->post_request($method, $params);
		if ($result === false || !is_array($result) || isset($result['error_code']) && $result['error_code'] > 0) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}
		$this->set_err(0, "");

		if (!$result)
			return array();



		$ret = array();
		if ($fullinfo || $hasapp) {
			foreach ($result as $user) {
			$uid = $user['uid'];
			if (!$uid)
				continue;

			$field = array_keys($this->_user_fds);
			foreach ($field as $fd) {
				if (stripos($this->_user_fds[$fd], ".") !== false) {
				$tmp = explode(".", $this->_user_fds[$fd]);
				$p = "";
				if ($tmp) {
					$p = $user;
					foreach ($tmp as $t) {
					$p = $p[$t];
					}
				}
				$row[$fd] = $p;
				} else {
				$k = $this->_user_fds[$fd];
				switch ($fd) {
					case 'nickname':
					case 'thumbnail_url':
					$row[$fd] = $user[$k];
					break;
				}
				}
			}
			$row[uid] = $user[uid];
			$ret[$row[uid]] = $row;
			}
		} else {
			foreach ($result as $id) {
			if (!$id)
				continue;

			$ret[$id] = $id;
			}
		}
		return $ret;
    }

    public function feed($title = "", $content = "", $imgs = "") {
		return false;
    }

    public function invite($to_uid = 0, $content = "") {
		return false;
    }
/*
 * used to judge whether someone is fan
 */
	public function isfan() {
		if (!$this->_user[uid])
		{
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$method = "pages.isFan";
		$params['uid'] = $this->_user[uid];
		$params['format'] = $this->format;
		$result = $this->post_request($method, $params);

		if (!is_array($result) || isset($result['error_code']) && $result['error_code'] > 0) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}
		$this->set_err(0, "");

		return intval($result["result"]);
    }

	public function becomefan() {
		if (!$this->_user[uid])
		{
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$method = "pages.becomeFan";
		$params['page_id'] = "699148503";
		$result = $this->post_request($method, $params);

		if (!is_array($result) || isset($result['error_code']) && $result['error_code'] > 0) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}
		$this->set_err(0, "");

		return intval($result["result"]);
    }

	public function regOrder($orderid = 0, $amount = 0, $ordername = "") {
		if (!$this->_user[uid])
		{
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$method = "pay.regOrder";
		//$method = "pay4Test.regOrder";
		$params['order_id'] = $orderid;
		$params['amount'] = $amount; //0-100，校内豆消费数额
		$params['desc'] = $ordername;
		$params['type'] = 0;
		$params['format'] = $this->format;
		$result = $this->post_request($method, $params);

		if (!is_array($result) || isset($result['error_code']) && $result['error_code'] > 0) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}
		$this->set_err(0, "");

		return $result["token"];
    }

	public function orderstat($orderid = 0) {
		if (!$this->_user[uid])
		{
			$this->set_err(101, "Get paras err.");
			return false;
		}

		$method = "pay.isCompleted";
		$params['order_id'] = $orderid;
		$result = $this->post_request($method, $params);

		if (!is_array($result) || isset($result['error_code']) && $result['error_code'] > 0) {
			$this->set_err(104, print_r($result, 1));
			return false;
		}
		$this->set_err(0, "");

		return $result["result"];
    }

}

?>
