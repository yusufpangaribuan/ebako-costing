<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of packing
 *
 * @author hp
 */
class packing extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_packing');
        $this->load->model('model_user');
    }

    function lists() {
        $data['packing'] = $this->model_packing->selectAll();
        $this->load->view('packing/list', $data);
    }

    function save() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_packing->save($name, $description);
    }

    function edit2($id) {
        $data['packing'] = $this->model_packing->selectById($id);
        $this->load->view('packing/edit2', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_packing->update($id, $name, $description);
    }

    function delete($id) {
        $this->model_packing->delete($id);
    }

}

?>
