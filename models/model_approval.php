<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_approval
 *
 * @author admin
 */
class model_approval extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert($prid, $employeeid, $outstanding) {
        return $this->db->insert("approval", array("prid" => $prid, "employeeid" => $employeeid, "outstanding" => $outstanding));
    }

    function update($prid, $id, $employeeid) {
        $this->db->where('id', $id);
        $this->db->where('prid', $prid);
        return $this->db->update("approval", array("employeeid" => $employeeid));
    }

    function selectApprovalPr($prid) {
        $query = "select approval.*,(select name from employee where id=approval.employeeid) \"name\" from approval where prid=$prid order by id asc";
        return $this->db->query($query)->result();
    }

    function approvepr($prid, $approvalid, $status, $notes) {
        $this->db->query("select approval_approve($prid,$approvalid,$status,'$notes')");
    }

    function isComplete($prid) {
        $query = "select * from approval where status != 1 and employeeid != '' and prid=$prid";
        $dt = $this->db->query($query)->result();
        return (empty($dt) ? true : false);
    }

    function isHaveApproval($prid) {
        $query = "select count(*) ct from approval where prid=$prid";
        $dt = $this->db->query($query)->row();
        return ($dt->ct == 0) ? false : true;
    }

    function selectOutstandingByEmployeeid($employeeid) {
        /* $query = "select approval.id approvalid,pr.id,pr.requestdate,pr.departmentid,sonumber,department.code departmentcode,department.name departmentname,
          pr.enduser,(select department.code where department.id=pr.enduser) endusercode,(select department.name where department.id=pr.enduser) endusername,
          pr.capex,pr.jsa,pr.remark,pr.requestnumber,pr.isclose from pr join department on pr.departmentid=department.id
          join approval on pr.id=approval.prid and approval.outstanding = true and approval.employeeid='$employeeid' and approval.status in (0,2)";
         */

        $query = "
            select 
            approval.id approvalid,
            pr.id,
            pr.requestdate,
            pr.remark,
            pr.requestnumber,
            pr_get_all_department_by_pr_id(pr.id) departmentname
            from pr join approval on pr.id=approval.prid 
            where approval.outstanding is true and approval.employeeid='$employeeid' and approval.status in (0,2)
            order by pr.id asc 
        ";

        return $this->db->query($query)->result();
    }

    function getOutStandingApprovalIdByEmployeeAndPr($employeeid, $prid) {
        $query = "select id from approval where employeeid='$employeeid' and prid=$prid and outstanding=true limit 1";
        //echo $query;
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function viewNotes($approvalid) {
        $query = "select notes from approval where id=$approvalid limit 1";
        //echo $query;
        $dt = $this->db->query($query)->row();
        return (empty($dt) ? "" : $dt->notes);
    }

}

?>
