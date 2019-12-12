<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class costing_pricereview extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('id')) {
            redirect("/home");
        }
        $this->load->model('model_costing');
        $this->load->model('model_customer');
        $this->load->model('model_user');
        $this->load->model('model_item');
        $this->load->model('model_rate');
        $this->load->model('model_costing_review');
    }

    function view_pricereview() {
    	//$data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
    	$data['customer'] = $this->model_customer->selectAll();
    	$data["list_model"] = $this->model_costing->selectAllModel();
    	
    	$this->load->view('costing_pricereview/view', $data);
    }
    
    function search_pricereview( $offset=0 ) { //tanda
    	//$data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
		
		//price list parameter    	
    	$con = (string)$this->input->post('price_review_base_on');
    	
    	$ratevalue = (double) $this->input->post('ratevalue');
    	$picklist_ratevalue = (double) $this->input->post('picklist_ratevalue');
    	
    	//filter data parameter
    	
    	$model_codes = $this->input->post('model_codes');
        $code = $this->input->post('code');
        $custcode = $this->input->post('custcode');
        $input_margins = $this->input->post('margin');

        $margins = array();
        $list_costing = $this->model_costing->get_costing($model_codes, $code, $custcode);
        
        $start_range = (int)date("Y");
        $end_range = (int)date("Y", strtotime('+1 year'));
        $costing_details = array();

        foreach ($list_costing as $costing) {
            $result = array();
            if($con == 'c1') {
                $result = $this->getMargin($costing);
            } else if($con == 'c2') {
                $result = $this->fixCurrencyFixPriceMarginConditional($costing);
            } else if($con == 'c3') {
                $result = $this->getMargin($costing, $ratevalue, $picklist_ratevalue);
            } else if($con == 'c4') {
                $result = $this->currencyConditionalFixPriceMarginConditional($ratevalue, $input_margins, $costing, $picklist_ratevalue);
            }
            $costing_details[ $costing->id ]['margin'][ $start_range ] = $result['old_result'];
            $costing_details[ $costing->id ]['margin'][ $end_range ] = $result['new_result'];
            $costing_details[ $costing->id ]['fob'][ $start_range ] = $result['fob_old'];
            $costing_details[ $costing->id ]['fob'][ $end_range ] = $result['fob_new'];
        }

        $ranges = array($start_range, $end_range);
    	$customerid = $this->input->post('customerid');
    	$datefrom = $this->input->post('datefrom');
    	$dateto = $this->input->post('dateto');
    	$is_over_due = $this->input->post('is_over_due');
    	
    	$limit = $this->config->item('limit');
    	
    	$data['num_rows'] = $this->model_costing->getNumRows_pricelist($model_codes, $code, $custcode, $customerid, $datefrom, $dateto, $is_over_due);
    	$data['num_page'] = (int) ceil($data['num_rows'] / $limit);
    	$data['offset'] = $offset + 1;
    	$data['first'] = 0;
    	$data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
    	$data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
    	$data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
    	$data['page'] = (int) ceil($offset / $limit) + 1;
    	
    	$costingcategories = $this->model_costing->selectCostingCategoryDirectMaterial();
    	$costingcategories_notdirect = $this->model_costing->selectCostingCategoryNotDirectMaterial();
    	
    	$data['ranges'] = $ranges;
    	$data['costing'] =  $list_costing ;
    	$data['costing_details'] =  $costing_details ;
    	
    	$data['target_price'] = 0;
    	$data['price_review_base_on'] = $con;
    	$this->load->view('costing_pricereview/search', $data);
    }

    function price_review() {
        $model_codes = $this->input->post('model_codes');
        $result = array();
        foreach ($model_codes as $mode_code) {
            $costing = $this->costing->get_costing_by_model_no($model_code);
            $old_fob = $costing->fob_price;
            $new_fob = $this->
            $data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
            $data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
            $data['costingcategoryall'] = $this->model_costing->selectAllCostingCategory();
        }
    }
    
    function search_pricereview_then_print_summary($offset) {
    	//$data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing"));
		
		//price list parameter    	
    	$price_review_base_on = $this->input->get('price_review_base_on');
    	 
    	$start_ratevalue = (double) $this->input->get('start_ratevalue');
    	$end_ratevalue = (double) $this->input->get('end_ratevalue');
    	$range_ratevalue = (double) $this->input->get('range_ratevalue');
    	$profit_percentage = (double) $this->input->get('profit_percentage');
    	 
    	$start_profit = (double) $this->input->get('start_profit');
    	$end_profit = (double) $this->input->get('end_profit');
    	$range_profit = (double) $this->input->get('range_profit');
    	$ratevalue = (double) $this->input->get('ratevalue');
    	
    	$fixed_cost = (double) $this->input->get('fixed_cost');
    	$variable_cost = (double) $this->input->get('variable_cost');
    	$port_origin_cost = (double) $this->input->get('port_origin_cost');
    	$picklist_mark_up = (double) $this->input->get('picklist_mark_up');
    	$picklist_ratevalue = (double) $this->input->get('picklist_ratevalue');
    
    	$is_over_due = $this->input->get('is_over_due');
    	
    	$target_price = (double) $this->input->get('target_price');
    	//filter data parameter
    	
    	$model_codes = $this->input->get('model_codes');
    	if( !empty($model_codes) ){
	    	$model_codes = json_decode($model_codes);
    	}
    	
    	$code = $this->input->get('code');
    	$custcode = $this->input->get('custcode');
    	$customerid = $this->input->get('customerid');
    	$datefrom = $this->input->get('datefrom');
    	$dateto = $this->input->get('dateto');
    	
    	$data['price_review_base_on'] = $price_review_base_on;
    	
    	$data['start_ratevalue'] = $start_ratevalue;
    	$data['end_ratevalue'] = $end_ratevalue;
    	$data['range_ratevalue'] = $range_ratevalue;
    	$data['profit_percentage'] = $profit_percentage;
    	
    	$data['start_profit'] = $start_profit;
    	$data['end_profit'] = $end_profit;
    	$data['range_profit'] = $range_profit;
    	$data['ratevalue'] = $ratevalue;
    	
    	$data['fixed_cost'] = $fixed_cost;
    	$data['variable_cost'] = $variable_cost;
    	$data['port_origin_cost'] = $port_origin_cost;
    	$data['picklist_mark_up'] = $picklist_mark_up;
    	$data['picklist_ratevalue'] = $picklist_ratevalue;
    	
    	$data['code'] = $code;
    	$data['custcode'] = $custcode;
    	$data['customerid'] = $customerid;
    	$data['datefrom'] = $datefrom;
    	$data['dateto'] = $dateto;
    	
    	$costingcategories = $this->model_costing->selectCostingCategoryDirectMaterial();
    	$costingcategories_notdirect = $this->model_costing->selectCostingCategoryNotDirectMaterial();
    	
    	$list_costing = $this->model_costing->search_and_get_all_for_pricereview($model_codes, $code, $custcode, $customerid, $datefrom, $dateto, $is_over_due);
    	$costing_details = [];
    	
    	$ranges = [];
    	$start_range = 0;
    	$end_range = 0;
    	$range = 0;
    	
    	if( $price_review_base_on == "rate" ){
	    	$start_range = $start_ratevalue;
	    	$end_range = $end_ratevalue;
	    	$range = $range_ratevalue;
    	}else{
	    	$start_range = $start_profit;
	    	$end_range = $end_profit;
	    	$range = $range_profit;
    	}
    	
    	while( $start_range <= $end_range ) {
    		$ranges [] = $start_range;
    		
    		if( $price_review_base_on == "rate" ){
	    		$ratevalue_tmp = $start_range; 
	    		$profit_percentage_tmp = $profit_percentage;
    		}else{
	    		$ratevalue_tmp = $ratevalue; 
	    		$profit_percentage_tmp = $start_range;
    		}
    		
    		
    		foreach ($list_costing as $costing){
    			$costing_details[ $costing->id ][ $start_range ] =  ceil( $this->getFOB_price($costing, $costingcategories, $costingcategories_notdirect, $ratevalue_tmp, $profit_percentage_tmp, $port_origin_cost, $fixed_cost, $variable_cost, $port_origin_cost, $picklist_mark_up, $picklist_ratevalue) );
    		}
    		$start_range += $range;
    	}
    	
    	$data['ranges'] = $ranges;
    	$data['costing'] =  $list_costing ;
    	$data['costing_details'] =  $costing_details ;
    	
    	$data['target_price'] =  $target_price ;
    	$data['price_review_base_on'] = $price_review_base_on;
    
    	$this->load->view('costing_pricereview/print_costing_pricereview', $data);
    }
    
    function print_preview_cost_sheet() {
    	//price list parameter
    	$id = $this->input->get('id');
    	$data['ratevalue'] = (double) $this->input->get('ratevalue');
    	$data['profit_percentage'] = (double) $this->input->get('profit_percentage');
    	$data['port_origin_cost'] = (double) $this->input->get('port_origin_cost');
    	$data['fixed_cost'] = (double) $this->input->get('fixed_cost');
    	$data['variable_cost'] = (double) $this->input->get('variable_cost');
    	$data['port_origin_cost'] = (double) $this->input->get('port_origin_cost');
    	$data['picklist_mark_up'] = (double) $this->input->get('picklist_mark_up');
    	$data['picklist_ratevalue'] = (double) $this->input->get('picklist_ratevalue');
    	 
    	$data['id'] = $id;
    	$data['costing'] = $this->model_costing->selectById($id);
    	$data['costingcategory'] = $this->model_costing->selectCostingCategoryDirectMaterial();
    	$data['costingcategorynotdirect'] = $this->model_costing->selectCostingCategoryNotDirectMaterial();
    	
    	$this->load->view('costing_pricereview/print_preview_cost_sheet', $data);
    }
    
    function set_as_fixed_cost_sheet(){
    	$costingid = (double) $this->input->post('costingid');
    	$arr_data = [
    			"ratevalue" => (double) $this->input->post('ratevalue'),
    			"profit_percentage" => (double) $this->input->post('profit_percentage'),
    			"fixed_cost" => (double) $this->input->post('fixed_cost'),
    			"variable_cost" => (double) $this->input->post('variable_cost'),
    			"port_origin_cost" => (double) $this->input->post('port_origin_cost'),
    			"variable_mark_up_cat_8" => (double) $this->input->post('picklist_mark_up'),
    			"picklist_ratevalue" => (double) $this->input->post('picklist_ratevalue'),
    			"fob_price" => (double) $this->input->post('fob_price'),
    			"updated_price" => "TRUE",
    			"date" => date('Y-m-d'),
    	];
    	
    	if ( $this->model_costing->update( $arr_data, array( "id" => $costingid) ) ) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function getFOB_price( 
    		$costing, 
    		$costingcategories, 
    		$costingcategories_notdirect, 
    		$rate, 
    		$profit_percentage, 
    		$port_origin_cost, 
    		$fixed_cost, 
    		$variable_cost, 
    		$port_origin_cost, 
    		$picklist_mark_up,
    		$picklist_ratevalue
    	){
    	
    	$costingid = $costing->id;
    	
    	if( empty($profit_percentage) ){
    		$profit_percentage = @$costing->profit_percentage;
    	}
    	if( empty($port_origin_cost) ){
    		$port_origin_cost = @$costing->port_origin_cost;
    	}
    	if( empty($fixed_cost) ){
    		$fixed_cost = @$costing->fixed_cost;
    	}
    	if( empty($variable_cost) ){
    		$variable_cost = @$costing->variable_cost;
    	}
    	if( empty($port_origin_cost) ){
    		$port_origin_cost = @$costing->port_origin_cost;
    	}
    	if( empty($picklist_mark_up) ){
    		$picklist_mark_up = @$costing->variable_mark_up_cat_8;
    	}
    	
    
    	$directmaterialtotal = 0;
    	$subtotal = 0;
    	foreach ( $costingcategories as $costingcategory ) {
    		// render costing
    		$costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId( $costingid, $costingcategory->id );
    
    		$subtotal = 0;
    		$total_in_usd = 0;
    		foreach ( $costingdetail as $result ) {
    			if (@$result->qty <= 0 || @$result->qty == '')
    				continue;
    					
    				$req_qty = $result->req_qty;
    				if ((empty( $result->yield ) || $result->yield <= 0)) {
    
    					if ($result->allowance < 0) {
    						$req_qty = 0;
    					}
    				}
    					
    				$unitpricerp = number_format( $result->unitpricerp, 3, '.', ',' );
    				if ($result->unitpriceusd != 0) {
    					$unitpricerp = number_format( ($result->unitpriceusd * $rate), 3, '.', '' );
    				}
    					
    				$unitpriceusd = number_format( ($result->unitpricerp / $rate), 3, '.', '' );
    				if ($result->unitpriceusd != 0) {
    					$unitpriceusd = $result->unitpriceusd;
    				}
    					
    				$total_in_usd = number_format( ($unitpriceusd * $req_qty), 3, '.', ',' );
    					
    				$subtotal = $subtotal + $total_in_usd;
    		}
    		$directmaterialtotal += $subtotal;
    	}
    
    	/**
    	 *  Costing not direct material
    	 */
    
    	$sum_not_direct = array ();
    	
    	$rate_tmp = $rate;
    	
    	foreach ( $costingcategories_notdirect as $costingcategory ) {
    		$costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId( $costingid, $costingcategory->id );
    		$subtotal = 0;
    		$total_in_usd = 0;
    		
    		if( $costingcategory->id == 8 ){
    			$rate_tmp = $picklist_ratevalue;
    		}else{
    			$rate_tmp = $rate;
    		}
    		
    		foreach ( $costingdetail as $result ) {
    				
    			if (@$result->qty <= 0 || @$result->qty == '')
    				continue;
    					
    				$req_qty = $result->req_qty;
    					
    				if ((empty( $result->yield ) || $result->yield <= 0)) {
    
    					if ($result->allowance < 0) {
    						$req_qty = 0;
    					}
    				}
    					
    				$unitpricerp = number_format( $result->unitpricerp, 3, '.', ',' );
    				if ($result->unitpriceusd != 0) {
    					$unitpricerp = number_format( ($result->unitpriceusd * $rate_tmp ), 3, '.', '' );
    				}
    					
    				$unitpriceusd = number_format( ($result->unitpricerp / $rate_tmp ), 3, '.', '' );
    				if ( $result->unitpriceusd != 0 ) {
    					$unitpriceusd = $result->unitpriceusd;
    				}
    				$total_in_usd = number_format( ($unitpriceusd * $req_qty), 3, '.', ',' );
    				$subtotal = $subtotal + $total_in_usd;
    		}
    		$sum_not_direct [ $costingcategory->id ] = $subtotal;
    	}
    
    	$noname = round( (100 - ($fixed_cost + $variable_cost + $profit_percentage)) / 100, 3 );
    	$factory_cost_and_profit = round( (($directmaterialtotal + $sum_not_direct [9]) / $noname), 3 );
    
    	if (! empty( $picklist_mark_up )) {
    		$sum_not_direct [8] = round( ($sum_not_direct [8] * $picklist_mark_up), 3 );
    	}
    	$port_origin_cost = round( ($factory_cost_and_profit * $port_origin_cost) / 100, 3 );
    	$subtotal_ = round( $sum_not_direct [8] + $sum_not_direct [10] + $port_origin_cost, 3 );
    	$fob_price = round( $subtotal_ + $factory_cost_and_profit, 3 );
        
    	return $fob_price;
    }

    //code
    function getFobFromMargin($margin, $direct_material, $direct_labor, $subtotal) {
        //$fob_temp = (82 * $margin) - 82;
        return (($margin * $subtotal) - (82 * $subtotal) + (100 * $direct_material) - (100 * $direct_labor)) / ($margin-82);
    }

    function fixCurrencyFixPriceMarginConditional($costing) {

        $margin_fob = $this->getMargin($costing);
        return array(
            'old_result' => $margin_fob['old_result'],
            'new_result' => $margin_fob['new_result'],
            'fob_old' => $margin_fob['fob_old'],
            'fob_new' => $margin_fob['fob_old'],
        ); 
    }
    
    function currencyConditionalFixPriceMarginConditional($ratevalue, $margin, $costing, $picklist_ratevalue) {
        $costingcategory = $this->model_costing->selectCostingCategoryDirectMaterial();
        $costingcategorynotdirect = $this->model_costing->selectCostingCategoryNotDirectMaterial();

        $direct_material_new = $this->direct_material_total_new($costing->id, $costingcategory, $costing, $ratevalue);
        $sum_not_direct_new = $this->mapping_sum_not_direct_new($costing->id, $costingcategorynotdirect, $costing, $ratevalue, $picklist_ratevalue);
        $noname = round( (100 - ($costing->fixed_cost + $costing->variable_cost + $costing->profit_percentage)) / 100 , 3);

        $directmaterialtotal_old = $this->direct_material_total($costing->id, $costingcategory, $costing);
        $sum_not_direct_old = $this->mapping_sum_not_direct($costing->id, $costingcategorynotdirect, $costing);

        // ====================

        $factory_cost_and_profit_new = round( ( ( $direct_material_new + $sum_not_direct_new[9]) / $noname), 3);
        $port_origin_cost_new = round( ($factory_cost_and_profit_new * $costing->port_origin_cost) / 100 , 3);

        $factory_cost_and_profit_old = round( ( ( $directmaterialtotal_old + $sum_not_direct_old[9]) / $noname), 3);
        $port_origin_cost_old = round( ($factory_cost_and_profit_old * $costing->port_origin_cost) / 100 , 3);

        // ===================

        $subtotal_new = $this->getSubTotal($sum_not_direct_new, $port_origin_cost_new);
        $subtotal_old = $this->getSubTotal($sum_not_direct_old, $port_origin_cost_old);

        $direct_labor_new = $sum_not_direct_new[9];
        $new_fob = $this->getFobFromMargin($margin, $direct_material_new, $direct_labor_new, $subtotal_new);
        $old_fob = round($subtotal_old + $factory_cost_and_profit_old, 3);
        
        return array(
            'old_result' => $old_fob,
            'new_result' => $new_fob,
            'old_fob' => $old_fob,
            'new_fob' => $new_fob
        );
    }

    function getMargin($costing, $ratevalue = null, $picklist_ratevalue = null) {
        $costingcategory = $this->model_costing->selectCostingCategoryDirectMaterial();
        $costingcategorynotdirect = $this->model_costing->selectCostingCategoryNotDirectMaterial();
        
        $directmaterialtotal = $this->direct_material_total_new($costing->id, $costingcategory, $costing, $ratevalue);
        $sum_not_direct = $this->mapping_sum_not_direct_new($costing->id, $costingcategorynotdirect, $costing, $ratevalue, $picklist_ratevalue);

        $directmaterialtotal_old = $this->direct_material_total($costing->id, $costingcategory, $costing);
        $sum_not_direct_old = $this->mapping_sum_not_direct($costing->id, $costingcategorynotdirect, $costing);
        $noname = round( (100 - ($costing->fixed_cost + $costing->variable_cost + $costing->profit_percentage)) / 100 , 3);
        $factory_cost_and_profit_new = round( ( ( $directmaterialtotal + $sum_not_direct[9]) / $noname), 3);
        $port_origin_cost_new = round( ($factory_cost_and_profit_new * $costing->port_origin_cost) / 100 , 3);

        $factory_cost_and_profit_old = round( ( ( $directmaterialtotal_old + $sum_not_direct_old[9]) / $noname), 3);
        $port_origin_cost_old = round( ($factory_cost_and_profit_old * $costing->port_origin_cost) / 100 , 3);

        $subtotal_new = $this->getSubTotal($sum_not_direct, $port_origin_cost_new);
        $subtotal_old = $this->getSubTotal($sum_not_direct_old, $port_origin_cost_old);

        $fob_price_new = round($subtotal_new + $factory_cost_and_profit_new, 3);
        $fob_price_old = round($subtotal_old + $factory_cost_and_profit_old, 3);


        $old_margin =  $this->review_profit_margin($directmaterialtotal_old, $sum_not_direct_old[9], $fob_price_old, $subtotal_old);
        $new_margin =  $this->review_profit_margin($directmaterialtotal, $sum_not_direct[9], $fob_price_new, $subtotal_new);

        $margin = array(
            'old_result' => $old_margin,
            'new_result' => $new_margin,
            'fob_old' => $fob_price_old,
            'fob_new' => $fob_price_new,
        ); 

        return $margin;
    }

    function getSubTotal($sum_not_direct, $port_origin_cost) {
        return round( $sum_not_direct[8] + $sum_not_direct[10] + $port_origin_cost ,3);
    }

    function mapping_sum_not_direct($id, $costingcategorynotdirect, $costing) {
        $sum_not_direct = array();
        
        $ratevalue = $costing->ratevalue;
        
        foreach ($costingcategorynotdirect as $costingcategory) {
            $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
            $subtotal   = 0;
            $total_in_usd = 0;
            
            if( $costingcategory->id == 8 ){
                $ratevalue = $costing->picklist_ratevalue;
            }else{
                $ratevalue = $costing->ratevalue;
            }

            foreach ($costingdetail as $result) {
                
                if( $result->qty <= 0 || $result->qty == '' )
                    continue;
                
                $req_qty = $result->req_qty;
                
                if( (empty($result->yield) || $result->yield <= 0 )  ){
                    
                    if( $result->allowance < 0 ){
                        $req_qty = 0;
                    }
                    
                }
                $unitpriceusd = $result->unitpricerp / $ratevalue;
                if ($result->unitpriceusd != 0) {
                    $unitpriceusd = $result->unitpriceusd;
                }
                
                $total_in_usd = $unitpriceusd * $req_qty;
                        
                $subtotal = $subtotal + $total_in_usd;
            }
            $sum_not_direct[$costingcategory->id] = $subtotal;
        }

        return $sum_not_direct;
    }

    function direct_material_total($id, $costingcategory, $costing) {
        $directmaterialtotal = 0;
        $subtotal = 0;
        foreach ($costingcategory as $costingcategory) {
            $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
            $subtotal = 0;
            $total_in_usd = 0;
            foreach ($costingdetail as $result) {
                
                if( $result->qty <= 0 || $result->qty == '' )
                    continue;
                
                $req_qty = $result->req_qty;
                if( (empty($result->yield) || $result->yield <= 0 )  ){
                    
                    if( $result->allowance < 0 ){
                        $req_qty = 0;
                    }
                } 

                $unitpricerp = $result->unitpricerp;
                if ($result->unitpriceusd != 0) {
                    $unitpricerp = ($result->unitpriceusd * $costing->ratevalue);
                }
                   
                $unitpriceusd = ($result->unitpricerp / $costing->ratevalue);
                if ($result->unitpriceusd != 0) {
                    $unitpriceusd = $result->unitpriceusd;
                }
                $total_in_usd = $unitpriceusd * $req_qty;
                $subtotal = $subtotal + $total_in_usd;
            }
            $directmaterialtotal += $subtotal;
            
        }

        return $directmaterialtotal;
    }

    function direct_material_total_new($id, $costingcategory, $costing, $ratevalue) {
        $directmaterialtotal = 0;
        $subtotal = 0;
        if($ratevalue == null) {
            $ratevalue = $costing->ratevalue;
        }

        foreach ($costingcategory as $costingcategory) {
            $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
            $subtotal = 0;
            $total_in_usd = 0;
            foreach ($costingdetail as $result) {
                $item = $this->model_item->getByPartNumber($result->itemid);

                $unitpriceusd = $this->convert_price($item, $ratevalue, $result);

                if( $result->qty <= 0 || $result->qty == '' )
                    continue;
                
                $req_qty = $result->req_qty;
                if( (empty($result->yield) || $result->yield <= 0 )  ){
                    
                    if( $result->allowance < 0 ){
                        $req_qty = 0;
                    }
                } 
                $unitpriceusd = $unitpriceusd;
                
                $total_in_usd = ($unitpriceusd * $req_qty);
                        
                $subtotal = $subtotal + $total_in_usd;
            }
            $directmaterialtotal += $subtotal;
        }

        return $directmaterialtotal;
    } 

    function mapping_sum_not_direct_new($id, $costingcategorynotdirect, $costing, $ratevalue, $picklist_ratevalue) {
        $sum_not_direct = array();
        
        foreach ($costingcategorynotdirect as $costingcategory) {
            $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
            $subtotal   = 0;
            $total_in_usd = 0;

            if($ratevalue != null) {
                $ratevalue = $costingcategory->id == 8 ? $picklist_ratevalue : $ratevalue;
            } else {
                $ratevalue = $costingcategory->id == 8 ? $costing->picklist_ratevalue : $costing->ratevalue;
            }

            foreach ($costingdetail as $result) {
                $item = $this->model_item->getByPartNumber($result->itemid);
                $unitpriceusd = $this->convert_price($item, $ratevalue, $result);

                if( $result->qty <= 0 || $result->qty == '' )
                    continue;
                
                $req_qty = $result->req_qty;
                
                if( (empty($result->yield) || $result->yield <= 0 )  ){
                    
                    if( $result->allowance < 0 ){
                        $req_qty = 0;
                    }
                    
                }
                $unitpriceusd = $unitpriceusd;
                $total_in_usd = $unitpriceusd * $req_qty;
                        
                $subtotal = $subtotal + $total_in_usd;
            }
            $sum_not_direct[$costingcategory->id] = $subtotal;
        }

        return $sum_not_direct;
    }

    

    function review_profit_margin($direct_material, $direct_labor, $fob, $subtotal) {
        $direct_total = ($direct_material + $direct_labor) * 100;
        $fob_subtotal_temp = $fob - $subtotal;
        if($fob_subtotal_temp == 0) return 0;
        $fob_subtotal = $fob_subtotal_temp * 82;
        $result_calculate = $fob_subtotal - $direct_total;
        $profit_margin = (double)$result_calculate / (double)$fob_subtotal_temp;
        return $profit_margin;
    } 

    function convert_price($item, $ratevalue, $costingdetail) { 
        if($item->curr == 'IDR')
            return $item->price / $ratevalue;
        
        return $item->price;
    }


}
