define(function(require,exports,module){
  var $=require("jquery/jquery/1.10.1/jquery");
  require("joneto/bootstrap.min");
  require("joneto/sidebar");
  require("uploadify/juqery.uploadify.min");

  $("#upload").uploadify({
	  height        : 30,
	  swf           : '/uploadify/uploadify.swf',
	  uploader      : '/uploadify/uploadify.php',
	  width         : 120
	});
});
