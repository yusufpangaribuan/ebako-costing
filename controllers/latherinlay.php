<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of latherinlay
 *
 * @author hp
 */
class latherinlay extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_latherinlay');
        $this->load->model('model_user');
    }

    function lists() {
        $data['latherinlay'] = $this->model_latherinlay->selectAll();
        $this->load->view('latherinlay/list', $data);
    }

    function save() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_latherinlay->save($name, $description);
    }

    function edit2($id) {
        $data['latherinlay'] = $this->model_latherinlay->selectById($id);
        $this->load->view('latherinlay/edit2', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_latherinlay->update($id, $name, $description);
    }

    function delete($id) {
        $this->model_latherinlay->delete($id);
    }

}

?>
