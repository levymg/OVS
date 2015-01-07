<?php

class Notifications_mdl extends MY_Model
{
    
  public $_table = "gc_user_notifications";
  
  public $primary_key = 'resource_id';

  public function __construct()
  {
      
      parent::__construct();
      
  }
  
  function notifications($user_id)
  {
      
        $this->db->select('*');
        
        $this->db->from('gc_user_notifications');
        
        $this->db->join('gc_notifications', 'gc_user_notifications.user_id = ' . $user_id . ' AND gc_user_notifications.expires != 1 AND gc_user_notifications.notification_id = gc_notifications.notification_id ORDER BY created_on ASC');

        $query = $this->db->get();
        
        if($query)
        {
            
            return $query->result();
            
        }
        
        else
        {
            
             return FALSE;
            
        }
        
  }
  
  function create_notification($formData)
  {
      
      $result = $this->insert($formData);
      
      return $result;
      
  }
  
  function expire_notification($resource_id)
  {
      
      $this->db->set("expires", 1);
      
      $this->db->where("resource_id", $resource_id);
      
      $query = $this->db->update("gc_user_notifications");
      
      if($query)
      {
          
          return TRUE;
          
      }
      else
      {
          
          return FALSE;
              
      }
      
      
  }
  
  function get_last_notification($user_id)
  {

        $this->db->select('*');
        
        $this->db->from('gc_user_notifications');

        $this->db->join('gc_notifications', 'gc_user_notifications.user_id = ' . $user_id . '  AND gc_user_notifications.notification_id = gc_notifications.notification_id ORDER BY created_on ASC LIMIT 1');

        $query = $this->db->get();
        
        if($query)
        {
            
            return $query->result();
            
        }
        else
        {
            
            return FALSE;
                
        }
        
    }
  
}