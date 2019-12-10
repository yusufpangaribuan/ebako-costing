<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_department
 *
 * @author admin
 */
class model_department extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectById($id) {
        return $this->db->query("select * from department where id=$id")->result();
    }

    function getNumRows($code, $name, $description) {
        $query = "select * from department where true ";
        if ($code != "") {
            $query .= " and code ilike '%$code%'";
        }if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($code, $name, $description, $limit, $offset) {
        $query = "select * from department where true ";
        if ($code != "") {
            $query .= " and code ilike '%$code%'";
        }if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id desc limit $limit offset $offset";
        return $this->db->query($query)->result();
    }

    function searchforprint($code, $name, $description) {
        $query = "select * from department where true ";
        if ($code != "") {
            $query .= " and code ilike '%$code%'";
        }if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id desc ";
        return $this->db->query($query)->result();
    }

    function selectAll() {
        return $this->db->query("select * from department order by name asc")->result();
    }

    function insert($code, $name, $description) {
        return $this->db->insert("department", array("code" => $code, "name" => $name, "description" => $description));
    }

    function update($id, $code, $name, $description) {
        $query = "update department set code='$code',name='$name',description='$description' where id=$id";
        return $this->db->query($query);
    }

    function delete($id) {
        return $this->db->query("delete from department where id=$id");
    }

    function getNameById($id) {
        $dt = $this->db->query("select name from department where id=$id")->row();
        return empty($dt) ? "" : $dt->name;
    }

    function select_sub_department() {
        $query = "select * from dept_division order by name asc";
        return $this->db->query($query)->result();
    }

    function select_cost_center() {
        $query = "select * from cost_center order by code asc";
        return $this->db->query($query)->result();
    }

    function select_area() {
        $query = "select * from area order by name asc";
        return $this->db->query($query)->result();
    }

}

?>
