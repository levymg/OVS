<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
        {
            
            parent::__construct();
            
            $this->load->model("blog_mdl");
            
        }
        
	public function index()
	{
            
            $data["title"] = "Latest Pest and Rodent Updates from Complete Pest Control Services";
            
            $data["meta"] = "<meta name='description' content='' />";
            
            $data["posts"] = $this->blog_mdl->get_posts();
            
            $this->load->view('template/header', $data);

            $this->load->view("content/blog", $data);
            
            $this->load->view("template/sidebar", $data);

            $this->load->view("template/footer", $data);
                
	}
        
        public function get_post()
        {
            
            if ($this->uri->segment(2) === FALSE)
            {
                $this->index;
            }
            else
            {
                
                $post = $this->blog_mdl->fetch_post($this->uri->segment(2));
                
            }
            
        }
        
}
