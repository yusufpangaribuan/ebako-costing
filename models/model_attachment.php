<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_attachment
 *
 * @author hp
 */
class model_attachment extends CI_Model{

    //put your code here
    public function __construct() {
        $this->load->database();
    }

    function insert_file($id,$reference,$filename, $title) {
        $data = array(
            'filename' => $filename,
            'title' => $title,
            'referenceid'=>$id,
            'reference'=>$reference
        );
        return $this->db->insert('attachment', $data);
        //return $this->db->insert_id();
    }
    
    function selectByReference($idref,$reference){
        $this->db->where('referenceid',$idref);
        $this->db->where('reference',$reference);
        $this->db->from('attachment');
        $this->db->order_by('id','desc');
        return $this->db->get()->result();
    }
    
    function getfiles(){
        return $this->db->get('attachment')->result();
    }
    
    function delete($id){
        return $this->db->delete('attachment',array("id"=>$id));
    }
    
    function getCount($referenceid,$reference){
        $query = "select count(*) ct from attachment where referenceid=$referenceid and reference='$reference'";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }

}

?>
