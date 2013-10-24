<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends Ctrl_Base {

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/sample/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction($name = "Stranger") {
		//var_dump($this);exit();
		//4. render by Yaf, 如果这里返回FALSE, Yaf将不会调用自动视图引擎Render模板

        $this->display("index");
	}

	public function logregAction(){
		$this->display("logreg");
		return TRUE;
	}
}
