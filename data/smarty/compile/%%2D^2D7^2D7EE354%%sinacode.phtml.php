<?php /* Smarty version 2.6.28, created on 2013-11-01 05:54:21
         compiled from user%5Csinacode.phtml */ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>囧途网—骑行导航，骑行路线</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['url']; ?>
/img/fav.jpg"> 
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <p>连接成功，正在跳转中。。。<p/>
    <script>
      var isreg="<?php echo $this->_tpl_vars['isreg']; ?>
";
      var pwindow=window.opener;
      if(isreg==1){
        pwindow.location.href="http://www.joneto.com";
      }
      else{
        pwindow.location.href="http://www.joneto.com/user/improve";
      }
      
      
      // setTimeout(function(){
      //   window.close();
      // },1000);
      
    </script>
  </body>
</html>