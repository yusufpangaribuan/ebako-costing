<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_stockoutdetail extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        return $this->db->insert('stockoutdetail', $data);
    }

    function insert_batch($data) {
        return $this->db->insert_batch('stockoutdetail', $data);
    }

    function savebymrchoose($stockoutid, $mrdetailid, $itemid, $qty, $unitid, $soid) {
        $this->db->insert('stockoutdetail', array(
            "stockoutid" => $stockoutid,
            "mrdetailid" => $mrdetailid,
            "itemid" => $itemid,
            "qty" => $qty,
            "unitid" => $unitid,
            "soid" => $soid
        ));
    }

    function save($stockoutid, $itemid, $unitid, $qty, $soid) {
        $this->db->insert('stockoutdetail', array(
            "stockoutid" => $stockoutid,
            "mrdetailid" => 0,
            "itemid" => $itemid,
            "qty" => $qty,
            "unitid" => $unitid,
            "soid" => $soid
        ));
    }

    function update($id, $itemid, $unitid, $qty) {
        $this->db->where('id', $id);
        $this->db->update('stockoutdetail', array(
            "itemid" => $itemid,
            "qty" => $qty,
            "unitid" => $unitid));
    }

    function selectByStockoutId($stockoutid) {
        $query = "with t as (
                select 
                stockoutdetail.*,
                item.partnumber code, 
                item.descriptions,
                mrdetail.qty as mrdetailqty,
                mrdetail.ots,
                unit.codes unitcode 
                from stockoutdetail 
                join item on stockoutdetail.itemid=item.id 
                left join mrdetail on stockoutdetail.mrdetailid=mrdetail.id
                join unit on stockoutdetail.unitid=unit.id
                ) select * from t where stockoutid=$stockoutid";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function delete($id) {
        $this->db->delete('stockoutdetail', array('id' => $id));
    }

    function deleteByStockOutId($stockoutid) {
        return $this->db->delete('stockoutdetail', array("stockoutid" => $stockoutid));
    }

}

?>
