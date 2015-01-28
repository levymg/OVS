<?php

class Pests_mdl extends CI_Model
{
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    function add_pest($data)
    {
        
        $data["created_on"] = time();
        
        $query = $this->db->insert("tbl_common_pests", $data);
        
        if($query)
        {
            
            return "Pest added.";
            
        }
        else
        {
            
            return "Pest was not added.";
            
        }
        
    }
    
    
}