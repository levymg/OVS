<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class GCNotifications extends REST_Controller
{
    
	function __construct()
        {
            parent::__construct();
            
            $this->load->model("notifications_mdl");
            
            $this->load->library('form_validation');
            $this->load->library("MY_Form_validation");
        }
        
        function notifications_get()
        {
            
             if(!$this->get('user_id'))
            {
                
                    $this->response(NULL, 400);
                    
            }
            
            $notifications = $this->notifications_mdl->notifications('user_id', $this->get('user_id'));

            if($notifications)
            {
                
                $this->response(array("notifications" => $notifications), 200);
                
                
            }
            else
            {
                
                $this->response("No Notifications", 403);
            }
            
        }
        
        function notifications_post()
        {
            
            if(!$this->post("resource_id"))
            {
                
                $formData = array(
                                
                                "user_id" => $this->post("user_id"),
                                "notification_id" => $this->post("notification_id"),
                                "created_on" => time(),
                                "expires" => time() + 60*60
                    
                            );
                
                $result = $this->notifications_mdl->create_notification($formData);
                
                if($result)
                {
                    
                    $this->response("Notification added", 200);
                    
                }
                else
                {
                    
                    $this->response("Error", 403);
                    
                }
                
            }
            else
            {
                
                $result = $this->notifications_mdl->expire_notification($this->post("resource_id"));
                
                if($result)
                {
                    
                    $callback = "processAction()";
                    
                    $this->response("Success", 200);
                    
                }
                else
                {
                    
                    $this->response("Zero", 200);
                }
                
            }
            
        }
        
}
