<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_quotationvalidity
 *
 * @author hp
 */
class model_quotationvalidity extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        return $this->db->get('quotationvalidity')->result();
    }

    function selectById($id) {
        return $this->db->query("select * from quotationvalidity where id=$id")->row();
    }

    function insert($desc) {
        return $this->db->insert('quotationvalidity', array(
                    "description" => $desc
                ));
    }

    function update($id, $description) {
        return $this->db->update('quotationvalidity', array(
                    "description" => $description
                        ), "id = $id");
    }

    function delete($id) {
        return $this->db->delete('quotationvalidity', array("id" => $id));
    }

}

?>
