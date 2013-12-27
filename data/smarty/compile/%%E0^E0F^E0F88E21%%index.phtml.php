<?php /* Smarty version 2.6.28, created on 2013-12-27 02:36:24
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
        <li class="active"><a href="/material" >图片</a></li>
        <li class=""><a href="/material/map">路书</a></li>
        
      </ul>
      <div id="myTabContent" class="tab-content" style="padding:10px;height:100%;">
        <div class="tab-pane fade active in" id="home" style="position:relative">
          <div id="container">
          </div><em class="text-muted" style="position:absolute;left:50px;top:5px;">大小: 不超过2M,    格式:  png, jpeg, jpg, gif</em>

          <div style="position:absolute;right:20px;top:0px;"><?php echo $this->_tpl_vars['page_str']; ?>
</div>

          <p>
            <table class="table" id="pictures">
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
          <hr>
          <div style="position:relative;"><div style="position:absolute;right:20px;top:0px;"><?php echo $this->_tpl_vars['page_str']; ?>
</div></div>
        </div>
        
      </div>
    

		</div>
	</div>

</div>
<div style="display:none">
<input type="hidden" id="joneto" value="<?php echo $this->_tpl_vars['jt']; ?>
">
</div>
<script src="<?php echo $this->_tpl_vars['url']; ?>
/js/uploadify/jquery.uploadify.min.js"></script>
<script>
$(document).ready(function(){
  setTimeout(function () {
      $('.bs-top').affix()
    }, 100)

    $("#container").uploadify({
      height        : 30,
      swf           : 'http://www.joneto.com/js/uploadify/uploadify.swf',
      uploader      : 'http://www.joneto.com/material/upload',
      width         : 50,
      buttonText    : "上传",
      formData    : {"jt_id":$("#joneto").val()},
      onQueueComplete:function(data){
        window.location.reload();
      }
    });

    $("#pictures tr").hover(
      function(){
        $(this).css({"background":"#f5f5f5"}).find("#pic-op").show();
      },
      function(){
        $(this).css({"background":"#ffffff"}).find("#pic-op").hide();
      }

    );

    $(document).on("click","#delimg",function(){
      var id=$(this).attr("data-id");
      $.get("/material/delimg/id/"+id,function(){
        window.location.reload();
      });
    });
});
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>