<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_gr extends CI_Model {

    function __construct() {
        $this->load->database();
    }

    function search($grnumber, $date_start, $date_end, $ponumber, $vendorid, $letternumber, $receiveby, $limit, $offset) {
        $query = "
            select 
            gr.id,
            gr.number grnumber,
            gr.date grdate,
            gr.letternumber,
            gr.receivedby,
            gr.poid,
            gr.do_date,
            gr.receivedate,
            gr.printed,
            gr.in_time,
            employee.name name_received,
            vendor.name vendorname,
            gr_is_match_date_gr_and_po(gr.id) ambigues_date_grpo
            from gr 
            left join vendor on gr.vendorid=vendor.id 
            left join employee on gr.receivedby=employee.id
            where true
       ";
        if (!empty($grnumber)) {
            $query .= " and gr.number ilike '%$grnumber%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date between '$date_start' and '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and gr.date = '$date_start' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date = '$date_end' ";
        }if (!empty($ponumber)) {
            $query .= " and gr.id in (select grid from gritem "
                    . "               join pritem on gritem.poitemid=pritem.id "
                    . "               join po on pritem.poid=po.id"
                    . "               where po.ponumber ilike '%$ponumber%')";
        }if ($vendorid != 0) {
            $query .= " and vendor.id = $vendorid ";
        }if (!empty($letternumber)) {
            $query .= " and gr.letternumber ilike '%$letternumber%' ";
        }

        /* if ($this->session->userdata('optiongroup') != "" && $this->session->userdata('department') == 10) {
          $query .= " and gr.receivedby ilike '%" . $this->session->userdata('id') . "%'";
          } */

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and gr.id in(
                                    select grid from gritem join pritem on gritem.poitemid=pritem.id
                                    join item on pritem.itemid=item.id where true 
                                    and (item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%'))";
        }
        $query .= " order by gr.id desc limit $limit offset $offset";
//        echo $query;
        return $this->db->query($query)->result();
    }

    function searchforprint($grnumber, $date_start, $date_end, $ponumber, $vendorid, $letternumber, $receiveby) {
        $query = "select 
            gr.id,
            gr.number grnumber,
            gr.date grdate,
            gr.letternumber,
            gr.receivedby,
            gr.poid,
            po.ponumber,
            po.dates podate,
            vendor.name vendorname
            from gr join po on gr.poid=po.id join
            vendor on po.vendorid=vendor.id where true ";
        if (!empty($grnumber)) {
            $query .= " and gr.number ilike '%$grnumber%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date between '$date_start' and '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and gr.date = '$date_start' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date = '$date_end' ";
        }if (!empty($ponumber)) {
            $query .= " and po.ponumber ilike '%$ponumber%' ";
        }if ($vendorid != 0) {
            $query .= " and vendor.id = $vendorid ";
        }if (!empty($letternumber)) {
            $query .= " and gr.letternumber ilike '%$letternumber%' ";
        }if ($this->session->userdata('optiongroup') != "" && $this->session->userdata('department') == 10) {
            $query .= " and gr.receivedby ilike '%" . $this->session->userdata('id') . "%'";
        }
        $query .= " order by gr.id desc ";
        return $this->db->query($query)->result();
    }

    function getNumRows($grnumber, $date_start, $date_end, $ponumber, $vendorid, $letternumber, $receiveby) {
        $query = "
            select 
            gr.id,
            gr.number grnumber,
            gr.date grdate,
            gr.letternumber,
            gr.receivedby,
            gr.poid,
            gr.do_date,
            gr.receivedate,
            employee.name name_received,
            vendor.name vendorname,
            gr_is_match_date_gr_and_po(gr.id) ambigues_date_grpo
            from gr 
            left join vendor on gr.vendorid=vendor.id 
            left join employee on gr.receivedby=employee.id
            where true
       ";
        if (!empty($grnumber)) {
            $query .= " and gr.number ilike '%$grnumber%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date between '$date_start' and '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and gr.date = '$date_start' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date = '$date_end' ";
        }if (!empty($ponumber)) {
            $query .= " and gr.id in (select grid from gritem "
                    . "               join pritem on gritem.poitemid=pritem.id "
                    . "               join po on pritem.poid=po.id"
                    . "               where po.ponumber ilike '%$ponumber%')";
        }if ($vendorid != 0) {
            $query .= " and vendor.id = $vendorid ";
        }if (!empty($letternumber)) {
            $query .= " and gr.letternumber ilike '%$letternumber%' ";
        }

        /* if ($this->session->userdata('optiongroup') != "" && $this->session->userdata('department') == 10) {
          $query .= " and gr.receivedby ilike '%" . $this->session->userdata('id') . "%'";
          } */

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and gr.id in(
                                    select grid from gritem join pritem on gritem.poitemid=pritem.id
                                    join item on pritem.itemid=item.id where true 
                                    and (item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%'))";
        }

        return $this->db->query($query)->num_rows();
    }

    function insert($poid, $letternumber, $receivedate, $receivedby) {
        $do_date = $this->input->post('do_date');
        $this->db->insert('gr', array(
            "poid" => $poid,
            "letternumber" => $letternumber,
            "receivedate" => $receivedate,
            "receivedby" => $receivedby,
            "do_date" => (empty($do_date) ? null : $do_date),
            "vendorid" => $this->input->post('vendorid')
        ));
        $dt = $this->db->query("select id from gr order by id desc limit 1")->row();
        return $dt->id;
    }

    function get_last_id() {
        $dt = $this->db->query("select id from gr order by id desc limit 1")->row();
        return $dt->id;
    }

    function update($id, $letternumber, $receivedate, $receivedby) {
        $this->db->where('id', $id);
        return $this->db->update('gr', array(
                    "letternumber" => $letternumber,
                    "receivedate" => $receivedate
                        /* "receivedby" => $receivedby, */
        ));
    }

    function selectById($id) {
        $query = "
            select 
            gr.id,
            gr.number grnumber,
            gr.date grdate,
            gr.letternumber,
            gr.receivedby,
            gr.poid,
            gr.do_date,
            gr.receivedate,
            employee.name name_received,
            vendor.name vendorname
            from gr 
            left join vendor on gr.vendorid=vendor.id 
            left join employee on gr.receivedby=employee.id
            where gr.id=$id";
        return $this->db->query($query)->row();
    }

    function delete($id) {
        $this->db->delete('gr', array("id" => $id));
    }

    function setPoStatus($poid) {
        return $this->db->query("select gr_set_po_status($poid)");
    }

}

?>
