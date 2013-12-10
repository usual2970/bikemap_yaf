<?php
class ImgModel extends Orm_Base{
	public $table="jt_img";
	public $field=array(
		"id"=>array("type"=>"int(10)","comment"=>"null"),
		"user_id"=>array("type"=>"int(10)","comment"=>"null"),
		"img_big"=>array("type"=>"char(30)","comment"=>"null"),
		"img_mid"=>array("type"=>"char(40)","comment"=>"null"),
		"img_sml"=>array("type"=>"char(12)","comment"=>"null"),
		"add_time"=>array("type"=>"int(10)","comment"=>"null"),
		"line_id"=>array("type"=>"int(10)","comment"=>"null"),
		"img_name"=>array("type"=>"char(50)","comment"=>"null"),
		"size"=>array("type"=>"int(10)","comment"=>"null")
	);

	public $pk="id";
}