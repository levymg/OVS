<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonials extends CI_Controller {

	function __construct()
        {
            
            parent::__construct();
            
        }
        
	public function index()
	{
            
            $data["title"] = "Pest, Rodent Control and Extermination - Complete Pest Control Services";
            
            $data["meta"] = "<meta name='description' content='' />";
            
            $this->load->view('template/header', $data);

            $this->load->view("content/testimonials", $data);
            
            $this->load->view("template/sidebar", $data);

            $this->load->view("template/footer", $data);
                
	}
        
}
