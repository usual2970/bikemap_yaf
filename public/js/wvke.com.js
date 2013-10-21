WVKE={
	$:function(o){return document.getElementById(o)},
	val:function(o, v){
		this.$(o).value = v;
	},
	confirm:function(u,a){
		var msg = {del:'删除操作不可恢复，确认要删除吗？'};
		if(confirm(msg[a]))self.location=u;
	},
	subchk:function(id, v){
		$('#'+id+' input').attr('checked', v);
	},
	redKW:function (key, result){
		return result.replace(eval("/"+key+"/gi"),'<font color="red">'+key+'</font>');
	},
	redTitle: function (kw) {
		var tall = document.getElementsByName("goods_title");
		for(var i=0, tl=tall.length; i < tl; i++)
		for(var j=0, kwl=kw.length; j<kwl; j++)
		tall[i].innerHTML = this.redKW(kw[j], tall[i].innerHTML);
	}
}