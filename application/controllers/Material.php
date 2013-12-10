<?php
class MaterialController extends Ctrl_Base{
	public function indexAction(){
		$page=intval($this->getQuery("page"));
		if(!$page) $page=1;
		$page_rows=10;
		$start=($page-1)*$page_rows;
		
		$img_obj=new ImgModel();


		$user_id=$_SESSION["id"];

		$rows=$img_obj->where("user_id={$user_id}")->count();
		$page=new Page_Base($rows,$page_rows);
		$page_str=$page->str();

		$this->assign("page_str",$page_str);

		$img=$img_obj->where("user_id={$user_id}")->order("id desc")->limit("{$start},{$page_rows}")->fList();

		$this->assign("imgs",$img);
		$this->assign("jt",Yaf_Registry::get('session_id'));
		$this->display("index");
	}

	public function uploadAction(){

        $tempFile = $_FILES['Filedata']['tmp_name'];

        $targetPath=APPLICATION_PATH."/public/img/material/".date("Ymd");

        $conf=Yaf_Registry::get("config")->get("site")->toArray();

        $targetUrl=$conf["url"]."/img/material/".date("Ymd"). '/' . $_FILES['Filedata']['name'];;

        if(!is_dir($targetPath)) mkdir($targetPath);

        $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
        
        $fileTypes = array('jpg','jpeg','gif','png'); 
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        if (in_array($fileParts['extension'],$fileTypes)) {
            move_uploaded_file($tempFile,$targetFile);
            $data=array(
            	"user_id"=>$_SESSION["id"],
            	"img_big"=>$targetUrl,
            	"img_mid"=>$targetUrl,
            	"img_sml"=>$targetUrl,
            	"add_time"=>time(),
            	"img_name"=>$_FILES['Filedata']['name'],
            	"size"=>$_FILES['Filedata']["size"]

            );
            $img_obj=new ImgModel();
            $img_obj->save($data);
            echo '1';
        } else {
            echo 'Invalid file type.';
        }
	}
}

?>