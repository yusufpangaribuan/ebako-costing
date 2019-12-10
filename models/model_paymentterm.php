<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_paymenterm
 *
 * @author hp
 */
class model_paymentterm extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function selectAll(){
        $this->db->order_by('id','asc'); 
        return $this->db->get('paymentterm')->result();
    }
}

?>
