<?php
class MaterialController extends Ctrl_Base{
	public function indexAction(){
		var_dump(Yaf_Registry::get('session_id'));
		$this->assign("jt",Yaf_Registry::get('session_id'));
		$this->display("index");
	}

	public function uploadAction(){

        $tempFile = $_FILES['Filedata']['tmp_name'];

        $targetPath=APPLICATION_PATH."/public/img/material/".date("Ymd");
        if(!is_dir($targetPath)) mkdir($targetPath);

        $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
        
        $fileTypes = array('jpg','jpeg','gif','png'); 
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        if (in_array($fileParts['extension'],$fileTypes)) {
            move_uploaded_file($tempFile,$targetFile);
            echo '1';
        } else {
            echo 'Invalid file type.';
        }
	}
}

?>