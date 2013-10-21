<?php
class BloginfoModel extends Orm_Base{
	public $table = 'bloginfo';
	public $field = array(
		'id' => array('type' => "int(10) unsigned", 'comment' => '外键'),
		'content' => array('type' => "text", 'comment' => '内容'),
	);
	public $pk = 'id';
}