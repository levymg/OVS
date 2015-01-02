<?php
/**
 * A base model with a series of CRUD functions (powered by CI's query builder),
 * validation-in-model support, event callbacks and more.
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-model
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 */
class MY_Controller extends CI_Controller
{
    
    
    public function __construct()
    {
        
        parent::__construct();
        
    }
    
    public function json_response($array)
    {
        
       $this->output->set_content_type('application/json')
               ->set_output(json_encode(array("statusCode" => 200, "errors" => $array)));
        
    }
    
   
    
}
