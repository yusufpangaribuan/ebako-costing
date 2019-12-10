<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_servicerequestdetail
 *
 * @author hp
 */
class model_servicerequestdetail extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function selectById($id) {
        $query = "select 
                servicerequestdetail.*,
                model.no modelcode
                from servicerequestdetail
                join model on servicerequestdetail.modelid=model.id 
                and servicerequestdetail.id=$id";
        return $this->db->query($query)->row();
    }

    function selectByServiceRequestId($servicerequestid) {
        $query = "select 
                servicerequestdetail.*,
                model.no modelcode
                from servicerequestdetail
                join model on servicerequestdetail.modelid=model.id 
                and servicerequestdetail.servicerequestid=$servicerequestid";
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('servicerequestdetail', $data);
    }

    function update($data, $where) {
        return $this->db->update('servicerequestdetail', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('servicerequestdetail', $where);
    }

}

?>
