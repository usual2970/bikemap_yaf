<?php /* Smarty version 2.6.28, created on 2013-12-04 06:28:18
         compiled from index/footer.phtml */ ?>
    <div class="jt-footer">
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <p class="text-muted">Designed and built with all the love in the world by <a href="http://t.qq.com/usual2970" target="_blank">@usual2970</a><br/><a href="http://www.miibeian.gov.cn/" target="_blank">浙ICP备13023240号-1</a></p>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo $this->_tpl_vars['url']; ?>
/js/sea-modules/seajs/seajs/2.1.1/sea.js"></script>
    <script>
      seajs.config({
        base: "<?php echo $this->_tpl_vars['url']; ?>
/js/sea-modules/",
        alias: {
          "jquery": "jquery/jquery/1.10.1/jquery.js"
        },
        preload:["jquery"]
      })

      seajs.use("joneto/index");

    </script>

    <script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F4c42ddf892cc186c28070d3ae395e0d9' type='text/javascript'%3E%3C/script%3E"));
    </script>

  </body>
</html>