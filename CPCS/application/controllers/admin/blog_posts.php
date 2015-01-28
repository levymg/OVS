<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_posts extends CI_Controller {

	function __construct()
        {
            
            parent::__construct();
            
            $this->load->library("form_validation");
            
            $this->load->model("blog_mdl");
            
        }
        
	public function create_post()
	{
            
		$this->form_validation->set_rules('post_title', 'Post Title', 'required|xss_clean');
                $this->form_validation->set_rules('post_author', 'Post Author', 'required|xss_clean');
                $this->form_validation->set_rules('post_content', 'Post Content', 'required|xss_clean');
                $this->form_validation->set_rules('publish_status', 'Publish Status', 'required|xss_clean');
                
                if ($this->form_validation->run() == FALSE)
                {
                    
                    echo validation_errors();

                }

                else
                {
                    
                    $config['upload_path'] = './assets/admin/blog_img';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	= '100';
                    $config['max_width']  = '1280';
                    $config['max_height']  = '295';

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload("post_img"))
                    {
                        
                            $error = array('error' => $this->upload->display_errors());

                            print_r($error);
                            
                    }
                    else
                    {
                            
                            $data["post_title"] = $this->input->post("post_title");
                            $data["post_author"] = $this->input->post("post_author");
                            $data["post_content"] = $this->input->post("post_content");
                            $data["publish_status"] = $this->input->post("publish_status");
                            $upload_data = $this->upload->data();
                            $data["post_img"] = $upload_data["file_name"];

                            $result = $this->blog_mdl->add_post($data);
                            
                            echo $result;
                            
                    }
                    

                }
                
	}
        
}
