<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stockout
 *
 * @author hp
 */
class model_stockout extends CI_Model {

    //put your code here

    public function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function insert($data) {
        return $this->db->insert('stockout', $data);
    }

    function get_last_id() {
        $dt = $this->db->query("select id from stockout order by id desc limit 1")->row();
        return $dt->id;
    }

    function search($number, $date_start, $date_end, $refno, $departmentid, $outby, $receiveby, $limit, $ofset) {
        $query = "select stockout.*,department.name departmentname from stockout
                  join department on stockout.departmentid=department.id where true ";

        if (!empty($number)) {
            $query .= " and stockout.number ilike '%$number%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and stockout.date between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and stockout.date = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and stockout.date = '$date_start' ";
        }if (!empty($refno)) {
            $query .= " and stockout.refno ilike '%$refno%' ";
        }if ($departmentid != 0) {
            $query .= " and stockout.departmentid = $departmentid ";
        }if (!empty($outby)) {
            $query .= " and stockout.outby ilike '%$outby%' ";
        }if (!empty($receiveby)) {
            $query .= " and stockout.receiveby ilike '%$receiveby%' ";
        }

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != "") {
                $query .= " and warehouseid=" . $this->session->userdata('optiongroup');
            }
        }
        $query .= " order by stockout.id desc limit $limit offset $ofset";
        return $this->db->query($query)->result();
    }

    function getNumRows($number, $date_start, $date_end, $refno, $departmentid, $outby, $receiveby) {
        $query = "select stockout.*,department.name departmentname from stockout
                  join department on stockout.departmentid=department.id where true ";

        if (!empty($number)) {
            $query .= " and stockout.number ilike '%$number%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and stockout.date between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and stockout.date = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and stockout.date = '$date_start' ";
        }if (!empty($refno)) {
            $query .= " and stockout.refno ilike '%$refno%' ";
        }if ($departmentid != 0) {
            $query .= " and stockout.departmentid = $departmentid ";
        }if (!empty($outby)) {
            $query .= " and stockout.outby ilike '%$outby%' ";
        }if (!empty($receiveby)) {
            $query .= " and stockout.receiveby ilike '%$receiveby%' ";
        }
        //echo $query;exit;
        return $this->db->query($query)->num_rows();
    }

    function searchforprint($number, $date_start, $date_end, $refno, $departmentid, $outby, $receiveby) {
        $query = "select stockout.*,department.name departmentname from stockout
                    join department on stockout.departmentid=department.id where true ";

        if (!empty($number)) {
            $query .= " and stockout.number ilike '%$number%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and stockout.dates between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and stockout.dates = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and stockout.dates = '$date_start' ";
        }if (!empty($refno)) {
            $query .= " and stockout.refno ilike '%$refno%' ";
        }if ($departmentid != 0) {
            $query .= " and stockout.departmentid = $departmentid ";
        }if (!empty($outby)) {
            $query .= " and stockout.outby ilike '%$outby%' ";
        }if (!empty($receiveby)) {
            $query .= " and stockout.receiveby ilike '%$receiveby%' ";
        }
        return $this->db->query($query)->result();
    }

    function savebymrchoose($mrid, $date, $refno, $outby, $receiveby, $departmentid, $dept_divisionid) {
        $this->db->insert('stockout', array(
            "number" => $this->getNextNumber(),
            "mrid" => $mrid,
            "date" => $date,
            "refno" => $refno,
            "outby" => $outby,
            "receiveby" => $receiveby,
            "departmentid" => $departmentid,
            "dept_divisionid" => $dept_divisionid,
            "warehouseid" => $this->session->userdata('optiongroup')
        ));
        $dt = $this->db->query("select id from stockout order by id desc limit 1")->row();
        return $dt->id;
    }

    function update($id, $mrid, $date, $refno, $outby, $receiveby, $departmentid, $dept_divisionid) {
        $this->db->update('stockout', array(
            "number" => $this->getNextNumber(),
            "mrid" => $mrid,
            "date" => $date,
            "refno" => $refno,
            "outby" => $outby,
            "receiveby" => $receiveby,
            "departmentid" => $departmentid,
            "dept_divisionid" => $dept_divisionid
                ), "id = '" . $id . "'");
    }

    function getNextNumber() {
        $dt = $this->db->query("select stockout_get_number() ct")->row();
        return $dt->ct;
    }

    function selectById($id) {
        $query = "select stockout.* from stockout where stockout.id=$id";
        //echo $query;
        return $this->db->query($query)->row();
    }

    function delete($id) {
        return $this->db->delete('stockout', array("id" => $id));
    }

    function receive($id) {
        //echo "select stockout_received($id)";
        return $this->db->query("select stockout_received($id)");
    }

}

?>
