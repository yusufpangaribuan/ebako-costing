<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_warehouse
 *
 * @author hp
 */
class model_warehouse extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function search() {
        return $this->db->get('warehouse')->result();
    }

    function selectAll() {
        return $this->db->get('warehouse')->result();
    }

    function selectAllByItem($itemid) {
        $query = "with t as(
                select stock.warehouseid id,warehouse.name warehousename
                from stock join warehouse on stock.warehouseid=warehouse.id 
                and stock.itemid=$itemid
                ) select distinct id,warehousename from t where true";

        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            $query .= "  and id=" . $this->session->userdata('optiongroup');
        }
        $query .= "  order by id asc";
        return $this->db->query($query)->result();
    }

    function selectNotIn($notin) {
        $query = "select * from warehouse where id not in $notin";
        return $this->db->query($query)->result();
    }

}

?>
