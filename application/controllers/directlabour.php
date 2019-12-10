<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class directlabour extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_directlabour');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "directlabour"));
        $offset = 0;
        $description = "";
        $data['num_rows'] = $this->model_directlabour->getNumRows($description);
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['directlabor'] = $this->model_directlabour->search($description, $limit, $offset);
        $this->load->view('directlabour/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "directlabour"));
        $description = $this->input->post('description');
        $data['num_rows'] = $this->model_directlabour->getNumRows($description);
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['directlabor'] = $this->model_directlabour->search($description, $limit, $offset);
        $this->load->view('directlabour/search', $data);
    }

    function add() {
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        } else {
            $this->load->model('model_unit');
            $data['unit'] = $this->model_unit->selectAll();
            $this->load->view('directlabour/add', $data);
        }
    }

    function save() {
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        } else {
            $directlabour = array(
                "description" => $this->input->post('description'),
                "unit" => $this->input->post('unitid'),
                "price" => $this->input->post('price'),
                "percentage" => $this->input->post('percentage'),
            );
            $this->model_directlabour->insert($directlabour);
        }
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        } else {
            $this->load->model('model_unit');
            $data['unit'] = $this->model_unit->selectAll();
            $data['directlabour'] = $this->model_directlabour->selectById($id);
            $this->load->view('directlabour/edit', $data);
        }
    }

    function update() {
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        } else {
            $id = $this->input->post('id');
            $directlabour = array(
                "description" => $this->input->post('description'),
                "unit" => $this->input->post('unitid'),
                "price" => $this->input->post('price'),
                "percentage" => $this->input->post('percentage'),
            );
            $this->model_directlabour->update($directlabour, array("id" => $id));
        }
    }
    
    function updateLabourBaseOnUMK(){
    	$labour_value = $this->input->post('labour');
    	
    	$all_directlabor = $this->model_directlabour->selectAll();
    	
    	foreach ($all_directlabor as $directlabour){
    		$percentage = (double) $directlabour->percentage;
    		if($percentage <= 0 ){
    			$percentage = 100;
    		}
    		
    		$directlabour_updated = array(
    				"price" => $percentage * $labour_value / 100,
    		);
    		$this->model_directlabour->update( $directlabour_updated, array( "id" => $directlabour->id ) );
    	}
    	
    	echo json_encode(array('success' => true));
    }

    function delete($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        } else {
            $this->model_directlabour->delete($id);
        }
    }

    function getByIdForSelection($id) {
    	if( !empty( $id ) ){
    		$data['directlabour'] = $this->model_directlabour->selectById( $id );
    	}else{
    		$data['directlabour'] = "";
    	}
    	echo json_encode($data);
    }
    
    function getAllForSelection_new_material() {
    	$term = $this->input->get('term');
    	$key_search = strtolower($term);
    	$data['datas']['options'] = $this->model_directlabour->getAllForSelection( $key_search );
    	
    	echo json_encode($data);
    }
    
}
?>


