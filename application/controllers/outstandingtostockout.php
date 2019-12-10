<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of outstandingtostockout
 *
 * @author user
 */
class outstandingtostockout extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function index() {
        $data['outstandingtostockout'] = $this;
        $this->load->view('outstandingtostockout/index', $data);
    }

    function search($offset) {
        $query = "
            select 
            mrdetail.*,
            item.partnumber item_code,
            item.descriptions item_description,
            mr.number mr_no,
            to_char(mr.date,'DD/MM/YY') mr_date,
            mr.requestby,
            employee.name employee_name_requested
            from 
            mrdetail 
            join item on mrdetail.itemid=item.id
            join mr on mrdetail.mrid=mr.id
            join employee on mr.requestby=employee.id
            where mrdetail.ots > 0 and mr.status=1
        ";

        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            $query .= " and mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . "::integer";
        }

        $mw_no = $this->input->post('mw_no');
        if (!empty($mw_no)) {
            $query .= " and mr.number ilike '%$mw_no' ";
        }

        $item_code_desc = $this->input->post('item_code_desc');
        if (!empty($item_code_desc)) {
            $query .= " and (item.partnumber ilike '%$item_code_desc%' or item.descriptions ilike '%$item_code_desc%') ";
        }

        $requestby = $this->input->post('requestby');
        if (!empty($requestby)) {
            $query .= " and (mr.requestby ilike '%$requestby%' or employee.name ilike '%$requestby%') ";
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $data['offset'] = $offset;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by mrdetail.id desc";
        $query .= " limit $limit offset $offset";
        $data['mritem'] = $this->db->query($query)->result();
        $this->load->view('outstandingtostockout/search', $data);
    }

    function print_list() {
        $query = "
            select 
            mrdetail.*,
            item.partnumber item_code,
            item.descriptions item_description,
            mr.number mr_no,
            to_char(mr.date,'DD/MM/YY') mr_date,
            mr.requestby,
            employee.name employee_name_requested
            from 
            mrdetail 
            join item on mrdetail.itemid=item.id
            join mr on mrdetail.mrid=mr.id
            join employee on mr.requestby=employee.id
            where mrdetail.ots > 0 and mr.status=1
        ";

        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            $query .= " and mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . "::integer";
        }

        $mw_no = $this->input->post('mw_no');
        if (!empty($mw_no)) {
            $query .= " and mr.number ilike '%$number' ";
        }

        $item_code_desc = $this->input->post('item_code_desc');
        if (!empty($item_code_desc)) {
            $query .= " and (item.partnumber ilike '%$item_code_desc%' or item.descriptions ilike '%$item_code_desc%') ";
        }

        $requestby = $this->input->post('requestby');
        if (!empty($requestby)) {
            $query .= " and (mr.requestby ilike '%$requestby%' or employee.name ilike '%$requestby%') ";
        }
        $query .= "  order by mrdetail.id desc";
        $data['mritem'] = $this->db->query($query)->result();
        $this->load->view('outstandingtostockout/print_list', $data);
    }

}
