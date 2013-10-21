<?php
class BlogModel extends Orm_Base{
	public $table = 'blog';
	public $field = array(
		'id' => array('type' => "int(10) unsigned", 'comment' => '主键'),
		'subject' => array('type' => "char(60)", 'comment' => '标题'),
		'seot' => array('type' => "char(255)", 'comment' => 'SEO标题'),
		'seok' => array('type' => "char(255)", 'comment' => 'SEO关键词'),
		'seod' => array('type' => "char(255)", 'comment' => 'SEO描述'),
		'created' => array('type' => "int(10) unsigned", 'comment' => '创建时间'),
		'comment' => array('type' => "int(10) unsigned", 'comment' => '评论数'),
		'view' => array('type' => "int(10) unsigned", 'comment' => '查看数'),
	);
	public $pk = 'id';
}