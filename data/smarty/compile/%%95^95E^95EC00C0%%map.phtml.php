<?php /* Smarty version 2.6.28, created on 2013-12-24 08:15:55
         compiled from material%5Cmap.phtml */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'material\\map.phtml', 28, false),)), $this); ?>
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
          <div style="position:absolute;right:20px;top:0px;"><?php echo $this->_tpl_vars['page_str']; ?>
</div>
          <div style="height:500px;" id="line-map">
            <p><button class="btn btn-default" id="line-add"><span class="glyphicon glyphicon-plus"></span>新增路线</button></p>
          
            <table class="table" id="pictures">
              <?php $_from = $this->_tpl_vars['map']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['line']):
?>
              <tr>
                <td width="50%">
                  <h4><?php echo $this->_tpl_vars['line']['name']; ?>
</h4>
                  
                </td>

                <td width="25%">
                  <h4><em class="text-muted"><?php echo ((is_array($_tmp=$this->_tpl_vars['line']['add_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M')); ?>
</em></h4>
                </td>
                <td>
                  <h4 class="text-center" id="pic-op" style="display:none;">
                    <a href="/material/editline/id/<?php echo $this->_tpl_vars['line']['id']; ?>
" class="text-muted" target="_blank" title="编辑查看路书"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                    <a href="javascript:void(0);" class="text-muted" id="delline" data-id="<?php echo $this->_tpl_vars['line']['id']; ?>
" title="删除路书"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
                  </h4>
                </td>
              </tr>
              <?php endforeach; endif; unset($_from); ?>
            </table>
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