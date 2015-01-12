<?php

class Industries_mdl extends MY_Model
{
    
  public $_table = "gc_industries";
  
  public $primary_key = 'resource_id';

  public function __construct()
  {
     parent::__construct();
      
  }
  
  public function create_gcgs($formData)
  {
      
      $response = new StdClass();

      $query = $this->db->insert("gc_gradesheet_submissions", $formData);
      
      if($query)
      {
          
          $response->message = "Record Added";

          $response->status = 200;
          
          return $response;
          
      }
      else
      {
          
          $response->message = "Something went wrong.";

          $response->status = 403;
          
          return $response;
          
      }
      
  }
  
  public function get_industries()
  {
      
      $query = $this->db->get("gc_industries");
      
      $industries = new StdClass();
      
        if ($query->num_rows() > 0)
        {
            
           foreach ($query->result() as $row => $key)
            {
              
               $industries->$row = (object) array("resource_id" => $key->resource_id, "industry_name" => $key->industry_name);
               
            }
           
        }
        
        return $industries;
      
  }
  
   public function get_industry($resource_id)
  {
       
        $this->db->select('gc_industries.*, gc_sales_reps.*');
        $this->db->from('gc_industries');
        $this->db->where('gc_industries.resource_id', $resource_id);
        $this->db->join('gc_industry_properties', 'gc_industry_properties.industry_id=gc_industries.resource_id', 'left');
        $this->db->join('gc_sales_reps', 'gc_sales_reps.rep_id=gc_industries.sales_rep', 'left');
        $this->db->join('gc_industry_selections','gc_industry_selections.resource_id=gc_industry_properties.selection_id', 'left')->select('GROUP_CONCAT(gc_industry_properties.selection_id) AS selections')->where('gc_industry_properties.industry_id', $resource_id)->group_by('gc_industry_properties.industry_id');
        $this->db->join('gc_industry_gradesheets', 'gc_industry_gradesheets.industry_id=gc_industries.resource_id', 'left')->select('GROUP_CONCAT(gc_industry_gradesheets.gradesheet) AS gradesheets')->where(array('gc_industry_gradesheets.industry_id' => $resource_id, 'gc_industry_gradesheets.properties_hook' => 0)); 
        $this->db->order_by('gc_industry_gradesheets.gradesheet', 'ASC');
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            
            
            foreach ($query->result() as $row => $key)
            {
               
                
                $selections = explode(',', $key->selections);
                
                $gradesheets = explode(',', $key->gradesheets);
                
                $industry = array(
                    
                        "resource_id" => $key->resource_id,
                        "industry_name" => $key->industry_name,
                        "wear_resistance" => $key->wear_resistance,
                        "gatekeeper" => $key->gatekeeper,
                        "rep" => $key->first_name ." " . $key->last_name,
                        "rep_email" => $key->email,
                        "rep_phone" => $key->phone,
                        "rep_alt_phone" => $key->alt_phone,
                        "selections" => array_unique($selections),
                        "gradesheets" => array_unique($gradesheets)
                    
                );
                
                        
            }
           
        }
        
        return $industry;
      
  }
  
}