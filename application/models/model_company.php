<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_company
 *
 * @author hp
 */
class model_company extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getDetail(){
        return $this->db->query("select * from companydetail limit 1")->row();        
    }
}

?>
