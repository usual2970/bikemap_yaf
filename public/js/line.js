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

document.onkeydown = function(event) {  
    var target, code, tag;  
    if (!event) {  
        event = window.event; //针对ie浏览器  
        target = event.srcElement;  
        code = event.keyCode;  
        if (code == 13) {  
            tag = target.tagName;  
            if (tag == "TEXTAREA") { return true; }  
            else { return false; }  
        }  
    }  
    else {  
        target = event.target; //针对遵循w3c标准的浏览器，如Firefox  
        code = event.keyCode;  
        if (code == 13) {  
            tag = target.tagName;  
            if (tag == "INPUT") { return false; }  
            else { return true; }   
        }  
    }  
};  

function loeamap(obj){
  this.ops=obj;
  this.pass_num=$(this.ops.kw_uint).length-2;
  this.selected=0;
  this.kw_num=0;
  var that=this;
   $(document).off("keyup",this.ops.kw_uint).on("keyup",this.ops.kw_uint,function(e){that.get_suggest_place(this,e);});
   $(document).off("click",this.ops.addbar_uint).on("click",this.ops.addbar_uint,function(){that.add_pass();})
   $(document).off("mouseover","#line-pass").on("mouseover","#line-pass",function(){$(this).find("#del-pass").show();})
   $(document).off("mouseout","#line-pass").on("mouseout","#line-pass",function(){$(this).find("#del-pass").hide();})
   $(document).off("click","#del-pass").on("click","#del-pass",function(){$(this).parents(".form-group").remove();});
   $(document).off("click","#prompt-close").on("click","#prompt-close",function(){that.remove_prompt()});
   $(document).off("click","#auto-prompt p").on("click","#auto-prompt p",function(){$(this).parents("#auto-prompt").siblings(that.ops.kw_uint).val($(this).attr("data-attr"));that.remove_prompt();});
   //百度地图
  this.map = new BMap.Map("line-map");            // 创建Map实例
  var point = new BMap.Point(curl_point.x, curl_point.y);    // 创建点坐标
  this.map.centerAndZoom(point,14);                     // 初始化地图,设置中心点坐标和地图级别。
  this.map.enableScrollWheelZoom();
}


loeamap.prototype={
  add_pass:function(){
    this.pass_num+=1;
    var html="<div class='form-group' id='line-pass'>"
              +"<label for='line-end' class='control-label'>途经点"+this.pass_num+":</label>"
              +"<a href='javascript:void(0)' title='删除途经点' id='del-pass' class='pull-right glyphicon glyphicon-trash text-info' style='margin-top:5px;text-decoration:none;display:none;'></a>"
              +"<input type='text' class='form-control place-name' id='line-end' placeholder='途经点'>"
            +"</div>";
    $("#line-end-group").before(html);
  },
  remove_prompt:function(){
    $("#auto-prompt").remove();
      this.selected=0;
      this.kw_num=0;
      return false;
  },
  get_suggest_place:function(obj,e){
    var that=this;
    if(e.which==13){
      if(this.selected==0){
        $(obj).val($("#auto-prompt p:eq("+this.selected+")").attr("data-attr"));
      }
      this.remove_prompt();
      return false;
    }
    if(e.which==38 && this.kw_num!=0){
      var index=0;
      if(this.selected==0){
        index=this.kw_num-1;
        //console.log("#auto-prompt p:eq("+this.kw_num-1+")");
        $("#auto-prompt p:eq("+index+")").addClass("bg-info").siblings().removeClass("bg-info");
        this.selected=index;
      }

      else if(this.selected!=0){
        index=--this.selected;
        $("#auto-prompt p:eq("+this.selected+")").addClass("bg-info").siblings().removeClass("bg-info");
      }
      $(obj).val($("#auto-prompt p:eq("+index+")").attr("data-attr"));
      return false;
    }

    if(e.which==40){
      var index=0;
      if(this.selected==this.kw_num && this.kw_num!=0){
        this.selected=1;
        $("#auto-prompt p:eq("+index+")").addClass("bg-info").siblings().removeClass("bg-info");
      }
      else{
        index=this.selected++;
        $("#auto-prompt p:eq("+index+")").addClass("bg-info").siblings().removeClass("bg-info");
      }
      $(obj).val($("#auto-prompt p:eq("+index+")").attr("data-attr"));
      return false;
    }

    var kw=$(obj).val();
    if(!!!kw) return false;
    $.get(site_url+"/material/sugplace",{kw:kw},function(rs){
      rs=eval("("+rs+")");
      var tpl=$("#prompt-tpl").html();
      var html=juicer(tpl,rs.data);
      $(obj).siblings("#auto-prompt").remove();
      $(obj).after(html);
      that.kw_num=rs.data.result.length;
      that.selected=0;
    })
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



