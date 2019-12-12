<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_costing
 *
 * @author hp
 */
class model_costing_history extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select 
                ch.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
                model.dd,
                model.dw,
                model.dht,
                customer.name customername
                from costing_history ch
                join model on ch.modelid=model.id
                join customer on ch.customerid=customer.id order by ch.id desc";
        return $this->db->query($query)->result();
    }

    function saveNew($data) {
        return $this->db->insert('costing_history', array(
            "costing_id" => $data['costing_id'],
            "modelid" => $data['modelid'],
            "customerid" => $data['customerid'],
            "profit_percentage" => $data['profit_percentage'],
            "rateid" => $data['rateid'],
            "ratevalue" => $data['ratevalue'],
            "fixed_cost" => $data['fixed_cost'],
            "variable_cost" => $data['variable_cost'],
            "port_origin_cost" => $data['port_origin_cost'],
            "date" => $data['date'],
            "fob_price" => $data['fob_price'],
            "approve" => $data['approve'],
            "needmodify" => $data['needmodify'],
            "locked" => $data['locked'],
            "sellprice" => $data['sellprice'],
            "direct_material" => $data['direct_material'],
            "direct_labour" => $data['direct_labour'],
            "fixed_cost_value" => $data['fixed_cost_value'],
            "variable_cost_value" => $data['variable_cost_value'],
            "pick_list_hardware" => $data['pick_list_hardware'],
            "sub_contractor" => $data['sub_contractor'],
            "port_origin_cost_value" => $data['port_origin_cost_value'],
            "sub_total" => $data['sub_total'],
            "isreviewed" => $data['isreviewed'],
            "updated_price" => $data['updated_price'],
            "variable_mark_up_cat_8" => $data['variable_mark_up_cat_8'],
            "picklist_rateid" => $data['picklist_rateid'],
            "picklist_ratevalue" => $data['picklist_ratevalue'],
            "checkedtime" => $data['checkedtime'],
            "approvedtime" => $data['approvedtime'],
            "checkedstatus" => $data['checkedstatus'],
            "approvedstatus" => $data['approvedstatus'],
            "preparedby" => $data['preparedby'],
            "checkedby" => $data['checkedby'],
            "approvedby" => $data['approvedby'],
            "additional_notes" => $data['additional_notes'],
            "created_at" => $data['created_at']
        ));
    }
    	 
    
}

?>
