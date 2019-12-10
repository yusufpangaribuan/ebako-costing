<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_user');
    }

    function index() {
        $offset = 0;
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $data['num_rows'] = $this->model_user->getNumRows($id, $name);
        $limit = $this->config->item('limit');
        $data['number'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['users'] = $this->model_user->search($id, $name, $limit, $offset);
        $this->load->view('user/view', $data);
    }

    function search($offset) {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $data['num_rows'] = $this->model_user->getNumRows($id, $name);
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['users'] = $this->model_user->search($id, $name, $limit, $offset);
        $this->load->view('user/search', $data);
    }

    function add() {
        $this->load->model('model_employee');
        $this->load->model('model_department');
        $this->load->model('model_warehouse');
        $this->load->model('model_setup');
        $data['employee'] = $this->model_employee->selectAll();
        $data['department'] = $this->model_department->selectAll();
        $data['warehouse'] = $this->model_warehouse->selectAll();
        $data['purchasing'] = $this->model_setup->selectAllPurchasingGroup();
        $this->load->view('user/add', $data);
    }

    function insert() {
        $id = $this->input->post('id');
        $departmentid = $this->input->post('departmentid');
        $password = $this->input->post('password');
        $optiongroup = $this->input->post('optiongroup');
        if ($this->model_user->insert($id, $departmentid, md5($password), $optiongroup)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function changepassword() {
        $data['userid'] = $this->session->userdata('id');
        $this->load->view('user/changepassword', $data);
    }

    function adminchangepassword($userid) {
        $data['userid'] = $userid;
        $this->load->view('user/adminchangepassword', $data);
    }

    function dochangepassword() {
        $userid = $this->input->post('userid');
        $newpassword = $this->input->post('newpassword');
        if ($this->model_user->changepassword($userid, $newpassword)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function config($userid) {
        $this->load->model('model_menu');
        $data['menu'] = $this->model_menu->selectAll_for_costing();
        $data['userid'] = $userid;
        $this->load->view('user/config', $data);
    }

    function saveconfig() {
        $userid = $this->input->post('userid');
        $arrmenu = $this->input->post('arrmenu');
        $this->model_user->deleteConfig($userid);
        for ($i = 0; $i < count($arrmenu); $i++) {
            if ($arrmenu[$i] != "home") {
                $this->model_user->saveConfig($userid, $arrmenu[$i]);
            }
        }
    }

    function setaction($userid, $accessmenu) {
        $data['userid'] = $userid;
        $data['accessmenu'] = $accessmenu;
        $data['action'] = $this->model_user->getMenuAction($accessmenu);
        $data['useraction'] = $this->model_user->getAction($userid, $accessmenu);
        $this->load->view('user/setaction', $data);
    }

    function dosetaction() {
        $userid = $this->input->post('userid');
        $accessmenu = str_replace("_", "/", $this->input->post('accessmenu'));
        $action = $this->input->post('action');
        if ($this->model_user->dosetaction($userid, $accessmenu, $action)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $userid = $this->input->post('userid');
        if ($this->model_user->delete($userid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function enable() {
        $userid = $this->input->post('userid');
        $rule = $this->input->post('rule');
        $where = array("id" => $userid);
        $data = array("enabled" => $rule);
        if ($this->model_user->enable($data, $where)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function removeaction() {
        $userid = $this->input->post('userid');
        $accessmenu = $this->input->post('accessmenu');
        $where = array(
            "userid" => $userid,
            "scriptmenu" => $accessmenu
        );
        if ($this->model_user->removeaction($where)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}