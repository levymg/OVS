<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Gcc extends REST_Controller
{
  
    
	function __construct()
        {
            
            parent::__construct();
            
            $this->load->model("industries_mdl");
            $this->load->model("auth");
            $this->load->model("calc_mdl");
            
            $this->load->library('form_validation');
            $this->load->library("MY_Form_validation");
            
            $response = new StdClass();
            
        }
        
        function categories_get()
        {
            
             $response = $this->calc_mdl->get_categories();
            
             $this->response($response->message, $response->statusCode);
            
        }
        
        function category_get()
        {
            
            if(!$this->get("resource_id")){
                
                $response->message = "No category specified";
                $response->statusCode = 403;
                
            }
            else
            {
                
                $response = $this->calc_mdl->get_category($this->get("resource_id"));
                
            }
            
            $this->response($response->message, $response->statusCode);
            
            
        }
        
        function unit_get()
        {
            
            if(!$this->get("resource_id"))
            {
                
                $response->message = "No unit specified";
                $response->statusCode = 403;
                
            }
            else
            {
                
                $response = $this->calc_mdl->get_unit($this->get("resource_id"));
                
            }
            
            $this->response($response->message, $response->statusCode);
            
        }
        
        function favorite_get()
        {
            
            if(!$this->get("user_id")) 
            {
                
                $response->message = "No user specified";
                $response->statusCode = 403;
                
            }
            else
            {
                
                $response = $this->calc_mdl->load_favorite($this->get("user_id"));
                
            }
            
            $this->response($response->message, $response->statusCode);
            
        }
        
        
}