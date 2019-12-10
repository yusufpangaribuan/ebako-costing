<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialreceive
 *
 * @author munte
 */
class materialreceive extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_stockoutdetail');
    }

    function index() {
        $data['materialreceive'] = $this;
        $this->load->view('materialreceive/index', $data);
    }

    function search($offset) {

        $query = "
            select 
            stockout.*,
            mr.number mr_number,
            mr.date mr_date,
            to_char(mr.date,'DD/MM/YYYY') mr_date_format,
            mr.requestby,
            employee.name mr_employee_request_name,
            mr.warehouse_request_id,
            warehouse.name warehouse_stock_out
            from stockout
            join mr on stockout.mrid=mr.id
            left join employee on mr.requestby=employee.id
            join warehouse on stockout.warehouseid=warehouse.id
            where true 
        ";

        if ($this->session->userdata('id') != "admin") {
            $query .= "and mr.requestby='" . $this->session->userdata('id') . "'";
        }
        //echo $query;

        $stockout_no = $this->input->post('stockout_no');
        if (!empty($stockout_no)) {
            $query .= " and stockout.number ilike '%$stockout_no' ";
        }
        $mw_no = $this->input->post('mw_no');
        if (!empty($mw_no)) {
            $query .= " and mr.number ilike '%$mw_no' ";
        }



        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and stockout.id in ("
                    . "select stockoutid from stockoutdetail join item on stockoutdetail.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
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
        $query .= "order by stockout.receivetime desc,stockout.id desc limit $limit offset $offset";
//        echo $query;
        $data['materialreceive'] = $this->db->query($query)->result();
        $this->load->view('materialreceive/search', $data);
    }

}
