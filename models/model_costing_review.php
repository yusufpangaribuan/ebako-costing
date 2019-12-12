<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_costing_review
 *
 * @author hp
 */
class model_costing_review extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select *
                from costing_review
                order by costing_review_id desc";
        return $this->db->query($query)->result();
    }

    function saveNew($data) {
        return $this->db->insert('costing_review', array(
                    "costing_review_id" => $data['costing_review_id'],
                    "costing_id" => $data['costing_id'],
                    "condition_type" => $data['condition_type'],
                    "rate_value" => $data['rate_value'],
                    "pick_list_rate_value" => $data['pick_list_rate_value'],
                    "fob_price" => $data['fob_price'],
                    "margin" => $data['margin'],
                    "costing_review_year" => $data['costing_review_year']
                ));
    }
    
    function getCostingReviewIdByCostingIdAndConditionTypeAndCostingReviewYear($costing_id, $condition_type, $costing_review_year) {
        $query = "select costing_review_id
                from costing_review
                where costing_id='$costing_id'
                and condition_type='$condition_type'
                and costing_review_year='$costing_review_year'";
        return $this->db->query($query)->result();
    }

    function updateCostingReviewById($data) {
        $this->db->where("costing_review_id", $data['costing_review_id']);
        $this->db->update('costing_review', array(
            "rate_value" => $data['rate_value'],
            "pick_list_rate_value" => $data['pick_list_rate_value'],
            "fob_price" => $data['fob_price'],
            "margin" => $data['margin'],
            "costing_review_year" => $data['costing_review_year']
        ));
    }
    	 
    
}

?>
