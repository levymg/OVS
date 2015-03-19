<?php

class Qa_mdl extends MY_Model
{
    
  public $_table = "gc_user_questions";
  
  public $primary_key = 'resource_id';

  public function __construct()
  {
      
      parent::__construct();
      
      $response = new StdClass();
      
  }
  
  public function get_questions()
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
  
  public function add_question($data)
  {
      
        
      
  }
  
 
  
}