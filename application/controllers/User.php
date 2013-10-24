<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class UserController extends Ctrl_Base {

	
	public function sinacodeAction(){
		$code=$this->getQuery("code");
		$conf=Yaf_Registry::get("config")->get("sns")->get("sina")->toArray();
		$base_uri=$conf["access_url"];
		$conf["code"]=$code;
		unset($conf["access_url"]);
		$rs=json_decode(Funs_Base::http($base_uri,"POST",http_build_query($conf)),true);
		if(!empty($rs["error"])){
			exit($rs["error"].",".$rs["error_code"]);
		}
		Yaf_Registry::set('sess',$rs);
		$sns=new Sns_Kra("sina",$conf["client_id"],$conf["client_secret"]);
		$user_info=$sns->get_user_info();
		//var_dump($user_info);
		return true;
	}

	public function sinaregAction(){
		var_dump($this->getRequests());
		return false;
	}
	public function logregAction(){
		return TRUE;
	}
}
