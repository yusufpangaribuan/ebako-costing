<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_comment
 *
 * @author admin
 */
class model_comment extends CI_Model{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function selectByReference($referenceid,$reference){
        $query = "select 
                  c.id,
                  c.referenceid,
                  c.reference,
                  c.employeeid,
                  e.name,
                  c.content,
                  c.datecomment 
                  from comment c join employee e 
                  on c.employeeid=e.id and c.referenceid=$referenceid and c.reference='$reference' order by c.id desc";
        //echo $query."<br/>";
        return $this->db->query($query)->result();
    }
    
    function post($referenceid,$reference,$employeeid,$content){
        $this->db->insert("comment",array("referenceid"=>$referenceid,
                                          "reference"=>$reference,
                                          "employeeid"=>$employeeid,
                                          "content"=>$content));
    }
    
    function getCount($id,$cat){
        $query = "select count(*) ct from comment where referenceid=$id and reference='$cat'";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }
    
    
    
}

?>
