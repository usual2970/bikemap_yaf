<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class UserController extends Ctrl_Base {

	
	public function regAction(){
		var_dump($this->getRequests());
		return false;
	}
	public function logregAction(){
		return TRUE;
	}
}
