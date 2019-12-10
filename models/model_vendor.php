<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_vendor
 *
 * @author admin
 */
class model_vendor extends CI_Model {

    //put your code here

    public function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function selectAll() {
        $query = "select * from vendor order by id asc";
        return $this->db->query($query)->result();
    }

    function select_all() {
        $query = "select * from vendor order by name asc";
        return $this->db->query($query)->result();
    }

    function search($name, $limit, $offset) {
        $query = "select * from vendor where true ";
        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }
        $query .= " order by id asc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function searchforprint($name) {
        $query = "select * from vendor where true ";
        if (!empty($name)) {
            $query .= " and name ilike '%$name%'";
        }
        $query .= " order by id desc";
//        echo $query;
        return $this->db->query($query)->result();
    }

    function getNumRows($name) {
        $query = "select * from vendor where true ";
        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }
        return $this->db->query($query)->num_rows();
    }

    function selectById($id) {
        $query = "select * from vendor where id=$id";
//        echo $query;
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert("vendor", $data);
    }

    function update($data, $where) {
        return $this->db->update("vendor", $data, $where);
    }

    function delete($where) {
        return $this->db->delete('vendor', $where);
    }

    function getLastNumber() {
        $dt = $this->db->query("select vendornumber from vendor order by id desc limit 1")->result();
        $vendornumber = "";
        if (!empty($dt)) {
            $vendornumber = $dt[0]->vendornumber;
        }
        return $vendornumber;
    }

    function getNameById($vendorid) {
        $this->db->select("name");
        $this->db->where("id", $vendorid);
        $dt = $this->db->get('vendor')->row();
        return $dt->name;
    }

    function getAddressById($vendorid) {
        $this->db->select("address1");
        $this->db->where("id", $vendorid);
        $dt = $this->db->get('vendor')->row();
        return $dt->address1;
    }

}

?>
