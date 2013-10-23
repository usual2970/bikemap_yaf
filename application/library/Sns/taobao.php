<?php

require_once("kra_base.php");

class taobao extends kra_base {

    private $format = 'json';
    private $_user_fds = array(
	'uid' => 'uid',
	'nickname' => 'nick',
	'gender' => 'sex',
	'thumbnail_url' => 'icons.icon_60'
    );

    public function __construct($api_key = "", $api_secret = "") {
	$this->_api_key = $api_key;
	$this->_api_secret = $api_secret;
	//$this->_rest_url = 'http://gw.api.tbsandbox.com/router/rest';
	$this->_rest_url = 'http://gw.api.taobao.com/router/rest';

	$this->get_paras();
    }

    public function __destruct() {
	
    }

    private function get_paras() {
		if ($_REQUEST['top_session'])
		{
			$this->_session_key = $_REQUEST['top_session'];
	    	set_cookie("ssid", $this->_session_key);
		} elseif ($_COOKIE['ssid']) {
			$this->_session_key = $_COOKIE['ssid'];
		}

		$_REQUEST['top_parameters'] = $_REQUEST['top_parameters'] ? $_REQUEST['top_parameters'] : ($_COOKIE['sspara'] ? $_COOKIE['sspara']: "");

		if ($_REQUEST['top_parameters']) {
			$top_parameters = base64_decode(rawurldecode($_REQUEST['top_parameters']));
			parse_str($top_parameters, $arr_params);
			if (is_array($arr_params)) {
			if ($arr_params['visitor_id']) {
				$this->_user[uid] = $arr_params['visitor_id'];
				$this->_user[nickname] = $arr_params['visitor_nick'];
	    		set_cookie("sspara", $_REQUEST['top_parameters']);
			}
			}
		}
    }

    protected function create_post_string($method, $params) {
	$params['app_key'] = $this->_api_key;
	$params['method'] = $method;
	$params['sign_method'] = "md5";
	$params['session'] = $this->_session_key;
	$params['timestamp'] = date('Y-m-d H:i:s');
	$params['format'] = $this->format;
	if (!isset($params['v'])) {
	    $params['v'] = '2.0';
	}
	$post_params = array();
	foreach ($params as $key => &$val) {
	    if (is_array($val))
		$val = implode(',', $val);
	    $post_params[] = $key . '=' . urlencode($val);
	}
	$post_params[] = 'sign=' . $this->generate_sig($params);
	return implode('&', $post_params);
    }

    private function generate_sig($params_array) {
	$app_secret = $this->_api_secret;
	$sign = $app_secret;
	ksort($params_array);
	foreach ($params_array as $key => $val) {
	    if ($key != '' && $val != '') {
		$sign .= $key . $val;
	    }
	}
	$sign .= $app_secret;
	$sign = strtoupper(md5($sign));
	return $sign;
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

	function request_permissions($callback_url = "") {
		header("Location: {$callback_url}");
		exit();
    }

	public function get_uid() {
		return $this->_user[uid];
	}

    public function me($field = array()) {
	if (!$this->_user[uid]) {
	    $this->set_err(101, "Get paras err.");
	    return false;
	}

	//taobao临时测试
	//return array("nickname" => $this->_user[nickname], "thumbnail_url" => "", "gender" => "", "age" => "");

	$field = $field ? $field : array_keys($this->_user_fds);

	$method = "taobao.jianghu.user.getProfile";
	$params['query_uid'] = $this->_user[uid];
	$result = $this->post_request($method, $params);

	if (!is_array($result['user_getProfile_response']['user'])) {
	    if ($result['error_response']['code'] == 27) {
		$this->set_err(103, "Login expired.");
		return false;
	    }

	    $this->set_err(104, print_r($result, 1));
	    return false;
	}
	$this->set_err(0, "");
	$result = $result['user_getProfile_response']['user'];
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
	    }
	    else
		$ret[$fd] = $result[$this->_user_fds[$fd]];
	}
	return $ret;
    }

    public function friends($page = 1, $pagesize = 20, $hasapp = 0, $fullinfo = 0) {
	if (!$this->_user[uid]) {
	    $this->set_err(101, "Get paras err.");
	    return false;
	}

	$page = intval($page);
	$page = $page ? $page : 1;
	$pagesize = intval($pagesize);
	$pagesize = $pagesize ? $pagesize : 20;

	$method = "taobao.jianghu.friends.getFriendList";
	$params['page_no'] = $page;
	$params['page_size'] = $pagesize;
	$result = $this->post_request($method, $params);

	if (!is_array($result['friends_getFriendList_response']['user'])) {
	    if ($result['error_response']['code'] == 27) {
		$this->set_err(103, "Login expired.");
		return false;
	    }

	    $this->set_err(104, print_r($result, 1));
	    return false;
	}
	$this->set_err(0, "");
	if (!$result['friends_getFriendList_response']['user'])
	    return array();

	$ret = array();
	if ($fullinfo) {
	    foreach ($result['friends_getFriendList_response']['user'] as $user) {
		$uidk = $this->_user_fds[uid];
		$uid = $user[$uidk];
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
			    case 'gender':
				$row[$fd] = $user[$k] ? "FEMALE" : "MALE";
				break;
			    default:
				$row[$fd] = $user[$k];
				break;
			}
		    }
		}
		$ret[$row[uid]] = $row;
	    }
	} else {
	    foreach ($result['friends_getFriendList_response']['user'] as $user) {
		$uidk = $this->_user_fds[uid];
		$uid = $user[$uidk];
		if (!$uid)
		    continue;

		$ret[$uid] = $uid;
	    }
	}
	return $ret;
    }

    public function feed($title = "", $content = "", $imgs = "")
	{
		$title_url = "";
		if (preg_match("/href=['\"]*([^ '\"]+)['\"]*[^>]*>([^<]+)</i", $title, $p))
		{
			$title_url = $p[1];
			$title = $p[2];
		}

		if (!$title || !$content && !$imgs) return false;

		$method = "taobao.jianghu.feed.publish";
		$params['title'] = $title;
		if ($title_url)
			$params['title_link'] = $title_url;
		if ($content)
			$params['body'] = $content;
		if ($imgs)
			$params['medias'] = $imgs;

		$result = $this->post_request($method, $params);

		if ($result['feed_publish_response'])
			return true;
		else
			return false;
    }

    public function invite($to_uid = 0, $content = "") {
	$method = "taobao.jianghu.msg.publish";
	$params['type'] = 1;
	$params['content'] = $content;
	$params['to_uid'] = $to_uid;

	$result = $this->post_request($method, $params);

	if ($result['msg_publish_response'])
	    return true;
	else
	    return false;
    }
	
	/*
	 *兑换淘金币		
	 */
	public function coinsconsume($coins_count){
		$method="taobao.jianghu.coins.consume";
		$params['coin_count']=$coins_count;
		$result=$this->post_request($method,$params);
		if($result['coins_consume_response']){
			return true;
		}
		else{
			return false;
		}
	}


	/*
	 *查看个人淘金币数
	 */
	public function coinssum(){
		$method="taobao.jianghu.coins.sum";
		$result=$this->post_request($method,$params);
		if($result['coins_sum_response']['sum']){
			return $result['coins_sum_response']['sum'];
		}
		else{
			return false;
		}
	}


	public function isfan() { return true; }

	public function becomefan() { return true; }

	public function regOrder($orderid = 0, $amount = 0, $ordername = "", $goodid = 0, $ordertm = 0)
	{
		//alipayid=780483631   proxycode=TJH_PEANSUN_GZYAR
		//http://tb-sndwarfs.peansun.com/tbpay_callback.php
		$method = "taobao.vas.isv.url.get";
		$params['item_id'] = $goodid;
		$params['item_version_id'] = 1;
		$params['total_price'] = $amount;
		$params['item_name'] = $ordername;
		$params['item_version_name'] = 1;
		$params['page_ret_url'] = PHP_ROOTURL . "tbpay_callback.php?";
		$params['proxy_code'] = "TJH_PEANSUN_GZYAR";
		$params['outer_order_id'] = $orderid;
		$params['buyer_time'] = $ordertm;
		$params['description'] = $ordername;
		$params['alipay_id'] = "780483631";

		$params['api_key'] = $this->_api_key;
		$params['format'] = $this->format;
		$params['v'] = '2.0';
		$params['timestamp'] = date('Y-m-d H:i:s');
		//$params['nick'] = "";
		$params['sign_method'] = "md5";
		$params['session'] = $this->_session_key;
		

		$result = $this->post_request($method, $params);

		/*
		array(1) {
		  ["vas_isv_url_get_response"]=>
		  array(1) {
			["vas_isv_url"]=>
			array(7) {
			  ["aplipay_isv_address"]=>
			  string(758) "https://tbapi.alipay.com/cooperate/gateway.do?agent=2088001467605498&body=%B6%A9%B5%A5%B1%E0%BA%C5%3A2011102832553054%2C%B6%A9%B5%A5%C3%FB%B3%C6%3Amymall+%B3%E4%D6%B5&buyer_email=ranbo1982%40163.com&notify_url=http%3A%2F%2Fpay.taobao.com%2Fsale%2Falipay%2FalipayNotify.do&out_trade_no=2011102832553054&partner=2088001467605498&payment_type=2&return_url=http%3A%2F%2Fpay.taobao.com%2Fisv%2FnotifyIsvInfo.do%3Forder_id%3D339009077%26pageret_url%3Dhttp%253A%252F%252Ftb-sndwarfs.peansun.com%252Ftbpay_callback.php&seller_email=paycenter%40taobao.com&service=create_direct_pay_by_user&subject=%B6%A9%B5%A5%BD%C9%B7%D1%3Amymall+%B3%E4%D6%B5&total_fee=0.10&sign_type=DSA&sign=_j_cy_z_x4_ki4_g_qabdy_e_mxe_ta_k_m_w_x_j_ej_pz_grt2cy4_m_r_d_i_i4_mvyz_s_d_tu_i3g%3D%3D"
			  ["message"]=>
			  string(36) "金额不足，请用支付宝支付"
			  ["order_id"]=>
			  string(9) "339009077"
			  ["outer_order_id"]=>
			  string(2) "48"
			  ["proxy_code"]=>
			  string(17) "TJH_PEANSUN_GZYAR"
			  ["sign_time"]=>
			  string(19) "1326-03-30 00:00:00"
			  ["status"]=>
			  int(2)
			}
		  }
		}
		*/
		if (!$result['vas_isv_url_get_response']) return false;

		$ret = false;
		if(intval($result['vas_isv_url_get_response']["vas_isv_url"]["status"]) == 2 && $result['vas_isv_url_get_response']["vas_isv_url"]["aplipay_isv_address"])
		{
			$ret = array();
			$ret["url"] = $result['vas_isv_url_get_response']["vas_isv_url"]["aplipay_isv_address"];
			$ret["tb_order_id"] = $result['vas_isv_url_get_response']["vas_isv_url"]["order_id"];
			$ret["order_id"] = $result['vas_isv_url_get_response']["vas_isv_url"]["outer_order_id"];
		}
		elseif(intval($result['vas_isv_url_get_response']["status"]) == 1)
		{
			$ret = array();
			$ret["tb_order_id"] = $result['vas_isv_url_get_response']["order_id"];
			$ret["order_id"] = $result['vas_isv_url_get_response']["outer_order_id"];
		}

		return $ret;
	}

}

?>
