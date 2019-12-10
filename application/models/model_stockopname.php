<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stockopname
 *
 * @author operational
 */
class model_stockopname extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insert($data) {
        return $this->db->insert('stockopname', $data);
    }

    function get_last_id() {
        $query = "select id from stockopname order by id desc limit 1";
        return $this->db->query($query)->row()->id;
    }

    function select_by_id($id) {
        $this->db->select("*");
        $this->db->from("stockopname");
        $this->db->where(array("id" => $id));
        return $this->db->get()->row();
    }

    function select_item($stockopnameid) {
        $query = "
            select
            stockopnamedetail.*,
            item.partnumber item_code,
            item.descriptions item_description,
            groups.names group_code,
            unit.codes unit_code
            from stockopnamedetail
            join item on stockopnamedetail.itemid=item.id
            join unit on stockopnamedetail.unitid=unit.id  
            join groups on item.groupsid=groups.id
            where stockopnamedetail.stockopnameid=$stockopnameid
            order by id asc
        ";

        return $this->db->query($query)->result();
    }

    function select_not_in_list($detail_ids, $stockopnameid) {
        $query = "
            select
            stockopnamedetail.*,
            item.partnumber item_code,
            item.descriptions item_description,
            unit.codes unit_code
            from stockopnamedetail
            join item on stockopnamedetail.itemid=item.id
            join unit on stockopnamedetail.unitid=unit.id  
            where stockopnamedetail.stockopnameid=$stockopnameid
            and stockopnamedetail.id not in ($detail_ids) order by id asc
        ";
        return $this->db->query($query)->result();
    }

    function item_insert_batch($data) {
        return $this->db->insert_batch('stockopnamedetail', $data);
    }

    function delete($where) {
        return $this->db->delete('stockopname', $where);
    }

    function detail_delete($where) {
        return $this->db->delete('stockopnamedetail', $where);
    }

    function detail_update($data, $where) {
        return $this->db->update('stockopnamedetail', $data, $where);
    }

    function posting($id) {
        return $this->db->query("select stockopname_posting($id)");
    }

}
