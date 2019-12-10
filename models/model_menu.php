<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_menu
 *
 * @author hp
 */
class model_menu extends CI_Model{
    //put your code here
    public function __construct() {
        $this->load->database();
        parent::__construct();
    }
    
    function selectAll(){
        $this->db->order_by('level','asc');
        return $this->db->get('menu')->result();
    }
    
    function selectAll_for_costing(){
        return $this->db->query("select * from menu where scriptview in ('costing', 'model','defaultmaterial','user', 'directlabour','rates') ")->result();
    }
}

?>
