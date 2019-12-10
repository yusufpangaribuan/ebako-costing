<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_gritem
 *
 * @author hp
 */
class model_gritem extends CI_Model {

    //put your code here
    function __construct() {
        $this->load->database();
    }

    function insert($grid, $poitemid, $qty, $reject, $note, $qltyid) {
        return $this->db->insert('gritem', array(
                    "grid" => $grid,
                    "poitemid" => $poitemid,
                    "qty" => $qty,
                    "rejectqty" => $reject,
                    "note" => $note,
                    "qltyid" => "{" . $qltyid . "}",
                    "warehouseid" => $this->session->userdata('optiongroup')
        ));
    }

    function selectByGrId($grid) {
        $query = "with t as (
                    select 
                    gritem.*,
                    po.ponumber,
                    po.dates po_date,
                    pritem.itemid,
                    item.partnumber itempartnumber,
                    item.descriptions itemdescription,
                    pritem.qty orderqty,
                    pritem.outstanding,
                    item.partnumber itemcode,
                    item.qccheck,
                    unit.codes unitcode,
                    materialrequisition.number mat_req_number
                    from gritem 
                    join pritem on gritem.poitemid=pritem.id 
                    left join item on pritem.itemid=item.id 
                    left join unit on pritem.unitid=unit.id
                    left join po on pritem.poid=po.id
                    left join materialrequisition_detail on pritem.materialrequisition_detail_id=materialrequisition_detail.id
                    left join materialrequisition on materialrequisition_detail.materialrequisitionid=materialrequisition.id
                    ) select * from t where grid=$grid";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function delete($id) {
        return $this->db->delete('gritem', array('id' => $id));
    }

    function deleteByGrId($grid) {
        return $this->db->delete('gritem', array('grid' => $grid));
    }

    function update($gritemid, $qty, $reject, $note) {
        $this->db->where('id', $gritemid);
        return $this->db->update('gritem', array(
                    "qty" => $qty,
                    "rejectqty" => $reject,
                    "note" => $note
        ));
    }

    function updateQlyReceivetoTrue($qltid) {
        return $this->db->query("update gritemcheck set status=True where id in ($qltid)");
    }

}

?>
