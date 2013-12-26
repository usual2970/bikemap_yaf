<?php /* Smarty version 2.6.28, created on 2013-12-26 13:12:42
         compiled from travel%5Cindex.phtml */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'travel\\index.phtml', 42, false),)), $this); ?>
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
        <li class="active"><a href="<?php echo $this->_tpl_vars['url']; ?>
/travel" >游记管理</a></li>
        
      </ul>
      <div id="myTabContent" class="tab-content" style="padding:10px;height:100%;">
        <div class="tab-pane fade active in" id="home" style="position:relative">
          <div style="position:absolute;right:20px;top:0px;"><?php echo $this->_tpl_vars['page_str']; ?>
</div>
          <div style="height:500px;" id="line-map">
            <p><a class="btn btn-default" id="line-add" target="_self" href="<?php echo $this->_tpl_vars['url']; ?>
/travel/add"><span class="glyphicon glyphicon-plus"></span>新增游记</a></p>
            <p>
            <table class="table" id="pictures">
               <tr>
                <th width="30%">
                  标题
                </th>
                 <th width="20%">
                  路书
                </th>
                <th width="25%">
                  创建时间
                </th>
                <th>
                  操作
                </th>
              </tr>
              <?php $_from = $this->_tpl_vars['arts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['art']):
?>
              <tr>
                <td width="30%">
                  <p><a href="<?php echo $this->_tpl_vars['img']['img_big']; ?>
" target="_blank"><?php echo $this->_tpl_vars['art']['title']; ?>
</a></p>
                </td>
                <td width="20%">
                  <p><a href="<?php echo $this->_tpl_vars['url']; ?>
/material/editline/id/<?php echo $this->_tpl_vars['art']['line_id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['art']['name']; ?>
</a></p>
                </td>
                <td width="25%">
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['art']['add_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M')); ?>

                </td>
                <td>
                  <h4 class="text-center" id="pic-op" style="display:none;">
                    <a href="/material/saveimg/id/<?php echo $this->_tpl_vars['img']['id']; ?>
" class="text-muted" target="_blank"><span class="glyphicon glyphicon-save"></span></a>&nbsp;&nbsp;
                    <a href="javascript:void(0);" class="text-muted" id="delimg" data-id="<?php echo $this->_tpl_vars['img']['id']; ?>
"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
                  </h4>
                </td>
              </tr>
              <?php endforeach; endif; unset($_from); ?>
            </table>
          </p>
          </div>

        </div>
        
      </div>
    

		</div>
	</div>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>