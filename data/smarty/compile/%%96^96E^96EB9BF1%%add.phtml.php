<?php /* Smarty version 2.6.28, created on 2013-12-25 06:50:33
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
          <div style="position:absolute;right:20px;top:0px;"><?php echo $this->_tpl_vars['page_str']; ?>
</div>
          <div style="height:500px;" id="line-map">
            <p>
              <script id="travel-editor" type="text/plain" style="width:100%;height:500px;"></script>
            </p>
          </div>

        </div>
        
      </div>
    

		</div>
	</div>

</div>
<script>
UE.getEditor('travel-editor');
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>