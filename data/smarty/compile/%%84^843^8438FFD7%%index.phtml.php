<?php /* Smarty version 2.6.28, created on 2014-01-03 09:22:19
         compiled from index%5Cindex.phtml */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'img', 'index\\index.phtml', 33, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/header.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--内容-->
    <div class="container" style="margin-top:40px;">
      <div class="row">
        <div class="col-md-8">

          <div class="row">
              <div class="col-md-10">
                  <p class="text-muted"><span class="glyphicon glyphicon-list-alt"></span> <b>&nbsp;最新动态</b></p>
              </div>
              <div class="col-md-2">
                <p class="text-muted text-right"><span class="glyphicon glyphicon-cog"></span>&nbsp;<small>设置</small></p>
              </div>
          </div>
          
          <?php $_from = $this->_tpl_vars['arts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['art']):
?>
          <div class="row jt-mt-10 jt-bt-1">
            <div class="col-md-12 clearfix jt-mt-10">
     
                <div class="pull-left jt-wt-40">
                  <a href="/people/so898" class="pull-left"><img src="<?php echo $this->_tpl_vars['art']['avatar']; ?>
" alt="" class="jt-avatar-40 img-rounded"></a>
                  <button type="button" class="btn btn-xs jt-mt-10 btn-info" title="赞">&nbsp;&nbsp;<?php echo $this->_tpl_vars['art']['like']; ?>
&nbsp;&nbsp;</button>
                </div>
                <div class="jt-ml-48">
                  <div>
                    <div class="text-muted">
                      <a href="/people/so898" class="text-muted"><small><?php echo $this->_tpl_vars['art']['user_name']; ?>
</small></a>*<a href="#" class="text-muted"><small>关注TA</small></a>
                      <span class="pull-right text-muted">精选内容</span>
                    </div>
                    <p><a href="<?php echo $this->_tpl_vars['url']; ?>
/note/index/id/<?php echo $this->_tpl_vars['art']['id']; ?>
" target="_blank"><strong><?php echo $this->_tpl_vars['art']['title']; ?>
</strong></a></p>
                    <p class="content-descript clearfix">
                      <?php if ($this->_tpl_vars['art']['imgs']): ?>
                      <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['art']['imgs'])) ? $this->_run_mod_handler('img', true, $_tmp) : Funs_Base::img_modifier($_tmp)); ?>
" class="content-img">
                      <?php endif; ?>
                      <?php echo $this->_tpl_vars['art']['descript']; ?>
… <a href="javascript:void(0);" class="show-all">显示全部</a>
                      <textarea class="content hidden"><?php echo $this->_tpl_vars['art']['content']; ?>
</textarea>
                      
                    </p>
                  </div>
                  <div id="art-bar" data-id="<?php echo $this->_tpl_vars['art']['id']; ?>
">
                    <a class="text-muted" href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;收藏路线</a>

                    <a class="text-muted jt-ml-10" href="javascript:void(0);" id="jt-comment-show"><span class="glyphicon glyphicon-comment"></span>&nbsp;共<?php echo $this->_tpl_vars['art']['comment']; ?>
条评论</a>

                    <a class="content-handup text-muted jt-ml-10 pull-right hide" href="javascript:void(0);"><span class="glyphicon glyphicon-open"></span>&nbsp;收起</a>
                  </div>

                  

                </div>
            </div>
            

          </div>
          <?php endforeach; endif; unset($_from); ?>
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

          <hr>
          <p class="jt-pl-10"><b>赞助商</b></p>

          <div class="clearfix">
            <div class="jt-ml-10">
              
              <p class="text-muted"><a href="http://s.click.taobao.com/t?e=m%3D2%26s%3DEOjMP%2FZdglccQipKwQzePCperVdZeJviEViQ0P1Vf2kguMN8XjClAhaeD7ZFp2KhmCBgKg63Ff9YU0kl1dGVYgbAqy1VXNRYqgOH9%2Fz8vrH6G2ObSgSB3%2Bdn1BbglxZYxUhy8exlzcq9AmARIwX9K%2BnbtOD3UdznPV1H2z0iQv%2FtmSjxrhnChg%3D%3D" target="_blank"><img src="http://gtms01.alicdn.com/tps/i1/T1vEJoFrFbXXcg0_ET-336-280.jpg" /></a></iframe></p>
            </div>
            
          </div>
        </div>
      </div>


    </div>
    <script id="jt-comment-tpl" type="text/template">
      <!--评论内容-->
      <div class="jt-comment-box">
        <i class="jt-icon jt-icon-top"></i>
        <div class="panel panel-default jt-comment-body">
          {@each data as item}
          <div class="clearfix jt-comment-unit">
            <div style="float:left;">
              <img src="${item.avatar}" style="width:38px;height:38px;">
            </div>
            <div style="margin-left:50px;">
              <p><a href="#">${item.user_name}</a></p>
              <p>${item.content}</p>
              <p>
                <span class="text-muted">${item.add_time}</span>
                &nbsp;&nbsp;
                <a href="javascript:void(0)" class="text-muted" id="jt-reply">
                  <span class="glyphicon glyphicon-share-alt"></span>&nbsp;回复
                </a>
                &nbsp;&nbsp;
                <a href="javascript:void(0)" class="text-muted" id="jt-like">
                  <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;赞
                </a>
              </p>
            </div>
          </div>
          {@/each}

          <div class="jt-comment-foot">
            <form>
              <div style="display:none;">
                <input type="hidden" name="id" value="${id}"/>
              </div>
              <div class="form-group">
                <label class="sr-only" for="jt-comment">评论</label>
                <input type="text" class="form-control" name="content" placeholder="写下你的评论...">
              </div>
              <div class="form-group clearfix text-right" id="jt-comment-bar" style="display:none;">
                
                  <a href="javascript:void(0);" id="jt-comment-cancel">取消</a>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" id="jt-comment">评论</button>
                
              </div>
            </form>
          </div>
          

        </div>
      </div>
      <!--评论内容-->

    </script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/juicer.js"></script>
    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/list.js"></script>
    <!--底部-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index/footer.phtml", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>