<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_materialrequisition
 *
 * @author user
 */
class model_materialrequisition extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        $query = "
          with t as (
                select 
                materialrequisition.*,
                employee.name employee_request_by,
                department.name departmentname,
                (select name from employee where id=materialrequisition.supervisorapproval) supervisor,
                (select name from employee where id=materialrequisition.managerapproval) manager
                from materialrequisition
                left join employee on materialrequisition.request_by=employee.id
                left join department on materialrequisition.departmentid=department.id
            ) select * from t where t.id=$id
        ";
        return $this->db->query($query)->row();
    }

    function select_detail_by_mat_req_id($mat_req_id) {
        $query = "
            select 
            materialrequisition_detail.*,
            item.partnumber item_code,
            item.descriptions item_description,
            unit.codes unit_code
            from materialrequisition_detail
            join item on materialrequisition_detail.itemid=item.id
            join unit on materialrequisition_detail.unitid=unit.id
            where materialrequisition_detail.materialrequisitionid=$mat_req_id 
            order by materialrequisition_detail.id asc
        ";
        return $this->db->query($query)->result();
    }

    function get_last_id() {
        $query = "select id from materialrequisition order by id desc limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function insert($data) {
        return $this->db->insert('materialrequisition', $data);
    }

    function update($data, $where) {
        return $this->db->update('materialrequisition', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('materialrequisition', $where);
    }

    function insert_detail($data) {
        return $this->db->insert('materialrequisition_detail', $data);
    }

    function insert_detail_batch($data) {
        return $this->db->insert_batch('materialrequisition_detail', $data);
    }

    function update_detail($data, $where) {
        return $this->db->update('materialrequisition_detail', $data, $where);
    }

    function delete_detail($where) {
        return $this->db->delete('materialrequisition_detail', $where);
    }

    function getLastApprovalByEmployee($employeeid) {
        $query = "
            select 
            materialrequisition.id,
            materialrequisition.supervisorapproval,
            employee.name supervisorname,
            materialrequisition.managerapproval,
            emp.name managername
            from materialrequisition 
            left join employee on materialrequisition.supervisorapproval=employee.id
            left join employee emp on materialrequisition.managerapproval=emp.id 
            where materialrequisition.request_by='$employeeid' 
            order by materialrequisition.id desc limit 1 
        ";
        return $this->db->query($query)->row();
    }

    function selectPendingApprovalByUser($id) {
        $query = "
            select 
            materialrequisition.*,
            employee.name name_requested,
            department.name departmentname
            from materialrequisition 
            join employee on materialrequisition.request_by=employee.id
            join department on materialrequisition.departmentid=department.id
            where (supervisorapproval='$id' and supervisorstatusapproval in (0,2) ) 
            or (managerstatusapproval in (0,2) and managerapproval='$id'  and supervisorstatusapproval = 1)
        ";
        //echo $query;
        return $this->db->query($query)->result();
    }

}
