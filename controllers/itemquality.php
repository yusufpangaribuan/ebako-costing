<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemquality
 *
 * @author hp
 */
class itemquality extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_gritemcheck');
        $this->load->model('model_user');
    }

    function index() {
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        } else {
            $data['num_rows'] = $this->model_gritemcheck->getNumRows("", "", "", "", "");
            $limit = $this->config->item('limit');
            $offset = 0;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['item'] = $this->model_gritemcheck->selectPOItemForQuality();
            $data['iteminspection'] = $this->model_gritemcheck->search("", "", "", "", "", $limit, $offset);
            $this->load->view("itemquality/view", $data);
        }
    }

    function search($offset) {
        $ponumber = $this->input->post('ponumber');
        $datefrom = $this->input->post('date_from');
        $dateto = $this->input->post('date_to');
        $code = $this->input->post('code');
        $description = $this->input->post('description');
        $data['num_rows'] = $this->model_gritemcheck->getNumRows($ponumber, $datefrom, $dateto, $code, $description);
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['iteminspection'] = $this->model_gritemcheck->search($ponumber, $datefrom, $dateto, $code, $description, $limit, $offset);
        $this->load->view('itemquality/search', $data);
    }

    function set($poitemid) {
        $data['poitemid'] = $this->model_gritemcheck->selectPOItemForQualitybyId($poitemid);
        $this->load->view('itemquality/set', $data);
    }

    function doset() {
        $poitemid = $this->input->post('poitemid');
        $itemid = $this->input->post('itemid');
        $qty = $this->input->post('qty');
        $date = $this->input->post('date');
        if ($this->model_gritemcheck->doSet($poitemid, $itemid, $qty, $date)) {
            echo json_encode(array('success' => true));
        } else {
            $this->db->_error_message();
        }
    }

    function delete($id) {
        if ($this->model_gritemcheck->isRecorded($id)) {
            echo '1';
        } else {
            $this->model_gritemcheck->delete($id);
            echo '0';
        }
    }

}
