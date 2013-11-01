<?php
class Sns_Qq extends Sns_Base{
	public function __construct($api_key = "", $api_secret = "") {
		$this->_api_key = $api_key;
		$this->_api_secret = $api_secret;
		$this->_rest_url = 'https://graph.qq.com/';

		$this->get_paras();
    }

    public function __destruct() {
	
    }


    protected function get_paras(){
    	if ($sess=Yaf_Registry::get("sess"))
		{
			$this->_session_key = $sess["access_token"];
	    	Funs_Base::set_cookie("ssid", $this->_session_key);
	    	$this->_user=$sess["openid"];
	    	Funs_Base::set_cookie("suid", base64_encode($this->_user));
	    	Funs_Base::set_cookie("sns", base64_encode("qq"));
		} elseif ($_COOKIE['ssid']) {
			$this->_session_key = $_COOKIE['ssid'];
			$this->_user = base64_decode($_COOKIE['suid']);
		}
    }
	protected function create_post_string($method, $params) {
		$this->_rest_url.=$method;
		return http_build_query($params);
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

    function get_user_info(){
    	$method="user/get_user_info";
    	$params=array(
    		"oauth_consumer_key"=>$this->_api_key,
    		"access_token"=>$this->_session_key,
    		"openid"=>$this->_user
    	);

    	return $this->post_request($method,$params,"get");

    }
}