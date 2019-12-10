<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class costing extends CI_Controller {

    public function __construct() {
    	
        parent::__construct();
        
        if (!$this->session->userdata('id')) {
        	redirect("/home");
        	echo "<script>location.reload()</script>";
        }
        $this->load->model('model_costing');
        $this->load->model('model_rate');
        $this->load->model('model_customer');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
        $data['customer'] = $this->model_customer->selectAll();
        $data['num_rows'] = $this->model_costing->getNumRows("", "", "", "", "", "");
        $limit = $this->config->item('limit');
        $offset = 0;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['costing'] = $this->model_costing->search("", "", "", "", "", "", $limit, $offset);
        
        $this->load->model('model_model');
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        
        $data["total_over_due"] = $this->model_costing->getCountOverDue();
        
        $this->load->view('costing/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
        $code = $this->input->post('code');
        $custcode = $this->input->post('custcode');
        $customerid = $this->input->post('customerid');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $is_over_due = $this->input->post('is_over_due');
        
        $limit = $this->config->item('limit');
        $data['num_rows'] = $this->model_costing->getNumRows($code, $custcode, $customerid, $datefrom, $dateto, $is_over_due);
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['costing'] = $this->model_costing->search($code, $custcode, $customerid, $datefrom, $dateto, $is_over_due, $limit, $offset);
        
        $this->load->model('model_model');
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        
        $this->load->view('costing/search', $data);
    }
    
    function search_then_print_summary($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
        $code = $this->input->get('code');
        $custcode = $this->input->get('custcode');
        $customerid = $this->input->get('customerid');
        $datefrom = $this->input->get('datefrom');
        $dateto = $this->input->get('dateto');
        $is_over_due = $this->input->get('is_over_due');

        $data['costing'] = $this->model_costing->search_and_get_all($code, $custcode, $customerid, $datefrom, $dateto, $is_over_due);
        
        $this->load->model('model_model');
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        
        $this->load->view('costing/print_summary_filtered_costing', $data);
    }

    function createfromrequest($id) {
        $data['rate'] = $this->model_rate->selectAll();
        $data['id'] = $id;
        $this->load->view('costing/createfromrequest', $data);
    }

    function createnew() {
        $this->load->model('model_customer');
        $data['rate'] = $this->model_rate->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $this->load->view('costing/createnew', $data);
    }

    function addfromrequestmodel() {
        $modelid = $this->input->post('modelid');
        $customerid = $this->input->post('customerid');
        $this->model_costing->addfromrequestmodel($modelid, $customerid);
    }

    function savefromrequest() {
        $id = $this->input->post('id');
        $rateid = $this->input->post('rateid');
        $ratevalue = $this->input->post('ratevalue');
        $fixed_cost = $this->input->post('fixed_cost');
        $variable_cost = $this->input->post('variable_cost');
        $profit_percentage = $this->input->post('profit_percentage');
        $port_origin_cost = $this->input->post('port_origin_cost');
        $date = $this->input->post('date');
        $this->model_costing->updatefromrequest($id, $rateid, $ratevalue, $fixed_cost, $variable_cost, $profit_percentage, $port_origin_cost, $date);
    }

    function savenew() {
        $modelid = $this->input->post('modelid');
        $customerid = $this->input->post('customerid');
        $rateid = $this->input->post('rateid');
        $ratevalue = $this->input->post('ratevalue');
        $fixed_cost = $this->input->post('fixed_cost');
        $variable_cost = $this->input->post('variable_cost');
        $profit_percentage = $this->input->post('profit_percentage');
        $port_origin_cost = $this->input->post('port_origin_cost');
        $date = $this->input->post('date');
        
        $preparedby = $this->input->post('preparedby');
        if(empty($preparedby) || $preparedby == "null"){
        	$preparedby = "";
        }
        $checkedby = $this->input->post('checkedby');
        $approvedby = $this->input->post('approvedby');
        
        $result = $this->model_costing->savenew($customerid, $modelid, $rateid, $ratevalue, $fixed_cost, $variable_cost, $profit_percentage, $port_origin_cost, $date, $preparedby,$checkedby,$approvedby);
    }

    function build($id, $flag) {
        $this->load->model('model_item');
        $this->load->model('model_rate');
        $this->load->model('model_directlabour');
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
        $data['id'] = $id;
        $data['costing'] = $this->model_costing->selectById($id);
        $data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
        $data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
        $data['costingcategoryall'] = $this->model_costing->selectAllCostingCategory();
        $data['flag'] = $flag;
        $this->load->view('costing/build', $data);
    }

    function adddetail($costingid, $category) {
        $this->load->model('model_unit');
        $data['rate'] = $this->model_rate->selectAll();
        $data['costingid'] = $costingid;
        $data['category'] = $category;
        $data['unit'] = $this->model_unit->selectAll();
        $this->load->view('costing/adddetail', $data);
    }

    function savedetail() {
        $costingid = $this->input->post('costingid');
        $categoryid = $this->input->post('categoryid');
        $materialcode = $this->input->post('materialcode');
        $materialdescription = $this->input->post('materialdescription');
        $uom = $this->input->post('uom');
        $qty = (double) $this->input->post('qty');
        $yield = (double) $this->input->post('yield');
        $allowance = (double) $this->input->post('allowance');
        $req_qty = (double) $this->input->post('req_qty');
        $unitpricerp = (double) $this->input->post('unitpricerp');
        $unitpriceusd = (double) $this->input->post('unitpriceusd');
        $this->model_costing->savedetail($costingid, $categoryid, $materialcode, $materialdescription, $uom, $qty, $yield, $allowance, $req_qty, $unitpricerp, $unitpriceusd);
    }
    
    function savedetail_from_printout() {
    	$objNewMaterial = json_decode( $this->input->post('new_material') );
    	$inserted_id = $this->model_costing->savedetail_from_printout( $objNewMaterial );
    	$data = array(
    			"success" => true,
    			"new_inserted_costingdetail_id" => $inserted_id,
    	);
    	echo json_encode($data);
    }

    function deletedetail($id) {
        $this->model_costing->deletedetail($id);
    }
    
    function deletedetail_from_printout($id) {
    	$id = $this->input->post('costingdetail_id');
        $this->model_costing->deletedetail($id);
    }

    function loadfrommaterial($costingid, $costingcategory, $modelid) {
        $this->model_costing->loadfrommaterial($costingid, $costingcategory, $modelid);
    }

    function updatedetail() {
        $id = $this->input->post('id');
        $costingid = $this->input->post('costingid');
        $materialcode = $this->input->post('materialcode');
        $materialdescription = $this->input->post('materialdescription');
        $uom = $this->input->post('uom');
        $qty = (double) $this->input->post('qty');
        $yield = (double) $this->input->post('yield');
        $allowance = (double) $this->input->post('allowance');
        $req_qty = (double) $this->input->post('req_qty');
        $unitpricerp = (double) $this->input->post('unitpricerp');
        $rate = $this->model_costing->getRateByCostingId($costingid);
        $tempunitpriceusd = $this->input->post('unitpriceusd');
        $unitpriceusd = ($tempunitpriceusd == "" ) ? ($rate * $unitpricerp) : $tempunitpriceusd;
        $itemid = $this->input->post("itemid");
        $this->model_costing->updatedetail($id, $materialcode, $materialdescription, $uom, $qty, $yield, $allowance, $req_qty, $unitpricerp, $unitpriceusd, $itemid);
    }
    
    function updatedetail_from_printout() {
    	$objMaterial = json_decode( $this->input->post('material') );
    	$this->model_costing->updatedetail_from_printout( $objMaterial );
    }
    
    function update_price_from_printout() {
    	$objMaterial = json_decode( $this->input->post('material') );
    	$this->model_costing->update_price_from_printout( $objMaterial );
    }
    
    function movedetail_from_printout() {
    	$objMovedMaterial = json_decode( $this->input->post('moved_material') );
    	$this->model_costing->movedetail_from_printout( $objMovedMaterial );
    }

    function move($id, $category) {
        $this->model_costing->move($id, $category);
    }

    function savefobprice() {
        $id = $this->input->post('id');
        $direct_material = $this->input->post('directmaterial');
        $direct_labour = $this->input->post('directlabour');
        $fixed_cost_value = $this->input->post('fixed_cost_value');
        $variable_cost_value = $this->input->post('variable_cost_value');
        $sell_price = $this->input->post('sellprice');
        $profit_percentage = $this->input->post('profit_percentage');
        $pick_list_hardware = $this->input->post('pick_list_hardware');
        $sub_contractor = $this->input->post('sub_contractor');
        $port_origin_cost = $this->input->post('port_origin_cost');
        $sub_total = $this->input->post('sub_total');
        $fob_price = $this->input->post('fobprice');
        $data = array(
            "direct_material" => $direct_material,
            "direct_labour" => $direct_labour,
            "fixed_cost_value" => $fixed_cost_value,
            "variable_cost_value" => $variable_cost_value,
            "sellprice" => $sell_price,
            "profit_percentage" => $profit_percentage,
            "pick_list_hardware" => $pick_list_hardware,
            "sub_contractor" => $sub_contractor,
            "port_origin_cost_value" => $port_origin_cost,
            "sub_total" => $sub_total,
            "fob_price" => $fob_price,
            "updated_price" => "FALSE"
        );
        $where = array("id" => $id);
        $this->model_costing->savefobprice($data, $where);
    }
    
    function savefobprice_from_print_out($costingid) {
    	$objCosting_summary = json_decode( $this->input->post('costing_summary') );
    	
    	$data = array(
    			"direct_material" => @$objCosting_summary->total_costingdirectmaterial_in_usd,
    			"direct_labour" => @$objCosting_summary->total_costingundirectmaterial_in_usd->cat_9, //direct labour
    			
    			"fixed_cost" => @$objCosting_summary->fixed_cost,
    			"fixed_cost_value" => @$objCosting_summary->fixed_cost_value,
    			"variable_cost" => @$objCosting_summary->variable_cost,
    			"variable_cost_value" => @$objCosting_summary->variable_cost_value,
    			
    			"sellprice" => @$objCosting_summary->factory_cost_and_profit,
    			"profit_percentage" => @$objCosting_summary->profit_percentage,
    			"pick_list_hardware" => @$objCosting_summary->total_costingundirectmaterial_in_usd->cat_9, //pick list
    			"sub_contractor" => @$objCosting_summary->total_costingundirectmaterial_in_usd->cat_10, //sub contractor
    			"port_origin_cost_value" => @$objCosting_summary->port_origin_cost,
    			"sub_total" => @$objCosting_summary->subtotal_cat_8_10,
    			"fob_price" => @$objCosting_summary->fob_price,
    			"variable_mark_up_cat_8" => @$objCosting_summary->variable_mark_up_cat_8,
    			"updated_price" => "FALSE",
    			"date" => date('Y-m-d'),
    	);
    	
    	$this->model_costing->savefobprice($data, ["id" => $costingid]);
    	
    	echo json_encode([ "success"=> true ]);
    }

    function prints($id, $st, $st2) {
        $data['id'] = $id;
        $data['costing'] = $this->model_costing->selectById($id);
        $data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
        $data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
        $data['costingcategoryall'] = $this->model_costing->selectAllCostingCategory();
        $data['st'] = $st;
        $data['st2'] = $st2;
        $data['access_fob_price_and_profit'] = $this->isAllowAccessToFobPriceAndProfit();
        
        $this->load->view('costing/prints', $data);
    }
    
    function prints_cost_material_only($id, $st, $st2) {
        $data['id'] = $id;
        $data['costing'] = $this->model_costing->selectById($id);
        $data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
        $data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
        $data['costingcategoryall'] = $this->model_costing->selectAllCostingCategory();
        $data['st'] = $st;
        $data['st2'] = $st2;
        $this->load->view('costing/prints_cost_material_only', $data);
    }
    
    function edit_print_out($id, $st, $st2) {
    	$data['id'] = $id;
    	$data['costing'] = $this->model_costing->selectById($id);
    	$data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
    	$data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
    	$data['costingcategoryall'] = $this->model_costing->selectAllCostingCategory();
    	$data['st'] = $st;
    	$data['st2'] = $st2;
    	$this->load->view('costing/print_out/edit_print_out', $data);
    }
    
    function isAllowAccessToFobPriceAndProfit(){
    	$access_menu = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
    	return in_array( 'view_fob_price_and_profit', $access_menu );
    }
    
    function load_costing($id, $st, $st2=null) {
    	$data = [];
    	$data['access_fob_price_and_profit'] = $this->isAllowAccessToFobPriceAndProfit();
    	
    	$id = $id;
    	$costing = $this->model_costing->selectById($id);
    	$costingcategory = $this->model_costing->selectCostingCategoryDirectMaterial();
    	$costingcategorynotdirect = $this->model_costing->selectCostingCategoryNotDirectMaterial();
    	$costingcategoryall_raw = $this->model_costing->selectAllCostingCategory();
    	
    	//$costingcategoryall = [];
    	//foreach ($costingcategoryall_raw as $costingcat) {
    	//	$costingcategoryall[$costingcat->id] = $costingcat->name;
    	//}
    	
    	$st = $st;
    	$st2 = $st2;
    	
    	$data['id'] = $id;
    	$data['costing'] = $this->model_costing->selectById($id);
    	$data['costingcategory'] = $costingcategory;
    	$data['costingcategorynotdirect'] = $costingcategorynotdirect;
    	$data['costingcategoryall'] = $costingcategoryall_raw;
    	$data['costing_detail_id'] = $st;
    	$data['costing_categori_id'] = $st2;

    	
    	$data['costing_directmaterial'] = [];
    	$data['costing_undirectmaterial'] = [];
    	
    	foreach ($costingcategory as $costingcat) {
	    	$data['costing_directmaterial'][] = [
				"category" => ["id" => $costingcat->id, "name"=>$costingcat->name],
	    		"datas" => $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcat->id), 
	    	];
    	}
    	
    	foreach ($costingcategorynotdirect as $costingcat) {
    		$data['costing_undirectmaterial'][] = [
				"category" => ["id" => $costingcat->id, "name"=>$costingcat->name],
	    		"datas" => $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcat->id), 
	    	];
    	}
    	
    	echo json_encode($data);
    }

    function approve2($id) {
        $this->model_costing->approve($id);
    }
    
    function approve() {
    	$costingid = $this->input->post('costingid');
    	$approvalid = $this->input->post('approvalid');
    	$status = $this->input->post('status');
    	$who = $this->input->post('who');
    	$notes = "";
    
    	if ($who == 1) {
    		$data = array(
    				"checkedstatus" => $status,
    				"checkedtime" => date('Y-m-d h:i:s')
    		);
    	} else {
    		$data = array(
    				"approvedstatus" => $status,
    				"approvedtime" => date('Y-m-d h:i:s'),
    		);
    	}
    
    	//validate
    	$costing = $this->model_costing->selectById( $costingid );
    	if( $who != "1"){
    		if( $costing->checkedstatus != "1" ){
	    		echo json_encode(array('msg' => "Error, Before Perform Approval, Please Do Checking First...!"));
	    		return;
    		}
    	}
    	
    	if ($this->model_costing->update($data, array("id" => $costingid))) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function rejectOrPending($costingid, $approvalid, $status, $who, $flag) {
    	$data['costingid'] = $costingid;
    	$data['approvalid'] = $approvalid;
    	$data['status'] = $status;
    	$data['flag'] = $flag;
    	$data['who'] = $who;
    	
    	$this->validateCheckingAndApprove($costingid, $who);
    	
    	$this->load->view('costing/reject_or_pending', $data);
    }
    
    function validateCheckingAndApprove($costingid, $who=2){
    	if( $who == 2 ){
    		$costing = $this->model_costing->selectById( $costingid );
    		if( $costing->checkedstatus != "1" ){
    			echo "Error, Before Perform Approval, Please Do Checking First...!";
    			exit();
    		}
    	}
    }
    
    function do_reject_or_pending() {
    	$costingid = $this->input->post('costingid');
    	$approvalid = $this->input->post('approvalid');
    	$status = $this->input->post('status');
    	$who = $this->input->post('who');
    	$notes = $this->input->post('notes');
    
    	if ($who == 1) {
    		$data = array(
    				"checkedstatus" => $status,
    				"checkedtime" => date('Y-m-d h:i:s')
    		);
    	} else {
    		$data = array(
    				"approvedstatus" => $status,
    				"approvedtime" => date('Y-m-d h:i:s'),
    		);
    	}
    
    	//if ($status == '2') {
    	//$data['status'] = -1;
    	//}
    
    	$error_message = "";
    
    	//validate
    	$costing = $this->model_costing->selectById( $costingid );
    	if( $who != "1"){
    		if($costing->checkedstatus != "1"){
	    		echo json_encode(array('msg' => "Error, Before Perform Approval, Please Do Checking First...!"));
	    		return;
    		}
    	}
    	
    	$this->db->trans_start();
    	if ( $this->model_costing->update( $data, array("id" => $costingid) ) ) {
    		$data_notes = array(
    				"costingid" => $costingid,
    				"employeeid" => $approvalid,
    				"timeapprove" => date('Y-m-d h:i:s'),
    				"notes" => $notes,
    				"status" => $status,
    				"who" => $who,
    		);
    		
    		if (!$this->db->insert("costingapprovalnotes", $data_notes)) {
    		   $error_message = $this->db->_error_message();
    		}
    	} else {
    		$error_message = $this->db->_error_message();
    	}
    
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === TRUE) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $error_message));
    	}
    }

    function view_approval_notes( $costingid, $status, $who) {
    	$query = " select nts.id, em.name as checked_by, nts.status, nts.notes, nts.timeapprove
	    	from costingapprovalnotes nts
	    	left join employee em on em.id = nts.employeeid
	    	where nts.costingid = $costingid and nts.status = $status and nts.who = '$who'
	    	order by nts.id desc ";
    	
    	$notes = $this->db->query($query)->result();
    	 
    	$data['notes'] = $notes;
    	$data['who'] = $who;
    	$data['costing'] = $this->model_costing->selectById( $costingid );
    	$this->load->view('costing/approval_notes', $data);
    }
    
    
    function view_additional_notes( $costingid ) {
    	$query = " select additional_notes from costing where id = $costingid ";
    	 
    	$costing = $this->db->query($query)->row();
    
    	$data['costingid'] = $costingid;
    	$data['additional_notes'] = @$costing->additional_notes;
    	$this->load->view('costing/additional_notes', $data);
    }
    
    function save_additional_notes() {
    	$costingid = $this->input->post('costingid');
    	$additional_notes = $this->input->post('additional_notes');
    
    	$data = array(
    		"additional_notes" => $additional_notes,
    	);
    	
    	$this->db->trans_start();
    	$this->model_costing->update( $data, array("id" => $costingid) );
    	$this->db->trans_complete();
    	
    	if ($this->db->trans_status() === TRUE) {
    		echo json_encode(array('success' => true));	
    	} else {
    		echo json_encode( array('msg' => $this->db->_error_message()) );
    	}
    }
    
    function editdetail($id, $costingid, $category) {
        $this->load->model('model_unit');
        $data['id'] = $id;
        $data['costingid'] = $costingid;
        $data['category'] = $category;
        $data['unit'] = $this->model_unit->selectAll();
        $data['costing'] = $this->model_costing->selectDetailById($id);
        $this->load->view('costing/editdetail', $data);
    }

    function copyfrom($toid) {
        $this->load->model('model_customer');
        $data['customer'] = $this->model_customer->selectAll();
        $data['costing'] = $this->model_costing->selectAll();
        $data['id'] = $toid;
        $this->load->view('costing/copyfrom', $data);
    }

    function docopy($toid, $fromid) {
        $this->model_costing->docopy($toid, $fromid);
    }

    function copypartfrom($toid, $category) {
        $this->load->model('model_customer');
        $data['customer'] = $this->model_customer->selectAll();
        $data['costing'] = $this->model_costing->selectAll();
        $data['id'] = $toid;
        $data['category'] = $category;
        $this->load->view('costing/copypartfrom', $data);
    }

    function docopypart($toid, $fromid, $category) {
        $this->model_costing->docopypart($toid, $fromid, $category);
    }

    function isexist($customerid, $modelid) {
        if ($this->model_costing->isExist($customerid, $modelid)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function isexist2($customerid, $modelid, $id) {
        if ($this->model_costing->isExist2($customerid, $modelid, $id)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function edit($id) {
        $this->load->model('model_customer');
        $data['rate'] = $this->model_rate->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $data['costing'] = $this->model_costing->selectById($id);
        $this->load->view('costing/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $modelid = $this->input->post('modelid');
        $customerid = $this->input->post('customerid');
        $rateid = $this->input->post('rateid');
        $ratevalue = $this->input->post('ratevalue');
        $fixed_cost = $this->input->post('fixed_cost');
        $variable_cost = $this->input->post('variable_cost');
        $profit_percentage = $this->input->post('profit_percentage');
        $port_origin_cost = $this->input->post('port_origin_cost');
        $currentratevalue = $this->input->post('currentratevalue');
        $newrate = $this->input->post('newrate');
        $date = $this->input->post('date');
        if ($newrate == 'true') {
            $currentratevalue = $ratevalue;
        }
        
        $preparedby = $this->input->post('preparedby');
        if(empty($preparedby) || $preparedby == "null"){
        	$preparedby = "";
        }
        $checkedby = $this->input->post('checkedby');
        $approvedby = $this->input->post('approvedby');
        
        $data = array(
        			"modelid" => $modelid,
        			"customerid" => $customerid,
        			"rateid" => $rateid,
        			"ratevalue" => $ratevalue,
        			
        			//"picklist_ratevalue" => $ratevalue,
        		
        			"fixed_cost" => $fixed_cost,
        			"variable_cost" => $variable_cost,
        			"profit_percentage" => $profit_percentage,
        			"port_origin_cost" => $port_origin_cost,
        			"date" => $date,
        			"preparedby" => $preparedby,
        			"checkedby" => $checkedby,
        			"approvedby" => $approvedby,
        		);
        		
        if ( $this->model_costing->update($data, array("id" => $id)) ) {
        	echo json_encode(array('success' => true));
        } else {
        	echo json_encode(array('msg' => $this->db->_error_message()));
        }
        
    }
    
    function save_ratevalue( $costing_id ) {
    	$ratevalue = $this->input->post('costing_ratevalue');
    	$this->model_costing->updateRateValue($costing_id, $ratevalue);
    }
    
    function save_picklist_ratevalue( $costing_id ) {
    	$picklist_ratevalue = $this->input->post('picklist_ratevalue');
    	$this->model_costing->updatePicklistRateValue($costing_id, $picklist_ratevalue);
    }
    
    //--------------------------
    function create($id, $soid, $modelid) {
        if (!$this->model_costing->isExist($id)) {
            $data['rate'] = $this->model_rate->selectAll();
            $data['id'] = $id;
            $data['soid'] = $soid;
            $data['modelid'] = $modelid;
            $this->load->view('costing/create', $data);
        } else {
            $data['id'] = $id;
            $data['soid'] = $soid;
            $data['modelid'] = $modelid;
            $data['header'] = $this->model_costing->selectHeaderById($id);
            $data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
            $data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
            $data['costingcategoryall'] = $this->model_costing->selectAllCostingCategory();
            $this->load->view('costing/view', $data);
        }
    }

    function saveheader() {
        $id = $this->input->post('id');
        $soid = $this->input->post('soid');
        $modelid = $this->input->post('modelid');
        $rateid = $this->input->post('rateid');
        $ratevalue = $this->input->post('ratevalue');
        $fixed_cost = $this->input->post('fixed_cost');
        $variable_cost = $this->input->post('variable_cost');
        $profit_percentage = $this->input->post('profit_percentage');
        $port_origin_cost = $this->input->post('port_origin_cost');
        $this->model_costing->insertheader($id, $soid, $modelid, $rateid, $ratevalue, $fixed_cost, $variable_cost, $profit_percentage, $port_origin_cost);
    }

    function loadfromcuttinglist($id, $soid, $modelid) {
        $this->model_costing->loadHardwareToCosting($id, $soid, $modelid);
    }

    function iscomplete($soid) {
        echo $this->model_costing->iscomplete($soid);
    }

    function iscompleteformanagement($soid) {
        echo $this->model_costing->iscompleteformanagement($soid);
    }

    function delete($id) {
        $this->model_costing->delete($id);
    }

    function loaddirectlabour($id) {
        $this->model_costing->loaddirectlabour($id);
    }

    function lock($costingid) {
        $this->model_costing->lock($costingid);
    }

    function unlock($costingid) {
        $this->model_costing->unlock($costingid);
    }
    
    function lock_from_printout() {
    	$costingid = $this->input->post('costingid');
        $this->model_costing->lock($costingid);
    }

    function unlock_from_printout() {
    	$costingid = $this->input->post('costingid');
        $this->model_costing->unlock($costingid);
    }

    function updatematerialprice($costingid) {
        $this->model_costing->updatematerialprice($costingid);
    }

    function searchcopycosting() {
        $id = $this->input->post('id');
        $modelcode = $this->input->post('modelcode');
        $custcode = $this->input->post('custcode');
        $modeldescription = $this->input->post('modeldescription');
        $customerid = $this->input->post('customerid');
        $data['id'] = $id;
        $data['costing'] = $this->model_costing->searchcopycosting($modelcode, $custcode, $modeldescription, $customerid);
        $this->load->view('costing/searchcopycosting', $data);
    }

    function review($costingid) {
        ?>
        <div style="width: 300px">            
            <input type="radio" name="changetype" value="1" /> Unchanged FOB Price<br/>
            <input type="radio" name="changetype" value="2" /> Unchanged Profit Percentage<br/><br/>
            <button style="font-size: 11px" onclick="costing_doreview(<?php echo $costingid ?>)">Ok</button>
            <button style="font-size: 11px" onclick="$('#dialog2').dialog('close')">Cancel</button>
        </div>
        <?php
    }

    function doreview() {
        $costingid = $this->input->post('costingid');
        $lastfobprice = $this->input->post('lastfobprice');
        $fobprice = $this->input->post('fobprice');
        $changetype = $this->input->post('changetype');
        if ($changetype == 2) {
            $this->model_costing->updatefobprice($costingid, $fobprice);
        }
    }

    function loadAllMaterialFromBOM($costingid, $modelid) {
        $this->model_costing->loadAllMaterialFromBOM($costingid, $modelid);
    }
    
    function loadAllMaterialFromDefaultMaterial($costingid) {
        $this->model_costing->loadAllMaterialFromDefaultMaterial($costingid);
    }

    
    //price list
    
    function view_pricelist() {
    	$data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
    	$data['customer'] = $this->model_customer->selectAll();
    	
    	$data['num_rows'] = $this->model_costing->getNumRows("", "", "", "", "", "");
    	$limit = $this->config->item('limit');
    	$offset = 0;
    	
    	$data['num_page'] = (int) ceil($data['num_rows'] / $limit);
    	$data['offset'] = $offset + 1;
    	$data['first'] = 0;
    	$data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
    	$data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
    	$data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
    	$data['page'] = (int) ceil($offset / $limit) + 1;
    	$data['costing'] = $this->model_costing->search("", "", "", "", "", "", $limit, $offset);
    
    	$this->load->model('model_model');
    	$data["finishoverview"] = $this->model_model->selectFinishOverview();
    	$data["constructionoverview"] = $this->model_model->selectConstructionOverview();
    
    	$this->load->view('costing/pricelist/view', $data);
    }

    
    
}