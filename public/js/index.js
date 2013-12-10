!function ($) {

  $(function(){

    // IE10 viewport hack for Surface/desktop Windows 8 bug
    //
    // See Getting Started docs for more information
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement("style");
      msViewportStyle.appendChild(
        document.createTextNode(
          "@-ms-viewport{width:auto!important}"
        )
      );
      document.getElementsByTagName("head")[0].
        appendChild(msViewportStyle);
    }


    var $window = $(window)
    var $body   = $(document.body)
    var navHeight = $('.navbar').outerHeight(true) + 10
    $window.on("load",function(){
      var wh=$window.height();
      var nh=$(".jt-navbar").height();
      var fh=$(".jt-footer").height();
      var sh=wh-nh-fh-160
      if($(".jt-uc-container").height()<sh){
        $(".jt-uc-container").css("height",sh+"px");
      }
    });
    // back to top
    setTimeout(function () {
      var $sideBar = $('.bs-sidebar')

      $sideBar.affix({
        offset: {
          top: function () {
            var offsetTop      = $sideBar.offset().top
            var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10)
            var navOuterHeight = $('.bs-docs-nav').height()

            return (this.top = offsetTop - navOuterHeight - sideBarMargin)
          }
        , bottom: function () {
            return (this.bottom = $('.bs-footer').outerHeight(true))
          }
        }
      })
    }, 100)

    setTimeout(function () {
      $('.bs-top').affix()
    }, 100)

    $("#container").uploadify({
		height        : 30,
		swf           : 'http://www.joneto.com/js/uploadify/uploadify.swf',
		uploader      : 'http://www.joneto.com/material/upload',
		width         : 120,
		buttonText	  : "上传图片",
		formData	  : {"jt_id":$("#joneto").val()}
	});
})

}(jQuery)

