<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_com
 *
 * @author munte
 */
class model_com extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        $query = "
            with t as(
                    select 
                            com.*,
                            customer.name customer_name,
                            employee.name name_receive_by
                    from com
                    join customer on com.customerid=customer.id
                    left join employee on com.receive_by=employee.id
            ) select t.* from t where t.id=$id
        ";
        return $this->db->query($query)->row();
    }

    function select_item_by_com_id($comid) {
        $query = "
            select 
            comitem.*,
            item.partnumber item_code,
            item.descriptions item_description,
            unit.codes unit_code
            from comitem 
            join item on comitem.itemid=item.id
            join unit on comitem.unitid=unit.id 
            where comitem.comid=$comid
        ";
        return $this->db->query($query)->result();
    }

    function get_last_id() {
        return $this->db->query("select id from com order by id desc limit 1")->row()->id;
    }

}
