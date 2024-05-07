<?php

// Error controller
// This controller is used to manage the errors (404)
class Errors extends CI_Controller 
{

	public function __construct() {

	    parent::__construct();

	    // load base_url
	    $this->load->helper('url');
	  }

    // Main controller for the contact form
    public function error404()
    {
        // Create your custom controller
    	$this->output->set_status_header('404');
        // Display page
        $this->load->view('errors/show_404');
    }
}