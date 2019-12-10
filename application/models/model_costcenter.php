<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_costcenter
 *
 * @author hp
 */
class model_costcenter extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_all() {
        $query = "select * from cost_center order by description asc";
        return $this->db->query($query)->result();
    }

    function select_by_id($id) {
        $query = "select * from cost_center where id=$id";
        return $this->db->query($query)->row();
    }

    function select_not_member($id) {
        $query = "select * from cost_center where id not in($id) order by description asc";
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('cost_center', $data);
    }

    function update($data, $where) {

        return $this->db->update('cost_center', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('cost_center', $where);
    }

    function select_member_result($cost_center_id) {
        $query = "select * from cost_center where id in (select unnest(member) from cost_center where id=$cost_center_id)
                order by description asc ";
        return $this->db->query($query)->result();
    }

}
