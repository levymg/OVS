<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Gccalc extends REST_Controller
{
	function __construct()
        {
            parent::__construct();
            $this->load->model("calc_mdl");
            $this->load->model("auth");
        }
    
    function calculations_get()
    {
        
        $calcs = $this->calc_mdl->get_calculations();
        
        $this->response($calcs, 200);
        
    }
    
    function calculation_post()
    {
        
        $data = new StdClass();
        
        $data->user_id = $this->input->post("user_id");
        $data->created_on = time();
        $data->unit = $this->input->post("unit");
        $data->result = $this->input->post("result");
        
        $calc = $this->calc_mdl->insert_calculation($data);
        
        $this->response($calc, 200);
        
    }
    

}