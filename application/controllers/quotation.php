<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of quotation
 *
 * @author hp
 */
class quotation extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_so');
        $this->load->model('model_quotation');
        $this->load->model('model_user');
    }

    function create($rfqid) {
        $data['rfqid'] = $rfqid;
        $this->load->view('quotation/create', $data);
    }

    function save() {
        $rfqid = $this->input->post('rfqid');
        $quotationnumber = strtoupper($this->input->post('quotationnumber'));
        $quotationdate = $this->input->post('quotationdate');
        $quotationvalidity = $this->input->post('quotationvalidity');
        $this->model_quotation->save($rfqid, $quotationnumber, $quotationdate, $quotationvalidity);
    }

    function edit($rfqid) {
        $data['rfqid'] = $rfqid;
        $data['quotation'] = $this->model_quotation->selectById($rfqid);
        $this->load->view('quotation/edit', $data);
    }

    function update() {
        $this->save();
    }

}

?>
