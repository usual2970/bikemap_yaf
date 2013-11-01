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
  var logdata=[];
  logdata.sina={client_id:"2002777054",redirect_uri:"http://www.joneto.com/user/sinacode",response_type:"code"};
  logdata.qq={client_id:"100548186",redirect_uri:"http://www.joneto.com/user/qqcode",response_type:"code",state:"adsfjoneto"};
  $(".jt-sign").click(function(){
    var data=eval("("+$(this).attr("data-attr")+")");
    var temp=logdata[data.logtype]
    var uri_arr=[];
    for(var k in temp){
     uri_arr.push(k+"="+temp[k]);
    }
    window.open(data.request_url+uri_arr.join("&"),"_blank","top=200,left=400,width=600,height=380,directories=no,menubar=no,toolbar=no");
    return false;
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
