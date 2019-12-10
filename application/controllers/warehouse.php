<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of warehouse
 *
 * @author hp
 */
class warehouse extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_warehouse');
        $this->load->model('model_user');
    }
    
    function index(){
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "warehouse"));
        $data['warehouse'] = $this->model_warehouse->search();
        $this->load->view('warehouse/view',$data);
    }
}

?>
