<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of setup
 *
 * @author hp
 */
class setup extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        $this->load->model('model_setup');
        $this->load->model('model_user');
    }

    function index() {
        $this->load->model('model_groups');
        $this->load->model('model_company');
        $data['purchasing'] = $this->model_setup->selectAllPurchasingGroup();        
        $data['itemgroup'] = $this->model_groups->selectAll();
        $data['company'] = $this->model_company->getDetail();
        $this->load->view('setup/view',$data);
    }

    function purchasinggroup() {
        $data['purchasing'] = $this->model_setup->selectAllPurchasingGroup();
        $this->load->model('model_groups');
        $data['itemgroup'] = $this->model_groups->selectAll();
        $this->load->view('setup/purchasinggroup', $data);
    }

    function editpurchasinggroup($id) {
        $this->load->model('model_groups');
        $data['itemgroup'] = $this->model_groups->selectAll();
        $data['purchasing'] = $this->model_setup->selectPurchasingGroupById($id);
        $this->load->view('setup/editpurchasinggroup', $data);
    }

    function updatepurchasinggroup() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $arritemgroup = $this->input->post('itemgroup');
        $itemgroup = empty($arritemgroup) ? "{0}" : "{" . join(',', $arritemgroup) . "}";
        $dataupdate = array("name" => $name, "itemgroup" => $itemgroup);
        $where = array("id" => $id);
        $this->model_setup->updatepurchasinggroup($dataupdate, $where);
    }

}

?>
