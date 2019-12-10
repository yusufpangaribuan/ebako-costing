<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_marble
 *
 * @author hp
 */
class model_marble extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select * from modelmarblelist order by id desc";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "select * from modelmarblelist where id=$id order by id desc";
        return $this->db->query($query)->row();
    }

    function save($name, $description) {
        return $this->db->insert('modelmarblelist', array(
                    "name" => $name,
                    "description" => $description
                ));
    }

    function update($id, $name, $description) {
        $this->db->where('id', $id);
        return $this->db->update('modelmarblelist', array(
                    "name" => $name,
                    "description" => $description
                ));
    }

    function delete($id) {
        $this->db->delete('modelmarblelist', array(
            "id" => $id
        ));
    }

}

?>
