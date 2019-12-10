<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_setup extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function selectAllPurchasingGroup() {
        return $this->db->query("select * from purchasinggroup order by id asc")->result();
    }

    function selectPurchasingGroupById($id) {
        $query = "select * from purchasinggroup where id=$id";
        return $this->db->query($query)->row();
    }

    function updatepurchasinggroup($dataupdate, $where) {
        return $this->db->update("purchasinggroup", $dataupdate, $where);
    }

}

?>
