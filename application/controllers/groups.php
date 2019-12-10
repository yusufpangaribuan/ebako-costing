<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groups
 *
 * @author admin
 */
class groups extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_groups');
        $this->load->model('model_user');
    }

    function index() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "groups"));
            $data['num_rows'] = $this->model_groups->getNumRows("", "", "");
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
            $data['groups'] = $this->model_groups->search("", "", "", $limit, $offset);
            $this->load->view('groups/view', $data);
        }
    }

    function search($offset) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "groups"));
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $data['num_rows'] = $this->model_groups->getNumRows($code, $name, $description);
            $limit = $this->config->item('limit');
            $data['offset'] = $offset + 1;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['offset'] = $offset;
            $data['groups'] = $this->model_groups->search($code, $name, $description, $limit, $offset);
            $this->load->view('groups/search', $data);
        }
    }

    function prints() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $code = $this->input->post('codes');
            $name = $this->input->post('names');
            $description = $this->input->post('description');
            $data['groups'] = $this->model_groups->searchforprint($code, $name, $description);
            $this->load->model('model_company');
            $data['companyaddress'] = $this->model_company->getAddressDetail();
            $this->load->view('groups/print', $data);
        }
    }
    
    function lists() {
    	$data['groups'] = $this->model_groups->selectAllForSelect();
    	echo json_encode($data);
    }

    function add() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->view('groups/add');
        }
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['groups'] = $this->model_groups->selectById($id);
            $this->load->view('groups/edit', $data);
        }
    }

    function insert() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $codes = $this->input->post('code');
            $names = $this->input->post('name');
            $descriptions = $this->input->post('description');
            if ($this->model_groups->insert($codes, $names, $descriptions)) {
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
            $codes = $this->input->post('codes');
            $names = $this->input->post('names');
            $descriptions = $this->input->post('descriptions');
            if ($this->model_groups->update($id, $codes, $names, $descriptions)) {
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
            if ($this->model_groups->delete($id)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function reload() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $groups = $this->model_groups->selectAll();
            echo "<option value=0>--Group--</option>";
            foreach ($groups as $result) {
                echo "<option value='" . $result->id . "'>[" . $result->codes . "]" . $result->names . "</option>";
            }
        }
    }

}

?>
