<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Gcqa extends REST_Controller
{
    
	function __construct()
        {
            
            parent::__construct();
            
            $this->load->model("auth");
            $this->load->model("industries_mdl");
            $this->load->model("qa_mdl");
            
            $this->load->library('form_validation');
            $this->load->library("MY_Form_validation");
            
        }
 
        function questions_get()
        {
            
            $response = $this->qa_mdl->get_questions();
            
            $this->response($response->message, $response->statusCode);
            
        }
        
        function question_get()
        {
            
            if(!$this->get('resource_id'))
            {
                
                $this->response(array("message" => "No question specified"), 400);
                    
            }
            
            $question = $this->qa_mdl->get_by('resource_id', $this->get('resource_id'));

            if($question)
            {
                
                $this->response($question, 200);
                
            }
            
        }
        
        function question_post()
        {
            
            
        }
        
        
}