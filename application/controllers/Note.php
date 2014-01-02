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
}
