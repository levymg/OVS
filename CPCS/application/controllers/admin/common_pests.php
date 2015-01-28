<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_pests extends CI_Controller {

	function __construct()
        {
            
            parent::__construct();
            
            $this->load->library("form_validation");
            
            $this->load->model("pests_mdl");
            
        }
        
	public function create_pest()
	{
            
		$this->form_validation->set_rules('pest_name', 'Pest Name', 'required|xss_clean');
                $this->form_validation->set_rules('pest_class', 'Pest Classification', 'required|xss_clean');
                $this->form_validation->set_rules('pest_season', 'Seasonal appearance', 'required|xss_clean');
                $this->form_validation->set_rules('pest_description', 'Pest Description', 'required|xss_clean');
                
                if ($this->form_validation->run() == FALSE)
                {
                    
                    echo validation_errors();

                }

                else
                {
                    
                    $config['upload_path'] = './assets/admin/insect_img';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	= '100';
                    $config['max_width']  = '1024';
                    $config['max_height']  = '768';

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload("pest_img"))
                    {
                        
                            $error = array('error' => $this->upload->display_errors());

                            print_r($error);
                            
                    }
                    else
                    {
                            
                            $data["pest_name"] = $this->input->post("pest_name");
                            $data["pest_class"] = $this->input->post("pest_class");
                            $data["pest_description"] = $this->input->post("pest_description");
                            $data["pest_season"] = implode(",", $this->input->post("pest_season"));
                            $upload_data = $this->upload->data();
                            $data["pest_img"] = $upload_data["file_name"];

                            $result = $this->pests_mdl->add_pest($data);
                            
                            echo $result;
                            
                    }
                    

                }
                
	}
        
}
