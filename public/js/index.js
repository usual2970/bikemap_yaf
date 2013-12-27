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

    var nav_selected=$(".bs-sidenav li[data-con="+controller+"]");
    nav_selected.addClass("active").siblings().removeClass("active").parents("li").addClass("active").siblings().removeClass("active");

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


    $(document).off("click",".show-all").on("click",".show-all",function(){
      var content=$(this).siblings(".content").val();
      $(this).parent().addClass("hide").after(content);
      $(this).parents(".jt-ml-48").find(".content-handup").removeClass("hide");
    });

     $(document).off("click",".content-handup").on("click",".content-handup",function(){
      $(this).addClass("hide").parents(".jt-ml-48").find(".content-descript").removeClass("hide").nextAll().remove();
    });
    
})

}(jQuery)


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

