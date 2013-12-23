function loeamap(obj){
  this.ops=obj;
  this.pass_num=$(this.ops.kw_uint).length-2;
  this.selected=0;
  this.kw_num=0;
  this.polyline=null;
  this.start=null;
  this.end=null;
  this.lushu=null;
  var that=this;
   $(document).off("click",this.ops.preview_bar).on("click",this.ops.preview_bar,function(){that.preview_line();});
   $(document).off("click",this.ops.submit_bar).on("click",this.ops.submit_bar,function(){that.submit_line();});
   $(document).off("keyup",this.ops.kw_uint).on("keyup",this.ops.kw_uint,function(e){that.get_suggest_place(this,e);});
   $(document).off("click",this.ops.addbar_uint).on("click",this.ops.addbar_uint,function(){that.add_pass();})
   $(document).off("mouseover","#line-pass").on("mouseover","#line-pass",function(){$(this).find("#del-pass").show();})
   $(document).off("mouseout","#line-pass").on("mouseout","#line-pass",function(){$(this).find("#del-pass").hide();})
   $(document).off("click","#del-pass").on("click","#del-pass",function(){$(this).parents(".form-group").remove();});
   $(document).off("click","#prompt-close").on("click","#prompt-close",function(){that.remove_prompt()});
   $(document).off("click","#auto-prompt p").on("click","#auto-prompt p",function(){$(this).parents("#auto-prompt").siblings(that.ops.kw_uint).val($(this).attr("data-attr")).attr("data-city",$(this).attr("data-city"));that.remove_prompt();});
   //百度地图
  this.map = new BMap.Map("line-map");            // 创建Map实例
  var point = new BMap.Point(curl_point.x, curl_point.y);    // 创建点坐标
  this.map.centerAndZoom(point,14);                     // 初始化地图,设置中心点坐标和地图级别。
  this.map.enableScrollWheelZoom();
}


loeamap.prototype={
  preview_line:function(){
    var that=this;
    if(!!!this.polyline) return false;
    if(!!!that.lushu){
      that.lushu = new BMapLib.LuShu(this.map,this.polyline.getPath(),{speed:10000,landmarkPois:[],defaultContent:that.start+"至"+that.end});
    }
    
    that.lushu.start();
  },
  submit_line:function(){
    var that=this;
    var names=$("input#place-name");
    var data=[];
    for(var i=0;i<names.length;i++){
      if($(names[i]).val()=="") continue;
      var temp={};
      temp.name=$(names[i]).val();
      temp.city=$(names[i]).attr("data-city");
      data.push(temp);
    }
    var transit = new BMap.DrivingRoute(that.map, {
      renderOptions: {
        map: that.map,
        panel: "r-result",
        enableDragging : true //起终点可进行拖拽
      },
      DrivingPolicy:BMAP_DRIVING_POLICY_AVOID_HIGHWAYS,
      onPolylinesSet:function(rs){
        that.polyline=rs[0].getPolyline();
      }
    });
    if(that.start==data[0].name && that.end==data[1].name) return false;
    that.start=data[0].name;
    that.end=data[1].name
    transit.search(data[0].name,data[1].name);

  },
  add_pass:function(){
    this.pass_num+=1;
    var html="<div class='form-group' id='line-pass'>"
              +"<label for='line-end' class='control-label'>途经点"+this.pass_num+":</label>"
              +"<a href='javascript:void(0)' title='删除途经点' id='del-pass' class='pull-right glyphicon glyphicon-trash text-info' style='margin-top:5px;text-decoration:none;display:none;'></a>"
              +"<input type='text' class='form-control place-name' id='place-name' name='place-name' placeholder='途经点'>"
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
        var selected=$("#auto-prompt p:eq("+this.selected+")")
        $(obj).val(selected.attr("data-attr")).attr("data-city",selected.attr("data-city"));
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
      var selected=$("#auto-prompt p:eq("+index+")")
      $(obj).val(selected.attr("data-attr")).attr("data-city",selected.attr("data-city"));
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
      var selected=$("#auto-prompt p:eq("+index+")")
      $(obj).val(selected.attr("data-attr")).attr("data-city",selected.attr("data-city"));
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
    addbar_uint:".add-bar",
    submit_bar:"#line-submit",
    preview_bar:"#line-preview"
  });

  


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


