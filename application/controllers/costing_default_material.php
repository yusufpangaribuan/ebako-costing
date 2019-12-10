<?php

class costing_default_material extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_costing_default_material');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing_default_material"));
        $data['costing_default_material'] = $this->model_costing_default_material->selectAll();
        $this->load->model('model_costing');
        $data['listCostingCategory'] = $this->model_costing->selectAllCostingCategory();
        
        $this->load->view('costing_default_material/view', $data);
    }

    function search($offset) {
    	if(!empty($offset)){
    		$offset = 0;
    	}
    	
    	$data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing_default_material"));
    	$categoryid = $this->input->post('categoryid');
    	$materialcode = $this->input->post('materialcode');
    	$materialdescription = $this->input->post('materialdescription');
    	
    	$data['num_rows'] = $this->model_costing_default_material->getNumRows($categoryid, $materialcode, $materialdescription);
    	$limit = $this->config->item('limit');
    	$data['offset'] = $offset + 1;
    	$data['num_page'] = (int) ceil($data['num_rows'] / $limit);
    	$data['first'] = 0;
    	$data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
    	$data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
    	$data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
    	$data['page'] = (int) ceil($offset / $limit) + 1;
    	
    	$data['costing_default_material'] = $this->model_costing_default_material->search($categoryid, $materialcode, $materialdescription, $limit, $offset);
    	$this->load->view('costing_default_material/search', $data);
    }
    
    function add() {
        $this->load->model('model_groups');
        $data['groups'] = $this->model_groups->selectAllForSelect();
        
        $this->load->model('model_costing');
        $data['listCostingCategory'] = $this->model_costing->selectAllCostingCategory();
        
        $this->load->model('model_unit');
        $data['uoms'] = $this->model_unit->selectAll();
        
        $this->load->view('costing_default_material/add', $data);
    }

    function save() {
    	$categoryid = $this->input->post('categoryid');
    	$yield = $this->input->post('yield');
    	$allowance = $this->input->post('allowance');
    	$datas = [
	        "categoryid" => $categoryid,
	        "itemid" => $this->input->post('itemid'),
	        "materialcode" => '',
	        "materialdescription" => '',
	        "uom" => $this->input->post('uom'),
	        "qty" => (double) $this->input->post('qty'),
        	"yield" => empty( $yield ) ? null : (double) $yield ,
        	"allowance" => empty( $allowance ) ? null : (double) $allowance ,
	        "req_qty" => (double) $this->input->post('req_qty'),
    			
    		"curr" => $this->input->post('curr'),
    		"price" => (double) $this->input->post('price'),
	    ];
    	
    	if( $categoryid == "9" ){
    		$datas["itemid"] = 0;
    		$datas["materialcode"] = $this->input->post('materialcode');
    		$datas["materialdescription"] = $this->input->post('materialdescription');
    	}else{
	    	$this->load->model('model_item');
	    	$item = $this->model_item->selectById( $this->input->post('itemid') );
	    	if( !empty($item) ){
	    		$datas["materialcode"] = $item->partnumber;
	    		$datas["materialdescription"] = $item->descriptions;
	    	}
    	}
    	
        $this->model_costing_default_material->insert($datas);
    }

    function edit($id) {
        $this->load->model('model_unit');
        $data['uoms'] = $this->model_unit->selectAll();
        $data['costing_default_material'] = $this->model_costing_default_material->selectById($id);
        $this->load->view('costing_default_material/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $yield = $this->input->post('yield');
        $allowance = $this->input->post('allowance');
        $updated_data = [
        		"uom" => $this->input->post('uom'),
        		"qty" => (double) $this->input->post('qty'),
        		"yield" => empty( $yield ) ? null : (double) $yield ,
        		"allowance" => empty( $allowance ) ? null : (double) $allowance ,
        		"req_qty" => (double) $this->input->post('req_qty'),
        		
        		"curr" => $this->input->post('curr'),
        		"price" => (double) $this->input->post('price'),
        ];
        $this->model_costing_default_material->update($id, $updated_data);
    }

    function delete($id) {
        $this->model_costing_default_material->delete($id);
    }

}

?>
