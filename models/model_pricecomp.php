<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_pricecomp
 *
 * @author hp
 */
class model_pricecomp extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectByItemId($itemid) {
        $this->db->where("pritemid", $itemid);
        $this->db->order_by("id", "desc");
        return $this->db->get('pricecomp')->result();
    }

    function setVendor($id, $vendorid) {
        $this->db->where('id', $id);
        return $this->db->update('pricecomp', array("vendorid" => $vendorid));
    }

    function setCurrency($id, $currencyid) {
        $this->db->where('id', $id);
        return $this->db->update('pricecomp', array("currency" => $currencyid));
    }

    function setPrice($id, $price) {
        $this->db->where('id', $id);
        return $this->db->update('pricecomp', array("price" => $price));
    }

    function setDiscount($id, $discount) {
        $this->db->where('id', $id);
        return $this->db->update('pricecomp', array("discount" => $discount));
    }

    function setPpn($id, $ppn) {
        $this->db->where('id', $id);
        return $this->db->update('pricecomp', array("ppn" => $ppn));
    }

    function set_matras_price($id, $matras_price) {
        return $this->db->update('pricecomp', array("matras_price" => $matras_price), array("id" => $id));
    }

    function setNote($id, $note) {
        $this->db->where('id', $id);
        return $this->db->update('pricecomp', array("notes" => $note));
    }

    function used($pritemid, $pricecompid) {
        return $this->db->query("select pricecomp_used(" . $pritemid . "," . $pricecompid . ")");
    }

    function remove($pricecompid, $pritemid) {
        $this->db->where("id", $pricecompid);
        $this->db->update('pricecomp', array(
            "vendorid" => 0,
            "price" => NULL,
            "currency" => NULL,
            "used" => 0,
            "notes" => NULL
        ));
        $this->db->where('id', $pritemid);
        $this->db->update('pritem', array(
            "price" => NULL,
            "vendorid" => NULL,
            "currency" => NULL
        ));
    }

    function selectAllVendorByPrId($prid) {
        $query = "select distinct pricecomp.vendorid,vendor.vendornumber,vendor.name 
                from pricecomp join vendor 
                on pricecomp.vendorid=vendor.id join pritem
                on pricecomp.pritemid=pritem.id join pr 
                on pritem.prid=pr.id and pr.id=$prid and pricecomp.vendorid <> 0 
                order by pricecomp.vendorid asc";
        return $this->db->query($query)->result();
    }

    function selectAllVendorByPrItemId($pritemid) {
        $query = "select pricecomp.price,pricecomp.used,pricecomp.currency,vendor.vendornumber,vendor.name 
                from pricecomp join vendor on pricecomp.vendorid=vendor.id
                and  pritemid=$pritemid order by vendor.id asc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectTotalPriceByPrId($prid) {
        $query = "select _totalprice totalprice, _currency currency from pricecomp_select_total_price($prid)";
        return $this->db->query($query)->result();
    }

    function set_as_item_price($itemid, $pricecompid) {
        $query = "select pricecomp_set_as_item_price($itemid, $pricecompid)";
        return $this->db->query($query);
    }

}

?>
