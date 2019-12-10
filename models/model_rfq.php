<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_rfq
 *
 * @author hp
 */
class model_rfq extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select 
            rfq.*,
            customer.name customer,
            (select name from customer where id=rfq.shiptoid) shipto
            from rfq join customer on rfq.customerid=customer.id order by rfq.id desc";
        return $this->db->query($query)->result();
    }

    function getNumRows($rfqno, $datefrom, $dateto, $customerid, $status) {
        $query = "select 
            rfq.*,
            customer.name customer,
            (select name from customer where id=rfq.shiptoid) shipto
            from rfq join customer on rfq.customerid=customer.id";
        if ($rfqno != "") {
            $query .= " and rfq.number ilike '%$rfqno%'";
        }if ($datefrom != "" && $dateto != "") {
            $query .= " and rfq.date between '$datefrom' and '$dateto' ";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and rfq.date = '$datefrom'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and rfq.date = '$dateto'";
        }if ($customerid != 0) {
            $query .= " and rfq.customerid=$customerid ";
        }if ($status != "0") {
            $query .= " and rfq.status=$status";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($rfqno, $datefrom, $dateto, $customerid, $status, $limit, $offset) {
        $query = "select 
            rfq.*,
            customer.name customer,
            (select name from customer where id=rfq.shiptoid) shipto
            from rfq join customer on rfq.customerid=customer.id";
        if ($rfqno != "") {
            $query .= " and rfq.number ilike '%$rfqno%'";
        }if ($datefrom != "" && $dateto != "") {
            $query .= " and rfq.date between '$datefrom' and '$dateto' ";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and rfq.date = '$datefrom'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and rfq.date = '$dateto'";
        }if ($customerid != 0) {
            $query .= " and rfq.customerid=$customerid ";
        }if ($status != 0) {
            $query .= " and rfq.status=$status";
        }
        $query .= " order by rfq.id desc limit $limit offset $offset ";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function nextNumber() {
        return $this->db->query("select rfq_get_number() as ct")->row()->ct;
    }

    function selectAvailabel() {
        $query = "with t as(
                select rfqdetail.rfqid,sodetail.rfqdetailid from rfqdetail left join sodetail
                on rfqdetail.id=sodetail.rfqdetailid
                )select distinct(t.rfqid),rfq.*,customer.name customer from t join rfq 
                on t.rfqid=rfq.id join customer on rfq.customerid=customer.id and t.rfqdetailid is null and rfq.status=1";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "select 
                rfq.*,
                customer.name customer,
                (select name from customer where id=rfq.shiptoid) shipto,
                paymentterm.description paymentterm
                from rfq 
                join customer on rfq.customerid=customer.id 
                left join paymentterm on rfq.paymenttermid=paymentterm.id
                where rfq.id=$id";
        return $this->db->query($query)->row();
    }
                    //$billto, $shipto, $shippingaddress, $promiseddate, $shipvia, $number, $date, $salesperson, $testing, $paymenttermid
    function insert($billto, $shipto, $shippingaddress, $promiseddate, $shipvia, $number, $date, $salesperson, $testing, $paymenttermid) {
        return $this->db->insert("rfq", array(
                    "number" => $number,
                    "customerid" => $billto,
                    "shiptoid" => $shipto,
                    "shippingaddress" => $shippingaddress,
                    "date" => $date,
                    "promiseddate" => $promiseddate,
                    "shipvia" => $shipvia,
                    "salesperson" => $salesperson,
                    "testing" => $testing,
                    "paymenttermid" => $paymenttermid
                ));
    }

    function update($id, $billto, $shipto, $shippingaddress, $promiseddate, $shipvia, $number, $date, $salesperson, $testing, $paymenttermid) {
        return $this->db->update("rfq", array(
                    "number" => $number,
                    "customerid" => $billto,
                    "shiptoid" => $shipto,
                    "shippingaddress" => $shippingaddress,
                    "date" => $date,
                    "promiseddate" => $promiseddate,
                    "shipvia" => $shipvia,
                    "salesperson" => $salesperson,
                    "testing" => $testing,
                    "paymenttermid" => $paymenttermid
                        ), array("id" => $id));
    }

    function isHaveDetail($rfqid) {
        $count = $this->db->query("select count(*) ct from rfqdetail where rfqid=$rfqid")->row()->ct;
        return ($count > 0) ? true : false;
    }

    function process($rfqid) {
        return $this->db->query("select rfq_process($rfqid)");
    }

    function isCompleteCosting($rfqid) {
        $dt = $this->db->query("select rfq_iscomplete_costing($rfqid) ct ")->row()->ct;
        return ($dt == 't');
    }
    
    function isCompleteModel($rfqid){
        $dt = $this->db->query("select count(*) ct from rfqdetail where rfqid=$rfqid and modelid=0")->row();
        return ($dt->ct == 0);
    }

    function doApprove($rfqid, $dateapprove, $pocustomer, $filename) {
        $this->db->where('id', $rfqid);
        return $this->db->update('rfq', array(
                    "status" => 1,
                    "dateapprove" => $dateapprove,
                    "ponumber" => $pocustomer,
                    "filename" => $filename));
    }

    function close($rfqid) {
        return $this->db->update('rfq', array("status" => 2), array("id" => $rfqid));
    }

    function delete($rfqid) {
        return $this->db->query("select rfq_delete($rfqid)");
    }

}

?>
