$(document).ready(function(){
	var $window = $(window)

    var navHeight = $('.navbar').outerHeight(true) + 10
    
      var wh=$window.height();
      var nh=$(".jt-navbar").height();
      var fh=$(".jt-footer").height();
      var sh=wh-nh-fh-150
      if($("#jt-container").height()<sh){
        $("#jt-container").css("min-height",sh+"px");
      }
});