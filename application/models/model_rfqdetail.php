<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_rfqdetail
 *
 * @author hp
 */
class model_rfqdetail extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insert($rfqid, $modelid, $type, $description, $qty, $custcode) {
        return $this->db->insert('rfqdetail', array(
                    "rfqid" => $rfqid,
                    "modelid" => $modelid,
                    "type" => $type,
                    "description" => $description,
                    "qty" => $qty,
                    "refmodelid" => $modelid,
                    "custcode" => $custcode
                ));
    }

    function update($id, $modelid, $description, $qty, $custcode) {
        return $this->db->update('rfqdetail', array(
                    "modelid" => $modelid,
                    "description" => $description,
                    "qty" => $qty,
                    "refmodelid" => $modelid,
                    "custcode" => $custcode
                        ), array("id" => $id));
    }

    function selectById($id) {
        $query = "with t as (
                select 
                rfqdetail.*,
                model.no,
                model.description modeldescription
                from rfqdetail left join model 
                on rfqdetail.modelid=model.id
                ) select * from t where id=$id";
        return $this->db->query($query)->row();
    }

    function selectByIdRfq($rfqid) {
        $query = "with t as (
                select 
                rfqdetail.*,
                model.no,
                model.filename,
                model.dw,
                model.dd,
                model.dht,                
                model.description modeldescription,
                (select model_getfinish_overview(model.id)) finishoverview,
                (select model_getconstruction_overview(model.id)) constructionoverview
                from rfqdetail left join model 
                on rfqdetail.modelid=model.id
                ) select * from t where rfqid=$rfqid order by id asc";
        return $this->db->query($query)->result();
    }
    
    function selectByIdRfqAndApprove($rfqid) {
        $query = "with t as (
                select 
                rfqdetail.*,
                model.no,
                model.filename,
                model.dw,
                model.dd,
                model.dht,
                model.description modeldescription
                from rfqdetail left join model 
                on rfqdetail.modelid=model.id
                ) select * from t where rfqid=$rfqid and approve=TRUE order by id asc";
        return $this->db->query($query)->result();
    }

    function delete($rfqdetailid) {
        return $this->db->delete('rfqdetail', array("id" => $rfqdetailid));
    }

    function notes($rfqdetailid) {
        return $this->db->query("select description from rfqdetail where id=$rfqdetailid")->row()->description;
    }

    function selectRequestedModel() {
        $query = "with t as (
        select rfqdetail.*,
        rfq.customerid,
        rfq.date,
        rfq.number,
        rfq.isprocess,
        model.no,
        model.custcode modelcustcode,
        model.description modeldescription,customer.name customername
        from rfqdetail 
        join rfq on rfqdetail.rfqid=rfq.id 
        join customer on rfq.customerid=customer.id 
        left outer join model on rfqdetail.modelid=model.id 
        ) select * from t where type in (2,3) and modelid=refmodelid and isprocess = true order by id asc ";
        return $this->db->query($query)->result();
    }

    function dosetmodelrfqdetail($rfqdetailid, $modelid) {
        return $this->db->update('rfqdetail', array("modelid" => $modelid), array("id" => $rfqdetailid));
    }

    function isProcess($modelid, $customerid) {
        $dt = $this->db->query("select costing_exist($modelid,$customerid) ct")->row()->ct;
        return ($dt == 't');
    }

    function approve($modelid) {
        $this->db->update('rfqdetail', array("approve" => 'TRUE'), array("id" => $modelid));
    }

}

?>
