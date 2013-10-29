<?php
class UserModel extends Orm_Base{
	public $table="jt_user";
	public $field=array(
		"id"=>array("type"=>"int(10)","comment"=>"null"),
		"user_name"=>array("type"=>"char(30)","comment"=>"null"),
		"password"=>array("type"=>"char(30)","comment"=>"null"),
		"email"=>array("type"=>"char(40)","comment"=>"null"),
		"mobile"=>array("type"=>"char(12)","comment"=>"null"),
		"gender"=>array("type"=>"enum('w','m')","comment"=>"null"),
		"age"=>array("type"=>"tinyint(3)","comment"=>"null"),
		"address"=>array("type"=>"char(255)","comment"=>"null"),
		"avatar"=>array("type"=>"char(255)","comment"=>"null"),
		"sns_id"=>array("type"=>"char(20)","comment"=>"null"),
		"sns"=>array("type"=>"char(10)","comment"=>"null"),
		"sns_profile"=>array("type"=>"char(100)","comment"=>"null"),
		"create_time"=>array("type"=>"int(10)","comment"=>"null"),
		"actived"=>array("type"=>"tinyint(1)","comment"=>"null"),
		"instruct"=>array("type"=>"char(255)","comment"=>"null"),
		"industry"=>array("type"=>"char(30)","comment"=>"null"),
		"real_name"=>array("type"=>"char(50)","comment"=>"null")
	);

	public $pk="id";
}