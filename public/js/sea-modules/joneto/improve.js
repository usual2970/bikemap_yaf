define(function(require){
	var $=require("jquery");
	$("#regform").submit(function(e){
		e.preventDefault();
		alert(1234);
	});
});