<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_returnproduction
 *
 * @author munte
 */
class model_returnproduction extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        $query = "
            with t as(
                    select 
                    returnproduction.*,
                    employee.name name_return_by,
                    dept_division.name department_name,
                    item.partnumber item_code,
                    item.descriptions item_description,
                    unit.codes unit_code
                    from returnproduction
                    join employee on returnproduction.return_by=employee.id
                    join item on returnproduction.itemid=item.id
                    join unit on returnproduction.unitid=unit.id
                    left join dept_division on returnproduction.departmentid=dept_division.id
            ) select t.* from t where t.id=$id
        ";
        return $this->db->query($query)->row();
    }

    function select_all_receive_by_return_id($id) {
        $query = "select rpc.*,(case when rpc.type=1 then 'Increase Stock' else 'Goods Reject' end) type_description,
                  wh.name warehouse_name,emp.name name_receive_by from returnproduction_receive rpc
                  left join warehouse wh on rpc.warehouseid=wh.id left join employee emp on rpc.receive_by=emp.id
                  where rpc.returnproductionid=$id";
        return $this->db->query($query)->result();
    }

    function select_receive_by_id($id) {
        $query = "select rpc.*,(case when rpc.type=1 then 'Increase Stock' else 'Goods Reject' end) type_description,
                  wh.name warehouse_name,emp.name name_receive_by from returnproduction_receive rpc
                  left join warehouse wh on rpc.warehouseid=wh.id left join employee emp on rpc.receive_by=emp.id
                  where rpc.id=$id";
//        echo $query;
        return $this->db->query($query)->row();
    }

}
