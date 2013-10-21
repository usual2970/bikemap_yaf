<?php /* Smarty version 2.6.28, created on 2013-10-21 10:32:33
         compiled from index%5Clogreg.phtml */ ?>
<!DOCTYPE html>
<html ng-app="logreg">
  <head>
    <meta charset="utf-8">
    <title>囧途网—骑行导航，骑行路线</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['url']; ?>
/img/logo_black.png"> 
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/logreg.css" rel="stylesheet" media="screen">
    <link href="<?php echo $this->_tpl_vars['url']; ?>
/css/jt.css" rel="stylesheet" media="screen">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!--底部-->
    <div class="container jt-log-wrap">

      <div class="jt-log-box" ng-controller="LogregCtrl">
        <div class="row">
          <div class="col-xs-12">
            <ul class="nav nav-tabs">
              <li class="{{ logcls }}" ng-click="showme('log')"><a href="#/log" class="jt-color-f">登录囧途</a></li>
              <li ng-click="showme('reg')" class="{{ regcls }}"><a href="#/reg" class="jt-color-f">注册</a></li>
            </ul>
           
          </div>
        </div>

        <div ng-view class="row"></div>

      </div>
    </div>

    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/angular/angular.min.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/angular/angular-route.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/angular/angular-resource.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/logreg.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/jquery-1.7.1.min.js"></script>
    
  </body>
</html>