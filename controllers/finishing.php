<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of finishing
 *
 * @author hp
 */
class finishing extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_finishing');
        $this->load->model('model_user');
    }

    function lists() {
        
        $data['finishing'] = $this->model_finishing->selectAll();
        $this->load->view('finishing/list', $data);
    }

    function save() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_finishing->save($name, $description);
    }

    function edit2($id) {
        $data['finishing'] = $this->model_finishing->selectById($id);
        $this->load->view('finishing/edit2', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_finishing->update($id, $name, $description);
    }

    function delete($id) {
        $this->model_finishing->delete($id);
    }

}

?>
