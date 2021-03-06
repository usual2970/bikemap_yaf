<?php
/**
 * @name Bootstrap
 * @author root
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract{

    public function _initConfig() {
    error_reporting(0);
		//把配置保存起来
		$arrConfig = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $arrConfig);
	}
	public function _initSession(Yaf_Dispatcher $dispatcher){
		//$conf=Yaf_Registry::get("config")->get("session")->memcache->toArray();
		$sess_id=isset($_REQUEST["jt_id"])?$_REQUEST["jt_id"]:"";
		if($sess_id) session_id($sess_id);
		session_start();
		// $sess=new Session_Memcache( $conf["dns"],$conf["name"],$sess_id);
		// $sess->my_session_start();
		Yaf_Registry::set('session_id', $sess_id);
	}
	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
		//注册一个插件
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initSmarty(Yaf_Dispatcher $dispatcher){
		$conf=Yaf_Registry::get("config")->get("smarty")->toArray();
		$view= new Smarty_Adapter(null, $conf);
	    Yaf_Dispatcher::getInstance()->setView($view);
	    Yaf_Dispatcher::getInstance()->disableView();
	}

	

	public function _initRoute(Yaf_Dispatcher $dispatcher) {
		 $router = Yaf_Dispatcher::getInstance()->getRouter();
         $router->addConfig(Yaf_Registry::get("config")->routes);
	}
	
	public function _initView(Yaf_Dispatcher $dispatcher){
		//在这里注册自己的view控制器，例如smarty,firekylin
	}
}
