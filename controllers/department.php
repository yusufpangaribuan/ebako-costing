<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of department
 *
 * @author admin
 */
class department extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_department');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "department"));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $data['num_rows'] = $this->model_department->getNumRows($code, $name, $description);
        $limit = $this->config->item('limit');
        $offset = 0;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['department'] = $this->model_department->search($code, $name, $description, $limit, $offset);
        $this->load->view('department/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "department"));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $data['num_rows'] = $this->model_department->getNumRows($code, $name, $description);
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['department'] = $this->model_department->search($code, $name, $description, $limit, $offset);
        $this->load->view('department/search', $data);
    }

    function prints() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->load->model('model_company');
        $data['companyaddress'] = $this->model_company->getAddressDetail();
        $data['department'] = $this->model_department->searchforprint($code, $name, $description);
        $this->load->view('department/print', $data);
    }

    function add() {
        $this->load->view('department/add');
    }

    function insert() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        if ($this->model_department->insert($code, $name, $description)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update() {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        if ($this->model_department->update($id, $code, $name, $description)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        if ($this->model_department->delete($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $data['department'] = $this->model_department->selectById($id);
        $this->load->view('department/edit', $data);
    }

}