<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_itemattachment
 *
 * @author hp
 */
class model_rfqitemattachment extends CI_Model {

//put your code here
    function __construct() {
        parent::__construct();
    }

    function selectByDetailId($rfqdetailid) {
        $query = "select * from rfqitemattachment where rfqdetailid=$rfqdetailid";
        return $this->db->query($query)->result();
    }

    function upload_detail_attachment($data) {
        return $this->db->insert('rfqitemattachment', $data);
    }

    function delete_detail_attachment($rfqdetailid) {
        return $this->db->delete('rfqitemattachment', array("id" => $rfqdetailid));
    }

}

?>
