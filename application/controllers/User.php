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
		//判断用户是否注册过
		$user_obj=new UserModel();
		$rs=$user_obj->where("sns_id='{$user_info['id']}' and sns='sina'")->fRow();
		if(empty($rs)){
			$data=array(
				"user_name"=>$user_info["screen_name"],
				"sns_id"=>$user_info["idstr"],
				"sns"=>"sina",
				"gender"=>$user_info["gender"],
				"sns_profile"=>$user_info["profile_url"],
				"avatar"=>$user_info["avatar_hd"],
				"address"=>$user_info["location"],
				"create_time"=>time()
			);
			$user_obj->save($data);
			
		}
		else{
			$this->_set_session($rs);
		}
		$this->display("sinacode");
	}

	public function logregAction(){
		$this->display("logreg");
	}

	public function _set_session($data){
		foreach($data as $k=>$v){
			$_SESSION[$k]=$v;
		}
	}

	public function logout(){
		session_destroy();
		$this->redirect("/");
	}
}
