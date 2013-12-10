<?php /* Smarty version 2.6.28, created on 2013-12-10 08:48:47
         compiled from material%5Cindex.phtml */ ?>
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
        <li class="active"><a href="#home" data-toggle="tab">图片</a></li>
        <li class=""><a href="#profile" data-toggle="tab">地图</a></li>
        
      </ul>
      <div id="myTabContent" class="tab-content" style="padding:10px;height:100%;">
        <div class="tab-pane fade active in" id="home" style="position:relative">
          <div id="container">
          </div><em class="text-muted" style="position:absolute;left:120px;top:5px;">大小: 不超过2M,    格式:  png, jpeg, jpg, gif</em>

          <div style="position:absolute;right:20px;top:0px;"><?php echo $this->_tpl_vars['page_str']; ?>
</div>

          <p>
            <table class="table">
              <?php $_from = $this->_tpl_vars['imgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['img']):
?>
              <tr>
                <td width="50%">
                  <p><h4><?php echo $this->_tpl_vars['img']['img_name']; ?>
</h4></p>
                  <p><a href="<?php echo $this->_tpl_vars['img']['img_big']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['img']['img_big']; ?>
" style="height:80px;width:80px;"/></a></p>
                </td>

                <td width="25%">
                  <h4><?php echo $this->_tpl_vars['img']['size']; ?>
<em class="text-muted">bytes</em></h4>
                </td><td></td>
              </tr>
              <?php endforeach; endif; unset($_from); ?>
            </table>
          </p>
        </div>
        <div class="tab-pane fade" id="profile">
          <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
        </div>
      </div>
    

		</div>
	</div>

</div>
<div style="display:none">
<input type="hidden" id="joneto" value="<?php echo $this->_tpl_vars['jt']; ?>
">
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>