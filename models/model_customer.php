<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_customer
 *
 * @author admin
 */
class model_customer extends CI_Model {

    //put your code here

    public function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function selectAll() {
        $query = "select * from customer order by name asc";
        return $this->db->query($query)->result();
    }
    
    function selectListIdAndName() {
    	$query = "select id,name from customer order by name asc";
    	return $this->db->query($query)->result();
    }

    function search($name, $limit, $offset) {
        $query = "select * from customer where true ";
        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }
        $query .= " order by id desc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function searchforprint($name) {
        $query = "select * from customer where true ";
        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }
        $query .= " order by id desc";
        return $this->db->query($query)->result();
    }

    function getNumRows($name) {
        $query = "select * from customer where true ";
        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }
        return $this->db->query($query)->num_rows();
    }

    function selectById($id) {
        return $this->db->query("select * from customer where id=$id")->result();
    }

    function insert($data) {
        return $this->db->insert("customer", $data);
    }

    function update($data, $where) {
        return $this->db->update("customer", $data, $where);
    }

    function delete($where) {
        return $this->db->delete('customer', $where);
    }

    function getLastNumber() {
        
        $dt = $this->db->query("select customernumber from customer order by id desc limit 1")->result();
        
        $customernumber = "";
        
        if (!empty($dt)) {
            $customernumber = $dt[0]->customernumber;
        }
        
        return $customernumber;
        
    }

    function getAddress($id) {
        
        $this->db->select('address1');
        $this->db->where('id', $id);
        $dt = $this->db->get('customer')->row();
        return $dt->address1;
    }

    function getNameById($id) {
        
        $this->db->select('name');
        $this->db->where('id', $id);
        $dt = $this->db->get('customer')->row();
        return $dt->name;
        
    }

    function getAddressById($id) {
        
        $this->db->select('address1');
        $this->db->where('id', $id);
        $dt = $this->db->get('customer')->row();
        return $dt->address1;
        
    }

}

?>
