<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_unit
 *
 * @author admin
 */
class model_unit extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        return $this->db->query("select * from unit order by names asc")->result();
    }

    function getNumRows($code, $name, $remark) {
        $query = "select * from unit where true ";
        if ($name != "") {
            $query .= " and names ilike '%" . $name . "%' ";
        }if ($code != "") {
            $query .= " and codes ilike '%" . $code . "%' ";
        }if ($remark != "") {
            $query .= " and remark ilike '%" . $remark . "%' ";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($code, $name, $remark, $limit, $offset) {
        $query = "select * from unit where true ";
        if ($name != "") {
            $query .= " and names ilike '%" . $name . "%' ";
        }if ($code != "") {
            $query .= " and codes ilike '%" . $code . "%' ";
        }if ($remark != "") {
            $query .= " and remark ilike '%" . $remark . "%' ";
        }
        $query .= " order by id asc limit $limit offset $offset";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function searchforprint($code, $name, $remark) {
        $query = "select * from unit where true ";
        if ($name != "") {
            $query .= " and names ilike '%" . $names . "%' ";
        }if ($code != "") {
            $query .= " and codes ilike '%" . $code . "%' ";
        }if ($remark != "") {
            $query .= " and remark ilike '%" . $remark . "%' ";
        }
        $query .= " order by id desc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "select * from unit where id=" . $id;
        return $this->db->query($query)->result();
    }

    function insert($codes, $names, $remark) {
        $query = "insert into unit(names,codes,remark) values ('$names','$codes','$remark')";
        return $this->db->query($query);
    }

    function update($id, $codes, $names, $remark) {
        $query = "update unit set names='$names',codes='$codes',remark='$remark' where id=" . $id;
        return $this->db->query($query);
    }

    function delete($id) {
        return $this->db->query("delete from unit where id=$id");
    }

    function getCodeById($id) {
        $query = "select codes from unit where id=$id";
        $dt = $this->db->query($query)->row();
        return (empty($dt) ? "" : $dt->codes);
    }

    function selectAllUnitByItemId($itemid) {
        $query = "select unitfrom id,unit.codes from stock 
                  join unit on stock.unitfrom=unit.id and itemid=$itemid";
        return $this->db->query($query)->result();
    }

}

?>
