<?php /* Smarty version 2.6.28, created on 2013-12-24 08:53:25
         compiled from material%5Ceditline.phtml */ ?>
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
      var curl_point='<?php echo $this->_tpl_vars['point']; ?>
';
      curl_point=eval("("+curl_point+")");
      var line='<?php echo $this->_tpl_vars['jsline']; ?>
';
      line=eval("("+line+")");
    </script>
    <!--[if lt IE 9]>
      <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/html5shiv.js"></script>
      <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onbeforeunload="event.returnValue=myexit()">
    <div class="line-wrap clearfix">
      <div class="line-top">
        <div style="padding:20px 0 0 100px;float:left;"><img src="<?php echo $this->_tpl_vars['url']; ?>
/img/logo.png"></div>
        <div style="margin-left:350px;padding:30px 0 0 200px;">
          <button class="btn btn-primary btn-lg" id="line-preview"><span class="glyphicon glyphicon-eye-open">预览</span></button>
          <button class="btn btn-primary btn-lg" id="line-save"><span class="glyphicon glyphicon-ok-sign">保存路书</span></button>
        </div>
      </div>
      <div class="line-left panel panel-default">
        <div class="panel-heading"><span class="text-info"><span class="glyphicon glyphicon-pencil"></span>填写路书基本信息</span></div>
        <div class="panel-body">
          <div class="panel panel-danger bg-danger" style="display:none;position:relative;">
            <button class="close" id="error-close" aria-hiden="true" style="position:absolute;top:5px;right:5px;">&times;</button>
            <div class="panel-body" id="line-error"></div>
          </div>
          <div style="padding:0 15px;">
          <form class="form-horizontal" role="form">
            <div class="form-group">
            <label for="line-name" class="control-label">名称:<span class="text-muted">（如：清明湖州到杭州）</span></label>
            

              <input type="email" class="form-control" id="line-name" placeholder="名称" value="<?php echo $this->_tpl_vars['line']['name']; ?>
">            
            </div>
            <?php $_from = $this->_tpl_vars['line']['pass']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pass'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pass']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['line_point']):
        $this->_foreach['pass']['iteration']++;
?>
            
              <?php if ($this->_tpl_vars['index'] == 0): ?>
              <div class="form-group">
                <label for="line-start" class="control-label">起点:</label>
                <input type="text" value="<?php echo $this->_tpl_vars['line_point']['name']; ?>
" data-city="<?php echo $this->_tpl_vars['line_point']['city']; ?>
" class="form-control place-name" id="place-name" name="palce-name" placeholder="起点">
              </div>
              <?php elseif ($this->_tpl_vars['index'] == $this->_foreach['pass']['total']-1): ?>
              <div class="form-group text-right" id="line-end-group"><a href="javascript:void(0);" class="add-bar"><span class="glyphicon glyphicon-plus-sign"></span>新增途经点</a></div>
              <div class="form-group">
                <label for="line-end" class="control-label">终点:</label>
                <input type="text" value="<?php echo $this->_tpl_vars['line_point']['name']; ?>
" data-city="<?php echo $this->_tpl_vars['line_point']['city']; ?>
" value="<?php echo $this->_tpl_vars['index']; ?>
" class="form-control place-name" id="place-name" name="palce-name" placeholder="终点">
              </div>
              <?php else: ?>
              <div class="form-group">
                <label for="line-start" class="control-label">途经点<?php echo $this->_tpl_vars['index']; ?>
:</label>
                <input type="text" value="<?php echo $this->_tpl_vars['line_point']['name']; ?>
" data-city="<?php echo $this->_tpl_vars['line_point']['city']; ?>
" value="<?php echo $this->_tpl_vars['index']; ?>
" class="form-control place-name" id="place-name" name="palce-name" placeholder="途经点<?php echo $this->_tpl_vars['index']; ?>
">
              </div>  
              <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            
    
            <div class="form-group">
              <div class="col-sm-offset-9 col-sm-3">
                <button type="button" class="btn btn-primary" id="line-submit">创建</button>
              </div>
            </div>
          </form>
          </div>


        </div>
      </div>

      <div class="line-main panel panel-default">
        <div id="line-map" style="height:100%;"></div>
      </div>
    </div>
  
    <script id="prompt-tpl" type="text/template">
      <div id="auto-prompt" style="position:absolute;width:300px;background:#fff;z-index:100;top:65px;">
        <button class="close" id="prompt-close" aria-hiden="true" style="position:absolute;top:5px;right:5px;">&times;</button>
        <div class="panel panel-info" style="padding-top:10px;">
          {@each result as place,index}
          <p style="padding:0 10px;" data-attr="${place.name}" data-city="${place.city}"><small>${place.name}</small>-<span>${place.district}</span>-<b>${place.city}</b></p>
          {@/each}
        </div>
      </div>
      

    </script>
    
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/juicer.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/line.js" type="text/javascript"></script>
    <script src="http://api.map.baidu.com/library/LuShu/1.2/src/LuShu_min.js"></script>
    <script>
      
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F4c42ddf892cc186c28070d3ae395e0d9' type='text/javascript'%3E%3C/script%3E"));
    </script>

  </body>
</html>