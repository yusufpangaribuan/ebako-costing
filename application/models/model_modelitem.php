<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_modelitem
 *
 * @author hp
 */
class model_modelitem extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function insert($modelid,$parentid,$itemid,$description,$unitid,$qty,$standardcost){
        return $this->db->insert('modelitem',array(
            "modelid"=>$modelid,
            "parentid"=>$parentid,
            "itemid"=>$itemid,
            "unitid"=>$unitid,
            "qty"=>$qty,
            "standardcost"=>$standardcost
        ));
    }
    
    function selectByModelIdAndParentId($modelid){
        $query ="select mi.*,
                it.partnumber itempartnumber,
                it.names itemname,
                unit.names unitname,
                unit.codes unitcode
                from modelitem mi join item it on mi.itemid=it.id 
                join unit on mi.unitid=unit.id and mi.modelid=$modelid order by id asc";
        //echo $query."<br/>";
        return $this->db->query($query)->result();
    }
} 

?>
