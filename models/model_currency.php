<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of currency
 *
 * @author admin
 */
class model_currency extends CI_Model{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function selectAll(){
        return $this->db->query("select * from currency")->result();
    }
    
    function select_by_id($id){
        return $this->db->get_where('currency',array("id"=>$id))->row();
    }
    
    function insert($data){
        return $this->db->insert('currency',$data);
    }
    
    function update($data,$where){
        return $this->db->update('currency',$data,$where);
    }
    
    function delete($where){
        return $this->db->delete('currency',$where);
    }
}

?>
