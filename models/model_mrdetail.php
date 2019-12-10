<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_mrdetail
 *
 * @author hp
 */
class model_mrdetail extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function insert_detail($data) {
        return $this->db->insert('mrdetail', $data);
    }

    function insert($mrid, $itemid, $qty, $unitid, $reason, $warehouseid) {
        return $this->db->insert('mrdetail', array(
                    "mrid" => $mrid,
                    "itemid" => $itemid,
                    "qty" => $qty,
                    "ots" => $qty,
                    "unitid" => $unitid,
                    "reason" => $reason,
                    "warehouseid" => $warehouseid
        ));
    }

    function insert_batch($data) {
        return $this->db->insert_batch('mrdetail', $data);
    }

    function update($mrdetailid, $itemid, $qty, $unitid, $reason) {
        $this->db->where('id', $mrdetailid);
        $this->db->update('mrdetail', array(
            "itemid" => $itemid,
            "qty" => $qty,
            "unitid" => $unitid,
            "reason" => $reason
        ));
    }

    function update_detail($data, $where) {
        return $this->db->update('mrdetail', $data, $where);
    }

    function selectByMrId($mrid) {
        $query = "select
                  mr.requestby,
                  mrdetail.*,
                  item.partnumber code,
                  item.descriptions,
                  unit.codes unitcode, 
                  (select mritem_get_ots_unreceived(mrdetail.id)) qtyunreceived,
                  (select mrdetail_getTotalReceive(mrdetail.id)) qtyreceived
                  from mrdetail 
                  join mr on mrdetail.mrid=mr.id
                  join item on mrdetail.itemid=item.id 
                  join unit on mrdetail.unitid=unit.id 
                  and mrdetail.mrid=$mrid";
        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            $query .= " and (mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . "
                      or (mr.requestby='" . $this->session->userdata('id') . "'))"; // Update Tgl 02-06-2015
        }
        
        $query .= " order by mrdetail.id desc ";        
        //echo $query . "<br/>";
        return $this->db->query($query)->result();
    }

    function selectByMrId_2($mrid, $request_type) {
        $query = "
            select
            mr.requestby,
            mrdetail.*,
            item.partnumber code,
            item.descriptions,
            unit.codes unitcode, 
            warehouse.name request_to,
            (select mritem_get_ots_unreceived(mrdetail.id)) qtyunreceived,
            (select mrdetail_getTotalReceive(mrdetail.id)) qtyreceived
            from mrdetail 
            join mr on mrdetail.mrid=mr.id
            join item on mrdetail.itemid=item.id 
            join unit on mrdetail.unitid=unit.id 
            join warehouse on mrdetail.warehouseid=warehouse.id
            and mrdetail.mrid=$mrid
        ";
        if ($request_type != 2) {
            if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
                $query .= " and (mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . " 
                            or (mr.requestby='" . $this->session->userdata('id') . "')) "; //tambah or tgl 29052015
            }
        }

//        echo $query . "<br/>";
        return $this->db->query($query)->result();
    }

    function delete($where) {
        return $this->db->delete('mrdetail', $where);
    }

}

?>
