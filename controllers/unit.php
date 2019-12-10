<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of unit
 *
 * @author admin
 */
class unit extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_unit');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "unit"));
        $data['num_rows'] = $this->model_unit->getNumRows("", "", "");
        $limit = $this->config->item('limit');
        $offset = 0;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['number'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['unit'] = $this->model_unit->search("", "", "", $limit, $offset);
        $this->load->view('unit/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "unit"));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $remark = $this->input->post('remark');
        $data['num_rows'] = $this->model_unit->getNumRows($code, $name, $remark);
        $limit = $this->config->item('limit');
        $data['number'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['unit'] = $this->model_unit->search($code, $name, $remark, $limit, $offset);
        $this->load->view('unit/search', $data);
    }

    function lists() {
    	$data['uoms'] = $this->model_unit->selectAll();
    	echo json_encode($data);
    }
    
    function prints() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $remark = $this->input->post('remark');
        $data['unit'] = $this->model_unit->searchforprint($code, $name, $remark);
        $this->load->model('model_company');
        $data['companyaddress'] = $this->model_company->getAddressDetail();
        $this->load->view('unit/print', $data);
    }

    function add() {
        $data['unit'] = $this->model_unit->selectAll();
        $this->load->view('unit/add', $data);
    }

    function insert() {
        $codes = $this->input->post('codes');
        $names = $this->input->post('names');
        $remark = $this->input->post('remark');
        if ($this->model_unit->insert($codes, $names, $remark)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $data['unit'] = $this->model_unit->selectById($id);
        $this->load->view('unit/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $codes = $this->input->post('codes');
        $names = $this->input->post('names');
        $remark = $this->input->post('remark');
        if ($this->model_unit->update($id, $codes, $names, $remark)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        if ($this->model_unit->delete($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
