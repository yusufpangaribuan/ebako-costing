<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of com
 *
 * @author munte
 */
class com extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_com');
        $this->load->model('model_user');
    }

    function index() {
        $data['com'] = $this;
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "com"));
        $this->load->view('com/index', $data);
    }

    function search($offset) {
        $data['offset'] = $offset;

        $query = "
            with t as(
                    select 
                            com.*,
                            customer.name customer_name,
                            employee.name name_receive_by
                    from com
                    join customer on com.customerid=customer.id
                    left join employee on com.receive_by=employee.id
            ) select t.* from t where true
        ";

        $item_code_description = $this->input->post('item_code_description');

        if (!empty($item_code_description)) {
            $query .= " and t.id in ("
                    . "select comid from comitem join item on comitem.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }

        $com_no = $this->input->post('com_no');
        if (!empty($com_no)) {
            $query .= " and t.com_no ilike '%$com_no%' ";
        }

        $customer_name = $this->input->post('customer_name');
        if (!empty($customer_name)) {
            $query .= " and t.customer_name ilike '%$customer_name%' ";
        }

        $awb = $this->input->post('awb');
        if (!empty($awb)) {
            $query .= " and t.awb ilike '%$awb%' ";
        }

        $date_from = $this->input->post('start_date');
        $date_to = $this->input->post('end_date');
        if (!empty($date_from) && !empty($date_to)) {
            $query .= " and t.date between '" . $date_from . "' and '" . $date_to . "' ";
        }if (!empty($date_from) && empty($date_to)) {
            $query .= " and t.date = '" . $date_from . "' ";
        }if (empty($date_from) && !empty($date_to)) {
            $query .= " and t.date = '" . $date_to . "' ";
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
        $query .= "  order by t.id desc limit $limit offset $offset";
//        echo $query;
        $data['com'] = $this->db->query($query)->result();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "com"));
        $this->load->view('com/search', $data);
    }

    function add() {
        $this->load->model('model_customer');
        $data['customer'] = $this->model_customer->selectAll();
        $this->load->view('com/add', $data);
    }

    function save() {
        $data = array(
            "date" => $this->input->post('date'),
            "customerid" => $this->input->post('customerid'),
            "sent_by" => $this->input->post('sent_by'),
            "acknowledge_by" => $this->input->post('acknowledge_by'),
            "acknowledge_by" => $this->input->post('acknowledge_by'),
            "receive_by" => $this->session->userdata('id'),
            "awb" => $this->input->post('awb'),
            "via" => $this->input->post('via')
        );

        $itemid = $this->input->post('itemid');
        $qty = $this->input->post('qty');
        $unitid = $this->input->post('unitid');
        $remark = $this->input->post('reason');

        $error_message = "";
        $this->db->trans_start();
        if ($this->db->insert('com', $data)) {
            $id = $this->model_com->get_last_id();
            $data_item = array();
            for ($i = 0; $i < count($itemid); $i++) {
                $data_item[] = array(
                    "comid" => $id,
                    "itemid" => $itemid[$i],
                    "unitid" => $unitid[$i],
                    "qty" => $qty[$i],
                    "remark" => $remark[$i],
                    "warehouseid" => $this->session->userdata('optiongroup')
                );
            }
            if (!$this->db->insert_batch('comitem', $data_item)) {
                $error_message = $this->db->_error_message();
            }
        } else {
            $error_message = $this->db->_error_message();
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

    function edit($id) {
        $this->load->model('model_customer');
        $this->load->model('model_unit');
        $data['customer'] = $this->model_customer->selectAll();
        $data['com'] = $this->model_com->select_by_id($id);
        $data['comitem'] = $this->model_com->select_item_by_com_id($id);
        $this->load->view('com/edit', $data);
    }

    function update($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "customerid" => $this->input->post('customerid'),
            "sent_by" => $this->input->post('sent_by'),
            "acknowledge_by" => $this->input->post('acknowledge_by'),
            "acknowledge_by" => $this->input->post('acknowledge_by'),
            "awb" => $this->input->post('awb'),
            "via" => $this->input->post('via')
        );

        $comitemid = $this->input->post('mrdetailid');
        $itemid = $this->input->post('itemid');
        $qty = $this->input->post('qty');
        $unitid = $this->input->post('unitid');
        $remark = $this->input->post('reason');

        $error_message = "";
        $this->db->trans_start();
        if ($this->db->update('com', $data, array("id" => $id))) {
            for ($i = 0; $i < count($itemid); $i++) {
                $data_item = array(
                    "comid" => $id,
                    "itemid" => $itemid[$i],
                    "unitid" => $unitid[$i],
                    "qty" => $qty[$i],
                    "remark" => $remark[$i]
                );
                if ($comitemid[$i] == 0) {
                    $data_item["comid"] = $id;
                    $data["warehouseid"] = $this->session->userdata('optiongroup');
                    if (!$this->db->insert('comitem', $data_item)) {
                        $error_message = $this->db->_error_message();
                    }
                } else {
                    if (!$this->db->update('comitem', $data_item, array("id" => $comitemid[$i]))) {
                        $error_message = $this->db->_error_message();
                    }
                }
            }
        } else {
            $error_message = $this->db->_error_message();
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

    function delete($id) {
        if ($this->db->delete('com', array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function additem($counter) {
        $data['flag'] = $counter;
        $this->load->view('com/additem', $data);
    }

    function item_delete() {
        if ($this->db->delete('comitem', array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id, $st) {
        $data['st'] = $st;
        $data['com'] = $this->model_com->select_by_id($id);
        $data['comitem'] = $this->model_com->select_item_by_com_id($id);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        if ($st == 1) {
            $this->load->library("pdf");
            $html = $this->load->view('com/print', $data, true);
            $this->pdf->pdf_create($html, "file");
        } else {
            $this->load->view('com/print', $data);
        }
    }

}
