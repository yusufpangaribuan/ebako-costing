<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_so
 *
 * @author hp
 */
class model_so extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getNumRowsAll($so, $customerid, $shipto, $datefrom, $dateto, $status) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        return $this->db->query($query)->num_rows();
    }

    function selectAll($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        }        
        $query .= " order by so.id desc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function getNumRowsAllFinishByRnd($so, $customerid, $shipto, $datefrom, $dateto, $status) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id and so.finishbyrnd=true ";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        return $this->db->query($query)->num_rows();
    }

    function selectAllFinishByRnd($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id and so.finishbyrnd=true ";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        $query .= " order by so.id desc limit $limit offset $offset ";
        return $this->db->query($query)->result();
    }

    function getNumRowsFinishByPPC($so, $customerid, $shipto, $datefrom, $dateto, $status) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id and so.status != 0";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        return $this->db->query($query)->num_rows();
    }

    function selectAllFinishByPPC($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id and so.status != 0";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        $query .= " order by so.id desc,so.status asc limit $limit offset $offset ";

        //echo $query;
        return $this->db->query($query)->result();
    }

    function getNumRowsAllFinishByMarketing($so, $customerid, $shipto, $datefrom, $dateto, $status) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id and so.finishbymarketing=true ";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        return $this->db->query($query)->num_rows();
    }

    function selectAllFinishByMarketing($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset) {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id and so.finishbymarketing=true ";
        if (!empty($so)) {
            $query .= " and so.number ilike '%$so%' ";
        }if ($customerid != 0) {
            $query .= " and so.customerid=$customerid ";
        }if ($shipto != 0) {
            $query .= " and so.shiptoid=$shipto ";
        }if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date between '$datefrom' and '$dateto' ";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and so.date = '$datefrom' ";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and so.date = '$dateto' ";
        }if ($status != '0') {
            $query .= " $status ";
        } 
        $query .= " order by so.id desc limit $limit offset $offset ";
        return $this->db->query($query)->result();
    }

    function selectItemBySoId($soid) {
        $query = "with t_left as 
                ( 
                select sodetail.*,
                model.no,
                model.description modeldescription,
                model.color,
                model.dw,
                model.dd,
                (select model_getfinish_overview(model.id)) finishoverview,
                (select model_getconstruction_overview(model.id)) constructionoverview,
                model.dht,
                model.dsh,
                model.dah,
                model.filename,
                model.volumepackage
                from sodetail left join model
                on sodetail.modelid=model.id
                )select * from t_left where  t_left.soid=$soid order by id asc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "with t as(
                  select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shiptoid) shiptoname 
                  from so 
                  join customer on so.customerid=customer.id order by so.id desc
                ) select * from t where id=$id";
        return $this->db->query($query)->row();
    }

    function insert($customerid, $shipto, $shippingaddress, $shipmentschedule, $shipvia, $number, $date, $salesperson, $testing, $ponumber, $paymenttermid) {
        $this->db->insert('so', array(
            "number" => $number,
            "customerid" => $customerid,
            "shiptoid" => $shipto,
            "date" => $date,
            "ponumber" => $ponumber,
            "salesperson" => $salesperson,
            "shippingaddress" => $shippingaddress,
            "shipmentschedule" => $shipmentschedule,
            "testing" => $testing,
            "paymenttermid" => $paymenttermid,
            "shipvia" => $shipvia
        ));
        $dt = $this->db->query('select max(id) id from so')->row();
        return $dt->id;
    }

    function update($soid, $customerid, $shipto, $shippingaddress, $shipmentschedule, $shipvia, $number, $date, $salesperson, $testing, $ponumber, $paymenttermid) {
        return $this->db->update('so', array(
                    "number" => $number,
                    "customerid" => $customerid,
                    "shiptoid" => $shipto,
                    "date" => $date,
                    "ponumber" => $ponumber,
                    "salesperson" => $salesperson,
                    "shippingaddress" => $shippingaddress,
                    "shipmentschedule" => $shipmentschedule,
                    "testing" => $testing,
                    "paymenttermid" => $paymenttermid,
                    "shipvia" => $shipvia
                        ), array("id" => $soid));
    }

    function insertdetail($soid, $modelid, $qty, $rfqdetailid) {
        return $this->db->insert('sodetail', array(
                    "soid" => $soid,
                    "modelid" => $modelid,
                    "qty" => $qty,
                    "rfqdetailid" => $rfqdetailid
                ));
    }

    function updatedetail($sodetailid, $modelid, $qty) {
        return $this->db->update('sodetail', array(
                    "modelid" => $modelid,
                    "qty" => $qty
                        ), array("id" => $sodetailid));
    }

    function deleteitem($id) {
        $query = "delete from sodetail where id=$id";
        $this->db->query($query);
    }

    function delete($id) {
        $query = "select so_delete($id)";
        return $this->db->query($query);
    }

    function getNextSoNumber() {
        $query = "select so_nextnumber() ct";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }

    function selectItemBuild($soid) {
        $query = "select 
                sodetail.*, bom.itemid, bom.qty bomqty, bom.typeitem, 
                case 
                when bom.typeitem = 'component' then (select description from component where id=bom.itemid) 
                when bom.typeitem = 'material' then (select descriptions description from item where id=bom.itemid) end itemname, 
                case 
                when bom.typeitem = 'component' then (select partnumber from component where id=bom.itemid) 
                when bom.typeitem = 'material' then (select partnumber description from item where id=bom.itemid) end itemcode,
                case
                when bom.typeitem = 'component' then (select unitid from component where id=bom.itemid) 
                when bom.typeitem = 'material' then (select unitfrom from stock where itemid=bom.itemid order by id asc limit 1) end unitid
                from sodetail join bom on sodetail.modelid=bom.modelid and sodetail.soid=$soid order by bom.typeitem asc ";
        return $this->db->query($query)->result();
    }

    function selectAllMaterial($soid) {
        $query = "with t as(
                select _itemid itemid,sum(_qty) qty,_unitid unitid from so_getallmaterial($soid) group by itemid,unitid
            ) select t.*,item.partnumber itemcode,item.descriptions description,unit.codes unitcode from t join item on t.itemid=item.id join unit on t.unitid=unit.id order by t.itemid asc";
        return $this->db->query($query)->result();
    }

    function selectMRPforSO($soid) {
        $query = "with t as(
                select 
                mrp.*,
                item.partnumber itemcode,
                (select item_get_id_smallest_unit(mrp.itemid))::integer unitid,
                item.descriptions description 
                from mrp join item on mrp.itemid=item.id and soid=$soid order by mrp.itemid asc
                ) select t.*,unit.codes unitcode from t join unit on t.unitid=unit.id order by t.itemid asc";
        return $this->db->query($query)->result();
    }

    function docreatebom($id, $date) {
        return $this->db->query("select so_createbom2($id,'$date')");
    }

    function selectOnProcess() {
        $query = "select so.*,customer.name billtoname,
                  (select customer.name from customer where id=so.shipto) shiptoname 
                  from so 
                  join customer on so.billto=customer.id and so.status=0 order by so.id desc";
        return $this->db->query($query)->result();
    }

    function updatedetailstatus($sodetailid, $status, $customerid, $modelid) {
        //return $this->db->update("sodetail", array("status" => $status), array("id" => $sodetailid));
        return $this->db->query("select so_updatedetailstatus($sodetailid,$status,$customerid,$modelid)");
    }

    function isCompleteStatus($soid) {
        $dt = $this->db->query("select so_is_complete_status($soid) ct")->row()->ct;
        return ($dt == 't');
    }

    function createFinalBom($soid) {
        return $this->db->query("select so_create_final_bom($soid)");
    }

    function finishByMarketing($soid) {
        return $this->db->update("so", array("finishbymarketing" => 'TRUE'), array("id" => $soid));
    }

    function finishByRnd($soid) {
        return $this->db->query("select so_finish_by_rnd($soid)");
    }

    function createmrp($soid) {
        return $this->db->query("select so_createmrp($soid)");
    }

    function selectOnProduction($number, $customerid, $date) {
        $query = "select so.id,so.number,customer.name customername,so.date
                  from so join customer on so.customerid=customer.id"; // and status=3 
        if (!empty($number)) {
            $query .= " and so.number ilike '%$number%' ";
        }if ($customerid != 0) {
            $query .= " and so.billto=$customerid ";
        }if (!empty($date)) {
            $query .= " and so.date='$date' ";
        }
        return $this->db->query($query)->result();
    }

    function updatestatus($data, $where) {
        $this->db->update("so", $data, $where);
    }

}

?>
