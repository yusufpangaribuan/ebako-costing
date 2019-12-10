<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_packing
 *
 * @author hp
 */
class model_packing extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select * from modelpackinglist order by id desc";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "select * from modelpackinglist where id=$id order by id desc";
        return $this->db->query($query)->row();
    }

    function save($name, $description) {
        return $this->db->insert('modelpackinglist', array(
                    "name" => $name,
                    "description" => $description
                ));
    }

    function update($id, $name, $description) {
        $this->db->where('id', $id);
        return $this->db->update('modelpackinglist', array(
                    "name" => $name,
                    "description" => $description
                ));
    }

    function delete($id) {
        $this->db->delete('modelpackinglist', array(
            "id" => $id
        ));
    }

}

?>
