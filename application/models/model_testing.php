<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_testing
 *
 * @author hp
 */
class model_testing extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function selectAll(){
        return $this->db->get('testing')->result();
    }
    
    function getNameById($id){
        $query = "select name from testing where id=$id";
        $dt = $this->db->query($query)->row();
        return empty($dt) ? "" : $dt->name;
    }
    
    
    
}

?>
