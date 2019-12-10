<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_bank
 *
 * @author hp
 */
class model_bank extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectAll() {
        $this->db->order_by('id', 'desc');
        return $this->db->get('bank')->result();
    }

    function insert($code, $name, $branch, $city, $country, $kliring, $rtgs, $swift) {
        $this->db->insert('bank', array(
            "code" => $code,
            "name" => $name,
            "branch" => $branch,
            "city" => $city,
            "country" => $country,
            "kliring" => $kliring,
            "rtgs" => $rtgs,
            "swift" => $swift
        ));
    }

    function delete($where) {
        return $this->db->delete('bank', $where);
    }

}

?>
