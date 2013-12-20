<?php /* Smarty version 2.6.28, created on 2013-12-20 05:31:06
         compiled from material%5Cmap.phtml */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/header.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container" style="margin-top:30px;">
	<div class="row">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/ucmenu.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="col-md-9 jt-uc-container">


      <ul id="myTab" class="nav nav-tabs">
        <li class=""><a href="<?php echo $this->_tpl_vars['url']; ?>
/material" >图片</a></li>
        <li class="active"><a href="<?php echo $this->_tpl_vars['url']; ?>
/material/map">路书</a></li>
        
      </ul>
      <div id="myTabContent" class="tab-content" style="padding:10px;height:100%;">
        <div class="tab-pane fade active in" id="home" style="position:relative">
          <div style="height:500px;" id="line-map">
            <p><button class="btn btn-default" id="line-add"><span class="glyphicon glyphicon-plus"></span>新增路线</button></p>
            <hr/>
            
          </div>

        </div>
        
      </div>
    

		</div>
	</div>

</div>
<script src="<?php echo $this->_tpl_vars['url']; ?>
/js/map.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>