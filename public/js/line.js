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

function loeamap(obj){
  this.ops=obj;
  this.pass_num=$(this.ops.kw_uint).length-2;
  var that=this;
   $(document).off("keyup",this.ops.kw_uint).on("keyup",this.ops.kw_uint,function(){alert(123);});
   $(document).off("click",this.ops.addbar_uint).on("click",this.ops.addbar_uint,function(){that.add_pass();})
   //百度地图
  this.map = new BMap.Map("line-map");            // 创建Map实例
  var point = new BMap.Point(curl_point.x, curl_point.y);    // 创建点坐标
  this.map.centerAndZoom(point,14);                     // 初始化地图,设置中心点坐标和地图级别。
  this.map.enableScrollWheelZoom();
}
loeamap.prototype={
  add_pass:function(){
    this.pass_num+=1;
    var html="<div class='form-group'>"
              +"<label for='line-end' class='control-label'>途经点"+this.pass_num+":</label>"
              +"<input type='text' class='form-control place-name' id='line-end' placeholder='途经点'>"
            +"</div>";
    

    $("#line-end-group").before(html);
  }
}




$(document).ready(function(){
  var wh=$(window).height();
  var mh=wh-100;
  $(".line-main,.line-left").css("height",mh+"px");

  var map_obj=new loeamap({
    kw_uint:".place-name",
    addbar_uint:".add-bar"
  });

  


});



