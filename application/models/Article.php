<?php
class ArticleModel extends Orm_Base{
	public $table = 'jt_article';
	public $field = array(
		'id' => array('type' => "int(10) unsigned", 'comment' => '主键'),
		'title' => array('type' => "char(255)", 'comment' => ''),
		'tags' => array('type' => "char(255)", 'comment' => ''),
		'descript' => array('type' => "tinytext", 'comment' => ''),
		'content' => array('type' => "text", 'comment' => ''),
		'author' => array('type' => "char(100)", 'comment' => ''),
		'comment' => array('type' => "int", 'comment' => ''),
		'view' => array('type' => "int", 'comment' => ''),
		'add_time' => array('type' => "int(10)", 'comment' => ''),
		'edit_time' => array('type' => "int(10)", 'comment' => ''),
		'imgs' => array('type' => "tinytext", 'comment' => ''),
		'user_id' => array('type' => "int(10)", 'comment' => ''),
		'state' => array('type' => "tinyint(2)", 'comment' => ''),
		'map_id' => array('type' => "int(10)", 'comment' => ''),
		'like' => array('type' => "int(10)", 'comment' => ''),
	);
	public $pk = 'id';
}