define(function(require,exports,module){
	var $=require("jquery");
	function tools(){}
	module.exports=tools;
	tools.prototype.check_email=function(v){
		var ret={};
		ret.ret=0;
		if(!!!v){
			ret.ret=1;
			ret.msg="邮箱不能为空";
			return ret;
		}
		var pat=/\w+?@\w+?\.\w{2,8}/
		var rs= pat.test(decodeURIComponent(v));
		if(!rs){
			ret.ret=2;
			ret.msg="邮箱格式不正确";
			return ret;
		}
		$.get("http://www.joneto.com/user/check_email",{email:v},function(rs){
			rs=eval("("+rs+")");
			if(rs.status==3){
				ret.ret=3;
				ret.msg="邮箱已存在"
			}
			else if(rs.status==1){
				ret.ret=1;
				ret.msg="邮箱不能为空";
				
			}
			else if(rs.status==2){
				ret.ret=2;
				ret.msg="邮箱格式不正确";
			}
		});
		return ret;
	}

	tools.prototype.show_error=function(v){
		var html="<p>"+v+"</p>";
		$("#jt-form-alert").addClass("in").append(html);
	}
});