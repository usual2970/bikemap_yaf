function loeamap(obj){
  this.ops=obj;
  this.pass_num=$(this.ops.kw_uint).length-2;
  this.selected=0;
  this.kw_num=0;
  this.polyline=null;
  this.start=null;
  this.end=null;
  this.lushu=null;
  this.error=[];
  this.landmark=[];
  var that=this;
   $(document).off("click",this.ops.preview_bar).on("click",this.ops.preview_bar,function(){that.preview_line();});
   $(document).off("click","#error-close").on("click","#error-close",function(){that.error_close();});
   $(document).off("click","#line-save").on("click","#line-save",function(){that.save_line();});
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
  show_error:function(){
    var that=this;
    var html="";
    for(var i=0;i<this.error.length;i++){
      html+="<p class='text-danger bg-danger'>"+this.error[i]+"</p>";
    }
    this.error=[];
    $("#line-error").html(html).parent().show();
    setTimeout(function(){that.error_close();},3000);
  },
  error_close:function(){
    $("#line-error").parent().hide();
  },
  save_line:function(){
    var url=site_url+"/material/saveline";
    if(typeof(line)!="undefined") url=site_url+"/material/saveline/id/"+line.id;
    var line_name=$("input#line-name").val();
    if(!!!line_name) this.error.push("路书标题不能为空");
    var names=$("input#place-name");
    var data=[];
    if(names.length!=0){
      for(var i=0;i<names.length;i++){
        if($(names[i]).val()==""){
          this.error.push("起终点及途经地点不能为空");
          continue;
        }
        var temp={};
        temp.name=$(names[i]).val();
        temp.city=$(names[i]).attr("data-city");
        data.push(temp);
      }
    }

    if(!!!this.polyline) this.error.push("请先创建路线");
    if(this.error.length>0) {
      this.show_error();
      return false;
    }
    var path=this.polyline.getPath();
    $.post(url,{name:line_name,pass:data,path:path,landmark:this.landmark},function(){

    });
    
  },
  preview_line:function(){
    var that=this;
    if(!!!this.polyline) return false;
    if(!!!that.lushu){
      that.lushu = new BMapLib.LuShu(this.map,this.polyline.getPath(),{speed:10000,landmarkPois:that.landmark,defaultContent:that.start+"至"+that.end});
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
    if(data.length==0) return false;
    $.get(site_url+"/material/getdirect",{data:data},function(rs){
      rs=eval("("+rs+")");
      that.map.clearOverlays();
      var points=[];
      for(var i=0;i<rs.data.rs.length;i++){
        points.push(new BMap.Point(rs.data.rs[i].lng,rs.data.rs[i].lat));
      }
      that.landmark=rs.data.landmark;
      that.polyline=new BMap.Polyline(points,{strokeColor:"blue", strokeWeight:6, strokeOpacity:0.5});
      that.map.addOverlay(that.polyline);
    });
    that.start=data[0].name;
    that.end=data[data.length-1].name
  },
  edit_line:function(line){
    var that=this;
    this.map.clearOverlays();
    var points=[];
    for(var i=0;i<line.path.length;i++){
      points.push(new BMap.Point(line.path[i].lng,line.path[i].lat));
    }
    that.start=line.pass[0].name;
    var num=line.pass.length-1;
    that.end=line.pass[num].name;
    that.landmark=line.landmark;
    that.polyline=new BMap.Polyline(points,{strokeColor:"blue", strokeWeight:6, strokeOpacity:0.5});
    that.map.addOverlay(that.polyline);
  },
  add_pass:function(){
    var names=$("#line-pass input#place-name");

    if(names.length!=0){
      for(var i=0;i<names.length;i++){
        if($(names[i]).val()==""){
          this.error.push("有未填的途经地点，不能新添");
          break;
        }
      }
    }
    if(this.error.length>0){
      this.show_error();
      return false;
    }
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
  if(typeof(line)!="undefined"){
    map_obj.edit_line(line);
  }

  


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


