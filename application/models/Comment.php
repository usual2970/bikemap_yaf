<?php
class CommentModel extends Orm_Base{
	public $table = 'comment';
	public $field = array(
		'id' => array('type' => "int(10) unsigned", 'comment' => '主键'),
		'bid' => array('type' => "int(10) unsigned", 'comment' => 'BLOGID'),
		'content' => array('type' => "char(255)", 'comment' => '内容'),
		'created' => array('type' => "int(10) unsigned", 'comment' => '创建时间'),
	);
	public $pk = 'id';
}