<?php

class BoxKee extends Controller {

	function BoxKee()
	{
		parent::Controller();	
		$this->load->database();
	}
	
	function actions() {
		
    	$this->load->library('useractions');
        $action = $this->uri->segment(3);
        
        if (FALSE !== $action) {
            $this->useractions->actions($action);
        }
	}
	
	function boxKeeView()
	{
		$this->load->view('boxkee');
	}
}



?>