<?php /* Smarty version 2.6.28, created on 2013-12-19 09:06:11
         compiled from material%5Caddline.phtml */ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>囧途网—囧途中的囧图集,囧文集,旅途百科,驴友集散地</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/fav.jpg"> 
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/line.css" rel="stylesheet" media="screen">
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/jquery.js"></script>
    <script src="http://api.map.baidu.com/api?v=2.0&ak=FDd8e975a4304939cfe447098f4594cc"></script>
    <script>
      var site_url="<?php echo $this->_tpl_vars['url']; ?>
";
    </script>
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onbeforeunload="event.returnValue=myexit()">
    <div class="line-wrap clearfix">
      <div class="line-top panel panel-info">
        <div style="padding:20px 0 0 100px;float:left;"><img src="<?php echo $this->_tpl_vars['url']; ?>
/img/logo.png"></div>
        <div style="margin-left:350px;padding:30px 0 0 200px;">
          <button class="btn btn-primary btn-lg">预览</button>
          <button class="btn btn-primary btn-lg">保存路书</button>
        </div>
      </div>
      <div class="line-left panel panel-info">

      </div>

      <div class="line-main panel panel-info">
        <div id="line-map" style="height:100%;"></div>
      </div>
    </div>
  

    
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/line.js" type="text/javascript"></script>
    <script>
      
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F4c42ddf892cc186c28070d3ae395e0d9' type='text/javascript'%3E%3C/script%3E"));
    </script>

  </body>
</html>