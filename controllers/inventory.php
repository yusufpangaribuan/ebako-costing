<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class inventory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        }
        $this->load->model('model_component');
        $this->load->model('model_item');
        $this->load->model('model_user');
    }

    function index() {
        $type = $this->input->post('type');
        $data['type'] = (empty($type) ? 2 : $type);
        $data['component'] = $this->model_component->search();
        $this->load->view('inventory/view', $data);
    }

    function searchoption() {
        $type = $this->input->post('type');
        if ($type == 2) {
            $data['component'] = $this->model_component->search();
            $this->load->view('inventory/component', $data);
        } else {
            $data['item'] = $this->model_item->search("", "", 0, 0, "", 50, 0);
            $this->load->view('inventory/material',$data);
        }
    }

    function material() {
        echo "test";
    }

}

?>
