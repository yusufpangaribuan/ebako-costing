<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of position
 *
 * @author admin
 */
class position extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_position');
        $this->load->model('model_user');
    }

    function index() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "position"));
            $data['num_rows'] = $this->model_position->getNumRows("", "", "");
            $limit = $this->config->item('limit');
            $offset = 0;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['position'] = $this->model_position->search("", "", "", $limit, $offset);
            $this->load->view('position/view', $data);
        }
    }

    function search($offset) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "position"));
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $data['num_rows'] = $this->model_position->getNumRows($code, $name, $description);
            $limit = $this->config->item('limit');
            $data['offset'] = $offset + 1;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['position'] = $this->model_position->search($code, $name, $description, $limit, $offset);
            $this->load->view('position/search', $data);
        }
    }

    function prints() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $data['position'] = $this->model_position->searchforprint($code, $name, $description);
            $this->load->model('model_company');
            $data['companyaddress'] = $this->model_company->getAddressDetail();
            $this->load->view('position/print', $data);
        }
    }

    function add() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->view('position/add');
        }
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['position'] = $this->model_position->selectById($id);
            $this->load->view('position/edit', $data);
        }
    }

    function insert() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $data = array(
                "code" => $code,
                "name" => $name,
                "description" => $description
            );
            if ($this->model_position->insert($data)) {
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
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $data = array(
                "code" => $code,
                "name" => $name,
                "description" => $description
            );

            if ($this->model_position->update($data, array("id" => $id))) {
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
            if ($this->model_position->delete($id)) {
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
            $position = $this->model_position->selectAll();
            echo "<option value=0>--Group--</option>";
            foreach ($position as $result) {
                echo "<option value='" . $result->id . "'>[" . $result->code . "]" . $result->name . "</option>";
            }
        }
    }

}

?>
