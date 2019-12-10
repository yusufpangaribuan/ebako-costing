<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modeltype
 *
 * @author hp
 */
class modeltype extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_modeltype');
        $this->load->model('model_user');
    }

    function index() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "modeltype"));
            $data['num_rows'] = $this->model_modeltype->getNumRows("", "");
            $limit = $this->config->item('limit');
            $offset = 0;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['offset'] = $offset;
            $data['modeltype'] = $this->model_modeltype->search("", "", $limit, $offset);
            $this->load->view('modeltype/view', $data);
        }
    }

    function search($offset) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "modeltype"));
            $code = $this->input->post('code');
            $description = $this->input->post('description');
            $data['num_rows'] = $this->model_modeltype->getNumRows($code, $description);
            $limit = $this->config->item('limit');
            $data['offset'] = $offset + 1;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['offset'] = $offset;
            $data['modeltype'] = $this->model_modeltype->search($code, $description, $limit, $offset);
            $this->load->view('modeltype/search', $data);
        }
    }

    function prints() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $code = $this->input->post('codes');
            $name = $this->input->post('names');
            $description = $this->input->post('description');
            $data['modeltype'] = $this->model_modeltype->searchforprint($code, $name, $description);
            $this->load->model('model_company');
            $data['companyaddress'] = $this->model_company->getAddressDetail();
            $this->load->view('modeltype/print', $data);
        }
    }

    function add() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->view('modeltype/add');
        }
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['modeltype'] = $this->model_modeltype->selectById($id);
            $this->load->view('modeltype/edit', $data);
        }
    }

    function insert() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $code = $this->input->post('code');
            $description = $this->input->post('description');
            $data = array(
                "name" => $code,
                "description" => $description
            );
            if ($this->model_modeltype->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function update() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $id = $this->input->post('id');
            $code = $this->input->post('code');
            $description = $this->input->post('description');
            $data = array(
                "name" => $code,
                "description" => $description
            );
            if ($this->model_modeltype->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            if ($this->model_modeltype->delete(array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

}

?>
