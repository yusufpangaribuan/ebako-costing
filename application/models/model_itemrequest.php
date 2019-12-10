<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_itemrequest
 *
 * @author hp
 */
class model_itemrequest extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        return $this->db->insert('itemrequest', $data);
    }

    function update($data, $where) {
        return $this->db->update('itemrequest', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('itemrequest', $where);
    }

    function selectById($id) {
        return $this->db->query("select * from itemrequest where id=$id")->row();
    }

    function getNumRows($query) {
        return $this->db->query($query)->num_rows();
    }

    function search($query) {
        return $this->db->query($query)->result();
    }

}

?>
