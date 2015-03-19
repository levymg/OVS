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
                
                $response = array(

                         "title" => $question->title,
                         "date" => date("m/d/Y", $question->created_on),
                         "time" => date("h:i:s", $question->created_on),
                         "user_id" => $question->user_id,
                         "content" => $question->content,

                 );
                
                $this->response($response, 200);
                
            }
            
        }
        
        function question_post()
        {
            
            if(!$this->input->post('user_id'))
            {
                
                $this->response(array("message" => "Please login to your Toolbox account."), 403);
                
            }
            
            else
            {
            
                $result = $this->auth->authenticate_token($this->input->post("user_id"), $this->input->post("token"));
                
                if($result):
                    
                    $this->form_validation->set_rules('title', 'Title', 'required|xss_clea');
                    $this->form_validation->set_rules('question', 'Question', 'required|xss_clean');
                    
                    $this->qa_mdl->add_question($this->input->post());
                
                endif;
                
            }
            
            
        }
        
}