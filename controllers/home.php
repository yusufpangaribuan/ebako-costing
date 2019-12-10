<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        if ($this->session->userdata('id')) {
            $this->load->model('model_user');
            $raw_accessmenu = $this->model_user->selectAccessMenuByUserid($this->session->userdata('id'));
            $accessmenu = [];
            foreach ($raw_accessmenu as $key => $row){
            	$accessmenu [ $row->scriptmenu ] = $row->label; 
            }
            $data['accessmenu'] = $accessmenu;
            
            $this->load->view('home/index', $data);
        } else {
            $this->load->view('home/login');
        }
    }

    function login() {
        $this->load->model('model_user');
        $name = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        $password = md5($password);
        $user = $this->model_user->login($name, $password);
        if (!empty($user)) {
            $this->session->set_userdata('id', $user->id);
            $this->session->set_userdata('department', $user->departmentid);
            $this->session->set_userdata('optiongroup', $user->optiongroup);
            $this->session->set_userdata('subdepartmentid', $user->sub_department_id);
            $this->session->set_userdata('costcenterid', $user->cost_center_id);
            $this->session->set_userdata('areaid', $user->area_id);
            redirect('');
        } else {
            $msg = "Error! User not found.";
            $this->session->set_userdata('msg', $msg);
            redirect('');
        }
    }

    function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('msg');
        redirect('');
    }

}