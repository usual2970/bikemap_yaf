$(document).ready(function(){
  var wh=$(window).height();
  var mh=wh-100;
  $(".line-main,.line-left").css("height",mh+"px");

  //百度地图
  var map = new BMap.Map("line-map");            // 创建Map实例
  var point = new BMap.Point(116.404, 39.915);    // 创建点坐标
  map.centerAndZoom(point,15);                     // 初始化地图,设置中心点坐标和地图级别。
  map.enableScrollWheelZoom();  
});
function myexit()   
{   
window.opener.location.reload();
return   "保存后再离开吧";   
}  
function onbeforeunload()   
{   
    if(event.clientX>document.body.clientWidth&&event.clientY<0||event.altKey)   
    {   
        window.event.returnValue="确定要退出本页吗？";   
    }   
}


