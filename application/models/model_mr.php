<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_mr
 *
 * @author hp
 */
class model_mr extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function getNumRows($number, $start_date, $end_date, $departmentid, $requestby, $supervisorapproval, $managerapproval, $status) {
        $query = "with t as (
                        select 
                        mr.*,
                        department.name departmentname,
                        department.code departmentcode,
                        (select name from employee where id=mr.requestby) namerequestby,
                        (select name from employee where id=mr.supervisorapproval) supervisor,
                        (select name from employee where id=mr.managerapproval) manager
                        from mr join department on mr.departmentid=department.id
                ) select * from t where true ";
//        if ($departmentid != 0) {
//            $query .= " and t.departmentid=$departmentid";
//        }

        if (!empty($number)) {
            $query .= " and t.number ilike '%$number%' ";
        }if (!empty($start_date) && !empty($end_date)) {
            $query .= " and t.date between '$start_date' and '$end_date' ";
        }if (!empty($start_date) && empty($end_date)) {
            $query .= " and t.date = '$start_date' ";
        }if (empty($start_date) && !empty($end_date)) {
            $query .= " and t.date = '$end_date' ";
        }if ($departmentid != 0) {
            $query .= " and t.departmentid = $departmentid ";
        }if (!empty($requestby)) {
            $query .= " and t.namerequestby ilike '%$requestby%' ";
        }if (!empty($supervisorapproval)) {
            $query .= " and t.supervisor ilike '%$supervisorapproval%' ";
        }if (!empty($managerapproval)) {
            $query .= " and t.manager ilike '%$managerapproval%' ";
        }if ($status != "") {
            $query .= " and t.status = $status ";
        }if ($this->session->userdata('id') != 'admin' && $this->session->userdata('department') != 10) {
            $query .= " and (requestby='" . $this->session->userdata('id') . "' or supervisorapproval='" . $this->session->userdata('id') . "' or managerapproval='" . $this->session->userdata('id') . "') ";
        }
        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and (select count(*) from mrdetail where mrdetail.mrid=t.id and mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . ") > 0";
            }
        }

        $item_code_description = $this->input->post('item_code_description');

        if (!empty($item_code_description)) {
            $query .= " and t.id in ("
                    . "select mrid from mrdetail join item on mrdetail.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }
        //echo $query."<br/>";
        return $this->db->query($query)->num_rows();
    }

    function search($number, $start_date, $end_date, $departmentid, $requestby, $supervisorapproval, $managerapproval, $status, $limit, $offset) {
        $query = "with t as (
                        select 
                        mr.*,
                        department.name departmentname,
                        department.code departmentcode,
                        reasonrequirement.description reasonrequirement,
                        (select name from employee where id=mr.requestby) namerequestby,
                        (select name from employee where id=mr.supervisorapproval) supervisor,
                        (select name from employee where id=mr.managerapproval) manager
                        from mr join department on mr.departmentid=department.id
                        join reasonrequirement on mr.reasonrequirementid=reasonrequirement.id
                ) select * from t where true ";
//        if ($departmentid != 0) {
//            $query .= " and t.departmentid=$departmentid";
//        }

        if (!empty($number)) {
            $query .= " and t.number ilike '%$number%' ";
        }if (!empty($start_date) && !empty($end_date)) {
            $query .= " and t.date between '$start_date' and '$end_date' ";
        }if (!empty($start_date) && empty($end_date)) {
            $query .= " and t.date = '$start_date' ";
        }if (empty($start_date) && !empty($end_date)) {
            $query .= " and t.date = '$end_date' ";
        }if ($departmentid != 0) {
            $query .= " and t.departmentid = $departmentid ";
        }if (!empty($requestby)) {
            $query .= " and t.namerequestby ilike '%$requestby%' ";
        }if (!empty($supervisorapproval)) {
            $query .= " and t.supervisor ilike '%$supervisorapproval%' ";
        }if (!empty($managerapproval)) {
            $query .= " and t.manager ilike '%$managerapproval%' ";
        }if ($status != "") {
            $query .= " and t.status = $status ";
        }if ($this->session->userdata('id') != 'admin' && $this->session->userdata('department') != 10) {
            $query .= " and (t.requestby='" . $this->session->userdata('id') . "' or t.supervisorapproval='" . $this->session->userdata('id') . "' or t.managerapproval='" . $this->session->userdata('id') . "') ";
        }

        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            $query .= " and (((select count(*) from mrdetail where mrdetail.mrid=t.id and mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . ") > 0) or t.requestby='" . $this->session->userdata('id') . "')";
            //$query .= " or t.requestby='" . $this->session->userdata('id') . "'";
        }
        $item_code_description = $this->input->post('item_code_description');

        if (!empty($item_code_description)) {
            $query .= " and t.id in ("
                    . "select mrid from mrdetail join item on mrdetail.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }

        $query .= "order by t.id desc limit $limit offset $offset;";
//        echo $query . "<br/>";
        return $this->db->query($query)->result();
    }

    function searchforprint($number, $start_date, $end_date, $departmentid, $requestby, $supervisorapproval, $managerapproval, $status) {
        $query = "with t as (
                        select 
                        mr.*,
                        department.name departmentname,
                        department.code departmentcode,
                        reasonrequirement.description reasonrequirement,
                        (select name from employee where id=mr.requestby) namerequestby,
                        (select name from employee where id=mr.supervisorapproval) supervisor,
                        (select name from employee where id=mr.managerapproval) manager
                        from mr join department on mr.departmentid=department.id
                        join reasonrequirement on mr.reasonrequirementid=reasonrequirement.id
                ) select * from t where true ";
//        if ($departmentid != 0) {
//            $query .= " and t.departmentid=$departmentid";
//        }

        if (!empty($number)) {
            $query .= " and t.number ilike '%$number%' ";
        }if (!empty($start_date) && !empty($end_date)) {
            $query .= " and t.date between '$start_date' and '$end_date' ";
        }if (!empty($start_date) && empty($end_date)) {
            $query .= " and t.date = '$start_date' ";
        }if (empty($start_date) && !empty($end_date)) {
            $query .= " and t.date = '$end_date' ";
        }if ($departmentid != 0) {
            $query .= " and t.departmentid = $departmentid ";
        }if (!empty($requestby)) {
            $query .= " and t.requestby ilike '%$requestby%' ";
        }if (!empty($supervisorapproval)) {
            $query .= " and t.supervisor ilike '%$supervisorapproval%' ";
        }if (!empty($managerapproval)) {
            $query .= " and t.manager ilike '%$managerapproval%' ";
        }if ($status != "") {
            $query .= " and t.status = $status ";
        }
        $query .= "order by t.id desc";
        //echo $query."<br/>";
        return $this->db->query($query)->result();
    }

    function searchByMrNumber($mrnumber) {
        $query = "select number from mr where true ";
        if ($mrnumber != "") {
            $query .= " and number ilike '%" . $mrnumber . "%'";
        }

        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "with t as (
                        select 
                        mr.*,
                        department.name departmentname,
                        department.code departmentcode,
                        reasonrequirement.description reasonrequirement,
                        (select name from employee where id=mr.requestby) namerequestby,
                        (select name from employee where id=mr.supervisorapproval) supervisor,
                        (select name from employee where id=mr.managerapproval) manager
                        from mr join department on mr.departmentid=department.id
                        join reasonrequirement on mr.reasonrequirementid=reasonrequirement.id
                ) select * from t where t.id=$id";
        return $this->db->query($query)->row();
    }

    function insert_new($data) {
        return $this->db->insert('mr', $data);
    }

    function insert($number, $date, $requestby, $departmentid, $supervisor, $manager, $reasonrequirementid, $datemustreceive, $soid, $request_type, $batch_time) {
        $data = array(
            "number" => $number,
            "date" => $date,
            "departmentid" => $departmentid,
            "requestby" => $requestby,
            "supervisorapproval" => $supervisor,
            "managerapproval" => $manager,
            "reasonrequirementid" => $reasonrequirementid,
            "datemustreceive" => $datemustreceive,
            "soid" => $soid,
            "request_type" => $request_type,
            "batch_time" => $batch_time);
        if ($request_type == 2) {
            $data["warehouse_request_id"] = $this->session->userdata('optiongroup');
        }
        $this->db->insert('mr', $data);
        $dt = $this->db->query("select id from mr order by id desc limit 1")->row();
        return $dt->id;
    }

    function get_last_id() {
        $dt = $this->db->query("select id from mr order by id desc limit 1")->row();
        return $dt->id;
    }

    function approve($mrid, $status, $approval) {
        return $this->db->query("select mr_approve($mrid,$status,$approval)");
    }

    function getNextNumber() {
        $dt = $this->db->query("select mr_get_number() ct")->row();
        return $dt->ct;
    }

    function update($id, $number, $date, $requestby, $departmentid, $supervisor, $manager, $reasonrequirementid, $datemustreceive, $soid, $batch_time) {
        $this->db->where('id', $id);
        $this->db->update('mr', array(
            "number" => $number,
            "date" => $date,
            "departmentid" => $departmentid,
            "requestby" => $requestby,
            "supervisorapproval" => $supervisor,
            "managerapproval" => $manager,
            "reasonrequirementid" => $reasonrequirementid,
            "datemustreceive" => $datemustreceive,
            "soid" => $soid,
            "batch_time" => $batch_time
        ));
    }

    function update_new($data, $where) {
        return $this->db->update('mr', $data, $where);
    }

    function delete($id) {
        $this->db->query("select mr_delete($id)");
    }

    function selectOpenMr($mrno, $departmentid, $date) {
        $query = "select mr.*,department.name departmentname from mr 
                  join department on mr.departmentid=department.id 
                  and status=1";
        if ($mrno != "") {
            $query .= " and mr.number ilike '%$mrno%' ";
        }if ($departmentid != 0) {
            $query .= " and mr.departmentid=$departmentid ";
        }if ($date != "") {
            $query .= " and mr.date='$date' ";
        }

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and (select count(*) from mrdetail where mrdetail.mrid=mr.id and mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . ") > 0";
            }
        }

        return $this->db->query($query)->result();
    }

    function getOts($mrid) {
        $query = "select sum(ots) ots from mrdetail where mrid=$mrid";
//        echo "<br/>".$query;
        $dt = $this->db->query($query)->row();
        return $dt->ots;
    }

    function changeStatus($id, $status) {
        $this->db->where('id', $id);
        $this->db->update('mr', array(
            "status" => $status
        ));
    }

    function getLastApproval($departmentid) {
        $query = "select 
                supervisorapproval,
                (select (name) from employee where id=supervisorapproval) supervisorname,
                managerapproval,
                (select (name) from employee where id=managerapproval) managername
                from mr where departmentid=$departmentid order by id desc limit 1";
        return $this->db->query($query)->row();
    }

    function getLastApprovalByEmployee($employeeid) {
        $query = "
            select 
            mr.id,
            mr.supervisorapproval,
            employee.name supervisorname,
            mr.managerapproval,
            emp.name managername
            from mr 
            left join employee on mr.supervisorapproval=employee.id
            left join employee emp on mr.managerapproval=emp.id 
            where mr.requestby='$employeeid' order by mr.id desc limit 1 
        ";
        return $this->db->query($query)->row();
    }

    function selectPendingApprovalByUser($id) {
        $query = "select * from mr where (supervisorapproval='$id' and supervisorstatusapproval in (0,2) ) or (managerstatusapproval in (0,2) and managerapproval='$id'  and supervisorstatusapproval = 1)";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectStockOutUnreceiveByMrId($id) {
        $query = "select stockout.*,department.name departmentname from stockout
                  join department on stockout.departmentid=department.id where stockout.mrid=$id and received=FALSE";
        return $this->db->query($query)->result();
    }

    function getCountNewReceiveMr($id) {
        $dt = $this->db->query("select count(*) ct from stockout where mrid=$id and received=false")->row();
        return $dt->ct;
    }

    function selectDetailReceive($mrid) {
        $query = "select stockout.*,warehouse.name warehousename from stockout 
                  join warehouse on stockout.warehouseid=warehouse.id and received=true and mrid=$mrid";
        return $this->db->query($query)->result();
    }

    function selectQuery($query) {
        return $this->db->query($query)->result();
    }
    
    function complete_receive($mrid) {
        return $this->db->query("select mw_is_complete_receive($mrid) ct ")->row()->ct;
    }

}

?>
