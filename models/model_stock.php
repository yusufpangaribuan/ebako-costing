<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_stock extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertunit($itemid, $unitfrom, $unitto, $conversionvalue, $stock, $warehouseid) {
        return $this->db->insert("stock", array("itemid" => $itemid,
                    "unitfrom" => $unitfrom,
                    "unitto" => $unitto,
                    "conversionvalue" => $conversionvalue,
                    "stock" => $stock,
                    "warehouseid" => $warehouseid));
    }

    function insertunit_batch($data) {
        return $this->db->insert_batch('stock', $data);
    }

    function isavailable($itemid, $unitid, $qtyout) {
        $query = "select stock_isavailable($itemid,$unitid,$qtyout) ct ";
        //echo $query."<br/>";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }

    function getStockByItemAndUnitAndWarehouse($itemid, $unitid, $warehouseid) {
        $query = "select stock,conversionvalue from stock where itemid=$itemid and unitfrom = $unitid and warehouseid=$warehouseid limit 1";
        //echo $query."<br/>";
        return $this->db->query($query)->row();
    }

    function get_last_balance_before_param_date($itemid, $warehouseid, $date) {
        $query = "select stock_transaction_before($itemid,$warehouseid,'$date') ct";
//        echo $query;
        return $this->db->query($query)->row()->ct;
    }

}
