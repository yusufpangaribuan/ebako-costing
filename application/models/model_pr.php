<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_pr
 *
 * @author admin
 */
class model_pr extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select pr.id,pr.sonumber,pr.totalprice,pr.requestdate,pr.departmentid,department.code departmentcode,department.name departmentname,
                  pr.enduser,(select department.code where department.id=pr.enduser) endusercode,(select department.name where department.id=pr.enduser) endusername,
                  pr.capex,pr.jsa,pr.remark,pr.requestnumber,pr.isclose from pr join department on pr.departmentid=department.id
                  order by pr.id desc";
        return $this->db->query($query)->result();
    }

    function search($requestnumber, $requestdatestart, $requestdateend, $departmentid, $capex, $jsa, $state, $limit, $offset) {
        $query = "
            with t as (
                select 
                pr.*,
                (prgetmatreqnumberpritembyprid_2(pr.id)) mr_number,
                pr_get_all_department_by_pr_id(pr.id) departmentcode,
                department.name departmentname,
                pr.enduser,
                dept.code endusercode,
                (select department.name where department.id=pr.enduser) endusername
                from pr 
                left join department on pr.departmentid=department.id
                left join department dept on pr.enduser=dept.id
            ) select t.* from t where true
        ";
//        echo $query;
        if ($requestnumber != "") {
            $query .= " and t.requestnumber ilike '%" . $requestnumber . "%'";
        }if (!empty($requestdatestart) && !empty($requestdateend)) {
            $query .= " and t.requestdate between '" . $requestdatestart . "' and '" . $requestdateend . "'";
        }if (!empty($requestdatestart) && empty($requestdateend)) {
            $query .= " and t.requestdate = '" . $requestdatestart . "'";
        }if (empty($requestdatestart) && !empty($requestdateend)) {
            $query .= " and t.requestdate = '" . $requestdateend . "'";
        }if ($departmentid != 0) {
            $query .= " and t.departmentid = $departmentid";
        }if ($capex != "") {
            $query .= " and t.capex ilike '%" . $capex . "%'";
        }if ($jsa != "") {
            $query .= " and t.jsa ilike '%" . $jsa . "%'";
        }if ($state != 0) {
            $query .= " and t.isclose=$state ";
        }

        $mr_no = $this->input->post('mr_no');
        if (!empty($mr_no)) {
            $query .= " and t.mr_number ilike '%" . $mr_no . "'";
        }
        //echo $state;
        $query .= " order by t.id desc limit $limit offset $offset ";
//        echo $query . "<br/>";
        return $this->db->query($query)->result();
    }

    function getNumRows($requestnumber, $requestdatestart, $requestdateend, $departmentid, $capex, $jsa, $state) {
        $query = "
            with t as (
                select 
                pr.*,
                (prgetmatreqnumberpritembyprid_2(pr.id)) mr_number,
                pr_get_all_department_by_pr_id(pr.id) departmentcode,
                pr.enduser,
                dept.code endusercode,
                (select department.name where department.id=pr.enduser) endusername
                from pr 
                left join department on pr.departmentid=department.id
                left join department dept on pr.enduser=dept.id
            ) select t.* from t where true
        ";

        if ($requestnumber != "") {
            $query .= " and t.requestnumber ilike '%" . $requestnumber . "%'";
        }if (!empty($requestdatestart) && !empty($requestdateend)) {
            $query .= " and t.requestdate between '" . $requestdatestart . "' and '" . $requestdateend . "'";
        }if (!empty($requestdatestart) && empty($requestdateend)) {
            $query .= " and t.requestdate = '" . $requestdatestart . "'";
        }if (empty($requestdatestart) && !empty($requestdateend)) {
            $query .= " and t.requestdate = '" . $requestdateend . "'";
        }if ($departmentid != 0) {
            $query .= " and t.departmentid = $departmentid";
        }if ($capex != "") {
            $query .= " and t.capex ilike '%" . $capex . "%'";
        }if ($jsa != "") {
            $query .= " and t.jsa ilike '%" . $jsa . "%'";
        }if ($state != 0) {
            $query .= " and t.isclose=$state ";
        }

        $mr_no = $this->input->post('mr_no');
        if (!empty($mr_no)) {
            $query .= " and t.mr_number ilike '%" . $mr_no . "'";
        }
//        echo $query;
        return $this->db->query($query)->num_rows();
    }

    function selectById($id) {
        $query = "select pr.id,
                  pr.requestdate,
                  pr.mrnumber,
                  pr.departmentid,
                  sonumber,
                  department.
                  code departmentcode,
                  department.name departmentname,
                  (prGetMatReqNumberPrItemByPrId(pr.id)) mr_num,
                  pr.enduser,(select department.code where department.id=pr.enduser) endusercode,(select department.name where department.id=pr.enduser) endusername,
                  pr.capex,pr.jsa,pr.remark,pr.requestnumber,pr.isclose from pr left join department on pr.departmentid=department.id where pr.id=$id";
        return $this->db->query($query)->row();
    }

    function insert($data) {
        return $this->db->insert("pr", $data);
    }

    function update($id, $requestnumber, $requestdate, $departmentid, $enduser, $capex, $jsa, $remark, $sonumber, $mrnumber) {
        $this->db->where('id', $id);
        return $this->db->update("pr", array("requestnumber" => $requestnumber,
                    "requestdate" => $requestdate,
                    "departmentid" => $departmentid,
                    "enduser" => $enduser,
                    "capex" => $capex,
                    "jsa" => $jsa,
                    "remark" => $remark,
                    "sonumber" => $sonumber,
                    "mrnumber" => $mrnumber));
    }

    function update2($data, $where) {
        return $this->db->update("pr", $data, $where);
    }

    function delete($id) {
        return $this->db->query("select pr_delete($id)");
    }

    function getNextPr() {
        $query = "select pr_get_next_request_number() as nextpr";
        $dt = $this->db->query($query)->result();
        return $dt[0]->nextpr;
    }

    function getLastId() {
        $query = "select pr_get_last_id() as prid";
        $dt = $this->db->query($query)->result();
        return $dt[0]->prid;
    }

    function updatestate($prid, $state) {
        $this->db->where('id', $prid);
        return $this->db->update('pr', array("isclose" => $state));
    }

    function isHadPo($prid) {
        $dt = $this->db->query("select count(*) ct from po where prid=$prid")->row();

        return ($dt->ct != 0 ) ? true : false;
    }

    function saveConfigApproval($checked, $acknowledge, $approved) {
        $this->db->update('approvaldefault', array(
            "checked" => $checked,
            "acknowledge" => $acknowledge,
            "approved" => $approved
        ));
    }

    function getPrDefaultApproval() {
        return $this->db->get('approvaldefault')->row();
    }

    function iscompletepricecomparison($prid) {
        $dt = $this->db->query("select pr_iscompletepricecomparison($prid) as ct")->row()->ct;
        return ($dt == 't') ? TRUE : FALSE;
    }

    function get_all_department_by_id($prid) {
        $query = "select pr_get_all_department_by_pr_id($prid) as ct";
        return $this->db->query($query)->row()->ct;
    }

}

?>
