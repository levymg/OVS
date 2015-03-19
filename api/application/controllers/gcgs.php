<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Gcgs extends REST_Controller
{
    
    public $_attachment;
    
	function __construct()
        {
            
            parent::__construct();
            
            $this->load->model("industries_mdl");
            $this->load->model("auth");
            
            $this->load->library('form_validation');
            $this->load->library("MY_Form_validation");
            
        }
        
        function industries_get()
        {
            
              $result = $this->industries_mdl->get_industries();
              
              $this->response($result, 200);
              
        }
        
        function industry_get()
        {
            
            if(!$this->get("resource_id"))
            {
                
                $this->response(array('error' => 'No resource ID specified could not be found'), 404);
                
            }
            
            else
            {
                
                $result = $this->industries_mdl->get_industry($this->get("resource_id"));
                
                if($result)
                {
                   
                    $this->response($result, 200);
                    
                }
                
                else
                {
                    
                    $this->response(array('error' => $this->get("resource_id") . " does not exist."), 404);
                    
                }
                
            }
            
        }
        
        function industry_post()
        {
            
            if(!$this->get("resource_id"))
            {
               
                 $this->response(array('error' => 'The inudstry specified could not be found'), 404);
                 
            }
            
            else
            {
                
                $result = $this->industries_mdl->get_industry($this->get("resource_id"), $this->input->post("wire"));

                if($result)
                {

                    $this->response($result, 200);

                }

                else
                {

                    $this->response(array('error' => $this->get("resource_id") . " does not exist."), 404);

                }

            }
            
        }
        
        function submission_post()
        {
            
            if(!$this->get("user_id"))
            {
                
                $user_id = 0;
                
                $register = true;
                
            }
            else
            {
                
                $user_id = $this->get("user_id");
                
                $register = false;
                
            }
            
            if($this->input->post("action") == "gcgs-form")
            {
                
                if(!$this->input->post("gradesheets"))
                {
                    
                    $response = array(
                        
                                        "message" => "Please choose a Gradesheet to download",
                                        "callback" => "gcgs-form"
                        
                                );
                    
                }
                
                else
                {
                    
                    $gradesheets = $this->input->post("gradesheets");
                    
                }
                
                    $selections = $this->input->post("selections");
                
                    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
                    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
                    $this->form_validation->set_rules('company', 'Company', 'required|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                    
                      if ($this->form_validation->run() == FALSE)
                        {

                            $response = array(
                                
                                                "message" => validation_errors(), 
                                                "callback" => "gcgs-form"
                                
                                        );

                            $this->response($response, 403);
                            
                        }

                        else
                        {
                            
                            if($register === true)
                            {
                                
                                $user_id = "";
                                
                                $formData = array(
                                    
                                                    "email" => $this->input->post("email"), 
                                                    "password" => null, 
                                                    "first_name" => $this->input->post("first_name"), 
                                                    "last_name" => $this->input->post("last_name"), 
                                                    "company" => $this->input->post("company")
                                        
                                            );
                                
                                $this->auth->create_user($formData);
                               
                            }
                            
                            else
                            {
                                
                                $user_id = $this->get("user_id");
                                
                            }
                           
                            $formData = array(

                                    "created_on" => time(),
                                    "user_id" => $user_id,
                                    "email" => $this->input->post("email"),
                                    "first_name" => $this->input->post("first_name"),
                                    "last_name" => $this->input->post("last_name"),
                                    "company" => $this->input->post("company"),
                                    "industry_id" => $this->input->post("industry"),
                                    "selections" => $selections,
                                    "gradesheets" => $gradesheets,
                                    "ip_address" => $this->input->ip_address()

                            );
                            
                            $gs_array = explode(",", $gradesheets);
                            
                            $gs_selections = explode(",", $selections);
                            
                            $response = $this->industries_mdl->create_gcgs($formData);

                            $this->email_mdl->send_gradesheets($this->input->post("email"), $gs_array, $gs_selections);
                              
                            $this->response(array($response->message), $response->status);
                                
                        }
                
            }
            
            else
            {
                
                $this->response(array("error" => "Unknnown submission route.  Please contact General Carbide.", 404));
                
            }
            
        }
        
        function gradesheets_post()
        {
            
            if(!$this->input->post("resource_id"))
            {
                
                $this->response(array("error" => "No industry specified.", 403));
                
            }
            
          
            $response = $this->industries_mdl->get_gradesheets($this->input->post());
                
            if($response)
            {

                $this->response($response, 200);

            }
            
            else
            {

                $this->response(array("message" => "Error determining gradesheets."), 403);

            }
                
        }
        
}