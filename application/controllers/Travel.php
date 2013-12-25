<?php
class TravelController extends Ctrl_Base {
	public function indexAction() {
        $this->display("index");
	}


	public function addAction(){
		$this->display("add");
	}
}
