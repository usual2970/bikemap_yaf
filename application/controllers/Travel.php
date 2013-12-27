<?php
class TravelController extends Ctrl_Base {
	public function indexAction() {
		$page=intval($this->getQuery("page"));
		if(!$page) $page=1;
		$page_rows=10;
		$start=($page-1)*$page_rows;
		$art_obj=new ArticleModel();

		$user_id=$_SESSION["id"];

		$rows=$art_obj->where("user_id={$user_id}")->count();
		$page=new Page_Base($rows,$page_rows);
		$page_str=$page->str();

		$this->assign("page_str",$page_str);

		$arts=$art_obj
				->field("jt_article.id,jt_article.title,jt_article.user_id,jt_article.add_time,jt_article.tags,jt_map.name,jt_map.id as line_id")
				->join("jt_map", "jt_map.id=jt_article.map_id", "left")
				->where("jt_article.user_id={$user_id}")
				->order("id desc")
				->limit("{$start},{$page_rows}")
				->fList();

		$this->assign("arts",$arts);

        $this->display("index");
	}


	public function addAction(){
		if($this->getRequest()->method=="POST"){
			extract($_POST);
			if(!$title ||!$content){
				exit("标题或内容为空");
			}
			if(!$desc){
				$pure_text=preg_replace("/\<.+?\>/i","", $content);
				$desc=substr($pure_text, 0,360);
			}
			preg_match_all("/\<img.*?src=\"(.*?)\".*?\>/i", $content, $matches);
			if($matches){
				$imgs=implode(",", $matches[1]);
			}

			$content=preg_replace("/<script.+?\/script>/", "", $content);

			$data=array(
				"title"=>$title,
				"map_id"=>$map_id,
				"content"=>mysql_real_escape_string($content),
				"tags"=>$tags,
				"`desc`"=>$desc,
				"imgs"=>$imgs,
				"add_time"=>time(),
				"`status`"=>0,
				"user_id"=>$_SESSION["id"]
			);
			$art_obj=new ArticleModel();
			$rs=$art_obj->save($data);
			if($rs){
				$this->redirect("/travel");
				exit();
			}
			else{
				exit("保存失败");
			}
			
			
		}
		$map_obj=new MapModel();
        $user_id=$_SESSION["id"];
        $map=$map_obj->where("user_id={$user_id}")->order("id desc")->fList();
        $this->assign("maps",$map);
		$this->display("add");
	}

	public function editAction(){
		$id=$this->getParam("id");
		$user_id=$_SESSION["id"];
		if(!$id) exit("参数有误");
		if($this->getRequest()->method=="POST"){
			extract($_POST);
			if(!$title ||!$content){
				exit("标题或内容为空");
			}
			if(!$desc){
				$pure_text=preg_replace("/\<.+?\>/i","", $content);
				$desc=substr($pure_text, 0,360);
			}
			preg_match_all("/\<img.*?src=\"(.*?)\".*?\>/i", $content, $matches);
			if($matches){
				$imgs=implode(",", $matches[1]);
			}

			$content=preg_replace("/<script.+?\/script>/", "", $content);

			$data=array(
				"title"=>$title,
				"map_id"=>$map_id,
				"content"=>mysql_real_escape_string($content),
				"tags"=>$tags,
				"`desc`"=>$desc,
				"imgs"=>$imgs,
				"edit_time"=>time(),
				"`status`"=>0,
				"user_id"=>$_SESSION["id"]
			);
			$art_obj=new ArticleModel();
			$rs=$art_obj->where("id={$id} and user_id={$user_id}")->update($data);
			if($rs){
				$this->redirect("/travel");
				exit();
			}
			else{
				exit("保存失败");
			}
		}
		
		$art_obj=new ArticleModel();
		
		$rs=$art_obj->where("user_id={$user_id} and id={$id}")->fRow();
		if(!$rs) exit("游记不存在");
		$this->assign("art",$rs);


		$map_obj=new MapModel();

		$map_obj=new MapModel();
        $map=$map_obj->where("user_id={$user_id}")->order("id desc")->fList();
        $this->assign("maps",$map);
		$this->display("edit");
	}

	public function deleteAction(){
		$id=$this->getParam("id");
		$user_id=$_SESSION["id"];
		if(!$id) exit("参数有误");
		$art_obj=new ArticleModel();

		echo $art_obj->where("id={$id} and user_id={$user_id}")->del();

	}
}
