<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employee
 *
 * @author hp
 */
class employee extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('model_employee');
        $this->load->model('model_user');
    }

    function index() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "employee"));
            $data['employee'] = $this;
            $this->load->view('employee/view', $data);
        }
    }

    function search($offset) {
        if (!$this->session->userdata('id')) {
            echo "location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "employee"));
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $city = $this->input->post('city');

            $data['num_rows'] = $this->model_employee->getNumRows($id, $name, $address, $city);
            $limit = $this->config->item('limit');
            $data['offset'] = $offset + 1;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['employee'] = $this->model_employee->search($id, $name, $address, $city, $limit, $offset);
            $this->load->view('employee/search', $data);
        }
    }

    function add() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_position');
            $this->load->model('model_department');
            $this->load->model('model_setup');
            $this->load->model('model_warehouse');
            $data['department'] = $this->model_department->selectAll();
            $data['position'] = $this->model_position->selectAll();
            $data['warehouse'] = $this->model_warehouse->selectAll();
            $data['purchasing'] = $this->model_setup->selectAllPurchasingGroup();
            $this->load->view('employee/add', $data);
        }
    }

    function insert() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_user');

            $startdate = $this->input->post('startdate');
            $enddate = $this->input->post('enddate');
            $dob = $this->input->post('dob');


            $data = array(
                "id" => $this->input->post('id'),
                "name" => $this->input->post('name'),
                "address" => $this->input->post('address'),
                "city" => $this->input->post('city'),
                "state" => $this->input->post('state'),
                "zipcode" => $this->input->post('zipcode'),
                "workphone" => $this->input->post('workphone'),
                "homephone" => $this->input->post('workphone'),
                "startdate" => ($startdate == '' ? null : $startdate),
                "enddate" => ($enddate == '' ? null : $enddate),
                "email" => $this->input->post('email'),
                "dob" => ($dob == '' ? null : $dob),
                "positionid" => $this->input->post("positionid"),
                "departmentid" => $this->input->post("departmentid"),
                "optiongroup" => $this->input->post('optiongroup')
            );
            if ($this->model_employee->insert($data)) {
                if ($this->model_user->insert($this->input->post('id'), $this->input->post("departmentid"), md5($this->input->post('id')), $this->input->post('optiongroup'))) {
                    echo json_encode(array('success' => true));
                    $data_access = array(
                        "userid" => $this->input->post('id'),
                        "scriptmenu" => 'mr',
                        "actions" => 'add|edit|delete'
                    );
                    $this->model_user->saveConfigInputArray($data_access);
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_position');
            $this->load->model('model_department');
            $this->load->model('model_warehouse');
            $this->load->model('model_setup');
            $data['department'] = $this->model_department->selectAll();
            $data['position'] = $this->model_position->selectAll();
            $data['warehouse'] = $this->model_warehouse->selectAll();
            $data['purchasing'] = $this->model_setup->selectAllPurchasingGroup();
            $data['employee'] = $this->model_employee->selectById($id);
            $data['sub_department'] = $this->model_department->select_sub_department();
            $data['cost_center'] = $this->model_department->select_cost_center();
            $data['area'] = $this->model_department->select_area();
            $this->load->view('employee/edit', $data);
        }
    }

    function update() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $startdate = $this->input->post('startdate');
            $enddate = $this->input->post('enddate');
            $dob = $this->input->post('dob');


            $id = $this->input->post('id');

            $data = array(
                "name" => $this->input->post('name'),
                "address" => $this->input->post('address'),
                "city" => $this->input->post('city'),
                "state" => $this->input->post('state'),
                "zipcode" => $this->input->post('zipcode'),
                "workphone" => $this->input->post('workphone'),
                "homephone" => $this->input->post('workphone'),
                "startdate" => ($startdate == '' ? null : $startdate),
                "enddate" => ($enddate == '' ? null : $enddate),
                "email" => $this->input->post('email'),
                "dob" => ($dob == '' ? null : $dob),
                "positionid" => $this->input->post("positionid"),
                "departmentid" => $this->input->post("departmentid"),
                "optiongroup" => $this->input->post('optiongroup'),
                "area_id" => $this->input->post('area_id'),
                "sub_department_id" => $this->input->post('sub_department_id'),
                "cost_center_id" => $this->input->post('cost_center_id')
            );
            if ($this->model_employee->update($data, array("id" => $id))) {
                $data_user = array(
                    "departmentid" => $this->input->post("departmentid"),
                    "optiongroup" => $this->input->post('optiongroup')
                );
                if ($this->model_user->enable($data_user, array("id" => $id))) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_employee->delete($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function search_autocomplete() {
        sleep(3);

        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $term = $_GET['term'];


        $key_search = strtolower($term);

        if (get_magic_quotes_gpc()) {
            $key_search = stripslashes($key_search);
        }

        $row = array();

        $query = "select * from employee where true";
        if ($key_search != "") {
            $query .= " and (id ilike '%$key_search%' or name ilike '%$key_search%')";
        }
        $query .= " order by name asc ";


        $items = $this->db->query($query)->result();

        foreach ($items as $result) {
            array_push($row, array("id" => $result->id, "label" => $result->name, "value" => $result->name));
        }

        echo json_encode($row);
    }
    
    function search_autocomplete2() {
    
    	parse_str($_SERVER['QUERY_STRING'], $_GET);
    	$term = $_GET['term'];
    
    
    	$key_search = strtolower($term);
    
    	if (get_magic_quotes_gpc()) {
    		$key_search = stripslashes($key_search);
    	}
    
    	$row = array();
    
    	$query = "select * from employee where true";
    	if ($key_search != "") {
    		$query .= " and (id ilike '%$key_search%' or name ilike '%$key_search%')";
    	}
    	$query .= " order by name asc ";
    
    
    	$items = $this->db->query($query)->result();
    
    	foreach ($items as $result) {
    		array_push($row, array("id" => $result->id, "text" => $result->name));
    	}
    
    	echo json_encode($row);
    }
    
    function search_autocomplete_prepared_by() {
    
    	parse_str($_SERVER['QUERY_STRING'], $_GET);
    	$term = $_GET['term'];
    
    
    	$key_search = strtolower($term);
    
    	if (get_magic_quotes_gpc()) {
    		$key_search = stripslashes($key_search);
    	}
    
    	$row = array();
    
    	$query = "select * from employee where true";
    	if ($key_search != "") {
    		$query .= " and (id ilike '%$key_search%' or name ilike '%$key_search%')";
    	}
    	$query .= " order by name asc ";
    
    
    	$items = $this->db->query($query)->result();
    
    	foreach ($items as $result) {
    		array_push($row, array("id" => $result->name, "text" => $result->name));
    	}
    
    	echo json_encode($row);
    }

}

?>
