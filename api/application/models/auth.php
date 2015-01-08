<?php

class Auth extends MY_Model
{
    
  public $_table = "gc_users";
  
  public $primary_key = 'user_id';

  public function __construct()
  {
      
      parent::__construct();
      
  }
  
  public function get_users()
  {
      
      $result = $this->get();
      
      return $result->result();
      
      
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
            
            $response = new StdClass();
            $response->status = 200;
            $response->callback = "view/static/splash-main.html";
            $response->focus = "#login-form";
            $response->message = "Please sign in.";
            
            $formData = 
                    
                        array(
                
                                "user_id" => $this->db->insert_id(),
                                "notification_id" => 7,
                                "created_on" => time(),
                                "expires" => time() * 60*60
                            
                        );
            
            $this->notifications_mdl->create_notification($formData);
            
            return $response;
        
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
          
          $user_token = $this->encrypt->encode(time() + $exists->user_id);
          
          $private_token = $this->encrypt->decode($user_token);
          
          $data = array(
              
                 "user_id" => $exists->user_id,
                 "token" => $private_token,
                 "created_on" => time(),
                 "expired" => 0
              
          );
          
          $this->db->insert("gc_user_tokens", $data);
          
          
          $result = new StdClass();
          $result->status = 200;
          $result->user_id = $exists->user_id;
          $result->token = $user_token;
            
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
      
      public function update_profile($formData) {
          
        
        if(isset($formData["password"]))
        {

            $formData["password"] = base64_encode(hash("sha256", $formData["password"]));

        }
           
        $data = (object) $formData;
        
        $args = array("user_id" => $data->user_id);
        
        $exists = $this->as_object()->get_by($args);
        
        if($exists->usage_level == 0 && !isset($formData["password"]))
        {
            
            $formData["usage_level"] = 1;
            
            $notificationData = 
                    
                        array(
                
                                "user_id" => $data->user_id,
                                "notification_id" => 1,
                                "created_on" => time(),
                                "expires" => time() * 60*60
                            
                        );
            
            $this->notifications_mdl->create_notification($notificationData);
            
        }
          
        $this->db->where("user_id", $data->user_id);
        
        $this->db->set($formData);
        
        $query = $this->db->update("gc_users");
        
        if($query)
        {
            
            
            if(isset($formData["password"]))
            {
                
                    $notificationData = 

                                array(

                                        "user_id" => $data->user_id,
                                        "notification_id" => 8,
                                        "created_on" => time(),
                                        "expires" => time() * 60*2

                                );

                    $this->notifications_mdl->create_notification($notificationData);
                    
            }
            
            $response = array(
                
                            "message" => "Profile updated.",
                            "callback" => "processAction",
                            "user_id" => $data->user_id,
                            "responseCode" => 200
            );
            
        }
        
        else
        {
            
            $response = array(
                
                            "message" => "There was an error updating your profile.",
                            "callback" => "edit-profile",
                            "responseCode" => 400
            );
            
        }
        
        return $response;
          
      }
      
      public function check_creds($formData)
      {
          
         $data = (object) $formData;
          
         $args = array("user_id" => $data->user_id, "password" => base64_encode(hash("sha256", $data->password)));
        
         $exists = $this->as_object()->get_by($args);
         
         if($exists)
         {
             
             return TRUE;
             
         }
         else
         {
             
             return FALSE;
             
         }
          
          
      }
      
      public function reset_password($formData)
      {
          
          $args = array("email" => $formData);
          
          $exists = $this->as_object()->get_by($args);
          
          if($exists)
          {
              
            $result = new StdClass();
            $result->callback = "view/static/splash-main.html";
            $result->focus = "#login-form";
            $result->message = "Your password has been sent.";
            $result->status = 200;
              
          }
          
          else
          {
              
            $result = new StdClass();
            $result->status = 403;
            $result->message = "The user was not found.";
              
              
          }
          
          return $result;
          
      }
      
       public function authenticate_token($formData)
      {
           
         $decode_token = $this->encrypt->decode($formData["token"]);
         
         $this->db->select("*");
           
         $this->db->where(array("user_id" => $formData["user_id"], "token" => $decode_token));
         
         $query = $this->db->get("gc_user_tokens");
         
         $row = $query->row_array(); 
         
         if($query->num_rows > 0)
         {
              
             if(array_key_exists("expired", $formData))
             {
                 $this->db->where(array("user_id" => $formData["user_id"], "token" => $decode_token));
                 
                 $this->db->set("expired", time());
                 
                 $this->db->update('gc_user_tokens');
                 
             }
             
             $result = new stdClass();
             $result->message = "OK";
             $result->status = 200;
             
         }
         elseif($query->num_rows > 2)
         {
             
             $result = new stdClass();
             $result->status = 403;
             $result->message = "Invalid session id.";
             
         }
         else
         {
             
             $result = new stdClass();
             $result->status = 403;
             $result->message = "Your session has timed out.";
             
         }
         
         return $result;
           
      }
          
}