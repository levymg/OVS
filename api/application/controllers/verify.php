<?php

class Verify extends CI_Controller {
    
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model("auth");
        
    }
    
    public function index()
    {
        
        if(!$this->input->get("token"))
        {
            
            echo "No token was entered";
            
        }
        
        else
        {
            
            $key = $this->input->get("token");
            
            $exists = $this->auth->verify_account($this->input->get("token"));
            
            if($exists)
            {
                
                header("Location: http://www.generalcarbide.com");
                
            }
            else
            {
                
                echo "User not found";
                
            }
            
        }
        
    }
    
}

