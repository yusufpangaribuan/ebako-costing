<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_quotation
 *
 * @author hp
 */
class model_quotation extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function save($rfqid, $quotationnumber, $quotationdate, $quotationvalidity) {
        $this->db->where('id', $rfqid);
        return $this->db->update('rfq', array(
                    "quotationnumber" => $quotationnumber,
                    "quotationdate" => $quotationdate,
                    "quotationvalidity" => $quotationvalidity
                ));
    }

    function selectById($soid) {
        $this->db->where("id", $soid);
        return $this->db->get('rfq')->row();
    }

}

?>
