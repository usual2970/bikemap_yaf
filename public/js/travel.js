$(document).ready(function(){
	$("#travel-add-desc").click(function(){
		$(this).parent().hide().siblings().show();
	});
	$("#travel-form").validate({
		rules:{
			title:{
				required:true,
				maxlength:80
			},
			content:{
				required:true,
				minlength:50
			}
		},
		messages:{
			title:{
				required:"标题不能为空",
				maxlength:"标题不能超过80个字符"
			},
			content:{
				required:"正文内容不能为空",
				minlength:"正文不能低于50个字符"
			}
		},
		errorLabelContainer:"#travel-error",
		errorElement:"<p>",
		showErrors:function(errors,element){
			var err="";
			for(var error in errors){
				err=err+errors[error]+"!";
			}
			if(err==="") return false;
			$("#travel-error").html(err);
			$("body").scrollTop(0);
			$("#travel-alert").show(300);
			setTimeout(function(){$("#travel-alert").hide(300);},3000);
		}
	});
	
});

