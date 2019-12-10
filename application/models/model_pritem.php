<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_pritem
 *
 * @author admin
 */
class model_pritem extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($prid, $itemid, $itempartnumber, $itemdescription, $unitid, $qty) {
        return $this->db->insert("pritem", array("prid" => $prid,
                    "itemid" => $itemid,
                    "itempartnumber" => $itempartnumber,
                    "itemdescription" => $itemdescription,
                    "unitid" => $unitid,
                    "qty" => $qty,
                    "outstanding" => $qty
        ));
    }

    public function insert2($data) {
        return $this->db->insert("pritem", $data);
    }

    public function insert_batch($data) {
        return $this->db->insert_batch("pritem", $data);
    }

    public function update($id, $itemid, $itempartnumber, $itemdescription, $unitid, $qty) {
        $this->db->where("id", $id);
        return $this->db->update("pritem", array(
                    "itemid" => $itemid,
                    "itempartnumber" => $itempartnumber,
                    "itemdescription" => $itemdescription,
                    "unitid" => $unitid,
                    "qty" => $qty,
                    "outstanding" => $qty
        ));
    }

    public function update2($data, $where) {
        return $this->db->update("pritem", $data, $where);
    }

    function selectByPrId($prid) {
        $query = "
            select 
            pritem.id,
            pritem.prid,
            pritem.itemid,
            pritem.currency,
            item.partnumber itempartnumber,
            item.names itemname,
            item.descriptions itemdescription,
            item.moq,
            pritem.qty,
            pritem.price,
            vendor.name vendorname,
            pritem.unitid,
            unit.names unitname,
            materialrequisition.number mr_number
            from pritem
            join item on pritem.itemid=item.id
            left join vendor on pritem.vendorid=vendor.id
            left join materialrequisition_detail on pritem.materialrequisition_detail_id=materialrequisition_detail.id
            left join materialrequisition on materialrequisition_detail.materialrequisitionid=materialrequisition.id
            join unit on pritem.unitid=unit.id 
            where pritem.prid=$prid order by pritem.id asc";
        return $this->db->query($query)->result();
    }

    function selectTotalPricePerPrId($prid) {
        $query = "select currency,sum(price) totalprice from pritem where prid=$prid and currency is not NULL group by currency";
        return $this->db->query($query)->result();
    }

    function selectTotalPricePrItemBasedOnCurrencyPerPrId($prid) {
        $query = "select distinct currency, sum(price) total from pritem where prid=$prid and currency is not NULL group by currency";
        return $this->db->query($query)->result();
    }

    function delete($id) {
        $this->db->delete('pritem', array("id" => $id));
    }

}

?>
