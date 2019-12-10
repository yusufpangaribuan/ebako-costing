<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_componentcategory extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function selectAll(){
        return $this->db->get("componentcategory")->result();
    }

}

?>
