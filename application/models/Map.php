<?php
class MapModel extends Orm_Base{
	public $table="jt_map";
	public $field=array(
		"id"=>array("type"=>"int(10)","comment"=>"null"),
		"user_id"=>array("type"=>"int(10)","comment"=>"null"),
		"name"=>array("type"=>"char(255)","comment"=>"null"),
		"add_time"=>array("type"=>"int(10)","comment"=>"null"),
		"path"=>array("type"=>"blob","comment"=>"null"),
		"pass"=>array("type"=>"blob","comment"=>"null"),
		"landmark"=>array("type"=>"blob","comment"=>"null")
	);

	public $pk="id";
}