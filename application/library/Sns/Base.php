<?php

class Sns_Base {

    protected $_rest_url = "";
    protected $_api_key = "";
    protected $_api_secret = "";
    protected $_session_key = "";
    protected $_user = "";
    protected $_ecode = 0;
    protected $_estr = "";

    public function __construct() {
	
    }

    public function __destruct() {
	
    }

    public function has_err() {
	return $this->_ecode ? true : false;
    }

    public function err_str() {
	return $this->_estr;
    }

    protected function set_err($ecode = 0, $estr = "") {
	$this->_ecode = $ecode;
	$this->_estr .= $estr ? $estr . "<br />\n" : "";
    }

    protected function post_request($method, $params, $posttype = "post", $url_addtion = "", $parseres = 1, $upload = 0) {
	if (!$this->_session_key) {
	    $this->set_err(1002, "No seesion key found.");
	    return false;
	}
	if ($upload)
	    $post_string = $params;
	else
	    $post_string = $this->create_post_string($method, $params);

	$url = $this->_rest_url . $url_addtion;
	if ($post_string === false) {
	    $this->set_err(1003, "No REST Method found.");
	    return false;
	}
	if ($parseres) {
	    $r = $this->parse_result($this->httpRequest($url, $post_string, $posttype, 1, 4, $err, $upload));
	    return $r;
	} else {
	    return $this->httpRequest($url, $post_string, $posttype, 1, 4, $err, $upload);
	}
    }

    protected function httpRequest($url, $post_string, $method = "post", $connectTimeout = 1, $readTimeout = 4, &$arrError = null, $upload = 0) {
	$method = strtolower($method);
	if ($method == "get")
	    $url = $url . "?" . $post_string;
	$result = "";
	if (function_exists('curl_init')) {
	    $timeout = $connectTimeout + $readTimeout;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
		if(defined("ONPROXY")){
			if (ONPROXY) {
				curl_setopt($ch, CURLOPT_PROXY, '192.168.1.200:18118');
			}
		}
	    
	    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
	    //curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
	    if ($method == "post") {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
	    }
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'API PHP5 Client (curl) ' . phpversion());
	    $result = curl_exec($ch);
	    curl_close($ch);
	} else {
	    // Non-CURL based version...
	    if ($upload)
		$result = false;
	    else
		$result = $this->socketPost($url, $post_string, $method, $connectTimeout, $readTimeout);
	}
	return $result;
    }

    /**
     * http post
     */
    private function socketPost($url, $post_string, $method="post", $connectTimeout=1, $readTimeout=2) {
	$urlInfo = parse_url($url);
	$urlInfo["path"] = ($urlInfo["path"] == "" ? "/" : $urlInfo["path"]);
	$urlInfo["port"] = ($urlInfo["port"] == "" ? 80 : $urlInfo["port"]);
	$hostIp = gethostbyname($urlInfo["host"]);

	$urlInfo["request"] = $urlInfo["path"] .
		(empty($urlInfo["query"]) ? "" : "?" . $urlInfo["query"]) .
		(empty($urlInfo["fragment"]) ? "" : "#" . $urlInfo["fragment"]);

	$fsock = fsockopen($hostIp, $urlInfo["port"], $errno, $errstr, $connectTimeout);
	if (false == $fsock) {
	    return false;
	}
	if ($method == "get") {
	    $post_string = "";
	}
	/* begin send data */
	$in = "POST " . $urlInfo["request"] . " HTTP/1.0\r\n";
	$in .= "Accept: */*\r\n";
	$in .= "User-Agent: API PHP5 Client (non-curl)\r\n";
	$in .= "Host: " . $urlInfo["host"] . "\r\n";
	$in .= "Content-type: application/x-www-form-urlencoded\r\n";
	$in .= "Content-Length: " . strlen($post_string) . "\r\n";
	$in .= "Connection: Close\r\n\r\n";
	$in .= $post_string . "\r\n\r\n";

	stream_set_timeout($fsock, $readTimeout);
	if (!fwrite($fsock, $in, strlen($in))) {
	    fclose($fsock);
	    return false;
	}
	unset($in);

	//process response
	$out = "";
	stream_set_timeout($fsock, $readTimeout);
	while ($buff = fgets($fsock, 4096)) {
	    $out .= $buff;
	}
	//finish socket
	fclose($fsock);
	$pos = strpos($out, "\r\n\r\n");
	$head = substr($out, 0, $pos);  //http head
	$status = substr($head, 0, strpos($head, "\r\n"));  //http status line
	$body = substr($out, $pos + 4, strlen($out) - ($pos + 4));  //page body
	if (preg_match("/^HTTP\/\d\.\d\s([\d]+)\s.*$/", $status, $matches)) {
	    if (intval($matches[1]) / 100 == 2) {//return http get body
		return $body;
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }

}

?>
