<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_servicerequest
 *
 * @author hp
 */
class model_servicerequest extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {

        $query = "
          with t as (
                  select 
                  servicerequest.*,
                  employee.name employee_request_by,
                  department.name department,
                  emp1.name name_approval1,
                  emp2.name name_approval2,
                  (select COALESCE(sum(ots_qty),0) from servicerequestdetail where servicerequestid=servicerequest.id) count_ots,
                  (select count(*) from attachment where referenceid=servicerequest.id and reference='SR') count_attchment,	
                  (select count(*) from comment where referenceid=servicerequest.id and reference='SR') count_comment,
                  (select sum(ots_qty) from servicerequestdetail where servicerequestid=servicerequest.id) ots_qty 
                  from servicerequest
                  left join employee on servicerequest.request_by=employee.id
                  left join employee emp1 on servicerequest.approval1=emp1.id
                  left join employee emp2 on servicerequest.approval2=emp2.id
                  left join department on servicerequest.departmentid=department.id
          ) select * from t where t.id=$id  
        ";

        return $this->db->query($query)->row();
    }

    function select_detail_by_service_request_id($id) {
        $query = "
            select srd.*,s_item.partnumber source_item_code,s_item.descriptions source_item_description,
            s_unit.codes source_unit_code,t_item.partnumber target_item_code,t_item.descriptions target_item_description,
            t_unit.codes target_unit_code from servicerequestdetail srd
            join item s_item on srd.source_itemid=s_item.id
            join item t_item on srd.target_itemid=t_item.id
            join unit s_unit on srd.source_unitid=s_unit.id
            join unit t_unit on srd.target_unitid=t_unit.id
            where srd.servicerequestid=$id
        ";
        return $this->db->query($query)->result();
    }

    function selectPendingApprovalByUser($userid) {
        $query = "
            select 
            servicerequest.*,
            employee.name name_requested,
            department.name departmentname
            from servicerequest 
            join employee on servicerequest.request_by=employee.id
            join department on servicerequest.departmentid=department.id
            where servicerequest.status=1 and (servicerequest.approval1='$userid' and servicerequest.approval1_status in (0,2) ) 
            or (servicerequest.approval2_status in (0,2) and servicerequest.approval2='$userid'  and servicerequest.approval1_status = 1)
        ";
//        echo $query;
//        exit;
        return $this->db->query($query)->result();
    }

    function get_last_id() {
        $query = "select id from servicerequest order by id desc limit 1";
        return $this->db->query($query)->row()->id;
    }

    function insert($data) {
        return $this->db->insert('servicerequest', $data);
    }

    function update($data, $where) {
        return $this->db->update('servicerequest', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('servicerequest', $where);
    }

    function getServiceRequestDefaultApproval() {
        return $this->db->get('servicerequestapprovaldefault')->row();
    }

    function insertapprove($data) {
        return $this->db->insert('servicerequestapproval', $data);
    }

    function selectApproval($servicerequestid) {
        $query = "select 
                servicerequestapproval.*,
                employee.name
                from servicerequestapproval 
                join employee on servicerequestapproval.employeeid=employee.id
                where servicerequestid=$servicerequestid order by id asc";
        return $this->db->query($query)->result();
    }

    function approve($servicerequestid, $approvalid, $status, $notes) {
        $query = "select servicerequest_approve($servicerequestid,$approvalid,$status,'$notes')";
        return $this->db->query($query);
    }

    function isHaveApproval($servicerequestid) {
        $query = "select count(*) ct from servicerequestapproval where servicerequestid=$servicerequestid";
        $dt = $this->db->query($query)->row();
        return ($dt->ct == 0) ? false : true;
    }

    function isComplete($servicerequestid) {
        $query = "select * from servicerequestapproval where status != 1 and employeeid != '' and servicerequestid=$servicerequestid";
        $dt = $this->db->query($query)->result();
        return (empty($dt) ? true : false);
    }

    function updateapproval($servicerequestid, $id, $employeeid) {
        $this->db->where('id', $id);
        $this->db->where('servicerequestid', $servicerequestid);
        return $this->db->update("servicerequestapproval", array("employeeid" => $employeeid));
    }

    function do_reject_or_pending($servicerequestid, $approvalid, $status, $notes) {
        $query = "select servicerequest_approve($servicerequestid,$approvalid,$status,'$notes')";
        return $this->db->query($query);
    }

    function detail_select_by_id($id) {
        $query = "
            select srd.*,s_item.partnumber source_item_code,s_item.descriptions source_item_description,
            s_unit.codes source_unit_code,t_item.partnumber target_item_code,t_item.descriptions target_item_description,
            t_unit.codes target_unit_code from servicerequestdetail srd
            join item s_item on srd.source_itemid=s_item.id
            join item t_item on srd.target_itemid=t_item.id
            join unit s_unit on srd.source_unitid=s_unit.id
            join unit t_unit on srd.target_unitid=t_unit.id
            where srd.id=$id
        ";
        return $this->db->query($query)->row();
    }

    function detail_insert($data) {
        return $this->db->insert('servicerequestdetail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('servicerequestdetail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('servicerequestdetail', $where);
    }

}
