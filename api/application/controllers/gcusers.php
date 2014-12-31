<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Gcusers extends REST_Controller
{
	function __construct()
        {
            parent::__construct();
            
            $this->load->model("auth");

        }
    
    function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

    	$user = $this->auth->get_by('id', $this->get('id'));
    	
        if($user)
        {
            $this->response($user, 200);
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200);
    }
    
    function user_delete()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

    	//$user = $this->auth->get_by('id', $this->get('id'));
    	
        if($user)
        {
            $this->response($user, 200);
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
        
    }
    
    function users_get()
    {
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);
        
        if($users)
        {
            $this->response($users, 200);
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    
    function authenticate()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->response(array('credentials' => $username . " " . $password), 200);
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}