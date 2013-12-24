<?php
class Sns_Baidu extends Sns_Base{
	public function __construct($api_key = "",$api_secret="") {
		$this->_api_key = $api_key;
		$this->_rest_url = 'http://api.map.baidu.com/';
        $this->_api_secret=$api_secret;
		$this->get_paras();
    }

    public function __destruct() {
	
    }


    protected function get_paras(){
        $this->_session_key="baidu";
    	return;
    }
	protected function create_post_string($method, $params) {
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
    //根据IP地址获取位置信息
    function get_location_by_ip($ip,$coor="bd09ll"){
    	$method="location/ip";
    	$params=array(
    		"ak"=>$this->_api_key,
    		"ip"=>$ip,
    		"coor"=>$coor,
            "sn"=>$this->_api_secret
    	);
    	return $this->post_request($method,$params,"get",$method);
    }
    //根据关键字获得建议位置
    function get_suggest_place($key){
        $method="place/v2/suggestion";
        $params=array(
            "ak"=>$this->_api_key,
            "query"=>$key,
            "region"=>"全国",
            "output"=>"json",
            "sn"=>$this->_api_secret,
            "timestamp"=>md5(time())
        );
        return $this->post_request($method,$params,"get",$method);
    }

    function get_direct($data,$data1){
        $method="direction/v1";
        $params=array(
            "ak"=>$this->_api_key,
            "origin"=>$data["name"],
            "origin_region"=>$data["city"],
            "destination"=>$data1["name"],
            "destination_region"=>$data1["city"],
            "tactics"=>10,
            "output"=>"json",
            "coord_type"=>"bd09ll",
            "sn"=>$this->_api_secret,
            "timestamp"=>md5(time())
        );
        return $this->post_request($method,$params,"get",$method);
    }

}