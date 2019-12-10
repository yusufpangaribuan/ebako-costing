<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of returnproduction
 *
 * @author munte
 */
class returnproduction extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_returnproduction');
        $this->load->model('model_user');
    }

    function index() {
        $data['returnproduction'] = $this;
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "returnproduction"));
        $this->load->view('returnproduction/index', $data);
    }

    function search($offset) {
        $data['offset'] = $offset;

        $query = "
            with t as(
                    select 
                    returnproduction.*,
                    employee.name name_return_by,
                    department.name department_name,
                    item.partnumber item_code,
                    item.descriptions item_description,
                    unit.codes unit_code
                    from returnproduction
                    join employee on returnproduction.return_by=employee.id
                    join item on returnproduction.itemid=item.id
                    join unit on returnproduction.unitid=unit.id
                    left join department on returnproduction.departmentid=department.id
            ) select t.* from t where true
        ";

        $item_code_description = $this->input->post('item_code_description');

        if (!empty($item_code_description)) {
            $query .= " and (t.item_code ilike '%$item_code_description%' or t.item_description ilike '%$item_code_description%')";
        }

        $returnproduction_no = $this->input->post('returnproduction_no');
        if (!empty($returnproduction_no)) {
            $query .= " and t.returnproduction_no ilike '%$returnproduction_no%' ";
        }

        $return_by = $this->input->post('return_by');
        if (!empty($return_by)) {
            $query .= " and (t.name_return_by ilike '%$return_by%' or t.return_by='%$return_by%')";
        }

        $department_name = $this->input->post('department_name');
        if (!empty($department_name)) {
            $query .= " and (t.department_name ilike '%$department_name%')";
        }

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and t.itemid in (select itemid from stock where warehouseid=" . $this->session->userdata('optiongroup') . ")";
            }
        } else {
            $query .= " and t.return_by='" . $this->session->userdata('id') . "'";
        }
//        echo $query;
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
        $data['returnproduction'] = $this->db->query($query)->result();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "returnproduction"));
        $this->load->view('returnproduction/search', $data);
    }

    function add() {
        $this->load->model('model_customer');
        $data['customer'] = $this->model_customer->selectAll();
        $data['department'] = $this->db->query("select * from dept_division order by name asc")->result();
        $this->load->view('returnproduction/add', $data);
    }

    function save() {
        $data = array(
            "date" => $this->input->post('date'),
            "return_by" => $this->session->userdata('id'),
            "user_inserted" => $this->session->userdata('id'),
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "qty" => $this->input->post('qty'),
            "ots_qty" => $this->input->post('qty'),
            "departmentid" => $this->session->userdata('department'),
            "remark" => $this->input->post('remark')
        );

        if ($this->db->insert('returnproduction', $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $data['returnproduction'] = $this->model_returnproduction->select_by_id($id);
        $this->load->view('returnproduction/edit', $data);
    }

    function update($id) {

        $data = array(
            "date" => $this->input->post('date'),
            "return_by" => $this->session->userdata('id'),
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "qty" => $this->input->post('qty'),
            "ots_qty" => $this->input->post('qty'),
            "departmentid" => $this->session->userdata('department'),
            "remark" => $this->input->post('remark'),
            "user_updated" => $this->session->userdata('id'),
            "update_time" => "now()"
        );

        if ($this->db->update('returnproduction', $data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        if ($this->db->delete('returnproduction', array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function receive($id, $type) {
        $this->load->model('model_item');
        $data['returnproduction'] = $this->model_returnproduction->select_by_id($id);
        $data['type'] = $type;
        $this->load->view('returnproduction/receive', $data);
    }

    function do_receive() {
        $qty = (double) $this->input->post('qty');
        $receive_qty = (double) $this->input->post('receive_qty');
        $data = array(
            "type" => $this->input->post('type'),
            "returnproductionid" => $this->input->post('returnproductionid'),
            "date" => $this->input->post('date'),
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "qty" => $receive_qty,
            "warehouseid" => (int) $this->input->post('warehouseid'),
            "remark" => $this->input->post('remark'),
            "receive_by" => $this->session->userdata('id')
        );


        if ($receive_qty > $qty) {
            echo json_encode(array('msg' => 'Out of outstanding, Outstanding qty: ' . $qty));
        } else {
            if ($this->db->insert('returnproduction_receive', $data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete_receive($id) {
        if ($this->db->delete('returnproduction_receive', array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id, $st) {
        echo "Under Construction";
//        $data['st'] = $st;
//        $data['returnproduction'] = $this->model_returnproduction->select_by_id($id);
//        $data['returnproductionitem'] = $this->model_returnproduction->select_item_by_returnproduction_id($id);
//        $this->load->model('model_company');
//        $data['company'] = $this->model_company->getDetail();
//        if ($st == 1) {
//            $this->load->library("pdf");
//            $html = $this->load->view('returnproduction/print', $data, true);
//            $this->pdf->pdf_create($html, "file");
//        } else {
//            $this->load->view('returnproduction/print', $data);
//        }
    }

}
