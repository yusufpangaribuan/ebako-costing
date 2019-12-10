<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_reasonrequirment
 *
 * @author hp
 */
class model_reasonrequirement extends CI_Model{
    //put your code here
    
    function __construct() {
        parent::__construct();
    }
    
    function selectAll(){
        return $this->db->get('reasonrequirement')->result();
    }
}

?>
