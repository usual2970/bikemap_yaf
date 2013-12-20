<?php

class Sns_Kra {

    private $ver = "1.0.0.2";
    private $_sns = false;
    private $_api_key = "";
    private $_api_secret = "";
    private $_avail_sns = array(
	'taobao' => 'Taobao',
	'qzone' => 'Tencent',
	'renren' => 'Renren',
	'qq'=>'Qq',
	'sina'=>'Sina',
	'baidu'=>'Baidu'
    );

    public function __construct($sns = "", $api_key = "", $api_secret = "", $addtions = array()) {
	if (array_key_exists($sns, $this->_avail_sns)) {
		$class="Sns_".$this->_avail_sns[$sns];
	    $this->_api_key = $api_key;
	    $this->_api_secret = $api_secret;
		$this->_sns = new $class($this->_api_key, $this->_api_secret);
	}
    }

    public function __call($method, $args) {
	if (!method_exists($this->_sns, $method))
	    die("unknown method [$method]");

	return call_user_func_array(array($this->_sns, $method), $args);
    }

    public function __destruct() {
	$this->_sns = false;
    }

    public function me($fields = array()) {
	if (!$this->_sns)
	    return false;

	if (method_exists($this->_sns, "me"))
	    return $this->_sns->me($fields);
	else
	    return false;
    }

    public function friends($page = 1, $pagesize = 20, $hasapp = 1, $fullinfo = false) {
	if (!$this->_sns)
	    return false;

	if (method_exists($this->_sns, "friends"))
	    return $this->_sns->friends($page, $pagesize, $hasapp, $fullinfo);
	else
	    return false;
    }

    public function feed($title = "", $content = "", $imgs = "") {
	if (!$this->_sns)
	    return false;

	if (method_exists($this->_sns, "feed"))
	    return $this->_sns->feed($title, $content, $imgs);
	else
	    return false;
    }

    public function invite($to_uid = 0, $content = "") {
	if (!$this->_sns)
	    return false;

	if (method_exists($this->_sns, "invite"))
	    return $this->_sns->invite($to_uid, $content);
	else
	    return false;
    }

	/*
	 *兑换淘金币
	 */
	public function coinsconsume($coins_count){
		if(!$this->_sns){
			return false;
		}
		
		if(method_exists($this->_sns,"coinsconsume")){
			return $this->_sns->coinsconsume($coins_count);
		}
		else{
			return false;
		}
	}

	/*
	 *查看淘金币数是量
	 */
	public function coinssum(){
		if(!$this->_sns){
			return false;
		}
		
		if(method_exists($this->_sns,"coinssum")){
			return $this->_sns->coinssum();
		}
		else{
			return false;
		}
	}
    public function has_err() {
	return $this->_sns->has_err();
    }

    public function err_str() {
	return $this->_sns->err_str();
    }

}

?>