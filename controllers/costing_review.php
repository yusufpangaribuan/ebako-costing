<?php
class costing_review extends Ci_Controller {

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('id')) {
            redirect("/home");
        }
        $this->load->model('model_costing_review');
    }

    function show_list() {
        $data['costing_reviews'] = $this->model_costing_review->selectAll();

        $this->load->view('costing_review/show_list', $data);
    }
}
?>