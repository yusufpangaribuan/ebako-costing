<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_position
 *
 * @author hp
 */
class model_position extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectAll() {
        return $this->db->query("select * from position")->result();
    }

    function getNumRows($code, $name, $description) {
        $query = "select * from position where true ";
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
        $query = "select * from position where true ";
        if ($code != "") {
            $query .= " and code ilike '%$code%'";
        }if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id asc limit $limit offset $offset";
        return $this->db->query($query)->result();
    }

    function searchforprint($code, $name, $description) {
        $query = "select * from position where true ";
        if ($code != "") {
            $query .= " and code ilike '%$code%'";
        }if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id desc";
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('position', $data);
    }

    function selectById($id) {
        return $this->db->query("select * from position where id=$id")->row();
    }

    function update($data, $where) {
        return $this->db->update('position', $data, $where);
    }

    function delete($id) {
        $query = "delete from position where id=$id";
        return $this->db->query($query);
    }

}

?>
