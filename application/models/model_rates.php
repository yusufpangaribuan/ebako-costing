<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_rates
 *
 * @author hp
 */
class model_rates extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_all() {
        $query = "select * from rates order id desc";
        return $this->db->query($query)->result();
    }

    function select_by_id($id) {
        $query = "select * from rates where id=$id";
        return $this->db->query($query)->row();
    }

    function insert($data) {
        return $this->db->insert('rates', $data);
    }

    function update($data, $where) {

        return $this->db->update('rates', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('rates', $where);
    }

    function get_exchange_rate_by_evidence_number($evidence_number) {
        $query = "select exchange_rate from rates where evidence_number='$evidence_number' limit 1";
        //echo $query;
        $dt = $this->db->query($query)->row();
        return (!empty($dt) ? $dt->exchange_rate : "");
    }

}

?>
