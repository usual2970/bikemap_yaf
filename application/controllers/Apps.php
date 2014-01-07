<?php
/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时刻被调用
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author root
 */
class AppsController extends Yaf_Controller_Abstract {

	//从2.1开始, errorAction支持直接通过参数获取异常
	public function xxqqAction() {
		$referer=$referer="http://user.qzone.qq.com/536464346/infocenter";#$_SERVER['HTTP_REFERER'];
		$ip=Funs_Base::real_ip();
		//$referer="http://user.qzone.qq.com/123456/infocenter";
		if(!strpos($referer,'infocenter')){//如果不是从个人中心进来
			header('Location: no.png');
			exit();
		}
		//截取QQ
		$urlArr = explode('/',$referer);
		$qq = $urlArr['3'];
		//用户姓名
		$username = Funs_Base::getQQName($qq);

		//信息位置
		#include 'ip/IpLocation.class.php';
		#$ipClass = new IpLocation('UTFWry.dat');
		#$area = $ipClass->getlocation($ip);
		#$place = str_replace('CZ88.NET','',$area['country'].$area['area']);
		//在线状态
		$QQState = Funs_Base::getQQState($qq);
		$ua = $_SERVER['HTTP_USER_AGENT'];
		//开始绘图
		$im = imagecreatefromjpeg(APPLICATION_PATH."/public/img/ml.jpg");
		//创建图像
		//$im = imagecreatetruecolor(400, 250);
		$color=imagecolorallocate($im,255,255,255);
		//设置颜色
		$pink  = ImageColorAllocate($im, 0 , 0 ,0);
		$red   = ImageColorAllocate($im, 255 , 0 ,0);
		$zise  = ImageColorAllocate($im, 0 , 255 ,0);
		$fontfile = APPLICATION_PATH."/public/fonts/MSYH.TTF";//雅黑字库
		//打印用户名
		ImageTTFText($im, 16,0,20,40,$red,$fontfile,''.$username.' 你好:');

		imagecopy($im, $avatar, 0, 0, 0, 0, 100, 100);

		Header("Content-type: image/jpeg");
		Imagejpeg($im);
		ImageDestroy($im);
		exit();
	}
}
