<?php

class BoxKee extends Controller {

	function BoxKee()
	{
		parent::Controller();	
	}
	
	function actions() {
    	$this->load->library('useractions');
        $this->useractions->actions();
	}
	
	function boxKeeView()
	{
		$this->load->view('boxkee');
	}
}



?>