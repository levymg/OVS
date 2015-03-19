<?php

class Calc_mdl extends MY_Model
{
    
  public $_table = "gc_calculation_categories";
  
  public $primary_key = 'resource_id';

  public function __construct()
  {
      
      parent::__construct();
      
  }
  
  public function get_categories()
  {
      
      $result = $this->get_all();
      
      if(!$result)
      {
          
          $response->statusCode = 403;
          
          $response->message = "No questions have been asked.";
          
      }
      else
      {
          
          $response->statusCode = 200;
          
          $response->message = $result;
          
      }
      
      return $response;
  }
  
   public function get_category($resource_id)
   {
       
       $this->db->select("*");
       
       $this->db->from("gc_calculations");
       
       $this->db->where("category", $resource_id);
       
       $query = $this->db->get();
       
        if($query)
        {
            
            $response->message = $query->result();
            
            $response->statusCode = 200;
                    
        }
        else
        {
            
            $response->message = "No matching items found.";
            
            $response->statusCode = 403;
            
        }
        
        return $response;
       
   }
   
   public function get_unit($resource_id)
   {
       
       $this->db->select("*");
       
       $this->db->from("gc_calculations");
       
       $this->db->where("resource_id", $resource_id);
       
       $query = $this->db->get();
       
        if($query)
        {
            
            $response->message = $query->result();
            
            $response->statusCode = 200;
                    
        }
        else
        {
            
            $response->message = "No matching items found.";
            
            $response->statusCode = 403;
            
        }
        
        return $response;
       
   }
   
   public function load_favorite($user_id)
   {
       
       $this->db->select("category", "");
       
   }
   
   public function get_calculations()
   {
       
       $this->db->select("created_on, email, first_name, last_name, company, phone, resource_id, unit, result");
       
       $this->db->from("gc_user_calculations");
       
       $this->db->join('gc_users', 'gc_users.user_id=gc_user_calculations.user_id', 'left');
       
       $query = $this->db->get();
       
       if($query->num_rows() > 0)
       {
           
           return $query->result();
                   
       }
       else
       {
           
           return FALSE;
           
       }
       
   }
   
   public function insert_calculation($data)
   {
       
      return $this->db->insert("gc_user_calculations", $data);
       
   }
    
}