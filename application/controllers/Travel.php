<?php
class TravelController extends Ctrl_Base {
	public function indexAction() {
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

			$content=preg_replace("/<script.+?\/script>", "", $content);

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
}
