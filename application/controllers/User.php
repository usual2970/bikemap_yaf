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
			$this->assign("isreg",0);
			
		}
		elseif(!empty($rs) && !$rs["actived"]){
			$this->assign("isreg",0);
		}
		else{
			$this->assign("isreg",1);
			$this->_set_session($rs);
		}
		$this->display("sinacode");
	}


	function qqcodeAction(){
		$code=$this->getQuery("code");
		var_dump($code);
		$conf=Yaf_Registry::get("config")->get("sns")->get("qq")->toArray();
		$base_uri=$conf["access_url"];
		$conf["code"]=$code;
		unset($conf["access_url"]);
		
		$this->redirect($base_uri."?".http_build_query($conf));
		$rs=Funs_Base::http($base_uri."?".http_build_query($conf));
		var_dump($rs);exit();
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
			$this->assign("isreg",0);
			
		}
		elseif(!empty($rs) && !$rs["actived"]){
			$this->assign("isreg",0);
		}
		else{
			$this->assign("isreg",1);
			$this->_set_session($rs);
		}
		$this->display("sinacode");
	}


	function improveAction(){
		if(!$_COOKIE["suid"]){
			$this->redirect("/user");
			return false;
		}
		$sns_id=base64_decode($_COOKIE["suid"]);
		$sns=base64_decode($_COOKIE["sns"]);
		$user_obj=new UserModel();
		$rs=$user_obj->where("sns_id='{$sns_id}' and sns='sina'")->fRow();
		if($this->getRequest()->isXmlHttpRequest()){
			$req=$this->getRequests();
			extract($req);
			$this->_check_email($email);
			if(!$surname) $this->ajax("随便填写个姓氏吧",1);
			if(!$name) $this->ajax("随便填写个名字吧",1);
			if(!$industry) $this->ajax("随便选择个行业吧",1);
			if(!$instruct) $this->ajax("随便填写个介绍吧",1);
			$rs["email"]=$email;
			$rs["real_name"]=$surname.$name;
			$rs["industry"]=$industry;
			$rs["instruct"]=$instruct;
			$rs["actived"]=1;
			$rs["gender"]=$gender;
			if($ret=$user_obj->where("sns_id='{$sns_id}' and sns='sina'")->update($rs)){
				$this->_set_session($rs);
				$this->ajax("success");
			}
			$this->ajax("完善资料失败，再试一下","1");

		}
		else{

			$this->assign("user_info",$rs);
			$this->display("improve");
		}
		
		
	}

	public function logregAction(){
		$this->display("logreg");
	}

	public function _set_session($data){
		foreach($data as $k=>$v){
			$_SESSION[$k]=$v;
		}
	}

	public function logoutAction(){
		session_destroy();
		$this->redirect("/");
	}

	function _check_email($email){
		if(!$email) $this->ajax("邮箱不能为空",1);
		if(!preg_match("/\w+?\@\w+?\.\w{2,8}/", $email)){
			$this->ajax("邮箱格式不正确",2);
		}
		$user_obj=new UserModel();
		$rs=$user_obj->where("email='{$email}'")->fRow();
		if(!empty($rs)){
			$this->ajax("邮箱已注册过",3);
		}
	}

	function check_emailAction(){

		$email=$this->getQuery("email");
		$this->_check_email($email);
		$this->ajax("success",0);
	}

}
