$(document).ready(function(){
	var comm=new jtComment({
		showbar:"#jt-comment-show",
		likebar:"#jt-like",
		replybar:"#jt-replay",
		commentbar:"#jt-comment",
		content:".jt-comment-box input[name=content]",
		cancelbar:"#jt-comment-cancel"
	});
});


function jtComment(opts){
	this.opts=opts;
	var that=this;
	$(document).off("click",this.opts.showbar).on("click",this.opts.showbar,function(){that.showComments(this);});
	$(document).off("click",this.opts.commentbar).on("click",this.opts.commentbar,function(){that.comment(this);});
	$(document).off("focus",this.opts.content).on("focus",this.opts.content,function(){that.show_submit(this);});
	$(document).off("click",this.opts.cancelbar).on("click",this.opts.cancelbar,function(){that.hide_submit(this);});
}


jtComment.prototype={
	showComments:function(obj){
		var box=$(obj).parent().siblings(".jt-comment-box");
		if(box.is(":visible")){
			box.remove();
		}
		else{
			var id=$(obj).parents("#art-bar").attr("data-id");
			$.get(site_url+"/note/getcomm/id/"+id,function(rs){
				rs=eval("("+rs+")");
				var tpl=$("#jt-comment-tpl").html();
				var html=juicer(tpl,{id:id,data:rs.data});

				$(obj).parents(".jt-ml-48").append(html);
			});
		}
	},
	hideComments:function(){},
	reply:function(){},
	comment:function(obj){
		var that=this;
		var query=$(obj).parents("form").serialize();
		if(!this.check(query)){
			alert("请填写评论内容");
			return false;
		}
		$.post(site_url+"/note/comment",query,function(rs){
			rs=eval("("+rs+")");
			if(rs.status!=0){
				alert(rs.msg);
			}

			that.hide_submit(obj);

		});
	},
	like:function(){},
	check:function(str){
		var params=str.split("&");
		for(var i=0;i<params.length;i++){
			var temp=params[i].split("=");
			if(temp[0]=="content"){
				if(!!!temp[1] ||(/^\s+$/.test(temp[1]))){
					return false;
				}
			}
		}
		return true;
	},
	show_submit:function(obj){
		$(obj).parents("form").find("#jt-comment-bar").show();
	},
	hide_submit:function(obj){
		$(obj).parents("form").find("#jt-comment-bar").hide();
		$(obj).parents("form").find("input[name=content]").val("");
	}
}

