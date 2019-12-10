<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_customer');
        $this->load->model('model_user');
    }

    public function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "customer"));
        $data['customer'] = $this;
        $this->load->view('customer/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "customer"));
        $name = $this->input->post('name');
        $data['num_rows'] = $this->model_customer->getNumRows($name);
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['number'] = $offset + 1;
        $data['offset'] = $offset;
        $data['customer'] = $this->model_customer->search($name, $limit, $offset);
        $this->load->view('customer/search', $data);
    }

    public function add() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $data['customernumber'] = $this->createCustomerNumber();
        $this->load->view('customer/add', $data);
    }

    public function save() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data = array(
            "customernumber" => $this->input->post('customernumber'),
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

        if ($this->model_customer->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $data['customer'] = $this->model_customer->selectById($id);
        $this->load->view('customer/edit', $data);
    }

    function update() {

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data = array(
            "customernumber" => $this->input->post('customernumber'),
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

        if ($this->model_customer->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    public function delete($id) {
        if ($this->model_customer->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function createCustomerNumber() {
        $lastnumber = $this->model_customer->getLastNumber();
        $nextnumber = "";
        if ($lastnumber == "") {
            $nextnumber = "C1";
        } else {
            $length = strlen($lastnumber);
            $number = (int) substr($lastnumber, 1, ($length - 1));
            $nextnumber = "C" . ($number + 1);
        }
        return $nextnumber;
    }

    function getaddress($id) {
        echo $this->model_customer->getAddress($id);
    }

    function loadShipTo($id) {
        $customer = $this->model_customer->selectAll();
        echo "<option value='0'>--Ship To--</option>";
        foreach ($customer as $customer) {
            if ($customer->id == $id) {
                echo "<option value='" . $customer->id . "' selected>" . $customer->name . "</option>";
            } else {
                echo "<option value='" . $customer->id . "'>" . $customer->name . "</option>";
            }
        }
    }

    function prints() {
        $name = $this->input->post('name');
        $data['customer'] = $this->model_customer->searchforprint($name);
        $this->load->model('model_company');
        $data['companyaddress'] = $this->model_company->getAddressDetail();
        $this->load->view('customer/print', $data);
    }

    function getAddresById($id) {
        echo $this->model_customer->getAddressById($id);
    }

}

?>
