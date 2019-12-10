<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_costing
 *
 * @author hp
 */
class model_costing extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = "select 
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
                model.dd,
                model.dw,
                model.dht,
                customer.name customername
                from costing
                join model on costing.modelid=model.id
                join customer on costing.customerid=customer.id order by costing.id desc";
        return $this->db->query($query)->result();
    }
    
    function selectAllModel() {
    	$query = "select
					model.no as modelcode,
					model.custcode,
					model.description,
					model.filename,
					customer.name customername
				from costing
				join model on costing.modelid=model.id
				join customer on costing.customerid=customer.id
				order by (case when costing.date is null then 0 else 1 end) desc, costing.date desc ";
    	return $this->db->query($query)->result();
    }

    function getNumRows($code, $custcode, $customerid, $datefrom, $dateto, $is_over_due) {
        $query = "select count(1) as total
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id where true ";
        if ($code != '') {
            $query .= " and model.no ilike '%$code%'";
        }if ($custcode != '') {
            $query .= " and model.custcode ilike '%$custcode%'";
        }if ($customerid != '' && $customerid != 0) {
            $query .= " and costing.customerid=$customerid";
        }if ($datefrom != '' && $dateto == '') {
            $query .= " and costing.date='$datefrom'";
        }if ($datefrom != '' && $dateto != '') {
            $query .= " and costing.date between '$datefrom' and '$dateto'";
        }if ($datefrom == '' && $dateto != '') {
            $query .= " and costing.date='$dateto'";
        }
        
        if ( $is_over_due == "true") {
        	$query .= " and costing.date < now() - '1 years'::interval " ;
        }
        
        return $this->db->query($query)->row()->total;
    }

    function getNumRows_pricelist($model_codes, $code, $custcode, $customerid, $datefrom, $dateto, $is_over_due) {
    	$query = "select count(1) as total
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id ";
    	 
    	$where_query = "";
    	$where_query_modelcodes="";
    	 
    	$codes = [];
    	$code = trim($code);
    	 
    	if( !empty($code) ){
    		$codes = explode(',', $code );
    	}
    	 
    	if( count($codes) > 0 ){
    		$where_query .= " and ( ";
    		$i = 1;
    		foreach ($codes as $code){
    			$where_query .= "  model.no ilike '%". trim($code) ."%'";
    			if( $i < count($codes) ){
    				$where_query .= " or ";
    			}
    			$i+=1;
    		}
    		$where_query .= " ) ";
    	}
    	 
    	if ($custcode != '') {
    		$where_query .= " and model.custcode ilike '%$custcode%'";
    	}if ($customerid != '' && $customerid != 0) {
    		$where_query .= " and costing.customerid=$customerid";
    	}if ($datefrom != '' && $dateto == '') {
    		$where_query .= " and costing.date='$datefrom'";
    	}if ($datefrom != '' && $dateto != '') {
    		$where_query .= " and costing.date between '$datefrom' and '$dateto'";
    	}if ($datefrom == '' && $dateto != '') {
    		$where_query .= " and costing.date='$dateto'";
    	}
    	 
    	if ( is_array($model_codes) && count($model_codes) > 0 ) {
    		//extract where in
    		$in_sql = "";
    		$in_cointer = 1;
    		$model_codes_length = count($model_codes);
    		foreach ($model_codes as $model_code){
    			$in_sql .= "'". $model_code ."'";
    			if( $in_cointer < $model_codes_length ){
    				$in_sql .= " , ";
    			}
    			$in_cointer +=1;
    		}
    		$where_query_modelcodes = " model.no in (" . $in_sql . ") ";
    	}
    	 
    	if(empty( $where_query )){
    		if( !empty($where_query_modelcodes) ){
    			$query .= " where " . $where_query_modelcodes ;
    		}
    	}else{
    		if( !empty($where_query_modelcodes) ){
    			$where_query = " where (true " . $where_query . ")";
    			$query .= $where_query . " or " . $where_query_modelcodes ;
    		}else{
    			$query .= " where true " . $where_query ;
    		}
    	}
    	 
    	if ( $is_over_due == "true") {
    		if( empty( $where_query ) && empty($where_query_modelcodes) ){
    			$query .= " where costing.date < now() - '1 years'::interval " ;
    		}else{
    			$query .= " and costing.date < now() - '1 years'::interval " ;
    		}
    	}
    	 
    	return $this->db->query($query)->row()->total;
    }
    
    function getCountOverDue(){
    	$query = "select count(1) as total from costing where date < now() - '1 years'::interval";
    	$data = $this->db->query($query)->row();
    	
    	return @$data->total;
    }
    
    function search($code, $custcode, $customerid, $datefrom, $dateto, $is_over_due, $limit, $offset) {
        $query = "select 
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
        		model.is_temporary_photo,
        		model.finishoverview,
        		model.constructionoverview,
                model.dd,
                model.dw,
                model.dht,
        		
                model.nw,
                model.gw,
                
        		customer.name customername,
        		
        		(select name as checkedby_name from employee where employee.id=costing.checkedby), 
				(select name as approvedby_name from employee where employee.id=costing.approvedby)
        		
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id where true ";
        if ($code != '') {
            $query .= " and model.no ilike '%$code%'";
        }if ($custcode != '') {
            $query .= " and model.custcode ilike '%$custcode%'";
        }if ($customerid != '' && $customerid != 0) {
            $query .= " and costing.customerid=$customerid";
        }if ($datefrom != '' && $dateto == '') {
            $query .= " and costing.date='$datefrom'";
        }if ($datefrom != '' && $dateto != '') {
            $query .= " and costing.date between '$datefrom' and '$dateto'";
        }if ($datefrom == '' && $dateto != '') {
            $query .= " and costing.date='$dateto'";
        }
        
        if ( $is_over_due == "true") {
        	$query .= " and costing.date < now() - '1 years'::interval " ;
        }
        
        $query .= " order by costing.id desc limit $limit offset $offset";
        
        return $this->db->query($query)->result();
    }
    
    function search_and_get_all($code, $custcode, $customerid, $datefrom, $dateto, $is_over_due) {
    	$query = "select
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
    			model.is_temporary_photo,
        		model.finishoverview,
        		model.constructionoverview,
                model.dd,
                model.dw,
                model.dht,
    
                model.nw,
                model.gw,
    
        		customer.name customername
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id where true ";
    	if ($code != '') {
    		$query .= " and model.no ilike '%$code%'";
    	}if ($custcode != '') {
    		$query .= " and model.custcode ilike '%$custcode%'";
    	}if ($customerid != '' && $customerid != 0) {
    		$query .= " and costing.customerid=$customerid";
    	}if ($datefrom != '' && $dateto == '') {
    		$query .= " and costing.date='$datefrom'";
    	}if ($datefrom != '' && $dateto != '') {
    		$query .= " and costing.date between '$datefrom' and '$dateto'";
    	}if ($datefrom == '' && $dateto != '') {
    		$query .= " and costing.date='$dateto'";
    	}
    	
    	if ( $is_over_due == "true") {
    		$query .= " and costing.date < now() - '1 years'::interval " ;
    	}
    	
    	$query .= " order by costing.id desc ";
    	return $this->db->query($query)->result();
    }
    
    function search_for_pricelist($model_codes, $code, $custcode, $customerid, $datefrom, $dateto, $is_over_due, $limit, $offset) {
        $query = "select 
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
        		model.is_temporary_photo,
        		model.finishoverview,
        		model.constructionoverview,
                model.dd,
                model.dw,
                model.dht,
        		
                model.nw,
                model.gw,
                
        		customer.name customername
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id ";
        
        $where_query = "";
        $where_query_modelcodes="";
        
        $codes = [];
        $code = trim($code);
        
        if( !empty($code) ){
	        $codes = explode(',', $code );
        }
        
        if( count($codes) > 0 ){
        	$where_query .= " and ( ";
        	$i = 1;
	        foreach ($codes as $code){
	        	$where_query .= "  model.no ilike '%". trim($code) ."%'";
	        	if( $i < count($codes) ){
	        		$where_query .= " or ";
	        	}
	        	$i+=1;
	        }
        	$where_query .= " ) ";
        }
        
        if ($custcode != '') {
            $where_query .= " and model.custcode ilike '%$custcode%'";
        }if ($customerid != '' && $customerid != 0) {
            $where_query .= " and costing.customerid=$customerid";
        }if ($datefrom != '' && $dateto == '') {
            $where_query .= " and costing.date='$datefrom'";
        }if ($datefrom != '' && $dateto != '') {
            $where_query .= " and costing.date between '$datefrom' and '$dateto'";
        }if ($datefrom == '' && $dateto != '') {
            $where_query .= " and costing.date='$dateto'";
        }
        
        if ( is_array($model_codes) && count($model_codes) > 0 ) {
            //extract where in
            $in_sql = "";
            $in_cointer = 1;
            $model_codes_length = count($model_codes);
            foreach ($model_codes as $model_code){
            	$in_sql .= "'". $model_code ."'";
            	if( $in_cointer < $model_codes_length ){
            		$in_sql .= " , ";
            	}
            	$in_cointer +=1;
            }
            $where_query_modelcodes = " model.no in (" . $in_sql . ") ";
        }
        
        if(empty( $where_query )){
        	if( !empty($where_query_modelcodes) ){
        		$query .= " where " . $where_query_modelcodes ;
        	}
        }else{
        	if( !empty($where_query_modelcodes) ){
	        	$where_query = " where (true " . $where_query . ")";
	        	$query .= $where_query . " or " . $where_query_modelcodes ;
        	}else{
        		$query .= " where true " . $where_query ;
        	}
        }
        
        if ( $is_over_due == "true") {
        	if( empty( $where_query ) && empty($where_query_modelcodes) ){
        		$query .= " where costing.date < now() - '1 years'::interval " ;
        	}else{
	        	$query .= " and costing.date < now() - '1 years'::interval " ;
        	}
        }
        
        $query .= " order by costing.id desc limit $limit offset $offset";

        return $this->db->query($query)->result();
    }
    
    function search_and_get_all_for_pricelist($model_codes, $code, $custcode, $customerid, $datefrom, $dateto, $is_over_due) {
        $query = "select 
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
        		model.is_temporary_photo,
        		model.finishoverview,
        		model.constructionoverview,
                model.dd,
                model.dw,
                model.dht,
        		
                model.nw,
                model.gw,
                
        		customer.name customername
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id";
    $where_query = "";
        $where_query_modelcodes="";
        
        $codes = [];
        $code = trim($code);
        
        if( !empty($code) ){
	        $codes = explode(',', $code );
        }
        
        if( count($codes) > 0 ){
        	$where_query .= " and ( ";
        	$i = 1;
	        foreach ($codes as $code){
	        	$where_query .= "  model.no ilike '%". trim($code) ."%'";
	        	if( $i < count($codes) ){
	        		$where_query .= " or ";
	        	}
	        	$i+=1;
	        }
        	$where_query .= " ) ";
        }
        
        if ($custcode != '') {
            $where_query .= " and model.custcode ilike '%$custcode%'";
        }if ($customerid != '' && $customerid != 0) {
            $where_query .= " and costing.customerid=$customerid";
        }if ($datefrom != '' && $dateto == '') {
            $where_query .= " and costing.date='$datefrom'";
        }if ($datefrom != '' && $dateto != '') {
            $where_query .= " and costing.date between '$datefrom' and '$dateto'";
        }if ($datefrom == '' && $dateto != '') {
            $where_query .= " and costing.date='$dateto'";
        }
        
        if ( is_array($model_codes) && count($model_codes) > 0 ) {
            //extract where in
            $in_sql = "";
            $in_cointer = 1;
            $model_codes_length = count($model_codes);
            foreach ($model_codes as $model_code){
            	$in_sql .= "'". $model_code ."'";
            	if( $in_cointer < $model_codes_length ){
            		$in_sql .= " , ";
            	}
            	$in_cointer +=1;
            }
            $where_query_modelcodes = " model.no in (" . $in_sql . ") ";
        }
        
        if(empty( $where_query )){
        	if( !empty($where_query_modelcodes) ){
        		$query .= " where " . $where_query_modelcodes ;
        	}
        }else{
        	if( !empty($where_query_modelcodes) ){
	        	$where_query = " where (true " . $where_query . ")";
	        	$query .= $where_query . " or " . $where_query_modelcodes ;
        	}else{
        		$query .= " where true " . $where_query ;
        	}
        }
        
    	if ( $is_over_due == "true") {
        	if( empty( $where_query ) && empty($where_query_modelcodes) ){
        		$query .= " where costing.date < now() - '1 years'::interval " ;
        	}else{
	        	$query .= " and costing.date < now() - '1 years'::interval " ;
        	}
        }
        
        $query .= " order by costing.id desc ";
        
        return $this->db->query($query)->result();
    }

    function addfromrequestmodel($modelid, $customerid) {
        return $this->db->insert("costing", array("modelid" => $modelid, "customerid" => $customerid));
    }

    function updatefromrequest($id, $rateid, $ratevalue, $fixed_cost, $variable_cost, $profit_percentage, $port_origin_cost, $date) {
        return $this->db->update('costing', array(
                    "rateid" => $rateid,
                    "ratevalue" => $ratevalue,
                    "fixed_cost" => $fixed_cost,
                    "variable_cost" => $variable_cost,
                    "profit_percentage" => $profit_percentage,
                    "port_origin_cost" => $port_origin_cost,
                    "date" => $date
                        ), array("id" => $id));
    }

    function savenew($customerid, $modelid, $rateid, $ratevalue, $fixed_cost, $variable_cost, $profit_percentage, $port_origin_cost, $date, $preparedby="",$checkedby="",$approvedby="") {
        return $this->db->insert('costing', array(
                    "modelid" => $modelid,
                    "customerid" => $customerid,
                    "rateid" => $rateid,
                    "ratevalue" => $ratevalue,
                    //"picklist_rateid" => $rateid,
                    "picklist_ratevalue" => $ratevalue,
                    "fixed_cost" => $fixed_cost,
                    "variable_cost" => $variable_cost,
                    "profit_percentage" => $profit_percentage,
                    "port_origin_cost" => $port_origin_cost,
                    "date" => $date,
        		
	        		'preparedby' => $preparedby,
	        		'checkedby' => $checkedby,
	        		'approvedby' => $approvedby
        		
                ));
    }

    function selectCostingByHeaderidAndCategoryId($costingheaderid, $category) {
        $query = "select * from costingdetail where costingid=$costingheaderid and categoryid=$category order by materialcode asc";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = "select 
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
                model.is_temporary_photo,
                model.dd,
                model.dw,
                model.dht,
                customer.name customername,
                
                (select name as checkedby_name from employee where employee.id=costing.checkedby), 
				(select name as approvedby_name from employee where employee.id=costing.approvedby)
                
                from costing
                left join model on costing.modelid=model.id
                left join customer on costing.customerid=customer.id where costing.id=$id";
        return $this->db->query($query)->row();
    }

    function selectDetailById($id) {
        $query = "select * from costingdetail where id=$id";
        return $this->db->query($query)->row();
    }

    function savedetail($costingid, $categoryid, $materialcode, $materialdescription, $uom, $qty, $yield, $allowance, $req_qty, $unitpricerp, $unitpriceusd) {
        return $this->db->insert('costingdetail', array(
                    "materialcode" => $materialcode,
                    "materialdescription" => $materialdescription,
                    "uom" => $uom,
                    "qty" => $qty,
                    "yield" => $yield,
                    "allowance" => $allowance,
                    "req_qty" => $req_qty,
                    "unitpricerp" => $unitpricerp,
                    "unitpriceusd" => $unitpriceusd,
                    "costingid" => $costingid,
                    "categoryid" => $categoryid
                ));
    }
    
    function savedetail_from_printout( $objNewMaterial ) {
    	$unitpricerp = (double) @$objNewMaterial->unitpricerp;
    	$unitpriceusd = (double) @$objNewMaterial->unitpriceusd;
    	
    	if( @$objNewMaterial->curr_costing_price == 'USD' ){
    		$unitpricerp = 0;
    	}else{
    		$unitpriceusd = 0;
    	}
    	
    	$this->db->insert('costingdetail', array(
    			"costingid" => @$objNewMaterial->costingid,
    			"categoryid" => @$objNewMaterial->categoryid,
    			"itemid" => @$objNewMaterial->itemid,
    			"materialcode" => @$objNewMaterial->materialcode,
    			"materialdescription" => @$objNewMaterial->materialdescription,
    			"uom" => @$objNewMaterial->uom,
    			"qty" => (double) @$objNewMaterial->qty,
    			"yield" => (double) @$objNewMaterial->yield,
    			"allowance" => (double) @$objNewMaterial->allowance,
    			"req_qty" => (double) @$objNewMaterial->req_qty,
    			"unitpricerp" => $unitpricerp,
    			"unitpriceusd" => $unitpriceusd,
    			"total" => (double) @$objNewMaterial->total,
    			"source" => @$objNewMaterial->source,
    	));
    	
    	return $this->db->insert_id();
    }

    function deletedetail($id) {
        $query = "delete from costingdetail where id=$id";
        //echo $query;
        return $this->db->query($query);
    }

    function move($id, $category) {
        $this->db->where("id", $id);
        $this->db->update('costingdetail', array(
            "categoryid" => $category
        ));
    }

    function updatedetail($id, $materialcode, $materialdescription, $uom, $qty, $yield, $allowance, $req_qty, $unitpricerp, $unitpriceusd, $itemid) {
        $this->db->where("id", $id);
        $this->db->update('costingdetail', array(
            "materialcode" => $materialcode,
            "materialdescription" => $materialdescription,
            "uom" => $uom,
            "qty" => $qty,
            "yield" => $yield,
            "allowance" => $allowance,
            "req_qty" => $req_qty,
            "unitpricerp" => $unitpricerp,
            "unitpriceusd" => $unitpriceusd,
            "itemid" => $itemid
        ));
    }
    
    function updatedetail_from_printout( $objMaterial ) {
    	$this->db->where("id", $objMaterial->id);
    	
    	$allowance = (@$objMaterial->allowance == "" || @$objMaterial->allowance == null ) ? null : (double) @$objMaterial->allowance;
    	
        $this->db->update('costingdetail', array(
            "qty" => (double) @$objMaterial->qty,
            "yield" => empty( @$objMaterial->yield ) ? null : (double) @$objMaterial->yield,
            "allowance" => $allowance,
            "req_qty" => (double) @$objMaterial->req_qty,
            //"unitpriceusd" => (double) @$objMaterial->unitpriceusd,
        	"total" => (double) @$objMaterial->total,	
        	"source" => "Manual",
        ));
    }
    
    function update_price_from_printout( $objMaterial ) {
    	$this->db->where("id", $objMaterial->id);
    	
    	$price_usd = 0;
    	$price_rp = 0;
    	
    	if( @$objMaterial->curr_costing_price == "USD" ){
    		$price_usd = (double) @$objMaterial->unitpriceusd;
    	}else if( @$objMaterial->curr_costing_price == "IDR" ){
    		$price_rp = (double) @$objMaterial->unitpricerp;
    	}
    	
    	$this->db->update('costingdetail', array(
    			"unitpricerp" => $price_rp,
    			"unitpriceusd" => $price_usd,
    			"total" => (double) @$objMaterial->total,
    			"source" => "Manual"
    	));
    }
    
    function movedetail_from_printout( $objMovedMaterial ) {
    	$this->db->where("id", $objMovedMaterial->id);
        $this->db->update('costingdetail', array(
            "categoryid" => @$objMovedMaterial->move_to_category_id,
        ));
    }

    function approve($id) {
        return $this->db->update('costing', array("approve" => 'TRUE', "isreviewed" => 'TRUE', "date" => date('Y-m-d'), "needmodify" => 'FALSE'), array("id" => $id));
    }

    function getRateByCostingId($costingid) {
        $dt = $this->db->query("select ratevalue from costing where id=$costingid")->row();
        return $dt->ratevalue;
    }

    function savefobprice($data, $where) {
        return $this->db->update('costing', $data, $where);
    }

    function docopy($toid, $fromid) {
        return $this->db->query("select costing_docopy($toid,$fromid)");
    }

    function docopypart($toid, $fromid, $category) {
        $query = "select costing_docopypart($toid, $fromid, $category)";
        echo $query;
        return $this->db->query($query);
    }

    function loadfrommaterial($costingid, $costingcategory, $modelid) {
        $query = "select costing_loadfrommaterial($costingid,$costingcategory,$modelid)";
        return $this->db->query($query);
    }

    function loadAllMaterialFromBOM($costingid, $modelid) {
        $query = "select costing_load_all($costingid,$modelid)";
        return $this->db->query($query);
    }
    
    function loadAllMaterialFromDefaultMaterial($costingid) {
        $query = "select costing_load_all_from_default_material($costingid)";
        return $this->db->query($query);
    }

    function isExist($customerid, $modelid) {
        $dt = $this->db->query("select * from costing where customerid=$customerid and modelid=$modelid")->row();
        return (!empty($dt));
    }

    function isExist2($customerid, $modelid, $id) {
        $dt = $this->db->query("select * from costing where customerid=$customerid and modelid=$modelid and id!=$id")->row();
        return (!empty($dt));
    }

    function update($data, $where) {
    	return $this->db->update('costing', $data, $where);
    }
    
    
    function updateRateValue($costing_id, $ratevalue) {
        return $this->db->update('costing', array(
                    "ratevalue" => $ratevalue,
               ), array("id" => $costing_id));
    }
    
    function updatePicklistRateValue($costing_id, $picklist_ratevalue) {
        return $this->db->update('costing', array(
                    "picklist_ratevalue" => $picklist_ratevalue,
               ), array("id" => $costing_id));
    }

    function getPriceByCustomerAndModel($modelid, $customerid) {
        //echo "select fob_price from costing where modelid=$modelid and customerid=$customerid";

        return $this->db->query("select fob_price from costing where modelid=$modelid and customerid=$customerid")->row()->fob_price;
    }

    //============================

    function selectCostingCategoryDirectMaterial() {
        $query = "select * from costingcategory where isdirectmaterial =TRUE order by id asc";
        return $this->db->query($query)->result();
    }

    function selectCostingCategoryNotDirectMaterial() {
        $query = "select * from costingcategory where isdirectmaterial=FALSE order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllCostingCategory() {
        $query = "select * from costingcategory order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllHeader() {
        $query = "select 
            costingheader.*,
            so.number sonumber,
            so.date sodate,
            model.id modelid,
            model.no,
            model.description,
            model.dw,
            model.dd,
            model.dht,
            model.filename,
        	model.is_temporary_photo,
            model.custcode from costingheader 
            join model on costingheader.modelid=model.id 
            join so on costingheader.soid=so.id";
        return $this->db->query($query)->result();
    }

    function loadHardwareToCosting($costingheaderid, $soid, $modelid) {
        $this->db->query("select costing_loadhardware($costingheaderid,$soid,$modelid)");
    }

    function getIdByModelIdAndSoId($modelid, $soid) {
        $query = "select id from costingheader where modelid=$modelid and soid=$soid limit 1";
        $dt = $this->db->query($query)->result();
        return empty($dt) ? 0 : $dt->id;
    }

    function iscomplete($soid) {
        $dt = $this->db->query("select costing_iscomplete($soid) as ct")->row();
        return $dt->ct;
    }

    function iscompleteformanagement($soid) {
        $dt = $this->db->query("select costing_iscompleteformanagement($soid) as ct")->row();
        return $dt->ct;
    }

    function delete($id) {
        return $this->db->query("select costing_delete($id)");
    }

    function loaddirectlabour($id) {
        return $this->db->query("select costing_loaddirectlabour($id)");
    }

    function lock($costingid) {
        return $this->db->update('costing', array("locked" => "TRUE", "needmodify" => 'FALSE', "approve" => "FALSE"), array("id" => $costingid));
    }

    function unlock($costingid) {
        return $this->db->update('costing', array("locked" => "FALSE", "approve" => "FALSE"), array("id" => $costingid));
    }

    function updatematerialprice($costingid) {
        return $this->db->query("select costing_updatematerialprice($costingid)");
    }

    function searchcopycosting($modelcode, $custcode, $modeldescription, $customerid) {
        $query = "select 
                costing.*,
                model.no code,
                model.custcode,
                model.description,
                model.filename,
                model.dd,
                model.dw,
                model.dht,
                customer.name customername
                from costing
                join model on costing.modelid=model.id
                join customer on costing.customerid=customer.id ";
        if ($modelcode != '') {
            $query .= " and model.no ilike '%" . $modelcode . "%' ";
        }if ($custcode != '') {
            $query .= " and model.custcode ilike '%" . $custcode . "%' ";
        }if ($modeldescription != '') {
            $query .= " and model.description ilike '%" . $modeldescription . "%' ";
        }if ($customerid != 0) {
            $query .= " and costing.customerid=$customerid ";
        }
        $query .= " order by costing.id desc ";
        //echo $query;        
        return $this->db->query($query)->result();
    }

    function updatefobprice($costingid, $fobprice) {
        $this->db->update('costing', array("fob_price" => $fobprice), array("id" => $costingid));
    }

    function get_costing($model_no, $model_type, $cust_code) {

        $query = "select c.*,
                m.no code,
                m.custcode,
                m.description,
                m.filename,
                m.is_temporary_photo,
                m.finishoverview,
                m.constructionoverview,
                m.dd,
                m.dw,
                m.dht,
                m.nw,
                m.gw,
                customer.name customername
                from costing c
                left join customer on c.customerid=customer.id 
                left join model m on c.modelid=m.id
                left join modeltype mt on mt.id=m.modeltypeid
                where true";

        if($model_no != null) {
            $model_no = implode($model_no, "','");
            $query .= " AND m.no in ('" . $model_no . "')";
        } else if($model_type != null) {
            $query .= " AND mt.name in ('" . $model_type . "')";
        } else if($cust_code != null) {
            $query .= " AND m.custcode='$cust_code'";
        } else {
            $query .= " AND false";
        }

        return $this->db->query($query)->result();
    }
}

?>
