<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bom
 *
 * @author hp
 */
class bom extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_bom');
        $this->load->model('model_user');
    }

    function index() {
        $this->load->view('bom/view');
    }

    function prints($modelid) {
        $this->load->model('model_model');
        $this->load->model('model_component');
        $this->load->model('model_item');
        $data['modelid'] = $modelid;
        $data['wood'] = $this->model_bom->selectAllWoodByModelId($modelid);
        //$data['woodbom'] = $this->model_model->selectWoodBom($modelid);
        $data['bom'] = $this->model_model->selectBomItemByModelId($modelid);
        $data['model'] = $this->model_model->selectById($modelid);
        $this->load->view('bom/print', $data);
    }

    function createtemporary($requestid, $modelid) {
        $this->model_bom->createtemporary($requestid, $modelid);
    }

}

?>
