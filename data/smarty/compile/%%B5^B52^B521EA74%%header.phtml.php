<?php /* Smarty version 2.6.28, created on 2013-12-24 07:55:38
         compiled from index/header.phtml */ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>囧途网—囧途中的囧图集,囧文集,旅途百科,驴友集散地</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['url']; ?>
/img/fav.jpg"> 
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/uc.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/jt.css" rel="stylesheet" media="screen">
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/jquery.js"></script>
    <script>
      var site_url="<?php echo $this->_tpl_vars['url']; ?>
";
    </script>
    <!--[if lt IE 9]>
      <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/html5shiv.js"></script>
      <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!--头部-->
    <div class="jt-navbar navbar-fixed-top">
      <div class="container">
        <div class="row">
          <div class="col-md-1">
            <a href="<?php echo $this->_tpl_vars['site_url']; ?>
" class="navbar-brand">JoneTo</a>
          </div>

          <div class="col-md-4">
            <form role="form" class="form-inline navbar-form" action="" method="post">
              
              <div class="form-group col-sm-10">
                <label for="placename" class="sr-only">目的地：</label>
                <input type="text" class="form-control input-sm" id="placename" name="kw" placeholder="杭州最拉风的路线...">
              </div>
              
              <button type="submit" class="btn btn-default btn-sm">搜索</button>
                
              
              
            </form>
          </div>


          <div class="col-md-4">
            <nav class="navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav pull-left">
                <li class="active"><a href="<?php echo $this->_tpl_vars['url']; ?>
">首页</a></li>
                <li><a href="<?php echo $this->_tpl_vars['url']; ?>
">活动</a></li>
                <li><a href="<?php echo $this->_tpl_vars['url']; ?>
">地图查询</a></li>
                <li><a href="<?php echo $this->_tpl_vars['url']; ?>
">帮助</a></li>
              </ul>
            </nav>
          </div>

          <div class="col-md-3">
            <?php if (! $_SESSION['id']): ?>
          
                <div class="jt-mt-10">
                  <a class="btn btn-info btn-sm" href="/user#reg">注册</button></a>
                  <a class="btn btn-success btn-sm" href="/user">登录</button></a>
                </div>
            <?php else: ?>
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="menu">
                      <?php if (! $_SESSION['avatar']): ?><span class="glyphicon glyphicon-user"></span><?php else: ?>
                      <img src="<?php echo $_SESSION['avatar']; ?>
" width="20" height="20"/><?php endif; ?>
                     &nbsp;&nbsp;<?php echo $_SESSION['user_name']; ?>
 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="<?php echo $this->_tpl_vars['url']; ?>
/user/logout">退出</a></li>
                    </ul>

                </li>
              </ul>
            </div>
            <?php endif; ?>
          </div>
          
        </div>

      </div>

    </div>