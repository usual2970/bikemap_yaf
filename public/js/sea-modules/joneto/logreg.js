define(function(require,exports,module){
  var $ =require("jquery");
  var site_url="http://www.joneto.com";
  var hash=window.location.hash;
  selectop(hash);

  $(".nav li").click(function(){
    var newhash="#"+$(this).find("a").attr("alt");
    window.location.hash=newhash;
    selectop(newhash);
  });

  function selectop(hash){
    if(hash=="" || hash=="#log"){
      $(".nav li a[alt=log]").parent().addClass("active").siblings().removeClass("active");
      $(".log-box").show().siblings().hide();
    }
    else if(hash=="#reg"){
      $(".nav li a[alt=reg]").parent().addClass("active").siblings().removeClass("active");
      $(".log-box").hide().siblings().show();
    }
  }
});
