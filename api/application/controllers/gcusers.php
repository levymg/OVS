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
            
            if(!$this->get('user_id'))
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

                    if($this->input->post("action") == "login-form")
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

                    if($this->input->post("action") == "forgot-form")
                    {

                            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');

                            if ($this->form_validation->run() == FALSE)
                            {

                                $response = array(
                                                    "message" => validation_errors(), 
                                                    "callback" => "forgot-form"
                                            );


                                $this->response($response, 403);
                            }

                            else
                            {
                                
                               $formData = $this->input->post("email");

                               $response = $this->auth->reset_password($formData);

                               $this->response($response, $response->status);
                               
                            }

                    }

            }
            
            if($this->get('user_id'))
            {
                
                $token = array(
                    
                                "user_id" => $this->get('user_id'), 
                                "token" => $this->input->post("token")
                        
                               );
                
                if($this->input->post("action") == "logout")
                {
                    
                    $token["expired"] = true;
                    
                }
                            
                    $token_auth = $this->auth->authenticate_token($token);

                    if($token_auth->status == 403)
                    {

                         $response = array(
                                            "message" => $token_auth->message,
                                            "callback" => $this->input->post("action")
                                    );

                    $this->response($response, 403);

                    }
                    else {
             
                        if($this->input->post("action") == "edit-profile"  && $this->input->post("token"))
                        {
                            
                            $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
                            $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
                            $this->form_validation->set_rules('company', 'Company', 'required|xss_clean');
                            $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
                            
                            if ($this->form_validation->run() == TRUE)
                            {
                                
                                $formData = array(
                                    
                                                    "first_name" => $this->input->post("first_name"),
                                                    "last_name" => $this->input->post("last_name"),
                                                    "company" => $this->input->post("company"),
                                                    "phone" => $this->input->post("phone"),
                                                    "user_id" => $this->get("user_id")
                                    
                                            );
                                
                                $response = $this->auth->update_profile($formData);
                                
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
                        
                        elseif($this->input->post("action") == "change-password")
                        {
                            
                            $this->form_validation->set_rules('password', 'Current Password', 'required|xss_clean');
                            $this->form_validation->set_rules('new_password', 'New Password', 'required|xss_clean');
                            $this->form_validation->set_rules('cnew_password', 'Confirm New Password', 'required|matches[new_password]|xss_clean');
                            
                            if ($this->form_validation->run() == FALSE)
                            {
                                
                                $response = array(
                                    
                                                    "message" => validation_errors(), 
                                                    "callback" => "change-password"
                                    
                                            );

                                            $this->response($response, 403);
                                            
                            }
                            
                            else
                            {
                                
                                    $formData = array(
                                        
                                                    "user_id" => $this->get('user_id'),
                                                    "password" => $this->input->post("password")
                                                    
                                                );
                                 
                                    $data = $this->auth->check_creds($formData);
                                    
                                    if($data)
                                    {
                                        
                                        $updateData = array(
                                            
                                                    "user_id" => $this->get("user_id"),
                                                    "password" => $this->input->post("cnew_password")
                                        );
                                        
                                        $response = $this->auth->update_profile($updateData);
                                        
                                        if($response)
                                        {
                                            
                                            $this->response($response, 200);
                                            
                                        }
                                        else
                                        {
                                            
                                             $response = array("message" => "Your password failed to update.  Please contact General Carbide.", "callback" => "change-password");
                                    
                                            $this->response($response, 403);
                                            
                                        }
                                        
                                    }
                                    
                                    else
                                    {
                                        
                                        $response = array("message" => "Your current password is incorrect.", "callback" => "change-password");
                                    
                                        $this->response($response, 403);
                                        
                                    }
                                    
                                }
                                
                            }
                            
                            elseif($this->input->post("action") == "logout")
                            {
                                $formData = array("user_id" => $this->get("user_id"), "token" => $this->input->post("token"), "expired" => time());
                        
                                $token_auth = $this->auth->authenticate_token($formData);

                                    if(!$token_auth)
                                    {

                                         $response = array(
                                                            "message" => "Invalid login",
                                                            "callback" => "edit-profile"
                                                    );

                                        $this->response($response, 403);

                                    }
                                    
                                    $response = "Logout ok";
                                    $this->response($response, 200);
                                    
                            }
                    }
                    
            }
           
            else
            {
                
                $response = "Not found";
                $this->response($response, 404);
                
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
            
            $users = $this->auth->get_users();
            
            if($users)
            {
                
                $this->response($users, 200);
                
            }

            else
            {
                
                $this->response(array('error' => 'No users exist.'), 404);
                
            }
            
        }
        
}