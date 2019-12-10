<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pricecomp
 *
 * @author hp
 */
class pricecomp extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        }
        $this->load->model('model_pricecomp');
        $this->load->model('model_user');
    }

    function view($prid) {
        $this->load->model('model_pritem');
        $this->load->model('model_vendor');
        $this->load->model('model_currency');
        $data['vendor'] = $this->model_vendor->select_all();
        $data['currency'] = $this->model_currency->selectAll();
        $data['pritem'] = $this->model_pritem->selectByPrId($prid);
        $this->load->view('pricecomp/view', $data);
    }

    function prints($prid) {
        $this->load->model('model_item');
        $this->load->model('model_pritem');
        $this->load->model('model_vendor');
        $this->load->model('model_currency');
        $this->load->model('model_pr');
        $data['prid'] = $prid;
        $data['vendor'] = $this->model_vendor->selectAll();
        $data['currency'] = $this->model_currency->selectAll();
        $data['pritem'] = $this->model_pritem->selectByPrId($prid);
        $data['pricetotal'] = $this->model_pricecomp->selectTotalPriceByPrId($prid);
        $data['pr'] = $this->model_pr->selectById($prid);
        echo "<a href=" . base_url() . 'index.php/pricecomp/pdf/' . $prid . " target='_blank'>pdf</a><br/>";
        $this->load->view('pricecomp/print', $data);
    }

    function pdf($prid) {
        $this->load->model('model_item');
        $this->load->model('model_pritem');
        $this->load->model('model_vendor');
        $this->load->model('model_currency');
        $this->load->model('model_pr');
        $data['prid'] = $prid;
        $data['vendor'] = $this->model_vendor->selectAll();
        $data['currency'] = $this->model_currency->selectAll();
        $data['pritem'] = $this->model_pritem->selectByPrId($prid);
        $data['pricetotal'] = $this->model_pricecomp->selectTotalPriceByPrId($prid);
        $data['pr'] = $this->model_pr->selectById($prid);
        $this->load->library("pdf");
        $html = $this->load->view('pricecomp/pdf', $data, true);
        $this->pdf->pdf_create($html, "file");
        //echo $html;
    }

    function addvendor() {
        $this->load->model('model_vendor');
        $this->load->model('model_currency');
        $data['vendor'] = $this->model_vendor->selectAll();
        $data['currency'] = $this->model_currency->selectAll();
        $this->load->view('pricecomp/addvendor', $data);
    }

    function setVendor() {
        $id = $this->input->post('id');
        $vendorid = $this->input->post('vendorid');
        if ($this->model_pricecomp->setVendor($id, $vendorid)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function setcurrency() {
        $id = $this->input->post('id');
        $currencyid = $this->input->post('currencyid');
        if ($this->model_pricecomp->setCurrency($id, $currencyid)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function setprice() {
        $id = $this->input->post('id');
        $price = $this->input->post('price');
        if ($this->model_pricecomp->setPrice($id, $price)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function setdiscount() {
        $id = $this->input->post('id');
        $discount = $this->input->post('discount');
        if ($this->model_pricecomp->setDiscount($id, $discount)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function setppn() {
        $id = $this->input->post('id');
        $ppn = $this->input->post('ppn');
        if ($this->model_pricecomp->setPpn($id, $ppn)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function setnote() {
        $id = $this->input->post('id');
        $note = $this->input->post('note');
        if ($this->model_pricecomp->setNote($id, $note)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function set_matras_price() {
        $id = $this->input->post('id');
        $matras_price = $this->input->post('matras_price');
        if ($this->model_pricecomp->set_matras_price($id, $matras_price)) {
            echo "<span style='color:green'>SAVED</span>";
        } else {
            echo "<span style='color:red'>FAILD</span>";
        }
    }

    function used($pritemid, $pricecompid) {
        $this->model_pricecomp->used($pritemid, $pricecompid);
    }

    function remove($pritemid, $pricecompid) {
        $this->model_pricecomp->remove($pricecompid, $pritemid);
    }

    function set_as_item_price($itemid, $pricecompid) {
        if ($this->model_pricecomp->set_as_item_price($itemid, $pricecompid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
