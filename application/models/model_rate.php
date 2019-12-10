<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_rate
 *
 * @author hp
 */
class model_rate extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select * from rate order by currency_from asc";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "select * from rate where id=$id limit 1";
        return $this->db->query($query)->row();
    }

    function getNumRows($currency) {
    	$query = "select * from rate where true ";
    	if (!empty($currency)) {
    		$query .= " and (currency_from ilike '%$currency%' or currency_to ilike '%$currency%')  ";
    	}
    	return $this->db->query($query)->num_rows();
    }
    
    function search($currency, $limit, $offset) {
    	$query = "select * from rate where true ";
    	if (!empty($currency)) {
    		$query .= " and (currency_from ilike '%$currency%' or currency_to ilike '%$currency%')  ";
    	}
    	$query .= " order by id desc limit $limit offset $offset ";
    	return $this->db->query($query)->result();
    }

    function insert($currency_from, $currency_to, $value) {
        $this->db->insert('rate', array(
            "currency_from" => $currency_from,
            "currency_to" => $currency_to,
            "value" => $value
        ));
    }

    function update($id, $currency_from, $currency_to, $value) {
        $this->db->where('id', $id);
        return $this->db->update('rate', array(
                    "currency_from" => $currency_from,
                    "currency_to" => $currency_to,
                    "value" => $value
                ));
    }

    function delete($id) {
        return $this->db->delete('rate', array("id" => $id));
    }

    function getRateValue($currfrom, $currto) {
        $query = "select value from rate where currency_from='$currfrom' and currency_to = '$currto' limit 1";
        $dt = $this->db->query($query)->row();
        return (!empty($dt) ? $dt->value : 0);
    }

}

?>
