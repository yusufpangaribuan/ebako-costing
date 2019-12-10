<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_category
 *
 * @author hp
 */
class model_category extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    function selectAll(){
        $query = "select * from category";
        return $this->db->query($query)->result();
    }
}

?>
