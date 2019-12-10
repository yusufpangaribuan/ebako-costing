<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_po
 *
 * @author hp
 */
class model_po extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select po.*,pr.requestdate,pr.departmentid,
                pr.capex,pr.jsa,pr.requestnumber,department.code departmentcode,
                vendor.vendornumber,vendor.name vendorname
                from po join pr on po.prid=pr.id 
                left join department on pr.departmentid=department.id join vendor 
                on po.vendorid=vendor.id ";
        return $this->db->query($query)->result();
    }

    function search($ponumber, $prnumber, $date_start, $date_end, $departmentid, $vendorid, $status, $limit, $offset) {
        $query = "select po.*,pr.requestdate,pr.departmentid,
                pr.capex,pr.jsa,pr.requestnumber,pr_get_all_department_by_pr_id(pr.id) departmentcode,
                vendor.vendornumber,vendor.name vendorname
                from po join pr on po.prid=pr.id join vendor 
                on po.vendorid=vendor.id ";
        if (!empty($ponumber)) {
            $query .= " and po.ponumber ilike '%$ponumber%' ";
        }if (!empty($prnumber)) {
            $query .= " and pr.requestnumber ilike '%$prnumber%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and po.dates between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and po.dates = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and po.dates = '$date_start' ";
        }if ($vendorid != 0) {
            $query .= " and po.vendorid = $vendorid ";
        }if ($status != "") {
            $query .= " and po.status = $status ";
        }
        $query .= " order by po.id desc limit $limit offset $offset ";
        //echo $query."<br/>";
        return $this->db->query($query)->result();
    }

    function getNumRows($ponumber, $prnumber, $date_start, $date_end, $departmentid, $vendorid, $status) {
        $query = "select po.*,pr.requestdate,pr.departmentid,
                pr.capex,pr.jsa,pr.requestnumber,pr_get_all_department_by_pr_id(pr.id) departmentcode,
                vendor.vendornumber,vendor.name vendorname
                from po join pr on po.prid=pr.id join vendor 
                on po.vendorid=vendor.id ";

        if (!empty($ponumber)) {
            $query .= " and po.ponumber ilike '$ponumber' ";
        }if (!empty($prnumber)) {
            $query .= " and pr.requestnumber ilike '$prnumber' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and po.dates between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and po.dates = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and po.dates = '$date_start' ";
        }if ($vendorid != 0) {
            $query .= " and po.vendorid = $vendorid ";
        }if ($status != "") {
            $query .= " and po.status = $status ";
        }

        //echo $query."<br/>";
        return $this->db->query($query)->num_rows();
    }

    function selectById($poid) {
        $query = "select po.*,pr.requestdate,pr.departmentid,
                pr.capex,pr.jsa,pr.requestnumber,department.code departmentcode,
                vendor.vendornumber,vendor.name vendorname,vendor.address1,vendor.phone
                from po join pr on po.prid=pr.id left join department 
                on pr.departmentid=department.id join vendor 
                on po.vendorid=vendor.id where po.id=$poid";
        return $this->db->query($query)->row();
    }

    function selectItemByPoId($poid) {
        $query = "select 
        pritem.id,
        pritem.prid,
        pritem.itemid,
        item.partnumber itempartnumber,
        item.names itemname,
        item.descriptions itemdescription,
        pritem.qty,
        pritem.discount,
        pritem.outstanding,
        pritem.price,     
        pritem.currency,
        pritem.matras_price,
        pritem.ppn,
        pritem.total,
        vendor.name vendorname,                
        pritem.unitid,
        unit.names unitname,
        unit.codes unitcode,
        materialrequisition.number mat_req_number,
        sr.number sr_number
        from pritem
        join item on pritem.itemid=item.id
        left join vendor on pritem.vendorid=vendor.id
        left join materialrequisition_detail on pritem.materialrequisition_detail_id=materialrequisition_detail.id
        left join materialrequisition on materialrequisition_detail.materialrequisitionid=materialrequisition.id
        left join servicerequestdetail srd on pritem.srd_id=srd.id
        left join servicerequest sr on srd.servicerequestid=sr.id
        join unit on pritem.unitid=unit.id where pritem.poid=$poid order by pritem.id asc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectOutstandingItemByPoId($poid) {
        $query = "with t as( select 
                pritem.id,
                pritem.prid,
                pritem.itemid,
                item.partnumber itempartnumber,
                item.names itemname,
                item.descriptions itemdescription,
                item.qccheck,
                pritem.qty,
                pritem.outstanding,
                pritem.price,
                vendor.name vendorname,
                pritem.unitid,
                unit.names unitname,
                unit.codes unitcode from pritem
                join item on pritem.itemid=item.id
                left join vendor on pritem.vendorid=vendor.id
                join unit on pritem.unitid=unit.id and pritem.poid=$poid and pritem.outstanding != 0 ),
                t2 as (
                        select warehouseid,itemid stockitemid from stock
                )select distinct(t.itemid) itemdistc,t.* from t join t2 on t.itemid=t2.stockitemid 
                where t2.warehouseid=" . $this->session->userdata('optiongroup');
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectOutstandingItemByVendorId($vendorid) {
        $query = "with t as( select 
                po.id poid,
                po.ponumber,
                po.dates po_date,
                pritem.id,
                pritem.prid,
                pritem.itemid,
                item.partnumber itempartnumber,
                item.names itemname,
                item.descriptions itemdescription,
                item.qccheck,
                pritem.qty,
                pritem.outstanding,
                pritem.price,
                vendor.name vendorname,
                pritem.unitid,
                unit.names unitname,
                unit.codes unitcode from pritem
                join item on pritem.itemid=item.id
                join po on pritem.poid=po.id
                left join vendor on pritem.vendorid=vendor.id
                join unit on pritem.unitid=unit.id 
                where po.vendorid=$vendorid 
                    and pritem.outstanding != 0 
                    and po.status=0),
                t2 as (
                        select warehouseid,itemid stockitemid from stock
                )select distinct(t.itemid) itemdistc,t.* from t join t2 on t.itemid=t2.stockitemid 
                where t2.warehouseid=" . $this->session->userdata('optiongroup') . " order by t.poid asc";
        return $this->db->query($query)->result();
    }

    function selectPoByPrid($prid) {
        $this->db->where("prid", $prid);
        return $this->db->get('po')->result();
    }

    function setPaymentAndDeliveryTermAndSumOf($id, $payterm, $deliverterm, $sumof) {
        $this->db->where('id', $id);
        return $this->db->update('po', array(
                    "payterm" => $payterm,
                    "deliveryterm" => $deliverterm,
                    "sumof" => $sumof));
    }

    function updatePayAndDelivery($data, $where) {
        return $this->db->update('po', $data, $where);
    }

    function selectPoUncompleteReceive() {
        //$this->db->select('id','ponumber');
//        $query = "select distinct pritem.poid,po.ponumber,po.dates,
//                (select name from vendor where id=po.vendorid) vendorname 
//                from pritem join 
//                po on pritem.poid=po.id and po.status=0"; //and outstanding != 0 and po.finalclose != TRUE ";
        //echo $query;
        $embed_query = "";
        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $embed_query = "and (item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }

        $query = "
          with t as (
            select 
            po.vendorid,
            po.dates
            from pritem 
            join po on pritem.poid=po.id
            join item on pritem.itemid=item.id 
            join stock on item.id=stock.itemid
            where po.status=0 and stock.warehouseid=" . $this->session->userdata('optiongroup') . "
            $embed_query
            order by po.dates asc 
            ) select distinct t.vendorid,vendor.name vendorname from t
              join vendor on t.vendorid=vendor.id where true
        ";

//        $query = "
//            with t_po as (
//                    select pritem.poid,
//                    po.ponumber,
//                    po.dates,
//                    stock.warehouseid,
//                    vendor.name vendorname
//                    from pritem 
//                    join po on pritem.poid=po.id 
//                    join item on pritem.itemid=item.id 
//                    join stock on item.id=stock.itemid 
//                    join vendor on po.vendorid=vendor.id
//                    where po.status=0 and stock.warehouseid=" . $this->session->userdata('optiongroup') . " 
//                    $embed_query
//            )select distinct(poid),ponumber,dates,warehouseid,vendorname from t_po where true ";

        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and t.vendorid in (select vendorid from po where ponumber ilike '%$po_no%') ";
        }
        $vendor = $this->input->post('vendor');
        if (!empty($vendor)) {
            $query .= " and vendor.name ilike '%$vendor%' ";
        }

//        echo $query;
//        $query .= " order by poid desc limit 50 offset 0";
        $query .= " limit 50 offset 0";

        return $this->db->query($query)->result();
    }

    function poCreate($prid) {
        return $this->db->query("select po_create($prid)");
    }

    function savePoStatus($poid, $status, $notes, $applevel1, $applevel2) {
        $this->db->where("id", $poid);
        $this->db->update('po', array(
            "status" => $status,
            "statusdescription" => $notes,
            "closeapprovallevel1" => $applevel1,
            "closeapprovallevel2" => $applevel2
        ));
    }

    function getPoStatus($poid) {
        $dt = $this->db->query("select statusdescription from po where id=$poid")->row();
        return $dt->statusdescription;
    }

    function approvelclose($poid, $status, $level, $approvallevel2) {
        $query = "select po_approvalclose($poid,$status,$level,'$approvallevel2')";
        return $this->db->query($query);
    }

    function selectReceive($poid) {
//        $query = "select 
//                pritem.id,
//                pritem.itemid,
//                pritem.itempartnumber,
//                pritem.itemdescription,
//                pritem.qty,
//                pritem.outstanding,
//                (select sum(qty) from gritem where poitemid=pritem.id) qtyreceive
//                from pritem where poid=$poid";
        $query = " select 
                pritem.id,
                pritem.itemid,
                item.partnumber itempartnumber,
                item.descriptions itemdescription,
                pritem.qty,
                pritem.outstanding,
                (select sum(qty) from gritem where poitemid=pritem.id) qtyreceive
                from pritem join item on pritem.itemid=item.id where poid=$poid";
        return $this->db->query($query)->result();
    }

    function selectPendingApprovalCloseByUser($id) {
        $query = "select * from po where (closeapprovallevel1='$id' and approvallevel1status = 0 ) or (closeapprovallevel2 = '$id' and approvallevel2status=0)";
        return $this->db->query($query)->result();
    }

    function selectDefaultApproval() {
        $query = "with t as (select 
                pocloseapproval.level1,
                (select name from employee where id=pocloseapproval.level1) level1name,
                pocloseapproval.level2,
                (select name from employee where id=pocloseapproval.level2) level2name from pocloseapproval limit 1
                ) select * from t";
        return $this->db->query($query)->row();
    }

    function isAllowItem($pritemid) {
        $query = "select count(*) ct from gritemcheck where poitemid=$pritemid and status=FALSE";
        $dt = $this->db->query($query)->row()->ct;
        return ($dt != 0);
    }

    function getQtyReceiveQuality($pritemid) {
//        $query = "select sum(qty) ct from gritemcheck where poitemid=$pritemid and status=FALSE";
        $query = "select qty as ct from gritemcheck where poitemid=$pritemid and status=FALSE order by id asc limit 1";
        return $this->db->query($query)->row()->ct;
    }

    function getQtyReceiveQuality2($inspectionid) {
        $query = "select qty from gritemcheck where id=$inspectionid";
        return $this->db->query($query)->row()->qty;
    }

    function getQualityId($pritemid) {
        $query = "select po_getqualityid($pritemid) as ct";
        return $this->db->query($query)->row()->ct;
    }

    function convert_number_to_words($number) {
        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}

?>
