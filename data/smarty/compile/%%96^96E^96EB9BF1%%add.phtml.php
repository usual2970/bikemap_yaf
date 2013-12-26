<?php /* Smarty version 2.6.28, created on 2013-12-26 08:57:05
         compiled from travel%5Cadd.phtml */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/header.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" charset="utf-8" src="<?php echo $this->_tpl_vars['url']; ?>
/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $this->_tpl_vars['url']; ?>
/js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="$url~/js/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="container" style="margin-top:30px;">
	<div class="row">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/ucmenu.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="col-md-9 jt-uc-container">


      <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="<?php echo $this->_tpl_vars['url']; ?>
/travel" >游记管理</a></li>
        
      </ul>
      <div id="myTabContent" class="tab-content" style="padding:10px;height:100%;">
        <div class="tab-pane fade active in" id="home" style="position:relative">
          <div class="alert alert-warning fade in" style="display:none;" id="travel-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <span id="travel-error"></span>
          </div>
          <div id="line-map">
            <form id="travel-form" method="post">
              <div class="form-group">
                <label for="title">标题</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="标题">
              </div>
              <?php if ($this->_tpl_vars['maps']): ?>
              <div class="form-group">
                <label for="map_id">路书<small class="text-muted">(选填)</small></label>
                <select class="form-control" name="map_id" id="map_id">
                  <?php $_from = $this->_tpl_vars['maps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['map']):
?>
                    <option value="<?php echo $this->_tpl_vars['map']['id']; ?>
"><?php echo $this->_tpl_vars['map']['name']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="tags">标签<small class="text-muted">(选填)</small></label>
                <input type="text" class="form-control" name="tags" id="tags" placeholder="标签">
              </div>
              <div class="form-group">
                 <label><a id="travel-add-desc" href="javascript:void(0);">添加摘要</a></label>
                 <label for="desc" style="display:none">摘要<small class="text-muted">(选填)</small></label>
                <textarea class="form-control" name="desc" id="desc" placeholder="摘要" rows="4" style="display:none"></textarea>
              </div>
            <div class="form-group">
              <label for="content">正文</label>
              <textarea id="content" name="content" style="width:100%;height:400px;"></textarea>
            </div>

            <div class="form-group">
              
              <button type="button" class="btn btn-success col-xs-2 col-md-offset-3" id="travel-preview">预览</button><button type="submit" class="btn btn-success col-xs-2 col-md-offset-1" id="travel-save">保存</button>
            </div>
          </form>
          </div>

        </div>
        
      </div>
    

		</div>
	</div>

</div>
<script>
UE.getEditor('content');
</script>

<script src="<?php echo $this->_tpl_vars['url']; ?>
/js/validator/dist/jquery.validate.min.js"></script>
<script src="<?php echo $this->_tpl_vars['url']; ?>
/js/travel.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>