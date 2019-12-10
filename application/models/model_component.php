<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_component
 *
 * @author hp
 */
class model_component extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function selecAll() {
        $query = "select 
                    component.*,
                    (select names from groups where id=(select groupsid from item where id=component.itemid)) groupsname,
                    (select name from wood where id=(select woodid from item where id=component.itemid)) woodname
                    from component
                    order by component.id desc";
        return $this->db->query($query)->result();
    }

    function search2() {
        $query = "select 
                    component.*,
                    item.descriptions itemdescription,
                    item.groupsid,
                    case when groupsid = 3 then 
                            (select item.descriptions)
                    else
                            (select names from groups where id=item.groupsid)
                    end woodname
                    from component join item on component.itemid=item.id order by component.id desc ";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function search($code, $description, $type, $limit, $offset) {
        $query = "select 
                    component.*,
                    item.descriptions itemdescription,
                    item.groupsid,
                    case when groupsid = 3 then (select item.descriptions)
                    when groupsid = 7 then (select ' '::character varying)
                    else (select names from groups where id=item.groupsid)
                    end woodname
                    from component left join item on component.itemid=item.id 
                    where true ";
        if (!empty($code)) {
            $query .= " and component.partnumber ilike '%$code%' ";
        }if (!empty($description)) {
            $query .= " and component.description ilike '%$description%' ";
        }if ($type != '0') {
            $query .= " and item.groupsid=$type ";
        }
        $query .= " order by component.id desc limit $limit offset $offset ";
        return $this->db->query($query)->result();
    }

    function getNumRows($code, $description, $type) {
        $query = "select 
                    component.*,
                    item.descriptions itemdescription,
                    item.groupsid,
                    case when groupsid = 3 then 
                            (select item.descriptions)
                    else
                            (select names from groups where id=item.groupsid)
                    end woodname
                    from component join item on component.itemid=item.id";

        if (!empty($code)) {
            $query .= " and component.partnumber ilike '%$code%' ";
        }if (!empty($description)) {
            $query .= " and component.description ilike '%$description%' ";
        }if ($type != '0') {
            $query .= " and item.groupsid=$type ";
        }
        return $this->db->query($query)->num_rows();
    }

    function searchfordialog($code, $description) {
        $query = "select 
                    component.*,
                    item.descriptions itemdescription,
                    item.groupsid,
                    case when groupsid = 3 then 
                            (select item.descriptions)
                    else
                            (select names from groups where id=item.groupsid)
                    end woodname
                    from component join item on component.itemid=item.id";

        if (!empty($code)) {
            $query .= " and component.partnumber ilike '%$code%' ";
        }if (!empty($description)) {
            $query .= " and component.description ilike '%$description%' ";
        }
        $query .= " order by component.id desc";
        return $this->db->query($query)->result();
    }

    function selectWoodId($componentid) {
        $query = "select woodid from component where id=$componentid";
        $dt = $this->db->query($query)->row();
        return (empty($dt) ? 0 : $dt->woodid);
    }

    function selectById($id) {
        $query = "select 
                    component.*,
                    item.descriptions itemdescription,
                    item.groupsid,
                    case when groupsid = 3 then 
                            (select item.descriptions)
                    else
                            (select names from groups where id=item.groupsid)
                    end woodname
                    from component join item on component.itemid=item.id and component.id=$id";
        return $this->db->query($query)->row();
    }

    function insert($data) {
        return $this->db->insert('component', $data);
    }

    function update($data, $where) {
        return $this->db->update('component', $data, $where);
    }

    function delete($id) {
        $this->db->delete('component', array('id' => $id));
    }

    function insertitem($componentid, $itemid, $unitid, $qty) {
        return $this->db->insert('componentitem', array(
                    "itemid" => $itemid,
                    "componentid" => $componentid,
                    "unitid" => $unitid,
                    "qty" => $qty
                ));
    }

    function selectMaterial($componentid) {
        $query = "select ci.*,i.partnumber,i.descriptions,i.names,u.names unitname from componentitem ci join item i
                on ci.itemid=i.id join unit u on ci.unitid=u.id and ci.componentid=$componentid";
        return $this->db->query($query)->result();
    }

    function getNameById($id) {
        $query = "select description from component where id=$id";
        $dt = $this->db->query($query)->row();
        return $dt->description;
    }

    function selectExcep($componentid) {
        $query = "select * from component where id <> $componentid";
        return $this->db->query($query)->result();
    }

    function getDescriptionsById($id) {
        $query = "select description from component where id=$id";
        $dt = $this->db->query($query)->row();
        return ($dt->description != "") ? $dt->description : "";
    }

    function searchComponent($id, $code, $name) {
        $query = "select * from component where id != $id";
        if (!empty($code)) {
            $query .= " and partnumber ilike '%" . $code . "%'";
        }if (!empty($name)) {
            $query .= " and description ilike '%" . $name . "%'";
        }
        return $this->db->query($query)->result();
    }

    function getUnitIdById($id) {
        $query = "select unitid from component where id=$id";
        $dt = $this->db->query($query)->row();
        return (empty($dt) ? 0 : $dt->unitid);
    }

    function deleteItem($id) {
        $this->db->where('id', $id);
        return $this->db->delete('componentitem');
    }

    function selectDescriptionComponent($descriptio) {
        $query = "select distinct description from component";
        if ($descriptio != "") {
            $query .= " where description ilike '%$descriptio%' ";
        }
        return $this->db->query($query)->result();
    }

}

?>
