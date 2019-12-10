<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_group
 *
 * @author admin
 */
class model_groups extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectAll() {
        return $this->db->query("select * from groups")->result();
    }
    
    function selectAllForSelect() {
        return $this->db->query("select * from groups order by codes asc")->result();
    }

    function selectAllInCondition() {
        return $this->db->query("select * from groups where id in (3,4,5,6,7)")->result();
    }

    function getNumRows($code, $name, $description) {
        $query = "select * from groups where true ";
        if ($code != "") {
            $query .= " and codes ilike '%$code%'";
        }if ($name != "") {
            $query .= " and names ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($code, $name, $description, $limit, $offset) {
        $query = "select * from groups where true ";
        if ($code != "") {
            $query .= " and codes ilike '%$code%'";
        }if ($name != "") {
            $query .= " and names ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id desc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function searchforprint($code, $name, $description) {
        $query = "select * from groups where true ";
        if ($code != "") {
            $query .= " and codes ilike '%$code%'";
        }if ($name != "") {
            $query .= " and names ilike '%$name%'";
        }if ($description != "") {
            $query .= " and description ilike '%$description%'";
        }
        $query .= " order by id desc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function insert($codes, $names, $descriptions) {
        //$query = "select group_insert('" . $codes . "','" . $names . "','" . $descriptions . "')";
        return $this->db->insert('groups', array(
                    "codes" => $codes,
                    "names" => $names,
                    "descriptions" => $descriptions
                ));
    }

    function selectById($id) {
        return $this->db->query("select * from groups where id=$id")->result();
    }

    function update($id, $codes, $names, $descriptions) {
        $query = "update groups set codes='$codes',names='$names',descriptions='$descriptions' where id=$id";
        //echo $query;
        return $this->db->query($query);
    }

    function delete($id) {
        $query = "delete from groups where id=$id";
//        echo $query;
        return $this->db->query($query);
    }

}

?>
