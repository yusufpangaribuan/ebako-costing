<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_hardwaretype
 *
 * @author hp
 */
class model_hardwaretype extends CI_Model {

    //put your code here

    function __construct() {
        $this->load->database();
    }
    
    function selectAll(){
        return $this->db->get('hardwaretype')->result();
    }

}

?>
