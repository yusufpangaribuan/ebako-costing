<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class bank extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_bank');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "bank"));
        $data['bank'] = $this->model_bank->selectAll();
        $this->load->view('bank/view', $data);
    }

    function add() {
        $this->load->view('bank/add');
    }

    function save() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $branch = $this->input->post('branch');
        $city = $this->input->post('city');
        $country = $this->input->post('country');
        $kliring = $this->input->post('kliring');
        $rtgs = $this->input->post('rtgs');
        $swift = $this->input->post('swift');
        $this->model_bank->insert($code, $name, $branch, $city, $country, $kliring, $rtgs, $swift);
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_bank->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
