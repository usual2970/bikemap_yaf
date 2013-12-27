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
     public function getimgsAction(){
        $user_id=$_SESSION["id"];
        $img_obj=new ImgModel();
        $rows=$img_obj->where("user_id={$user_id}")->fList();
        $str="";
        foreach($rows as $k=>$v){
            $str.=$v["img_sml"]."ue_separate_ue";
        }
        echo $str;
    }

    //编辑器上传图片
    public function upimg4ediAction(){
        $site_url="http://www.joneto.com";
        //上传图片框中的描述表单名称，
        $title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
        $path = htmlspecialchars($_POST['dir'], ENT_QUOTES);
        $globalConfig = include( "config.php" );
        $imgSavePathConfig = array(APPLICATION_PATH."/public/img/material");

        //获取存储目录
        if ( isset( $_GET[ 'fetch' ] ) ) {

            header( 'Content-Type: text/javascript' );
            echo 'updateSavePath('. json_encode($imgSavePathConfig) .');';
            return;

        }

        //上传配置
        $config = array(
            "savePath" => $imgSavePathConfig,
            "maxSize" => 1000, //单位KB
            "allowFiles" => array(".gif", ".png", ".jpg", ".jpeg", ".bmp"),
            "fileNameFormat" => $_POST['fileNameFormat']
        );

        if ( empty( $path ) ) {

            $path = $config[ 'savePath' ][ 0 ];

        }

        //上传目录验证
        if ( !in_array( $path, $config[ 'savePath' ] ) ) {
            //非法上传目录
            echo '{"state":"\u975e\u6cd5\u4e0a\u4f20\u76ee\u5f55"}';
            return;
        }

        $config[ 'savePath' ] = $path . '/';

        //生成上传实例对象并完成上传
        $up = new Img_Upload("upfile", $config);

        /**
         * 得到上传文件所对应的各个参数,数组结构
         * array(
         *     "originalName" => "",   //原始文件名
         *     "name" => "",           //新文件名
         *     "url" => "",            //返回的地址
         *     "size" => "",           //文件大小
         *     "type" => "" ,          //文件类型
         *     "state" => ""           //上传状态，上传成功时必须返回"SUCCESS"
         * )
         */
        $info = $up->getFileInfo();

        /**
         * 向浏览器返回数据json数据
         * {
         *   'url'      :'a.jpg',   //保存后的文件路径
         *   'title'    :'hello',   //文件描述，对图片来说在前端会添加到title属性上
         *   'original' :'b.jpg',   //原始文件名
         *   'state'    :'SUCCESS'  //上传状态，成功时返回SUCCESS,其他任何值将原样返回至图片上传框中
         * }
         */
        echo "{'url':'" . $info["url"] . "','title':'" . $title . "','original':'" . $info["originalName"] . "','state':'" . $info["state"] . "'}";
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
        $page=intval($this->getQuery("page"));
        if(!$page) $page=1;
        $page_rows=10;
        $start=($page-1)*$page_rows;
        
        $map_obj=new MapModel();


        $user_id=$_SESSION["id"];

        $rows=$map_obj->where("user_id={$user_id}")->count();
        $page=new Page_Base($rows,$page_rows);
        $page_str=$page->str();

        $this->assign("page_str",$page_str);

        $map=$map_obj->where("user_id={$user_id}")->order("id desc")->limit("{$start},{$page_rows}")->fList();

        $this->assign("map",$map);
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

    //保存路线
    public function savelineAction(){
        extract($_POST);
        $id=$this->getParam("id");
        if(!$name) $this->ajax("路书名称不能为空",1);
        if(!$pass) $this->ajax("起终点及途经地点不能为空",2);
        if(!$path) $this->ajax("请先创建路书",3);

        $data=array(
            "user_id"=>$_SESSION["id"],
            "add_time"=>time(),
            "pass"=>serialize($pass),
            "path"=>serialize($path),
            "name"=>$name,
            "landmark"=>serialize($landmark)
        );
        $map_obj=new MapModel();
        if(!$id){
            $map_obj->save($data);
        }
        else{
            $map_obj->where("id={$id}")->update($data);
        }
        
        
        $this->ajax("ok",0);
    }

    public function editlineAction(){
        $id=$this->getParam("id");
        $map_obj=new MapModel();
        $line=$map_obj->where("id={$id}")->fRow();
        $line["pass"]=unserialize($line["pass"]);
        $line["path"]=unserialize($line["path"]);
        $line["landmark"]=unserialize($line["landmark"]);
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
        $this->assign("jsline",json_encode($line));
        $this->assign("line",$line);
        $this->display("editline");
    }

    public function dellineAction(){
        $id=$this->getParam("id");
        $img_obj=new MapModel();
        echo $img_obj->where("id={$id}")->del();
    }

    //获得建议数据
    public function sugplaceAction(){
        $key=isset($_GET["kw"])?trim($_GET["kw"]):false;
        if(!$key) $this->ajax("no param",1);
        $conf=Yaf_Registry::get("config")->get("sns")->get("baidu")->toArray();
        $sns=new Sns_Kra("baidu",$conf["ak"],$conf["sn"]);
        $this->ajax("ok",0,$sns->get_suggest_place($key));
    }

    //获得规划路线
    function getdirectAction(){
        $data=isset($_GET["data"])?$_GET["data"]:false;
        if(!$data) $this->ajax("no param",1);

        $conf=Yaf_Registry::get("config")->get("sns")->get("baidu")->toArray();
        $sns=new Sns_Kra("baidu",$conf["ak"],$conf["sn"]);
        $rs=array();
        $landmark=array();
        for($i=0;$i<count($data)-1;$i++){
            $temp=$sns->get_direct($data[$i],$data[$i+1]);
            foreach($temp["result"]["routes"][0]["steps"] as $k=>$v){
                $point=explode(",", $v["path"]);
                $rs[]=array("lng"=>$point[0],"lat"=>$point[1]);
                if($v["pois"][0]["name"]){
                    $landmark[]=array("lng"=>$point[0],"lat"=>$point[1],"html"=>$v["pois"][0]["name"],"pauseTime"=>1);
                }
            }
        }
        
        

        $this->ajax("ok",0,array("rs"=>$rs,"landmark"=>$landmark));
    }
}

?>