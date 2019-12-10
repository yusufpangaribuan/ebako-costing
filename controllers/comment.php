<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of comment
 *
 * @author admin
 */
class comment extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_comment');
        $this->load->model('model_user');
    }

    function index() {
        $referenceid = $this->input->post('referenceid');
        $reference = $this->input->post('reference');
        $data['referenceid'] = $referenceid;
        $data['reference'] = $reference;
        $this->load->view('comment/view', $data);
    }

    function post() {
        $comment = $this->input->post('comment');
        $referenceid = $this->input->post('referenceid');
        $reference = $this->input->post('reference');
        $employeeid = $this->session->userdata('id');
        $this->model_comment->post($referenceid, $reference, $employeeid, $comment);
        $this->commentList($referenceid, $reference);
    }

    function commentList($referenceid, $reference) {
        $data['comment'] = $this->model_comment->selectByReference($referenceid, $reference);
        $this->load->view('comment/list', $data);
    }

}

?>
