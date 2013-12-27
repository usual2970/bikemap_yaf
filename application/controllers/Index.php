<?php
class IndexController extends Ctrl_Base {
	public function indexAction($name = "Stranger") {
		$art_obj=new ArticleModel();
		$rs=$art_obj->field("jt_article.id,jt_article.content,jt_article.title,jt_article.descript,jt_article.imgs,jt_user.user_name,jt_user.avatar,jt_article.comment,jt_article.like")
					->join("jt_user","jt_article.user_id=jt_user.id","left")
					->order("jt_article.id desc")
					->limit("0,20")
					->fList();
		$this->assign("arts",$rs);
        $this->display("index");
	}

	public function logregAction(){
		$this->display("logreg");
		return TRUE;
	}
}
