<?php

class Blog_mdl extends CI_Model
{
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    function add_post($data)
    {
        
        $data["created_on"] = time();
        
        $query = $this->db->insert("tbl_blog_posts", $data);
        
        if($query)
        {
            
            return "Post added.";
            
        }
        else
        {
            
            return "Post was not added.";
            
        }
        
    }
    
    function get_posts()
    {
        
        $this->db->select("*");
        
        $this->db->from("tbl_blog_posts");
        
        $query = $this->db->get();
        
        if($query)
        {
            
            return $query->result();
            
        }
        else
        {
            
            return "No Blog Posts Exist.";
            
        }
        
    }
    
    function get_post($data)
    {
        
        $this->db->select("*");
        
        $this->db->from("tbl_blog_posts");
        
        $this->db->where("post_title", $data);
        
        $query = $this->db->get();
        
        if($query)
        {
            
            return $query->result();
            
        }
        else
        {
            
            return "No Blog Posts Exist.";
            
        }
        
        
    }
    
}