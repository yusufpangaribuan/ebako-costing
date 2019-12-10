<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_sodetailnotes extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function selectAll(){
        $this->order_by('id','asc');
        return $this->db->get('sodetailnotes')->result();
    }
    
    function selectBySoIdModelId($soid,$modelid){
        $this->db->where('soid',$soid);
        $this->db->where('modelid',$modelid);
        $this->db->order_by('id','asc');
        return $this->db->get('sodetailnotes')->result();
    }
    
    function insert($soid,$modelid,$notes){
        $this->db->insert('sodetailnotes',array(
            "soid"=>$soid,
            "modelid"=>$modelid,
            "notes"=>$notes,
        ));
    }
    
    function update($id,$soid,$modelid,$notes){
        $this->db->where('id',$id);
        $this->db->update('sodetailnotes',array(
            "soid"=>$soid,
            "modelid"=>$modelid,
            "notes"=>$notes,
        ));
    }
    
    function delete($id){
        $this->db->delete('sodetailnotes',array("id"=>$id));
    }
}
?>
