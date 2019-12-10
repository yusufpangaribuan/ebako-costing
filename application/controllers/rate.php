<?php

class rate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_rate');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rate"));
        $data['rate'] = $this->model_rate->selectAll();
        $this->load->view('rate/view', $data);
    }

    function search($offset) {
    	$data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rate"));
    	$currency = $this->input->post('currency');
    	$data['num_rows'] = $this->model_rate->getNumRows($currency);
    	$limit = $this->config->item('limit');
    	$data['offset'] = $offset + 1;
    	$data['num_page'] = (int) ceil($data['num_rows'] / $limit);
    	$data['first'] = 0;
    	$data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
    	$data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
    	$data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
    	$data['page'] = (int) ceil($offset / $limit) + 1;
    	$data['rate'] = $this->model_rate->search($currency, $limit, $offset);
    	$this->load->view('rate/search', $data);
    }    
    
    function add() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $this->load->view('rate/add', $data);
    }

    function save() {
        $currency_from = $this->input->post('currency_from');
        $currency_to = $this->input->post('currency_to');
        $value = $this->input->post('value');
        $this->model_rate->insert($currency_from, $currency_to, $value);
    }

    function edit($id) {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAll();
        $data['rate'] = $this->model_rate->selectById($id);
        $this->load->view('rate/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $currency_from = $this->input->post('currency_from');
        $currency_to = $this->input->post('currency_to');
        $value = $this->input->post('value');
        $this->model_rate->update($id, $currency_from, $currency_to, $value);
    }

    function delete($id) {
        $this->model_rate->delete($id);
    }

}

?>
