define(function(require){
	var $=require("jquery");
	var t=require("joneto/tools");
	var tools=new t();
	require("joneto/bootstrap.min");
	$("#regform").submit(function(e){
		e.preventDefault();
		var query=$("#regform").serialize();
		var query_arr=query.split("&");
		//email=&surname=&name=&gender=w&industry=&instruct= 
		for(var i=0;i<query_arr.length;i++){
			var temp=query_arr[i].split("=");
			switch(temp[0]){
				case "email":
					var rs=tools.check_email(temp[1]);
					if(rs.ret!=0){
						tools.show_error(rs.msg);
						return false;
					}
					break;
				case "surname":
					if(!!!temp[1]){
						tools.show_error("随便填个姓氏");
						return false;
					}
					break;
				case "name":
					if(!!!temp[1]){
						tools.show_error("随便填个名字");
						return false;
					}
					break;
				case "industry":
					if(!!!temp[1]){
						tools.show_error("随便选一个行业");
						return false;
					}
					break;
				case "instruct":

					if(!!!temp[1]){
						tools.show_error("随便写一句介绍");
						return false;
					}
					break;
			}

		}
		$.get("http://www.joneto.com/user/improve",query,function(rs){
			rs=eval("("+rs+")");
			if(rs.status!=0){
				tools.show_error(rs.msg);
				return false;
			}
			else{
				window.location.href="http://www.joneto.com";
			}
		});

	});
});