<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_directlabour
 *
 * @author hp
 */
class model_directlabour extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        return $this->db->query("select * from directlabour")->result();
    }

    function getNumRows($description) {
        $query = "select * from directlabour where true ";
        if (!empty($description)) {
            $query .= " and description ilike '%$description%' ";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($description, $limit, $offset) {
        $query = "select * from directlabour where true ";
        if (!empty($description)) {
            $query .= " and description ilike '%$description%' ";
        }
        $query .= " order by id desc limit $limit offset $offset ";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        return $this->db->query("select * from directlabour where id=$id")->row();
    }
    
    function getAllForSelection( $key_search ){
    	$query = " select id, description as text from directlabour where true ";
    	if( !empty($key_search) ){
    		$query .= " and description ilike '%$key_search%' ";
    	}
    	$query .= " limit 100 ";
    
    	return $this->db->query( $query )->result();
    }

    function insert($directlabour) {
        return $this->db->insert('directlabour', $directlabour);
    }

    function update($directlabour, $where) {
        return $this->db->update('directlabour', $directlabour, $where);
    }

    function delete($id) {
        return $this->db->query("delete from directlabour where id=$id");
    }

    function getPrice($itemid) {
        $query = "select price,curr from directlabour where id=$itemid limit 1;";
        return $this->db->query($query)->row();
    }

}

?>
