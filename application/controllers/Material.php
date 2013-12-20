<?php
class MaterialController extends Ctrl_Base{
    //图片列表
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
    //上传图片
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
    //删除图片
    public function delimgAction(){
        $id=$this->getParam("id");
        $img_obj=new ImgModel();
        echo $img_obj->where("id={$id}")->del();

    }

    //保存图片
    public function saveimgAction(){
        header('Content-type: image/jpeg');
        
        $img_obj=new ImgModel();
        $id=$this->getParam("id");
        $rs=$img_obj->where("id={$id}")->fRow();

        header("Content-Disposition: attachment; filename={$rs['img_name']}");

        @readfile($rs["img_big"]);
    }

    //路线列表
    public function mapAction(){
        $this->display("map");
    }
    //新增路线
    public function addlineAction(){
        $ip=Funs_Base::real_ip();
        $conf=Yaf_Registry::get("config")->get("sns")->get("baidu")->toArray();
        $sns=new Sns_Kra("baidu",$conf["ak"],$conf["sn"]);
        $location=$sns->get_location_by_ip($ip);
        $point=array();
        if($location["status"]!=0){
            $point=array("x"=>"120.21937542","y"=>"30.25924446");
        }
        else{
            $point=$location["content"]["point"];
        }
        $this->assign("point",json_encode($point));
        $this->display("addline");
    }

    //获得建议数据
    public function sugplaceAction(){
        $key=isset($_GET["kw"])?trim($_GET["kw"]):false;
        if(!$key) $this->ajax("no param",1);
        $conf=Yaf_Registry::get("config")->get("sns")->get("baidu")->toArray();
        $sns=new Sns_Kra("baidu",$conf["ak"],$conf["sn"]);
        $this->ajax("ok",0,$sns->get_suggest_place($key));
    }
}

?>