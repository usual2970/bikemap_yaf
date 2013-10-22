<?php /* Smarty version 2.6.28, created on 2013-10-22 05:21:25
         compiled from index%5Cindex.phtml */ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>囧途网—骑行、旅行路线分享，骑行、旅行路线查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/fav.jpg"> 
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="css/jt.css" rel="stylesheet" media="screen">
    <!--[if lt IE 9]>
      <script src="<?php echo $this->_tpl_vars['site_url']; ?>
/statics/js/html5shiv.js"></script>
      <script src="<?php echo $this->_tpl_vars['site_url']; ?>
/statics/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!--头部-->
    <div class="navbar navbar-fixed-top navbar-inverse">
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


          <div class="col-md-5">
            <nav class="navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav pull-left">
                <li class="active"><a href="<?php echo $this->_tpl_vars['site_url']; ?>
">首页</a></li>
                <li><a href="<?php echo $this->_tpl_vars['site_url']; ?>
">活动</a></li>
                <li><a href="<?php echo $this->_tpl_vars['site_url']; ?>
">地图查询</a></li>
                <li><a href="<?php echo $this->_tpl_vars['site_url']; ?>
">帮助</a></li>
              </ul>
            </nav>
          </div>

          <div class="col-md-2">
          
              
                <div class="jt-mt-10">
                  <a class="btn btn-info btn-sm" href="/user#reg">注册</button></a>
                  <a class="btn btn-success btn-sm" href="/user">登录</button></a>
                </div>
               
           
            <!--<nav class="navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav pull-left">
                <li class="dropdown">
                  
                    <a class="dropdown-toggle" type="text" data-toggle="dropdown" href="javascript:void(0);"><span class="glyphicon glyphicon-user"></span>
                     &nbsp;&nbsp;刘旋尧 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">退出</a></li>
                    </ul>
                  

                </li>
              </ul>
            </nav>-->
          </div>
          
        </div>

      </div>

    </div>


    <!--内容-->
    <div class="container" style="margin-top:70px;">
      <div class="row">
        <div class="col-md-8">

          <div class="row">
              <div class="col-md-10">
                  <p class="text-muted"><span class="glyphicon glyphicon-list-alt"></span> <b>&nbsp;最新动态</b></p>
              </div>
              <div class="col-md-2">
                <p class="text-muted"><span class="glyphicon glyphicon-cog"></span>&nbsp;<small>设置</small></p>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="jt-bt">
                <p class="text-muted pager">你的首页暂时还没有内容，多关注些人吧 <a href="#">换一批</a>·<a href="#">更多推荐</a></p>
                <table class="table table-bordered">
                  <tr>
                    <td width="33.3%">
                      <div class="suggest-item-inner">
                        <div class="row">
                          <div class="col-md-12">
                            <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                            <div class="pull-left jt-ml-10">
                              <a href="/people/so898" class="item-link">Bill Cheng</a>
                              <p class="text-muted">517 个回答</p>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-muted jt-details">
                          <small>是一只死掉的考拉，大家不用在意</small>
                        </div>
                        <hr class="devider hr-medium">
                        <div class="text-center jt-summary">
                          互联网 · 科技 · 创业领域活跃用户
                        </div>
                        <div class="text-right">
                          <button class="btn btn-success btn-xs">&nbsp;关注&nbsp;</button>
                        </div>
                      </div>
                    </td>
                    <td width="33.3%">
                      <div class="suggest-item-inner">
                        <div class="row">
                          <div class="col-md-12">
                            <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                            <div class="pull-left jt-ml-10">
                              <a href="/people/so898" class="item-link">Bill Cheng</a>
                              <p class="text-muted">517 个回答</p>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-muted jt-details">
                          <small>是一只死掉的考拉，大家不用在意</small>
                        </div>
                        <hr class="devider hr-medium">
                        <div class="text-center jt-summary">
                          互联网 · 科技 · 创业领域活跃用户
                        </div>
                        <div class="text-right">
                          <button class="btn btn-success btn-xs">&nbsp;关注&nbsp;</button>
                        </div>
                      </div>
                    </td>
                    <td width="33.3%">
                      <div class="suggest-item-inner">
                        <div class="row">
                          <div class="col-md-12">
                            <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                            <div class="pull-left jt-ml-10">
                              <a href="/people/so898">Bill Cheng</a>
                              <p class="text-muted">517 个回答</p>
                            </div>
                          </div>
                        </div>
                        
                        <div class="text-muted jt-details">
                          <small>是一只死掉的考拉，大家不用在意</small>
                        </div>
                        <hr class="devider hr-medium">
                        <div class="text-center jt-summary">
                          互联网 · 科技 · 创业领域活跃用户
                        </div>
                        <div class="text-right">
                          <button class="btn btn-success btn-xs">&nbsp;关注&nbsp;</button>
                        </div>
                      </div>
                    </td>
                  </tr>

                </table>
              </div>
            </div>
          </div>

          <div class="row jt-mt-20">
            <div class="col-md-12 clearfix">
     
                <div class="pull-left jt-wt-40">
                  <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                  <button type="button" class="btn btn-xs jt-mt-10 btn-info">&nbsp;&nbsp;11&nbsp;&nbsp;</button>
                </div>
                <div class="jt-ml-48">
                  <div>
                    <div class="text-muted">
                      <a href="/people/so898" class="text-muted"><small>刘旋尧</small></a>*<a href="#" class="text-muted"><small>关注TA</small></a>
                      <span class="pull-right text-muted">精选内容</span>
                    </div>
                    <p><a href="#"><strong>iOS 设备越狱合法吗，为什么苹果公司的激活服务器不封禁有过越狱行为的设备？</strong></a></p>
                    <p>
                      根据美国法律，iOS 设备的越狱是合法的。 美国禁止破坏 DRM 的行为，但是美国最高法院解释说 iOS 越狱是为了在消费者自己的机器上运行设备制造商不允许的软件，不属于破坏 DRM。 但是破坏蓝光 DVD 的解密就被认为是企图播放盗版。同样越狱 Kindle 等电子书阅… <a href="#">显示全部</a>
                      
                    </p>
                  </div>
                  <div>
                    <a class="text-muted" href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;收藏路线</a>

                    <a class="text-muted jt-ml-10" href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;共12条评论</a>
                  </div>
                </div>
                <hr>
            </div>
            

          </div>

          <div class="row">
            <div class="col-md-12 clearfix">
     
                <div class="pull-left jt-wt-40">
                  <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                  <button type="button" class="btn btn-xs jt-mt-10 btn-info">&nbsp;&nbsp;11&nbsp;&nbsp;</button>
                </div>
                <div class="jt-ml-48">
                  <div>
                    <div class="text-muted">
                      <a href="/people/so898" class="text-muted"><small>刘旋尧</small></a>*<a href="#" class="text-muted"><small>关注TA</small></a>
                      <span class="pull-right text-muted">精选内容</span>
                    </div>
                    <p><a href="#"><strong>iOS 设备越狱合法吗，为什么苹果公司的激活服务器不封禁有过越狱行为的设备？</strong></a></p>
                    <p>
                      根据美国法律，iOS 设备的越狱是合法的。 美国禁止破坏 DRM 的行为，但是美国最高法院解释说 iOS 越狱是为了在消费者自己的机器上运行设备制造商不允许的软件，不属于破坏 DRM。 但是破坏蓝光 DVD 的解密就被认为是企图播放盗版。同样越狱 Kindle 等电子书阅… <a href="#">显示全部</a>
                      
                    </p>
                  </div>
                  <div>
                    <a class="text-muted" href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;收藏路线</a>

                    <a class="text-muted jt-ml-10" href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;共12条评论</a>
                  </div>
                </div>
                <hr>
            </div>
            

          </div>


          <div class="row">
            <div class="col-md-12 clearfix">
     
                <div class="pull-left jt-wt-40">
                  <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                  <button type="button" class="btn btn-xs jt-mt-10 btn-info">&nbsp;&nbsp;11&nbsp;&nbsp;</button>
                </div>
                <div class="jt-ml-48">
                  <div>
                    <div class="text-muted">
                      <a href="/people/so898" class="text-muted"><small>刘旋尧</small></a>*<a href="#" class="text-muted"><small>关注TA</small></a>
                      <span class="pull-right text-muted">精选内容</span>
                    </div>
                    <p><a href="#"><strong>iOS 设备越狱合法吗，为什么苹果公司的激活服务器不封禁有过越狱行为的设备？</strong></a></p>
                    <p>
                      根据美国法律，iOS 设备的越狱是合法的。 美国禁止破坏 DRM 的行为，但是美国最高法院解释说 iOS 越狱是为了在消费者自己的机器上运行设备制造商不允许的软件，不属于破坏 DRM。 但是破坏蓝光 DVD 的解密就被认为是企图播放盗版。同样越狱 Kindle 等电子书阅… <a href="#">显示全部</a>
                      
                    </p>
                  </div>
                  <div>
                    <a class="text-muted" href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;收藏路线</a>

                    <a class="text-muted jt-ml-10" href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;共12条评论</a>
                  </div>
                </div>
                <hr>
            </div>
            

          </div>


          <div class="row">
            <div class="col-md-12 clearfix">
     
                <div class="pull-left jt-wt-40">
                  <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                  <button type="button" class="btn btn-xs jt-mt-10 btn-info">&nbsp;&nbsp;11&nbsp;&nbsp;</button>
                </div>
                <div class="jt-ml-48">
                  <div>
                    <div class="text-muted">
                      <a href="/people/so898" class="text-muted"><small>刘旋尧</small></a>*<a href="#" class="text-muted"><small>关注TA</small></a>
                      <span class="pull-right text-muted">精选内容</span>
                    </div>
                    <p><a href="#"><strong>iOS 设备越狱合法吗，为什么苹果公司的激活服务器不封禁有过越狱行为的设备？</strong></a></p>
                    <p>
                      根据美国法律，iOS 设备的越狱是合法的。 美国禁止破坏 DRM 的行为，但是美国最高法院解释说 iOS 越狱是为了在消费者自己的机器上运行设备制造商不允许的软件，不属于破坏 DRM。 但是破坏蓝光 DVD 的解密就被认为是企图播放盗版。同样越狱 Kindle 等电子书阅… <a href="#">显示全部</a>
                      
                    </p>
                  </div>
                  <div>
                    <a class="text-muted" href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;收藏路线</a>

                    <a class="text-muted jt-ml-10" href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;共12条评论</a>
                  </div>
                </div>
                <hr>
            </div>
            

          </div>


          <div class="row">
            <div class="col-md-12 clearfix">
     
                <div class="pull-left jt-wt-40">
                  <a href="/people/so898" class="pull-left"><img src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg" alt="" class="jt-avatar-40 img-rounded"></a>
                  <button type="button" class="btn btn-xs jt-mt-10 btn-info">&nbsp;&nbsp;11&nbsp;&nbsp;</button>
                </div>
                <div class="jt-ml-48">
                  <div>
                    <div class="text-muted">
                      <a href="/people/so898" class="text-muted"><small>刘旋尧</small></a>*<a href="#" class="text-muted"><small>关注TA</small></a>
                      <span class="pull-right text-muted">精选内容</span>
                    </div>
                    <p><a href="#"><strong>iOS 设备越狱合法吗，为什么苹果公司的激活服务器不封禁有过越狱行为的设备？</strong></a></p>
                    <p>
                      根据美国法律，iOS 设备的越狱是合法的。 美国禁止破坏 DRM 的行为，但是美国最高法院解释说 iOS 越狱是为了在消费者自己的机器上运行设备制造商不允许的软件，不属于破坏 DRM。 但是破坏蓝光 DVD 的解密就被认为是企图播放盗版。同样越狱 Kindle 等电子书阅… <a href="#">显示全部</a>
                      
                    </p>
                  </div>
                  <div>
                    <a class="text-muted" href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;收藏路线</a>

                    <a class="text-muted jt-ml-10" href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;共12条评论</a>
                  </div>
                </div>
                <hr>
            </div>
            

          </div>


        </div>

        <div class="col-md-4">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#" class="text-muted"><span class="glyphicon glyphicon-file"></span>&nbsp;我的草稿</a></li>
            <li><a href="#" class="text-muted"><span class="glyphicon glyphicon-bookmark"></span>&nbsp;我的收藏</a></li>
            <li><a href="#" class="text-muted"><span class="glyphicon glyphicon-check"></span>&nbsp;我关注的人</a></li>
            <li><a href="#" class="text-muted"><span class="glyphicon glyphicon-tower"></span>&nbsp;邀请好友加入囧途</a></li>
          </ul>
          <hr>
          <p class="jt-pl-10"><b>你可能感兴趣的人</b></p>
          <div class="clearfix">
            <div class="pull-left">
              <a href="#">
                <img  class="jt-avatar-25" src="http://p2.zhimg.com/0e/b5/0eb52fe6f_m.jpg"/>
              </a>
            </div>
            <div class="jt-ml-45">
              <p><a href="#"><small>李双龙</small></a></p>
              <p class="text-muted">产品经理，从事教育类互联网产品研发</p>
              <p class="text-muted">他也关注 互联网 • 关注</p>
            </div>
          </div>

          <hr>
          <p class="jt-pl-10"><b>囧途提示</b></p>

          <div class="clearfix">
            <div class="jt-ml-10">
              
              <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;出行都是为了获得一段美好的体验，带上一副好心情traveling light,既然是traveling light,就一定要轻，带上足够的银子，几件换洗的衣服，就果断出发吧，千万别上山背石头哦。。。</p>
            </div>
            
          </div>
        </div>
      </div>


    </div>
    <!--底部-->

    <footer class="jt-footer">
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <p class="text-muted">Designed and built with all the love in the world by <a href="http://t.qq.com/usual2970" target="_blank">@usual2970</a><br/><a href="http://www.miibeian.gov.cn/" target="_blank">浙ICP备13023240号-1</a></p>
          </div>
        </div>
      </div>
    </footer>

    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/holder.js"></script>
  </body>
</html>