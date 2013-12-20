<?php /* Smarty version 2.6.28, created on 2013-12-20 02:24:39
         compiled from index%5Clogreg.phtml */ ?>
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
              <li><a href="javascript:void(0);" class="jt-color-f" alt="log">登录囧途</a></li>
              <li><a href="javascript:void(0);" class="jt-color-f" alt="reg">快速注册</a></li>
            </ul>
           
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 log-box" style="display:none;">
            <form class="jt-form" role="form-log" id="logform">
              <div class="form-group clearfix">
                <label for="username" class="jt-label-normal">用户名：</label>
                  <input type="text" ng-pattern="word" class="form-control" id="username" name="jone" placeholder="用户名或邮箱..." required/>
                
              </div>

             <div class="form-group clearfix">
                <label for="password" class="jt-label-normal">密码：</label><a class="pull-right text-muted" href="#/getpass"><small>忘记登录密码</small></a>
                  <input type="password" class="form-control" id="password" name="to" placeholder="请输入密码..." required/>
                
              </div>

               <button type="submit" class="btn btn-warning" style="width:100%;">登录</button>

            </form>
            <div class="jt-mt-10"><span class="text-muted"><small>社区账号直接登录：</small></span>
                  <a href="javascript:void(0);" title="QQ账号登录"><i data-attr="{logtype:'qq',request_url:'https://graph.qq.com/oauth2.0/authorize?'}" class="jt-sign jt-sign-qq"></i></a>
                  <a href="javascript:void(0);" title="新浪账号登录"><i data-attr="{logtype:'sina',request_url:'https://api.weibo.com/oauth2/authorize?'}" class="jt-sign jt-sign-sina"></i></a></div>
          </div>

          <div class="col-xs-12 reg-box" style="display:none;">
            <form class="jt-form" role="form-reg" id="regform">
              <div class="form-group clearfix">
                <label for="user_name" class="jt-label-normal">用户名：</label>
                  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="请输入用户名..." required/>
                
              </div>
              <div class="form-group clearfix">
                <label for="email" class="jt-label-normal">邮箱：</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="请输入邮箱..." required/>
                
              </div>

             <div class="form-group clearfix">
                <label for="password" class="jt-label-normal">密码：</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码..." required/>

              </div>

               <button type="submit" class="btn btn-warning" style="width:100%;">注册</button>

            </form>
            <div class="jt-mt-10"><span class="text-muted"><small>社区账号直接登录：</small></span>
                  <a href="javascript:void(0);" title="QQ账号登录"><i data-attr="{logtype:'qq',request_url:'https://graph.qq.com/oauth2.0/authorize?'}" class="jt-sign jt-sign-qq"></i></a>
                  <a href="javascript:void(0);" title="新浪账号登录"><i data-attr="{logtype:'sina',request_url:'https://api.weibo.com/oauth2/authorize?'}" class="jt-sign jt-sign-sina"></i></a></div>
          </div>

        </div>
      </div>
    </div>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/sea-modules/seajs/seajs/2.1.1/sea.js"></script>
    <script>
      seajs.config({
        base: "<?php echo $this->_tpl_vars['url']; ?>
/js/sea-modules/",
        alias: {
          "jquery": "jquery/jquery/1.10.1/jquery.js"
        }
      })

      seajs.use("joneto/logreg");
    </script>
  </body>
</html>