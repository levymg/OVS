<?php

class Auth extends MY_Model
{
    
  public $_table = "gc_users";
  
  public $primary_key = 'user_id';

  public function __construct()
  {
      
      parent::__construct();
      
  }
  
  public function create_user($formData)
  {
      
      $data = array(
                    "active" => 1,
                    "email" => $formData["email"],
                    "password" => base64_encode(hash("sha256", $formData["password"])),
                    "ip_address" => $this->input->ip_address(),
                    "registered_on" => time(),
                    "last_login" => 0,
                    "login_attempts" => 0,
                    "modified_on" => time(),
                    "usage_level" => 0
                );
      $exists = $this->get_by('email', $data["email"]);
      
      if($exists)
      {
            $result = new StdClass();
            $result->status = 403;
            $result->message = "This e-mail address is already registered.";
            return $result;
          
      }
      else
      {
          
        $result = $this->insert($data, FALSE);
        
        if($result) :
            
            $result = new StdClass();
            $result->status = 200;
            $result->callback = "view/static/splash-main.html";
            $result->focus = "#login-form";
            $result->message = "Please sign in.";
            return $result;
        
        endif;
        
      }
      
  }
  
  public function authenticate($formData)
  {
      
      $data = array(
          
                    "email" => $formData["email"],
                    "password" => base64_encode(hash("sha256", $formData["password"])),
                    "ip_address" => $this->input->ip_address(),
          
                );
      
      $args = array(
          
                    "email" => $data["email"], 
                    "password" => $data["password"]
              );
      
      $exists = $this->as_object()->get_by($args);
      
      if($exists)
      {
          
          if($exists->login_expires > time())
          {
              
              $this->db->where('email', $data['email']);
            
              $this->db->set('login_attempts', '`login_attempts`+ 1', FALSE);
            
              $this->db->update("gc_users");
              
              $result = new StdClass();
              $result->status = 400;
              $result->message =  "You have exceeded the amount of login attempts allowed.  Please wait 5 minutes before trying again.";
              
              return $result;
              
          }
          
          else
          {
          
          $args = array(
              
                        "last_login" => time(),
                        "login_attempts" => 0,
                        "login_expires" => NULL
              
                    );
          
          $this->update($exists->user_id, $args);
          
            $result = new StdClass();
            $result->status = 200;
            $result->user_id = $exists->user_id;
            
            return $result;
            
          }
          
      }
      else
      {
          
          //Check if e-mail is registered
          $args = array("email" => $data["email"]);
          
          $exists = $this->as_object()->get_by($args);
          
          //If the e-mail is registered, check the login attempts
          if($exists && $exists->login_attempts >= 5)
          {
              
            $expiration = time() + 5*60;
              
            $this->db->where('email', $data['email']);
            
            $this->db->set('login_expires', $expiration, FALSE);
            
            $this->db->update("gc_users");
              
            $result = new StdClass();
            $result->status = 400;
            $result->message = "You have exceeded the amount of login attempts allowed.  Please wait 5 minutes before trying again.";
            
            return $result;
          }
          
          else 
          {
              
            $this->db->where('email', $data['email']);
            
            $this->db->set('login_attempts', '`login_attempts`+ 1', FALSE);
            
            $this->db->update("gc_users");
          
            $result = new StdClass();
            $result->status = 403;
            $result->message = "Incorrect username / password";
            
            return $result;
          }
            
          }
        
      }
      
  }