<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Model extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_model');
        $this->load->model('model_rfqdetail');
        $this->load->model('model_user');
    }

    public function index2() {
    	$this->load->view('model/view_detail');
    }
    public function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $offset = 0;
        $this->load->model('model_modeltype');
        $this->load->model('model_rfqdetail');
        $data['numberrequest'] = count($this->model_rfqdetail->selectRequestedModel());
        $data['modeltype'] = $this->model_modeltype->selectAll();
        $data['num_rows'] = $this->model_model->getNumRows("", "", 0, "");
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['offset'] = $offset;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['model'] = $this->model_model->search("", "", 0, "", $limit, $offset);
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        //$this->load->view('model/view', $data);
        $this->load->view('model/index', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $code = $this->input->post('code');
        $custcode = $this->input->post('custcode');
        $description = $this->input->post('description');
        $modeltypeid = $this->input->post('modeltypeid');
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        $data['num_rows'] = $this->model_model->getNumRows($code, $description, $modeltypeid, $custcode);
        $limit = $this->config->item('limit');
        
        if(empty($offset) || $offset < -1){
        	$offset = 0;
        }
        
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['model'] = $this->model_model->search($code, $description, $modeltypeid, $custcode, $limit, $offset);
        $this->load->view('model/search', $data);
    }

    function search2($offset) {
    	if(empty($offset) || $offset < -1){
    		$offset = 0;
    	}
        $id = $this->input->post('id');
        $temp = $this->input->post('temp');
        $code = $this->input->post('code');
        $custcode = $this->input->post('custcode');
        $description = $this->input->post('description');
        $modeltypeid = $this->input->post('modeltypeid');
        $billto = $this->input->post('billto');
        $data['id'] = $id;
        $data['temp'] = $temp;
        $data['billto'] = $billto;
        if ($billto == 0) {
            $data['num_rows'] = $this->model_model->getNumRows($code, $description, $modeltypeid, $custcode);
            $limit = $this->config->item('limit');
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['model'] = $this->model_model->searchAvailabel($code, $description, $modeltypeid, $custcode, $limit, $offset);
        } else {
            $data['model'] = [];// $this->model_model->selectAllFromCostingByCustomer($billto);
        }
        $this->load->view('model/search2', $data);
    }

    function create() {
        $this->load->model('model_category');
        $this->load->model('model_unit');
        $this->load->model('model_modeltype');
        $data['category'] = $this->model_category->selectAll();
        $data['unit'] = $this->model_unit->selectAll();
        $data['modeltype'] = $this->model_modeltype->selectAll();
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        $data['expose'] = $this->model_model->selectExpose();
        $data['internal'] = $this->model_model->selectInternal();
        $data['panel'] = $this->model_model->selectPanel();
        $data['veneer'] = $this->model_model->selectVeneer();
        $data['others'] = $this->model_model->selectOthers();
        $data['last_number'] = $this->model_model->getLastModelNumber();
        
        //$data['customer'] = $this->model_customer->selectListIdAndName();
        
        $this->load->view('model/create', $data);
    }

    function save() {
        $modelno = $this->input->post('modelno');
        $description = trim($this->input->post('description'));
        $w = (double) $this->input->post('w');
        $d = (double) $this->input->post('d');
        $ht = (double) $this->input->post('ht');
        $cw = (double) $this->input->post('cw');
        $cd = (double) $this->input->post('cd');
        $ch = (double) $this->input->post('ch');
        
        $gw = (double) $this->input->post('gw');
        $nw = (double) $this->input->post('nw');
        
        $color = $this->input->post('color');
        $volume_package = (double) $this->input->post('volume_package');
        $modeltypeid = $this->input->post('modeltypeid');
        $yield = (double) $this->input->post('yield');
        $custcode = $this->input->post('custcode');
        
        $preparedby = $this->input->post('preparedby');
        if(empty($preparedby) || $preparedby == "null"){
        	$preparedby = "";
        }
        
        $checkedby = $this->input->post('checkedby');
        $approvedby = $this->input->post('approvedby');
        
        $is_temporary_photo = $this->input->post('is_temporary_photo');
        
        $finishoverview = "{" . $this->input->post('finishoverview') . "}";
        $constructionoverview = "{" . $this->input->post('constructionoverview') . "}";
        
        //$modelno = str_replace(' ', '', $modelno);

        $file_element_name = 'fileupload';
        $upload_path = '';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        if (!file_exists( './files/' )) {
        	mkdir('./files/', 0777, true);
        }
        $this->load->library('upload', $config);
        
        $data_model = array(
            'no' => $modelno,
            'description' => $description,
            'color' => $color,
            'dw' => round($w, 3),
            'dd' => round($d, 3),
            'dht' => round($ht, 3),
            'cw' => round($cw, 3),
            'cd' => round($cd, 3),
            'ch' => round($ch, 3),
        		
            'gw' => round($gw, 3),
            'nw' => round($nw, 3),
        		
            'volumepackage' => round($volume_package, 3),
            'modeltypeid' => $modeltypeid,
            'yield' => round($yield, 3),
            'custcode' => $custcode,
            'finishoverview' => $finishoverview,
            'constructionoverview' => $constructionoverview,
            'preparedby' => $preparedby,
            'checkedby' => $checkedby,
            'approvedby' => $approvedby,
        	"is_temporary_photo" =>	$is_temporary_photo,
        );

        if (!$this->upload->do_upload($file_element_name)) {
            if ($this->model_model->insert($data_model)) {
                echo json_encode(array('nofile' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
                unlink($data['full_path']);
            }
        } else {
            $data = $this->upload->data();
            $data_model['filename'] = $data['file_name'];
            if ($this->model_model->insert($data_model)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
                unlink($data['full_path']);
            }
        }

        @unlink($_FILES[$file_element_name]);
    }

    function update() {
        $id = $this->input->post('id');
        $modelno = $this->input->post('modelno');
        $description = $this->input->post('description');
        $w = (double) $this->input->post('w');
        $d = (double) $this->input->post('d');
        $ht = (double) $this->input->post('ht');
        $cw = (double) $this->input->post('cw');
        $cd = (double) $this->input->post('cd');
        $ch = (double) $this->input->post('ch');
        
        $gw = (double) $this->input->post('gw');
        $nw = (double) $this->input->post('nw');
        
        $color = $this->input->post('color');
        $volume_package = (double) $this->input->post('volume_package');
        $modeltypeid = $this->input->post('modeltypeid');
        $yield = (double) $this->input->post('yield');
        $finishoverview = "{" . $this->input->post('finishoverview') . "}";
        $constructionoverview = "{" . $this->input->post('constructionoverview') . "}";
        
        $file_element_name = 'fileupload';
        $upload_path = '';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        if (!file_exists( './files/' )) {
        	mkdir('./files/', 0777, true);
        }
        $this->load->library('upload', $config);
        
//        $modelno = str_replace(' ', '', $modelno);
        $filename = $this->input->post('filename');
        $custcode = $this->input->post('custcode');

        $preparedby = $this->input->post('preparedby');
        if(empty($preparedby) || $preparedby == "null"){
        	$preparedby = "";
        }
        $checkedby = $this->input->post('checkedby');
        $approvedby = $this->input->post('approvedby');
        $is_temporary_photo = $this->input->post('is_temporary_photo');
        
        $data_model = array(
            'no' => $modelno,
            'description' => $description,
            'color' => $color,
            'dw' => round($w, 3),
            'dd' => round($d, 3),
            'dht' => round($ht, 3),
            'cw' => round($cw, 3),
            'cd' => round($cd, 3),
            'ch' => round($ch, 3),
        		
            'gw' => round($gw, 3),
            'nw' => round($nw, 3),
        		
            'volumepackage' => round($volume_package, 3),
            'filename' => $filename,
            'modeltypeid' => $modeltypeid,
            'yield' => round($yield, 3),
            'custcode' => $custcode,
            'finishoverview' => $finishoverview,
            'constructionoverview' => $constructionoverview,
        		
            'preparedby' => $preparedby,
            'checkedby' => $checkedby,
            'approvedby' => $approvedby,
            'is_temporary_photo' => $is_temporary_photo,
        );

        if ( $this->upload->do_upload($file_element_name) ) {
            $data = $this->upload->data();
            $data_model['filename'] = $data['file_name'];
            $filetodelete = "./files/" . $filename;
            if (file_exists($filetodelete)) {
            	@unlink($filetodelete);
            }
        }
        
        @unlink($_FILES[$file_element_name]);
        
        $this->model_model->update($data_model, array("id" => $id));
        
        echo json_encode(array('success' => true));
    }
    
    function delete($id) {
        try {
            $filename = $this->model_model->getFileNameModelById($id);
            if ($this->model_model->delete($id)) {
                unlink('./files/' . $filename);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function viewdetail($id) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $this->load->model('model_bom');
        $data['id'] = $id;
        $data['model'] = $this->model_model->selectById($id);
        $data['marble'] = $this->model_model->selectmarbleByModelId($id);
        $data['packing'] = $this->model_model->selectpackingByModelId($id);
        $data['glass'] = $this->model_model->selectGlassByModelId($id);
        $data['latherinlay'] = $this->model_model->selectlatherinlayByModelId($id);
        $data['hardwaretype'] = $this->model_model->selectTypeHardwareFormModelByModelId($id);
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        $data["upholstry"] = $this->model_model->selectItemHarwareByModelId($id, 3);
        $data["veneer"] = $this->model_model->selectVeneerByModelId($id);
        $data["solidwood"] = $this->model_model->selectSolidwoodByModelId($id);
        $data["plywood"] = $this->model_model->selectPlywoodByModelId($id);
        $this->load->view('model/view_detail', $data);
    }

    function viewitem($id) {
        $this->load->model('model_modelitem');
        $data['modelitem'] = $this->model_modelitem->selectByModelIdAndParentId($id);
        $this->load->view('model/viewitem', $data);
    }

    function addmaterial($modelid, $parentid) {
        $this->load->model('model_unit');
        $data['unit'] = $this->model_unit->selectAll();
        $data['modelid'] = $modelid;
        $data['parentid'] = $parentid;
        $this->load->view('model/addmaterial', $data);
    }

    function insertitem() {
        $this->load->model('model_modelitem');
        $modelid = $this->input->post('modelid');
        $parentid = $this->input->post('parentid');
        $itemid = $this->input->post('itemid');
        $description = $this->input->post('description');
        $unitid = $this->input->post('unitid');
        $qty = round($this->input->post('qty'), 3);
        $standardcost = $this->input->post('standardcost');
        $this->model_modelitem->insert($modelid, $parentid, $itemid, $description, $unitid, $qty, $standardcost);
    }

    function viewmodelwood($modelid) {
        $data['wood'] = $this->model_model->selectWoodByModelId($modelid);
        $this->load->view('model/wood', $data);
    }

    function deletemodelwood($id) {
        $this->model_model->deletemodelwood($id);
    }

    function setveneer($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setveneer', $data);
    }
    
    function editveneer($modelid, $id) {
    	$data['modelid'] = $modelid;
    	$data['veneer'] = $this->model_model->selectVeneerById($id);
    	$this->load->view('model/editveneer', $data);
    }
    
    function updateveneer() {
    	$location = $this->input->post('location');
    	$specifications = $this->input->post('specifications');
    	$yield = (double) $this->input->post('yield');
    	$cutting_list = (double) $this->input->post('cutting_list');
    	
    	$data = array(
    			"itemid" => $this->input->post('itemid'),
    			"unitid" => $this->input->post('unitid'),
    			//"thickness" => (double) $this->input->post('thickness'),
    			//"length" => (double) $this->input->post('length'),
    			//"width" => (double) $this->input->post('width'),
    			"qty" => round( (double) $this->input->post('qty'), 3),
    			"location" => $location,
    			"specifications" => $specifications,
    			"yield" => round( $yield, 3),
    			"cutting_list" => round( $cutting_list, 3),
    	);
    
    	if ($this->db->update("modelveneer", $data, array("id" => $this->input->post("id")))) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function deleteveneer($id) {
    	if ($this->model_model->deleteveneer($id)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function saveveneer() {
    	$modelid = $this->input->post('modelid');
    	$itemid = $this->input->post('itemid');
    	$unitid = $this->input->post('unitid');
    	$thickness = (double) $this->input->post('thickness');
    	$length = (double) $this->input->post('length');
    	$width = (double) $this->input->post('width');
    	$qty = (double) $this->input->post('qty');
    	$location = $this->input->post('location');
    	$specifications = $this->input->post('specifications');
    	$yield = (double) $this->input->post('yield');
    	$cutting_list = (double) $this->input->post('cutting_list');
    	$data = array(
    			"modelid" => $modelid,
    			"itemid" => $itemid,
    			"unitid" => $unitid,
    			"thickness" => round($thickness, 3),
    			"length" => round($length, 3),
    			"width" => round($width, 3),
    			"qty" => round($qty, 3),
    			"location" => $location,
    			"specifications" => $specifications,
    			"yield" => round( $yield, 3),
    			"cutting_list" => round( $cutting_list, 3),
    	);
    	if ($this->model_model->saveveneer($data)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function setsolidwood($modelid) {
    	$data['modelid'] = $modelid;
    	$this->load->view('model/setsolidwood', $data);
    }
    
    function editsolidwood($modelid, $id) {
    	$data['modelid'] = $modelid;
    	$data['solidwood'] = $this->model_model->selectSolidwoodById($id);
    	$this->load->view('model/editsolidwood', $data);
    }
    
    function updatesolidwood() {
    	$location = $this->input->post('location');
    	$specifications = $this->input->post('specifications');
    	$yield = (double) $this->input->post('yield');
    	$cutting_list = (double) $this->input->post('cutting_list');
    	
    	$data = array(
    			"itemid" => $this->input->post('itemid'),
    			"unitid" => $this->input->post('unitid'),
    			//"thickness" => (double) $this->input->post('thickness'),
    			//"length" => (double) $this->input->post('length'),
    			//"width" => (double) $this->input->post('width'),
    			"qty" => round( (double) $this->input->post('qty'), 3),
    			"location" => $location,
    			"specifications" => $specifications,
    			"yield" => round( $yield, 3),
    			"cutting_list" => round( $cutting_list, 3),
    	);
    
    	if ($this->db->update("modelsolidwood", $data, array("id" => $this->input->post("id")))) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function deletesolidwood($id) {
    	if ($this->model_model->deletesolidwood($id)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function savesolidwood() {
    	$modelid = $this->input->post('modelid');
    	$itemid = $this->input->post('itemid');
    	$unitid = $this->input->post('unitid');
    	$thickness = (double) $this->input->post('thickness');
    	$length = (double) $this->input->post('length');
    	$width = (double) $this->input->post('width');
    	$qty = (double) $this->input->post('qty');
    	$location = $this->input->post('location');
    	$specifications = $this->input->post('specifications');
    	$yield = (double) $this->input->post('yield');
    	$cutting_list = (double) $this->input->post('cutting_list');
    	
    	$data = array(
    			"modelid" => $modelid,
    			"itemid" => $itemid,
    			"unitid" => $unitid,
    			"thickness" => round($thickness, 3),
    			"length" => round($length,3),
    			"width" => round($width,3),
    			"qty" => round( $qty, 3),
    			"location" => $location,
    			"specifications" => $specifications,
    			"yield" => round($yield, 3),
    			"cutting_list" => round($cutting_list, 3),
    	);
    	if ($this->model_model->savesolidwood($data)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    
    //set plywood

    function setplywood($modelid) {
    	$data['modelid'] = $modelid;
    	$this->load->view('model/setplywood', $data);
    }
    
    function editplywood($modelid, $id) {
    	$data['modelid'] = $modelid;
    	$data['plywood'] = $this->model_model->selectPlywoodById($id);
    	$this->load->view('model/editplywood', $data);
    }
    
    function updateplywood() {
    	$location = $this->input->post('location');
    	$specifications = $this->input->post('specifications');
    	$yield = (double) $this->input->post('yield');
    	$cutting_list = (double) $this->input->post('cutting_list');
    	 
    	$data = array(
    			"itemid" => $this->input->post('itemid'),
    			"unitid" => $this->input->post('unitid'),
    			//"thickness" => (double) $this->input->post('thickness'),
    			//"length" => (double) $this->input->post('length'),
    			//"width" => (double) $this->input->post('width'),
    			"qty" => round((double) $this->input->post('qty'), 3),
    			"location" => $location,
    			"specifications" => $specifications,
    			"yield" => round($yield, 3),
    			"cutting_list" => round($cutting_list, 3),
    	);
    
    	if ($this->db->update("modelplywood", $data, array("id" => $this->input->post("id")))) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function deleteplywood($id) {
    	if ($this->model_model->deleteplywood($id)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function saveplywood() {
    	$modelid = $this->input->post('modelid');
    	$itemid = $this->input->post('itemid');
    	$unitid = $this->input->post('unitid');
    	$thickness = (double) $this->input->post('thickness');
    	$length = (double) $this->input->post('length');
    	$width = (double) $this->input->post('width');
    	$qty = (double) $this->input->post('qty');
    	$location = $this->input->post('location');
    	$specifications = $this->input->post('specifications');
    	$yield = (double) $this->input->post('yield');
    	$cutting_list = (double) $this->input->post('cutting_list');
    	 
    	$data = array(
    			"modelid" => $modelid,
    			"itemid" => $itemid,
    			"unitid" => $unitid,
    			"thickness" => round($thickness,3),
    			"length" => round($length,3),
    			"width" => round($width,3),
    			"qty" => round($qty, 3),
    			"location" => $location,
    			"specifications" => $specifications,
    			"yield" => round($yield, 3),
    			"cutting_list" => round($cutting_list, 3),
    	);
    	if ($this->model_model->saveplywood($data)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }

    function setfinishing($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setfinishing', $data);
    }

    function savefinishing() {
        $modelid = $this->input->post('modelid');
        $finishingid = $this->input->post('finishingid');
        $this->model_model->savefinishing($modelid, $finishingid);
    }

    function deletefinishing($id) {
        $this->model_model->deletefinishing($id);
    }

    function setmarble($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setmarble', $data);
    }

    function editmarble($modelid, $id) {
        $data['modelid'] = $modelid;
        $data['marble'] = $this->model_model->selectMarbleById($id);
        $this->load->view('model/editmarble', $data);
    }

    function savemarble() {
        $type = $this->input->post('type');
        $modelid = $this->input->post('modelid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $thickness = (double) $this->input->post('thickness');
        $length = (double) $this->input->post('length');
        $width = (double) $this->input->post('width');
        $qty = (double) $this->input->post('qty');
        $location = $this->input->post('location');
        $specifications = $this->input->post('specifications');
        $data = array(
            "type" => $type,
            "modelid" => $modelid,
            "itemid" => $itemid,
            "unitid" => $unitid,
            "thickness" => round($thickness,3),
            "length" => round($length,3),
            "width" => round($width,3),
            "qty" => round($qty, 3),
            "location" => $location,
            "specifications" => $specifications
        );
        if ($this->model_model->savemarble($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function updatemarble() {
        $data = array(
            "type" => $this->input->post('type'),
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "thickness" => round( (double) $this->input->post('thickness'), 3),
            "length" => round( (double) $this->input->post('length'), 3),
            "width" => round( (double) $this->input->post('width'), 3),
            "qty" => round((double) $this->input->post('qty'), 3),
            "location" => $this->input->post('location'),
            "specifications" => $this->input->post('specifications')
        );
        if ($this->db->update("modelmarble", $data, array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function setpacking($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setpacking', $data);
    }

    function editpacking($modelid, $id) {
        $data['modelid'] = $modelid;
        $data['packing'] = $this->model_model->selectpackingById($id);
        $this->load->view('model/editpacking', $data);
    }

    function deletemarble($id) {
        if ($this->model_model->deletemarble($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function savepacking() {
        $type = $this->input->post('type');
        $modelid = $this->input->post('modelid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $width = round( (double) $this->input->post('width'), 3);
        $depth = round( (double) $this->input->post('depth'), 3);
        $height = round( (double) $this->input->post('height'), 3);
        $qty = round(@$this->input->post('qty'), 3);
        $location = $this->input->post('location');
        $specifications = $this->input->post('specifications');
        if ($this->model_model->savepacking($modelid, $itemid, $unitid, $width, $depth, $height, $qty, $location, $type, $specifications)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function updatepacking() {

        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "width" => round( (double) $this->input->post('width'), 3),
            "depth" => round( (double) $this->input->post('depth'), 3),
            "height" => round( (double) $this->input->post('height'), 3),
            "qty" => round((double) $this->input->post('qty'), 3),
            "location" => $this->input->post('location'),
            "specifications" => $this->input->post('specifications')
        );
        if ($this->db->update("modelpacking", $data, array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function deletepacking($id) {
        if ($this->model_model->deletepacking($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function setlatherinlay($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setlatherinlay', $data);
    }

    function editlatherinlay($modelid, $id) {
        $data['modelid'] = $modelid;
        $data["latherinlay"] = $this->model_model->selectlatherinlayById($id);
        $this->load->view('model/editlatherinlay', $data);
    }

    function setupholstry($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setupholstry', $data);
    }

    function saveupholstry() {
        $modelid = $this->input->post('modelid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $thickness = (double) $this->input->post('thickness');
        $length = (double) $this->input->post('length');
        $width = (double) $this->input->post('width');
        $qty = (double) $this->input->post('qty');
        $location = $this->input->post('location');
        $specifications = $this->input->post('specifications');
        $is_picklist = $this->input->post('is_picklist');
        
        $data = array(
            "modelid" => $modelid,
            "itemid" => $itemid,
            "unitid" => $unitid,
            "thickness" =>round( $thickness, 3),
            "length" => round( $length, 3),
            "width" => round( $width, 3), 
            "qty" => round($qty, 3),
            "location" => $location,
            "specifications" => $specifications,
        	"is_picklist" => $is_picklist,
            "hardwaretypeid" => 3
        );
        if ($this->db->insert("modelhardware", $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function editupholstry($modelid, $id) {
        $data['modelid'] = $modelid;
        $data["upholstery"] = $this->model_model->selectHardwareById($id);
        $this->load->view('model/editupholstry', $data);
    }

    function updateupholstry() {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "thickness" => round( (double) $this->input->post('thickness'), 3),
            "length" => round( (double) $this->input->post('length'), 3),
            "width" => round( (double) $this->input->post('width'), 3),
            "qty" => round((double) $this->input->post('qty'), 3),
            "location" => $this->input->post('location'),
            "specifications" => $this->input->post('specifications'),
        	"is_picklist" => $this->input->post('is_picklist'),
        );
        if ($this->db->update("modelhardware", $data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function setglass($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/setglass', $data);
    }

    function editglass($modelid, $id) {
        $data['modelid'] = $modelid;
        $data['glass'] = $this->model_model->selectGlassById($id);
        $this->load->view('model/editglass', $data);
    }

    function updateglass() {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "thickness" => round( (double) $this->input->post('thickness'), 3),
            "length" => round( (double) $this->input->post('length'), 3),
            "width" => round( (double) $this->input->post('width'), 3),
            "qty" => round((double) $this->input->post('qty'), 3),
            "location" => strtoupper($this->input->post('location')),
            "specifications" => strtoupper($this->input->post('specifications'))
        );

        if ($this->db->update("modelglass", $data, array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function deleteglass($id) {
        if ($this->model_model->deleteglass($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function saveglass() {
        $modelid = $this->input->post('modelid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $thickness = (double) $this->input->post('thickness');
        $length = (double) $this->input->post('length');
        $width = (double) $this->input->post('width');
        $qty = (double) $this->input->post('qty');
        $location = $this->input->post('location');
        $specifications = $this->input->post('specifications');
        $data = array(
            "modelid" => $modelid,
            "itemid" => $itemid,
            "unitid" => $unitid,
            "thickness" => round( $thickness, 3),
            "length" => round( $length, 3),
            "width" => round( $width, 3),
            "qty" => round( round($qty, 3), 3),
            "location" => $location,
            "specifications" => $specifications
        );
        if ($this->model_model->saveglass($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function savelatherinlay() {
        $modelid = $this->input->post('modelid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $thickness = (double) $this->input->post('thickness');
        $length = (double) $this->input->post('length');
        $width = (double) $this->input->post('width');
        $qty = (double) $this->input->post('qty');
        $location = $this->input->post('location');
        $specifications = $this->input->post('specifications');
        $data = array(
            "modelid" => $modelid,
            "itemid" => $itemid,
            "unitid" => $unitid,
            "thickness" => round( $thickness, 3),
            "length" => round( $length, 3),
            "width" => round( $width, 3), 
            "qty" => round($qty, 3),
            "location" => $location,
            "specifications" => $specifications
        );
        if ($this->model_model->savelatherinlay($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function updatelatherinlay() {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "thickness" => round( (double) $this->input->post('thickness'), 3), 
            "length" => round( (double) $this->input->post('length'), 3), 
            "width" => round( (double) $this->input->post('width'), 3), 
            "qty" => round((double) $this->input->post('qty'), 3),
            "location" => $this->input->post('location'),
            "specifications" => $this->input->post('specifications')
        );
        if ($this->db->update("modellatherinlay", $data, array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function deletelatherinlay($id) {
        if ($this->model_model->deletelatherinlay($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function addcomponent($modelid, $type, $class) {
        $this->load->model('model_hardwaretype');
        $data['hardwaretype'] = $this->model_hardwaretype->selectAll();
        $data['modelid'] = $modelid;
        $data['type'] = $type;
        $data['class'] = $class;
        $this->load->view('model/addcomponent', $data);
    }

    function inserthardware() {
        $modelid = $this->input->post('modelid');
        $class = $this->input->post('class');
        $itemid = $this->input->post('itemid');
        $qty = round((double) @$this->input->post('qty'), 3);
        $hardwaretypeid = $this->input->post('hardwaretypeid');
        $unitid = $this->input->post('unitid');
        $location = $this->input->post('location');
        $supplier = $this->input->post('supplier');
        $notes = $this->input->post('notes');
        $is_picklist = $this->input->post('is_picklist');
        
        if ($this->model_model->inserthardware($modelid, $hardwaretypeid, $class, $itemid, $qty, $unitid, $location, $supplier, $notes, $is_picklist)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function lists($temp, $id, $billto) {
        $this->load->model('model_modeltype');
        $data['modeltype'] = $this->model_modeltype->selectAll();
        if ($billto == 0) {
            $data['model'] = [];// $this->model_model->selectAllAvailabel();
        } else {
            $data['model'] = $this->model_model->selectAllFromCostingByCustomer($billto);
        }
        $data['temp'] = $temp;
        $data['id'] = $id;
        $data['billto'] = (int) $billto;
        
        $this->load->view('model/list', $data);
    }

    function bom($modelid) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $this->load->model('model_component');
        $this->load->model('model_item');
        $this->load->model('model_bom');
        $data['modelid'] = $modelid;
        //$data['allitem'] = $this->model_model->selectAllItemByModelId($modelid); Old use
        $data['allitem'] = $this->model_model->selectAllItemByModelId_updated($modelid);
        //$data['wood'] = $this->model_model->selectAllWoodByModelId($modelid);
        $data['wood'] = $this->model_model->selectAllWoodByModelId_updated($modelid);
        //$data['bom'] = $this->model_model->selectBomItemByModelId($modelid);
        $data['bom'] = $this->model_model->selectBomItemByModelId_updated($modelid);
        $data['model'] = $this->model_model->selectById($modelid);

        $data['venneritemid'] = $this->model_model->selectVeenerIdByModelId_updated($modelid);
        $this->load->view('model/bom', $data);
    }

    function bomadditem($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/bomadditem', $data);
    }

    function bomedititem($itemid, $modelid) {
        $this->load->model('model_bom');
        $data['modelid'] = $modelid;
        $data['component'] = $this->model_bom->selectById_updated($itemid);
        $this->load->view('model/bomedititem', $data);
    }

    function updatebomitem() {
        $this->load->model('model_bom');

        $data_component = array(
            'qty' => $this->input->post('qty'),
            'location' => $this->input->post('location'),
            'partnumber' => $this->input->post('partnumber'),
            'description' => $this->input->post('description'),
            'turn' => $this->input->post('turn'),
            'lam' => $this->input->post('lam'),
            'carv' => $this->input->post('carv'),
            'mall' => $this->input->post('mall'),
            'ft' => round( (double) $this->input->post('ft'), 3),
            'fw' => round( (double) $this->input->post('fw'), 3),
            'fl' => round( (double) $this->input->post('fl'), 3),
            'rt' => round( (double) $this->input->post('rt'), 3),
            'rw' => round( (double) $this->input->post('rw'), 3),
            'rl' => round( (double) $this->input->post('rl'), 3),
            'itemid' => $this->input->post('itemid'),
            'ven_type' => $this->input->post('ven_type'),
            'ven_s1s' => $this->input->post('ven_s1s'),
            'ven_dgb' => $this->input->post('ven_dgb'),
            'ven_s2s' => $this->input->post('ven_s2s'),
            'mhmd' => $this->input->post('mhmd'),
            'sq_ven_a' => $this->input->post('sq_ven_a'),
            'sq_ven_dgb' => $this->input->post('sq_ven_dgb'),
            'ven_itemid' => $this->input->post('ven_id')
        );

        if ($this->db->update('bom', $data_component, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function chooseitem($tempid, $tempname) {
        $this->load->model('model_component');
        $this->load->model('model_item');
        $data['tempid'] = $tempid;
        $data['tempname'] = $tempname;
        $data['component'] = $this->model_component->search2();
        $this->load->view('model/chooseitem', $data);
    }

    function savebomitem() {

        $data_component = array(
            'modelid' => $this->input->post('modelid'),
            'componentid' => $this->input->post('componentid'),
            'qty' => round( $this->input->post('qty'), 3),
            'location' => $this->input->post('location'),
            'partnumber' => $this->input->post('partnumber'),
            'description' => $this->input->post('description'),
            'turn' => $this->input->post('turn'),
            'lam' => $this->input->post('lam'),
            'carv' => $this->input->post('carv'),
            'mall' => $this->input->post('mall'),
            'ft' => round( (double) $this->input->post('ft'), 3),
            'fw' => round( (double) $this->input->post('fw'), 3),
            'fl' => round( (double) $this->input->post('fl'), 3),
            'rt' => round( (double) $this->input->post('rt'), 3),
            'rw' => round( (double) $this->input->post('rw'), 3),
            'rl' => round( (double) $this->input->post('rl'), 3),
            'itemid' => $this->input->post('itemid'),
            'ven_type' => $this->input->post('ven_type'),
            'ven_s1s' => $this->input->post('ven_s1s'),
            'ven_dgb' => $this->input->post('ven_dgb'),
            'ven_s2s' => $this->input->post('ven_s2s'),
            'mhmd' => $this->input->post('mhmd'),
            'sq_ven_a' => $this->input->post('sq_ven_a'),
            'sq_ven_dgb' => $this->input->post('sq_ven_dgb'),
            'ven_itemid' => $this->input->post('ven_id')
        );

        if ($this->db->insert('bom', $data_component)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
        //$this->model_model->saveBomItem($modelid, $componentid, $qty, $location);
    }

    function bomdeleteitemid($bomitemid) {
        $this->model_model->bomdeleteitemid($bomitemid);
    }

    function imageview($filename) {
        echo "<img src='". base_url() ."/files/$filename' style='max-width:500px;max-height:500px'>";
    }

    function edit($id) {
        $this->load->model('model_modeltype');
        $this->load->model('model_item');
        $data['model'] = $this->model_model->selectById($id);
        $data['modeltype'] = $this->model_modeltype->selectAll();
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        $data['expose'] = $this->model_model->selectExpose();
        $data['internal'] = $this->model_model->selectInternal();
        $data['panel'] = $this->model_model->selectPanel();
        $data['veneer'] = $this->model_model->selectVeneer();
        $data['others'] = $this->model_model->selectOthers();
        $data['last_number'] = $this->model_model->getLastModelNumber();
        
        $this->load->view('model/edit', $data);
    }

    function deletehardware($hardwareid) {
        if ($this->model_model->deleteHardware($hardwareid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function setprice($modelid) {
        $this->load->model('model_currency');
        $data['modelid'] = $modelid;
        $data['currency'] = $this->model_currency->selectAll();
        $data['model'] = $this->model_model->selectById($modelid);
        $this->load->view('model/setprice', $data);
    }

    function dosetprice() {
        $modelid = $this->input->post('modelid');
        $curr = $this->input->post('curr');
        $price = $this->input->post('price');
        $this->model_model->setprice($modelid, $price, $curr);
    }

    function choosematerial() {
        $this->load->model('model_component');
        $data['component'] = $this->model_component->selecAll();
        $this->load->view('model/choosecomponent', $data);
    }

    function addhardware($modelid) {
        $data['modelid'] = $modelid;
        $this->load->model('model_hardwaretype');
        $data['hardwaretype'] = $this->model_hardwaretype->selectAll();
        $this->load->view('model/addhardware', $data);
    }

    function edithardware($modelid, $hardwareid) {
        $data['modelid'] = $modelid;
        $data['hardwareid'] = $hardwareid;
        $data['hardware'] = $this->model_model->selectHardwareById($hardwareid);
        $this->load->model('model_hardwaretype');
        $data['hardwaretype'] = $this->model_hardwaretype->selectAll();
        $this->load->view('model/edithardware', $data);
    }

    function updatehardware() {
        $data = array(
            "modelid" => $this->input->post("modelid"),
            "itemid" => $this->input->post("itemid"),
            "unitid" => $this->input->post("unitid"),
            "hardwaretypeid" => $this->input->post("hardwaretypeid"),
            "qty" =>  round($this->input->post("qty"), 3),
            "location" => $this->input->post("location"),
            "supplier" => $this->input->post("supplier"),
            "notes" => $this->input->post("notes"),
            "is_picklist" => $this->input->post("is_picklist"),
        );
        if ($this->db->update("modelhardware", $data, array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function viewlisthardware($element) {
        $this->load->model('model_item');
        $data['element'] = $element;
        $data['item'] = $this->model_item->selectAll();
        $this->load->view('model/listhardware', $data);
    }

    function isExistCode($code) {
        echo $this->model_model->isExistCode($code);
    }

    function copy($modelid) {
        $data['modelid'] = $modelid;
        $this->load->view('model/copy', $data);
    }

    function docopy() {
        $modelid = $this->input->post('modelid');
        $modelno = $this->input->post('modelno');
       // print_r($modelid." - ".$modelno);
        if ($this->model_model->docopy($modelid, $modelno)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function getFinishing($modelid) {
        $finishing = $this->model_model->selectfinishingByModelId($modelid);
        $strfinishing = "";
        foreach ($finishing as $finishing) {
            $strfinishing .= "-" . $finishing->description . "\n";
        }
        echo $strfinishing;
    }

    function getFabrication($modelid) {
        $hardware = $this->model_model->selectItemByModelId($modelid, 2);
        $strhardware = "";
        foreach ($hardware as $hardware) {
            $strhardware .= "- " . $hardware->description;
        }
        echo $strhardware;
    }

    function cdsprint($id, $st) {
        $this->load->model('model_hardwaretype');
        $this->load->model('model_model');
        $this->load->model('model_item');
        $data['model'] = $this->model_model->selectById($id);
        $data['wood'] = $this->model_item->selectWood();
        $data["finishoverview"] = $this->model_model->selectFinishOverview();
        $data["constructionoverview"] = $this->model_model->selectConstructionOverview();
        $data["decorativehardware"] = $this->model_model->selectItemHarwareByModelId($id, 1);
        $data["functionalhardware"] = $this->model_model->selectItemHarwareByModelId($id, 2);
        $data["upholstery"] = $this->model_model->selectItemHarwareByModelId($id, 3);
        $data["packingmaterial"] = $this->model_model->selectPackingMaterialByModelId($id, 3);
        $data['glass'] = $this->model_model->selectGlassByModelId($id);
        $data['marble'] = $this->model_model->selectmarbleByModelId($id);
        $data['latherinlay'] = $this->model_model->selectlatherinlayByModelId($id);
        $data['layout'] = $this->model_model->selectLayout($id);
        $data['additionalnotes'] = $this->model_model->getAdditionalNotes($id);
        $data['reviewnotes'] = $this->model_model->selectreviewnotesandhistorybymodel($id);
        $data['solidwood'] = $this->model_model->selectMaterialSpecificationByGroup($id, "3");
        $data['mdf_plywd_prtcl'] = $this->model_model->selectMaterialSpecificationByGroup($id, "4,5,6");
        $data['veneer'] = $this->model_model->selectMaterialSpecificationByGroup($id, "7");
        $data['expose'] = $this->model_model->selectExpose();
        $data['internal'] = $this->model_model->selectInternal();
        $data['panel'] = $this->model_model->selectPanel();
        $data['material_veneer'] = $this->model_model->selectVeneer();
        $data['others'] = $this->model_model->selectOthers();

        $data['special_requirement'] = $this->model_model->selectSpecialRequirement();
        $data['packing_type'] = $this->model_model->selectPackingType();
        
        $data['expose_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 1);
        $data['internal_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 2);
        $data['panel_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 3);
        $data['veneer_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 4);
        $data['others_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 5);
        
        $data['special_requirement_other'] = $this->model_model->selectOtherSpecialRequirementByModelIdAndType($id, 11);
        $data['packing_type_other'] = $this->model_model->selectOtherPackingTypeByModelIdAndType($id, 12);

        $this->load->view('model/cdsprint', $data);
    }

    function viewrequest() {
        $this->load->model('model_rfqdetail');
        $this->load->model('model_rfqitemattachment');
        $data['model'] = $this->model_rfqdetail->selectRequestedModel();
        $this->load->view('model/viewrequest', $data);
    }

    function createbom($modelid) {
        $this->model_model->createbom($modelid);
    }

    function setmodelrfqdetail($id, $modelid, $customerid, $cust_code = "") {
        $data['rfqdetailid'] = $id;
        $data['refmodelid'] = $modelid;
        $data['customerid'] = $customerid;
        $data['cust_code'] = $cust_code;
        $this->load->view('model/setmodelrfqdetail', $data);
    }

    function dosetmodelrfqdetail() {
        $rfqdetailid = $this->input->post('rfqdetailid');
        $modelid = $this->input->post('modelid');
        $cust_code = $this->input->post('cust_code');
        if ($this->model_rfqdetail->dosetmodelrfqdetail($rfqdetailid, $modelid)) {
            echo '1';
            $this->model_model->update(array("custcode" => $cust_code), array("id" => $modelid));
        }
    }

    function printcuttinglist($modelid, $printyield) {
        $this->load->model('model_model');
        $this->load->model('model_component');
        $this->load->model('model_item');
        $data['modelid'] = $modelid;
        $data['printyield'] = $printyield;
        //$data['allitem'] = $this->model_model->selectAllItemByModelId($modelid);
        $data['allitem'] = $this->model_model->selectAllItemByModelId_updated($modelid);
        //$data['wood'] = $this->model_model->selectAllWoodByModelId($modelid);
        $data['wood'] = $this->model_model->selectAllWoodByModelId_updated($modelid);
        //$data['bom'] = $this->model_model->selectBomItemByModelId($modelid);
        $data['bom'] = $this->model_model->selectBomItemByModelId_updated($modelid);
        $data['model'] = $this->model_model->selectById($modelid);
        //$data['venneritemid'] = $this->model_model->selectVeenerIdByModelId($modelid);
        $data['venneritemid'] = $this->model_model->selectVeenerIdByModelId_updated($modelid);
        $this->load->view('model/printcuttinglist', $data);
    }

    function additionalnotes($modelid) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $data['modelid'] = $modelid;
        $data['additionalnotes'] = $this->model_model->getAdditionalNotes($modelid);
        $this->load->view('model/additionalnotes', $data);
    }

    function updateadditionalnotes() {
        $modelid = $this->input->post('modelid');
        $additionalnotes = $this->input->post('additionalnotes');
        $this->model_model->updateadditionalnotes(array("additionalnotes" => $additionalnotes), array("id" => $modelid));
    }

    function layout($id) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $data["layout"] = $this->model_model->selectLayout($id);
        $this->load->view('model/layout', $data);
    }

    function uploadlayout() {
        $modelid = $this->input->post('modelid');
        $file_element_name = 'fileupload';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload($file_element_name)) {
            $data = $this->upload->data();
            $this->model_model->uploadlayout(array("modelid" => $modelid, "filename" => $data['file_name']));
        }
        @unlink($_FILES[$file_element_name]);
        
        echo json_encode(array('success' => true));
    }

    function deletelayout() {
        $id = $this->input->post("id");
        $filename = $this->input->post("filename");
        $this->load->helper("file");
        $path = "./files/$filename";
        if (@unlink($path)) {
            $this->model_model->deletelayout($id);
        } else {
            echo $path;
        }

        echo json_encode(array('success' => true));
    }

    function reviewnotesandhistory($modelid) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "model"));
        $data['reviewnotes'] = $this->model_model->selectreviewnotesandhistorybymodel($modelid);
        $this->load->view('model/reviewnotesandhistory', $data);
    }

    function addreviewnotesandhistory() {
        $this->load->view('model/addreviewnotesandhistory');
    }

    function savereviewnotesandhistory() {
        $modelid = $this->input->post('modelid');
        $date = $this->input->post('date');
        $reviewedby = $this->input->post('reviewedby');
        $notes = $this->input->post('notes');
        $data = array("modelid" => $modelid, "date" => $date, "reviewedby" => $reviewedby, "notes" => $notes);
        $this->model_model->savereviewnotesandhistory($data);
    }

    function editreviewnotesandhistory($id) {
        $data['notesandreview'] = $this->model_model->selectreviewnotesandhistorybyid($id);
        $this->load->view('model/editreviewnotesandhistory', $data);
    }

    function updatereviewnotesandhistory() {
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $reviewedby = $this->input->post('reviewedby');
        $notes = $this->input->post('notes');
        $data = array("date" => $date, "reviewedby" => $reviewedby, "notes" => $notes);
        $condition = array("id" => $id);
        $this->model_model->updatereviewnotesandhistory($data, $condition);
    }

    function deletereviewnotesandhistory($id) {
        $this->model_model->deletereviewnotesandhistory($id);
    }

    function print_bom($id) {
        $this->load->model('model_company');
        $data['model_bom'] = $this->model_model->select_model_bom($id);
        $data['company'] = $this->model_company->getDetail();
        $this->load->view('model/print_bom', $data);
    }

    function material_overview($id) {
        $data['model'] = $this->model_model->selectById($id);
        $data['expose'] = $this->model_model->selectExpose();
        $data['expose_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 1);
        $data['internal'] = $this->model_model->selectInternal();
        $data['internal_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 2);
        $data['panel'] = $this->model_model->selectPanel();
        $data['panel_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 3);
        $data['veneer'] = $this->model_model->selectVeneer();
        $data['veneer_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 4);
        $data['others'] = $this->model_model->selectOthers();
        $data['others_other'] = $this->model_model->selectOtherMaterialOverviewByTypeanModelId($id, 5);
        $data['modelid'] = $id;
        $this->load->view('model/material_overview', $data);
    }

    function update_material_overview() {
        $modelid = $this->input->post("modelid");
    	$expose = $this->input->post('expose');
    	$internal = $this->input->post('internal');
    	$panel = $this->input->post('panel');
    	$veneer = $this->input->post('veneer');
    	$others = $this->input->post('others');
    	
        $expose = "{" . implode (", ", $expose ? $expose : [] ) . "}";
        $internal = "{" . implode (", ", $internal ? $internal : []) . "}";
        $panel = "{" . implode (", ", $panel ? $panel : [] ) . "}";
        $veneer = "{" . implode (", ", $veneer ? $veneer : [] ) . "}";
        $others = "{" . implode (", ", $others ? $others : [] ) . "}";
        
        $data = array(
            'expose' => $expose,
            'internal' => $internal,
            'panel' => $panel,
            'veneer' => $veneer,
            'others' => $others
        );
        if ($this->model_model->update($data, array("id" => $modelid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add_other_material_overview($modelid, $typeid) {
        $data['modelid'] = $modelid;
        $data['typeid'] = $typeid;
        $data['id'] = 0;
        $data['description'] = "";
        $this->load->view('model/add_other_material_overview', $data);
    }

    function edit_other_material_overview($id) {
        $othermaterial_overview = $this->model_model->selectOtherMaterialOverviewById($id);
        $data['modelid'] = $othermaterial_overview->modelid;
        $data['typeid'] = $othermaterial_overview->typeid;
        $data['id'] = $id;
        $data['description'] = $othermaterial_overview->description;
        $this->load->view('model/add_other_material_overview', $data);
    }

    function save_other_material_overview() {
        $id = $this->input->post('id');
        $modelid = $this->input->post('modelid');
        $typeid = $this->input->post('typeid');
        $description = $this->input->post('description');
        $data = array(
            "typeid" => $typeid,
            "modelid" => $modelid,
            "description" => $description
        );
        if ($id == 0) {
            if ($this->model_model->insert_other_material_overview($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_model->update_other_material_overview($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete_other_material_overview() {
        $id = $this->input->post('id');
        if ($this->model_model->delete_other_material_overview($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function search_component_autocomplete() {
        sleep(3);
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $term = $_GET['term'];

        $key_search = strtolower($term);

        if (get_magic_quotes_gpc()) {
            $key_search = stripslashes($key_search);
        }

        $row = array();

        $query = "
            select 
            bom.*,
            item.descriptions item_description,
            itm.descriptions ven_item_description
            from bom 
            left join item on bom.itemid=item.id
            left join item itm on bom.ven_itemid=itm.id
            where true
        ";

        if ($key_search != "") {
            $query .= " and (bom.partnumber ilike '%$key_search%' or bom.description ilike '%$key_search%')";
        }

        $query .= " order by bom.partnumber asc ";

        $items = $this->db->query($query)->result();

        foreach ($items as $result) {
            $row[] = array(
                "label" => $result->partnumber,
                "value" => $result->partnumber,
                "description" => $result->description,
                "itemid" => $result->itemid,
                "item_description" => $result->item_description,
                "turn" => $result->turn,
                "lam" => $result->lam,
                "carv" => $result->carv,
                "mall" => $result->mall,
                "ft" => $result->ft,
                "fw" => $result->fw,
                "fl" => $result->fl,
                "rt" => $result->rt,
                "rw" => $result->rw,
                "rl" => $result->rl,
                "ven_type" => $result->ven_type,
                "ven_s1s" => $result->ven_s1s,
                "ven_dgb" => $result->ven_dgb,
                "ven_s2s" => $result->ven_s2s,
                "mhmd" => $result->mhmd,
                "sq_ven_a" => $result->sq_ven_a,
                "sq_ven_dgb" => $result->sq_ven_dgb,
                "ven_itemid" => $result->ven_itemid,
                "ven_item_description" => $result->ven_item_description
            );
        }

        echo json_encode($row);
    }
    function approve() {
        $this->load->model('model_approval');
        $modelid = $this->input->post('modelid');
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
        $model = $this->model_model->selectById( $modelid );
        if( $who != "1"){
        	if( $model->checkedstatus != "1" ){
	        	echo json_encode(array('msg' => "Error, Before Perform Approval, Please Do Checking First...!"));
	        	return;
        	}
        }
        
        if ($this->model_model->update($data, array("id" => $modelid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
        
    }

    function rejectOrPending($modelid, $approvalid, $status, $who, $flag) {
        $data['modelid'] = $modelid;
        $data['approvalid'] = $approvalid;
        $data['status'] = $status;
        $data['flag'] = $flag;
        $data['who'] = $who;
        
        $this->validateCheckingAndApprove($modelid, $who);
        
        $this->load->view('model/reject_or_pending', $data);
    }

    function validateCheckingAndApprove($modelid, $who=2){
    	if( $who == 2 ){
	    	$model = $this->model_model->selectById( $modelid );
	    	if( $model->checkedstatus != "1" ){
	    		echo "Error, Before Perform Approval, Please Do Checking First...!";
	    		exit();
	    	}
    	}
    }
    
    function do_reject_or_pending() {
        $modelid = $this->input->post('modelid');
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
        
        //validate, cheking then approve
        $model = $this->model_model->selectById( $modelid );
        if( $who != "1" ){
        	if( $model->checkedstatus != "1" ){
	        	echo json_encode(array('msg' => "Error, Before Perform Approval, Please Do Checking First...!"));
	        	return;
        	}
        }

        $this->db->trans_start();
        if ($this->model_model->update($data, array("id" => $modelid))) {
            
            $data_notes = array(
                "modelid" => $modelid,
                "employeeid" => $approvalid,
                "timeapprove" => date('Y-m-d h:i:s'),
                "status" => $status,
                "notes" => $notes,
                "who" => $who
            );
            if (!$this->db->insert("modelapprovalnotes", $data_notes)) {
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

    function view_approval_notes($modelid, $status, $who) { //"who" = if 1: chekced_by, 2: approved_by
    	$query = " select nts.id,em.name as checked_by, nts.status, nts.notes, nts.timeapprove
					from modelapprovalnotes nts 
					left join employee em on em.id = nts.employeeid
					where nts.modelid=$modelid and nts.status = $status and nts.who = '$who'
				   order by nts.id desc ";
    	
    	$notes = $this->db->query($query)->result();
    	
    	$data['notes'] = $notes;
    	$data['who'] = $who;
    	$data['model'] = $this->model_model->selectById( $modelid );
    	$this->load->view('model/approval_notes', $data);
    }
    
    // Special Requirement
    function special_requirement( $id ) {
    	$data['model'] = $this->model_model->selectById($id);
    	
    	//$finish_on_body_frame__finish_on_metal_hardware = $this->model_model->selectFinishOnBodyFrameByModelId( $id );
    	//$data['finish_on_body_frame'] = @$finish_on_body_frame__finish_on_metal_hardware->finish_on_body_frame;
    	//$data['finish_on_metal_hardware'] = @$finish_on_body_frame__finish_on_metal_hardware->finish_on_metal_hardware;
    	
    	$data['special_requirement'] = $this->model_model->selectSpecialRequirement();
    	$data['special_requirement_other'] = $this->model_model->selectOtherSpecialRequirementByModelIdAndType($id, 11);
    	
    	$data['packing_type'] = $this->model_model->selectPackingType();
    	$data['packing_type_other'] = $this->model_model->selectOtherPackingTypeByModelIdAndType($id, 12);
    	
    	$data['modelid'] = $id;
    	$this->load->view('model/special_requirement', $data);
    }
    
    function update_special_requirement() {
    	$modelid = $this->input->post("modelid");
    	$finish_on_body_frame = $this->input->post('finish_on_body_frame');
    	$finish_on_metal_hardware = $this->input->post('finish_on_metal_hardware');
    	
    	$special_requirement = $this->input->post('special_requirement');
    	$packing_type = $this->input->post('packing_type');
    	 
    	$special_requirement = "{" . implode (", ", $special_requirement ? $special_requirement : [] ) . "}";
    	$packing_type = "{" . implode (", ", $packing_type ? $packing_type : []) . "}";
    
    	$data = array(
    			'finish_on_body_frame' => $finish_on_body_frame,
    			'finish_on_metal_hardware' => $finish_on_metal_hardware,
    			
    			'special_requirement' => $special_requirement,
    			'packing_type' => $packing_type,
    	);
    	if ($this->model_model->update($data, array("id" => $modelid))) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }
    
    function add_other_special_requirement($modelid, $typeid) {
    	$data['modelid'] = $modelid;
    	$data['typeid'] = $typeid;
    	$data['id'] = 0;
    	$data['description'] = "";
    	$this->load->view('model/add_other_special_requirement', $data);
    }
    
    function edit_other_special_requirement($id) {
    	$special_requirement = $this->model_model->selectOtherSpecialRequirementById($id);
    	$data['modelid'] = $special_requirement->modelid;
    	$data['typeid'] = $special_requirement->typeid;
    	$data['id'] = $id;
    	$data['description'] = $special_requirement->description;
    	$this->load->view('model/add_other_special_requirement', $data);
    }
    
    function save_other_special_requirement() {
    	$id = $this->input->post('id');
    	$modelid = $this->input->post('modelid');
    	$typeid = $this->input->post('typeid');
    	$description = $this->input->post('description');
    	$data = array(
    			"typeid" => $typeid,
    			"modelid" => $modelid,
    			"description" => $description
    	);
    	if ($id == 0) {
    		if ($this->model_model->insert_other_special_requirement($data)) {
    			echo json_encode(array('success' => true));
    		} else {
    			echo json_encode(array('msg' => $this->db->_error_message()));
    		}
    	} else {
    		if ($this->model_model->update_other_special_requirement($data, array("id" => $id))) {
    			echo json_encode(array('success' => true));
    		} else {
    			echo json_encode(array('msg' => $this->db->_error_message()));
    		}
    	}
    }
    
    function delete_other_special_requirement() {
    	$id = $this->input->post('id');
    	if ($this->model_model->delete_other_special_requirement($id)) {
    		echo json_encode(array('success' => true));
    	} else {
    		echo json_encode(array('msg' => $this->db->_error_message()));
    	}
    }

}
