<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_employee
 *
 * @author admin
 */
class model_employee extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectAll() {
        $query = "select 
                employee.*,
                position.name \"position\"
                from employee 
                left join position on employee.positionid=position.id";
        return $this->db->query($query)->result();
    }

    function getNumRows($id, $name, $address, $city) {
        $query = "select * from employee where true ";
        if (!empty($id)) {
            $query .= " and id ilike '%$id%' ";
        }if (!empty($name)) {
            $query .= " and name ilike '%$name%' ";
        }if (!empty($address)) {
            $query .= " and address ilike '%$address%' ";
        }if (!empty($city)) {
            $query .= " and city ilike '%$city%' ";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($id, $name, $address, $city, $limit, $offset) {
        $query = "select 
                employee.*,
                department.name department,
                dept_division.name subdepartment,
                area.name area,
                cost_center.code costcenter,
                position.name \"position\"
                from employee 
                left join position on employee.positionid=position.id 
                left join department on employee.departmentid=department.id
                left join dept_division on employee.sub_department_id=dept_division.id
                left join area on employee.area_id=area.id
                left join cost_center on employee.cost_center_id=cost_center.id
                 where true";
        if ($id != "") {
            $query .= " and employee.id ilike '%$id%' ";
        }if ($name != "") {
            $query .= " and employee.name ilike '%$name%' ";
        }if ($address != "") {
            $query .= " and employee.address ilike '%$address%' ";
        }if ($city != "") {
            $query .= " and employee.city ilike '%$city%' ";
        }
        $query .= " and employee.name != 'admin' ";
        $query .= " order by employee.id_field desc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $this->db->where('id', $id);
        return $this->db->get('employee')->row();
    }

    function searchToPr($employeeid, $employeename) {
        $query = "select 
                employee.*,
                position.name \"position\"
                from employee 
                left join position on employee.positionid=position.id where true  ";
        if ($employeeid != "") {
            $query .= " and employee.id ilike '%$employeeid%' ";
        }if ($employeename != "") {
            $query .= " and employee.name ilike  '%" . $employeename . "%' ";
        }
        $query .= " order by name asc ";
        echo $query;
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('employee', $data);
    }

    function update($data, $where) {
        return $this->db->update('employee', $data, $where);
    }

    function getNameById($id) {
        $temp = "";
        if ($id != "") {
            $query = "select \"name\" from employee where id='$id'";
            //echo $query;
            $dt = $this->db->query($query)->row();
            $temp = (empty($dt) ? "" : $dt->name);
        }
        return $temp;
    }

    function delete($id) {
        return $this->db->delete("employee", array("id" => $id));
    }

}

?>
