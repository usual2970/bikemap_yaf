<?php
class NoteController extends Ctrl_Base {

	public function indexAction(){
		$id=$this->getParam("id");
		$art_obj=new ArticleModel();
		$art=$art_obj->where("jt_article.id={$id}")
					->field("jt_article.title,jt_article.user_id,jt_article.content,jt_user.avatar")
					->join("jt_user","jt_article.user_id=jt_user.id","left")
					->fRow();
		$this->assign("art",$art);
		$this->display("note");
	}

	public function commentAction(){
		$id=isset($_POST["id"])?intval($_POST["id"]):false;
		$content=isset($_POST["content"])?trim($_POST["content"]):false;
		if(!$id || !$content) $this->ajax("参数有误，请重试",1);
		$comm_ojb=new CommentModel();
		$art_obj=new ArticleModel();
		$data=array(
			"user_id"=>$_SESSION["id"],
			"add_time"=>time(),
			"content"=>$content,
			"article_id"=>$id,
		);
		$rs=$comm_ojb->save($data);
		$art_obj->where("id={$id}")->addField(array(
			"comment"=>1
		));
		if(!$rs) $this->ajax("添加评论失败，请重试",2);
		$this->ajax("添加评论成功");
	}

	public function getcommAction(){
		$id=$this->getParam("id");
		$comm_obj=new CommentModel();
		$rs=$comm_obj->field("jt_comment.id,jt_comment.like,jt_comment.content,jt_user.avatar,jt_user.user_name,from_unixtime(jt_comment.add_time) as add_time")
			->join("jt_user","jt_comment.user_id=jt_user.id","left")
			->where("article_id={$id}")
			->limit("0,10")->fList();
		$this->ajax("success",0,$rs);
	}
}
