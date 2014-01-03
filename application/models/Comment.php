<?php
class CommentModel extends Orm_Base{
	public $table = 'jt_comment';
	public $field = array(
		'id' => array('type' => "int(10) unsigned", 'comment' => '主键'),
		'user_id' => array('type' => "int(10) unsigned", 'comment' => 'user_id'),
		'content' => array('type' => "text", 'comment' => '内容'),
		'add_time' => array('type' => "int(10) unsigned", 'comment' => '创建时间'),
		'article_id'=>array('type' => "int(10) unsigned", 'comment' => ''),
		'parent_id'=>array('type' => "int(10) unsigned", 'comment' => ''),
		'like'=>array('type' => "int(10) unsigned", 'comment' => ''),
	);
	public $pk = 'id';
}
