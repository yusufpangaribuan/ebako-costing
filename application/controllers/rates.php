<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class rates extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_rates');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rates"));
        $data['rates'] = $this;
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $this->load->view('rates/index', $data);
    }

    function search($offset) {
        $data['offset'] = $offset;

        $query = "
            with t as(
                    select 
                    rates.*,
                    employee.name user_inserted_name,
                    emp.name user_updated_name
                    from rates 
                    left join employee on rates.user_inserted=employee.id
                    left join employee emp on rates.user_updated=emp.id
            ) select t.* from t where true
        ";

        $evidence_number = $this->input->post('evidence_number');
        if (!empty($evidence_number)) {
            $query .= " and t.evidence_number ilike '%$evidence_number%'";
        }

        $currency = $this->input->post('currency');
        if (!empty($currency)) {
            $query .= " and t.currency='$currency'";
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
        $data['rates'] = $this->db->query($query)->result();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rates"));
        $this->load->view('rates/search', $data);
    }

    function add() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $this->load->view('rates/add', $data);
    }

    function save() {
        $data = array(
            "date" => $this->input->post('date'),
            "currency" => $this->input->post('currency'),
            "exchange_rate" => $this->input->post('exchange_rate'),
            "user_inserted" => $this->session->userdata('id')
        );
        if ($this->model_rates->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $data['rates'] = $this->model_rates->select_by_id($id);
        $this->load->view('rates/edit', $data);
    }

    function update() {

        $data = array(
            "date" => $this->input->post('date'),
            "currency" => $this->input->post('currency'),
            "exchange_rate" => $this->input->post('exchange_rate'),
            "user_updated" => $this->session->userdata('id'),
            "update_time" => "now()"
        );

        if ($this->model_rates->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        if ($this->model_rates->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
