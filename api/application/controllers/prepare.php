<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prepare extends MY_Controller
{
	function __construct()
        {
            parent::__construct();
            
            $this->load->library('form_validation');
            
        }
        
        public function index()
        {
           
            switch($this->input->post("action"))
            {
                
                case "register-form" :
                    $this->validateRegistration($this->input->post());
                    break;
                
                case "login-form" :
                    $this->validateAuth($this->input->post());
                    break;
                
                default:
                    echo "Request Failed";
                    break;
            }
            
        }
        
        public function validateRegistration($formData)
        {
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
            
            if ($this->form_validation->run($formData) == FALSE)
            {
              
                echo validation_errors();
                    
            }
            
            else
            {
                
                echo "Success";
                    
            }
                
        }
        
        public function validateAuth($formData)
        {
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run($formData) == FALSE)
            {
                
                echo validation_errors();

            }
            
            else
            {
                echo "Success";
                    
            }
            
        }
        
}