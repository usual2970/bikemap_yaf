<?php /* Smarty version 2.6.28, created on 2014-01-02 07:54:52
         compiled from note%5Cnote.phtml */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/header.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container" style="margin-top:20px;" id="jt-container">
	<div class="row">
		<div class="col-md-12">
			<div class="jt-note-right" style="height:300px;">
				<div class="jt-note-icons">
					 <a href="<?php echo $this->_tpl_vars['url']; ?>
/user/profile/id/<?php echo $this->_tpl_vars['user_id']; ?>
" class="jt-note-avatar-link"><img src="<?php echo $_SESSION['avatar']; ?>
" class="jt-note-avatar"></a>

					<p>
						<h3>
						<a href="/po" class="text-muted" title="上一篇">
							<span class="glyphicon glyphicon-fast-backward"></span>
						</a>
						&nbsp;&nbsp;
						<a href="/po" class="text-muted" title="下一篇">
							<span class="glyphicon glyphicon-fast-forward"></span>
						</a></h3>
					</p>
				</div>
			</div>
			<div class="panel panel-default" style="margin-right:200px;padding:30px;">
				<p class="h3 text-left"><?php echo $this->_tpl_vars['art']['title']; ?>
</p>
				<p>

					<?php echo $this->_tpl_vars['art']['content']; ?>


				</p>

			</div>

		</div>
	</div>
</div>
<script src="<?php echo $this->_tpl_vars['url']; ?>
/js/note.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>