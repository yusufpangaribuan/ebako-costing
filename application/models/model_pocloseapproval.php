<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_pocloseapproval
 *
 * @author hp
 */
class model_pocloseapproval extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        return $this->db->get('pocloseapproval')->row();
    }

    function update($level1, $level2) {
        return $this->db->update('pocloseapproval', array(
                    "level1" => $level1,
                    "level2" => $level2
                ));
    }

}

?>
