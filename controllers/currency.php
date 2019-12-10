<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class currency extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_currency');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "currency"));
        $data['currency'] = $this;
        $this->load->view('currency/index', $data);
    }

    function search($offset) {
        $data['offset'] = $offset;

        $query = "
                    select 
                    currency.*,
                    employee.name user_inserted_name                    
                    from currency 
                    left join employee on currency.user_inserted=employee.id
                    where true
        ";

        $code_or_description = $this->input->post('code_or_description');
        if (!empty($code_or_description)) {
            $query .= " and (currency.curr ilike '%$code_or_description%' or currency.desc ilike '%$code_or_description%') ";
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
        $query .= "  order by currency.insert_time desc limit $limit offset $offset";
//        echo $query;
        $data['currency'] = $this->db->query($query)->result();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "currency"));
        $this->load->view('currency/search', $data);
    }

    function add() {
        $this->load->view('currency/add');
    }

    function save() {
        $data = array(
            "curr" => $this->input->post('curr'),
            "desc" => $this->input->post('desc'),
            "user_inserted" => $this->session->userdata('id')
        );
        if ($this->model_currency->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $data['currency'] = $this->model_currency->select_by_id($id);
        $this->load->view('currency/edit', $data);
    }

    function update() {

        $data = array(
            "curr" => $this->input->post('curr'),
            "desc" => $this->input->post('desc'),
            "user_updated" => $this->session->userdata('id'),
            "update_time" => "now()"
        );

        if ($this->model_currency->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        if ($this->model_currency->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
