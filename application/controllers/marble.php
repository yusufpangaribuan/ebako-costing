<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of marble
 *
 * @author hp
 */
class marble extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_marble');
        $this->load->model('model_user');
    }

    function lists() {
        $data['marble'] = $this->model_marble->selectAll();
        $this->load->view('marble/list', $data);
    }

    function save() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_marble->save($name, $description);
    }

    function edit2($id) {
        $data['marble'] = $this->model_marble->selectById($id);
        $this->load->view('marble/edit2', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->model_marble->update($id, $name, $description);
    }

    function delete($id) {
        $this->model_marble->delete($id);
    }

}

?>
