<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_bom
 *
 * @author hp
 */
class model_bom extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selectById($id) {
        $query = "select bom.*,component.description from bom 
                  join component on bom.componentid=component.id and bom.id=$id";
        return $this->db->query($query)->row();
    }

    function selectById_updated($id) {
        $query = "
            select 
            bom.*,
            item.descriptions item_description,
            v_i.descriptions ven_item_description
            from bom left join item on bom.itemid=item.id
            left join item v_i on bom.ven_itemid=v_i.id
            where bom.id=$id       
        ";
        //echo $query;
        return $this->db->query($query)->row();
    }

    function selectAllWoodByModelId($modelid) {
        $query = "with t as (
                select
                item.id,
                item.descriptions
                from bom join component on bom.componentid=component.id 
                join item on component.itemid=item.id and bom.modelid=$modelid and item.groupsid=3
                ) select distinct id,descriptions as woodname from t order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllItemByModelId($modelid) {
        $query = "with t as (
                select
                item.id,
                item.descriptions
                from bom join component on bom.componentid=component.id 
                join item on component.itemid=item.id and bom.modelid=$modelid
                ) select distinct id,descriptions as woodname from t order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllTightComponentByModelIdAndComponentCategoryId($modelid, $itemgroupsid) {
        $query = "select 
                distinct component.rt
                from bom 
                join component on bom.componentid=component.id 
                join item on component.itemid=item.id and item.groupsid=$itemgroupsid and bom.modelid=$modelid";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectVeneerByModelId($modelid) {
        $query = "select 
            component.ven_type
            from bom 
            join component on bom.componentid=component.id 
            and bom.modelid=$modelid and component.ven_type != '' order by bom.id asc ";
        return $this->db->query($query)->result();
    }

    function updateBomItem($id, $modelid, $componentid, $qty) {
        $this->db->where('id', $id);
        return $this->db->update('bom', array(
                    "modelid" => $modelid,
                    "componentid" => $componentid,
                    "qty" => $qty));
    }

    function createtemporary($requestid, $modelid) {
        return $this->db->query("select bom_createtemporary($requestid,$modelid)");
    }

}

?>
