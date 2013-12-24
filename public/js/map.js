$(document).ready(function(){
	$(document).on("click","#line-add",function(){
		var left=($(window).width()-1024)/2;
		var wh=$(window).height();
		var ww=$(window).width();
		var overlay="<div style='width:"+ww+"px;height:"+wh+"px;top:0;left:0;z-index:10;position:absolute;'></div>";
		$(overlay).css({"opacity":0.5,"background":"#000"}).appendTo("body");
		window.open(site_url+"/material/addline","_blank","top=0,left=0,width="+ww+",height="+wh+",directories=no,menubar=no,toolbar=no");
	});

	$("#pictures tr").hover(
      function(){
        $(this).css({"background":"#f5f5f5"}).find("#pic-op").show();
      },
      function(){
        $(this).css({"background":"#ffffff"}).find("#pic-op").hide();
      }

    );
});