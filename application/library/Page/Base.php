<?php
class Page_Base{
	var $rows=0;
	var $cur_page=1;
	var $page_rows=10;
	var $url="";
	function __construct($rows,$page_rows=10,$url=""){
		$this->rows=$rows;
		$this->cur_page=!$_GET["page"]?1:intval($_GET["page"]);
		$this->page_rows=$page_rows;
		$pages=ceil($this->rows/$this->page_rows);
		if($this->cur_page>$pages) $this->cur_page=$pages;
		if($this->cur_page<=0) $this->cur_page=1;
		$this->url=!$url?$_SERVER["REQUEST_URI"]:$url;
		$this->url=preg_replace("/\?.*/i", "",$this->url);
	}

	function str(){
		$str="";
		if(!$this->rows) return $str;
		$pages=ceil($this->rows/$this->page_rows);
		$str.="<span>{$this->cur_page}/{$pages}</span>";
		if($pages>$this->cur_page){
			$next=$this->cur_page+1;
			$str.="<a class='text-muted' href='{$this->url}?page={$next}' target='_self'><span class='glyphicon glyphicon-step-forward'></span></a>";
		}
		
		if($this->cur_page>1){
			$prev=$this->cur_page-1;
			$str="<a class='text-muted' href='{$this->url}?page={$prev}' target='_self'><span class='glyphicon glyphicon-step-backward'></span></a>".$str;
		}
		$form="";
		if($pages>1){
			$form.="<input type='text' style='width:30px;' name='page' class='input-sm'><input type='submit' value='跳转' class='btn btn-default btn-sm'/><form>";
		}


		return "<form class='form-inline' method='get'>{$str}{$form}</form>";
	}
}

?>