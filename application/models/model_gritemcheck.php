<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_gritemcheck
 *
 * @author hp
 */
class model_gritemcheck extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function search2() {
        $query = "select 
                gritemcheck.*,
                gr.number grnumber,
                gr.date grdate,
                item.partnumber itemcode,
                item.descriptions,
                unit.codes unitcode,
                warehouse.name warehousename
                from gritemcheck join gritem
                on gritemcheck.gritemid=gritem.id join gr
                on gritem.grid=gr.id join unit
                on gritemcheck.unitid=unit.id join item
                on gritemcheck.itemid=item.id join warehouse
                on gritemcheck.warehouseid=warehouse.id order by gritemcheck.status asc,gritemid desc ";
        return $this->db->query($query)->result();
    }

    function selectById($gritemid) {
        $query = "select 
                gritemcheck.*,
                gr.number grnumber,
                gr.date grdate,
                item.partnumber itemcode,
                item.descriptions,
                unit.codes unitcode,
                warehouse.name warehousename
                from gritemcheck join gritem
                on gritemcheck.gritemid=gritem.id join gr
                on gritem.grid=gr.id join unit
                on gritemcheck.unitid=unit.id join item
                on gritemcheck.itemid=item.id join warehouse
                on gritemcheck.warehouseid=warehouse.id and gritemcheck.gritemid=$gritemid";
        return $this->db->query($query)->row();
    }

    function selectPOItemForQuality() {
        /*$query = "with t as (
                select 
                pritem.id,
                pritem.prid,
                pritem.poid,
                pritem.itemid,
                pritem.unitid,
                item.partnumber itempartnumber,
                item.descriptions itemdescription,
                unit.codes unitcode,
                pritem.qty,
                ((pritem.outstanding)-(select COALESCE(sum(qty),0) qty from gritemcheck where poitemid=pritem.id and status=false)) outstanding,
                po.ponumber,
                po.dates podate,
                item.qccheck from pritem 
                join po on pritem.poid=po.id 
                join item on pritem.itemid=item.id 
                join unit on pritem.unitid=unit.id
                where po.status=0 and item.qccheck=true
                ) select * from t where outstanding > 0 ";*/
        
        
        $query = "with t as (
                select 
                pritem.id,
                pritem.prid,
                pritem.poid,
                pritem.itemid,
                pritem.unitid,
                item.partnumber itempartnumber,
                item.descriptions itemdescription,
                unit.codes unitcode,
                pritem.qty,
                ((pritem.qty)-(select COALESCE(sum(qty),0) qty from gritemcheck where poitemid=pritem.id)) outstanding,
                po.ponumber,
                po.dates podate,
                item.qccheck from pritem 
                join po on pritem.poid=po.id 
                join item on pritem.itemid=item.id 
                join unit on pritem.unitid=unit.id
                where po.status=0 and item.qccheck=true
                ) select * from t where outstanding > 0 ";

        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and t.ponumber ilike '%$po_no'";
        }
        $item_code_desc = $this->input->post('item_code_desc');
        if (!empty($item_code_desc)) {
            $query .= " and (t.itempartnumber ilike '%$item_code_desc%' or t.itemdescription ilike '%$item_code_desc%')";
        }

        $query .= " order by t.podate desc";

//        echo $query;

        return $this->db->query($query)->result();
    }

    function selectPOItemForQualitybyId($poitemid) {
        /*$query = "select 
                pritem.id,
                pritem.prid,
                pritem.poid,
                pritem.itemid,
                pritem.unitid,
                pritem.itempartnumber,
                pritem.itemdescription,
                unit.codes unitcode,
                pritem.qty,
                ((pritem.outstanding)-(select COALESCE(sum(qty),0) qty from gritemcheck where poitemid=$poitemid and status=false)) outstanding,
                po.ponumber,
                po.dates podate,
                item.qccheck from pritem 
                join po on pritem.poid=po.id join item on pritem.itemid=item.id 
                join unit on pritem.unitid=unit.id
                and po.status=0 and item.qccheck=true and pritem.id=$poitemid";*/
        
        $query = "select 
                pritem.id,
                pritem.prid,
                pritem.poid,
                pritem.itemid,
                pritem.unitid,
                pritem.itempartnumber,
                pritem.itemdescription,
                unit.codes unitcode,
                pritem.qty,
                ((pritem.qty)-(select COALESCE(sum(qty),0) qty from gritemcheck where poitemid=$poitemid)) outstanding,
                po.ponumber,
                po.dates podate,
                item.qccheck from pritem 
                join po on pritem.poid=po.id join item on pritem.itemid=item.id 
                join unit on pritem.unitid=unit.id
                and po.status=0 and item.qccheck=true and pritem.id=$poitemid";
        
        return $this->db->query($query)->row();
    }

    function getNumRows($ponumber, $datefrom, $dateto, $itemcode, $description) {
        $query = "select 
                gritemcheck.id,
                gritemcheck.poitemid,
                pritem.poid,
                gritemcheck.date,
                po.ponumber,
                gritemcheck.itemid,
                item.partnumber itemcode,
                item.descriptions,
                unit.codes unitcode,
                gritemcheck.qty,
                gritemcheck.status from gritemcheck
                join item on gritemcheck.itemid=item.id
                join pritem on gritemcheck.poitemid=pritem.id
                join unit on pritem.unitid=unit.id
                join po on pritem.poid=po.id ";
        if ($ponumber != "") {
            $query .= " and po.ponumber ilike '%$ponumber%' ";
        }if ($datefrom != "" && $dateto != "") {
            $query .= " and gritemcheck.date betwen '$datefrom' and '$dateto' ";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and gritemcheck.date='$datefrom' ";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and gritemcheck.date='$dateto' ";
        }if ($description != "") {
            $query .= " and item.descriptions ilike '%$description%' ";
        }if ($itemcode != "") {
            $query .= " and item.partnumber ilike '%$itemcode%' ";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($ponumber, $datefrom, $dateto, $itemcode, $description, $limit, $offset) {
        $query = "select 
                gritemcheck.id,
                gritemcheck.poitemid,
                pritem.poid,
                gritemcheck.date,
                po.ponumber,
                gritemcheck.itemid,
                item.partnumber itemcode,
                item.descriptions,
                unit.codes unitcode,
                gritemcheck.qty,
                gritemcheck.status from gritemcheck
                join item on gritemcheck.itemid=item.id
                join pritem on gritemcheck.poitemid=pritem.id
                join unit on pritem.unitid=unit.id
                join po on pritem.poid=po.id";
        if ($ponumber != "") {
            $query .= " and po.ponumber ilike '%$ponumber%' ";
        }if ($datefrom != "" && $dateto != "") {
            $query .= " and gritemcheck.date betwen '$datefrom' and '$dateto' ";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and gritemcheck.date='$datefrom' ";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and gritemcheck.date='$dateto' ";
        }if ($description != "") {
            $query .= " and item.descriptions ilike '%$description%' ";
        }if ($itemcode != "") {
            $query .= " and item.partnumber ilike '%$itemcode%' ";
        }

        $query .= " order by gritemcheck.id desc limit $limit offset $offset ";

        return $this->db->query($query)->result();
    }

    function doSet($poitemid, $itemid, $qty, $date) {
        return $this->db->insert("gritemcheck", array("poitemid" => $poitemid, "itemid" => $itemid, "qty" => $qty, "date" => $date));
    }

    function delete($id) {
        return $this->db->delete("gritemcheck", array("id" => $id));
    }

    function isRecorded($id) {
        $query = "select count(*) ct from gritem where $id = any(qltyid)";
        return ($this->db->query($query)->row()->ct > 0);
    }

}

?>
