<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_modeltype extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        return $this->db->get('modeltype')->result();
    }

    function selectById($id) {
        $this->db->where("id", $id);
        return $this->db->get('modeltype')->row();
    }

    function getNumRows($code, $description) {
        $query = "select * from modeltype where true ";
        if ($code != "") {
            $query .= " and name ilike '%$code%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($code, $description, $limit, $offset) {
        $query = "select * from modeltype where true ";
        if ($code != "") {
            $query .= " and name ilike '%$code%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id desc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert("modeltype", $data);
    }

    function update($data, $where) {
        return $this->db->update("modeltype", $data, $where);
    }

    function delete($where) {
        return $this->db->delete("modeltype",$where);
    }

}

?>
