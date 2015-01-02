<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Gcusers extends REST_Controller
{
    
	function __construct()
        {
            parent::__construct();
            
            $this->load->model("auth");
            
            $this->load->library('form_validation');
            $this->load->library("MY_Form_validation");
        }
    
        function user_get()
        {
            
            if(!$this->get('resource_id'))
            {
                
                    $this->response(NULL, 400);
                    
            }

            $user = $this->auth->get_by('user_id', $this->get('resource_id'));

            if($user)
            {
                
                $response = array(
                    
                                    "user_id" => $user->user_id,
                                    "email" => $user->email,
                                    "first_name" => $user->first_name,
                                    "last_name" => $user->last_name,
                                    "phone" => $user->phone,
                                    "company" => $user->company,
                                    "usage_level" => $user->usage_level,
                                    "last_login" => time()
                        
                            );
                
                $this->response($response, 200);
                
            }

            else
            {
                
                $this->response(array('error' => 'User could not be found'), 404);
                
            }
        }
    
        function user_post()
        {
            
            if($this->input->post("action") == "register-form")
            {
                
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
                $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|matches[password]|xss_clean');

                if ($this->form_validation->run() == FALSE)
                {
                    
                    $response = array(
                                        "message" => validation_errors(), 
                                        "callback" => "register-form"
                                );
                    
                    $this->response($response, 403);

                }

                else
                {
                    
                    $formData = array("email" => $this->input->post("email"), "password" => $this->input->post("password"));
                    
                    $response = $this->auth->create_user($formData);
                    
                    $this->response($response, $response->status);

                }
                
            }
            
            elseif($this->input->post("action") == "login-form")
            {
                
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
                
                if ($this->form_validation->run() == FALSE)
                {
                    
                    $response = array(
                                        "message" => validation_errors(), 
                                        "callback" => "login-form"
                                );
                    
                    $this->response($response, 403);

                }

                else
                {
                    
                    $formData = array("email" => $this->input->post("email"), "password" => $this->input->post("password"));
                    
                    $response = $this->auth->authenticate($formData);
                    
                    $this->response($response, $response->status);

                }
                
            }

        }
        
        function user_put()
        {
            
            $_POST = var_dump($this->put());
            
             if($this->input->post("action") == "edit-profile")
             {
                
                $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
                $this->form_validation->set_rules('company', 'Company', 'required|xss_clean');
                $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean');
                
                if ($this->form_validation->run() == FALSE)
                {
                    
                    $response = $_POST;
                    
                    $this->response($response, 200);

                }

                else
                {
                    
                  $response = array(
                                        "message" => validation_errors(), 
                                        "callback" => "edit-profile"
                                );
                    
                $this->response($response, 403);

                }
                
             }
            
            
        }

        function user_delete()
        {
            
            if(!$this->get('id'))
            {
                
                    $this->response(NULL, 400);
                    
            }

            if($user)
            {
                
                $this->response($user, 200);
                
            }

            else
            {
                
                $this->response(array('error' => 'User could not be found'), 404);
                
            }

        }

        function users_get()
        {
            
            $users = array(
                            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
                            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
                            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
                    );

            if($users)
            {
                $this->response($users, 200);
            }

            else
            {
                $this->response(array('error' => 'Couldn\'t find any users!'), 404);
            }
        }

        public function send_post()
        {
                var_dump($this->request->body);
        }


        public function send_put()
        {
                var_dump($this->put('foo'));
        }
}