<?php
class Cache_Memcache{
	private static $instance=array();

	function __construct(){
	}
	
	static function &instance($pConfig = 'session'){
		if(!self::$instance){
			$tCC = Yaf_Registry::get("config")->cache->$pConfig->toArray();
			$mc=new Memcache;

			self::$instance = $mem->connect($tCC["host"],$tCC["port"]);
		}
		return self::$instance;
	}
}

?>