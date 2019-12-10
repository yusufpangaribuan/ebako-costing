<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class vendor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_vendor');
        $this->load->model('model_user');
    }

    public function index() {
        //$data['vendor'] = $this->model_vendor->selectAll();        
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "vendor"));
        $data['vendor'] = $this;
        $this->load->view('vendor/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "vendor"));

        $query = "select * from vendor where true ";

        $name = $this->input->post('name');

        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();

        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['number'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;

        $query .= " order by id desc limit $limit offset $offset";

        $data['vendor'] = $this->db->query($query)->result();
        $data['offset'] = $offset;
        $this->load->view('vendor/search', $data);
    }

    function prints() {
        $name = $this->input->post('name');
        $data['vendor'] = $this->model_vendor->searchforprint($name);
        $this->load->model('model_company');
        $data['companyaddress'] = $this->model_company->getDetail();
        $this->load->view('vendor/print', $data);
    }

    public function add() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $data['vendornumber'] = $this->createVendorNumber();
        $this->load->view('vendor/add', $data);
    }

    public function save() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data = array(
            "vendornumber" => $this->input->post('vendornumber'),
            "name" => $this->input->post('name'),
            "curr" => $this->input->post('curr'),
            "curr2" => $this->input->post('curr2'),
            "curr3" => $this->input->post('curr3'),
            "contact" => $this->input->post('contact'),
            "phone" => $this->input->post('phone'),
            "fax" => $this->input->post('fax'),
            "email" => $this->input->post('email'),
            "address1" => $this->input->post('address1'),
            "address2" => $this->input->post('address2'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "zipcode" => $this->input->post('zipcode'),
            "country" => $this->input->post('country'),
            "service" => $this->input->post('service'),
            "taxnumber" => $this->input->post('taxnumber'),
            "startdate" => $this->input->post('startdate'),
            "enddate" => $this->input->post('enddate'),
            "startdate" => (empty($startdate) ? null : $startdate),
            "enddate" => (empty($enddate) ? null : $enddate)
        );

        if ($this->model_vendor->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $data['vendor'] = $this->model_vendor->selectById($id);
        $this->load->view('vendor/edit', $data);
    }

    public function update() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data = array(
            "vendornumber" => $this->input->post('vendornumber'),
            "name" => $this->input->post('name'),
            "curr" => $this->input->post('curr'),
            "curr2" => $this->input->post('curr2'),
            "curr3" => $this->input->post('curr3'),
            "contact" => $this->input->post('contact'),
            "phone" => $this->input->post('phone'),
            "fax" => $this->input->post('fax'),
            "email" => $this->input->post('email'),
            "address1" => $this->input->post('address1'),
            "address2" => $this->input->post('address2'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "zipcode" => $this->input->post('zipcode'),
            "country" => $this->input->post('country'),
            "service" => $this->input->post('service'),
            "taxnumber" => $this->input->post('taxnumber'),
            "startdate" => $this->input->post('startdate'),
            "enddate" => $this->input->post('enddate'),
            "startdate" => (empty($startdate) ? null : $startdate),
            "enddate" => (empty($enddate) ? null : $enddate)
        );
        if ($this->model_vendor->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    public function delete($id) {
        if ($this->model_vendor->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function createVendorNumber() {
        $lastnumber = $this->model_vendor->getLastNumber();
        $nextnumber = "";
        if ($lastnumber == "") {
            $nextnumber = "V1";
        } else {
            $length = strlen($lastnumber);
            $number = (int) substr($lastnumber, 1, ($length - 1));
            $nextnumber = "V" . ($number + 1);
        }
        return $nextnumber;
    }

}

?>
