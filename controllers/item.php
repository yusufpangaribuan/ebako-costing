<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class item extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_item');
        $this->load->model('model_unit');
        $this->load->model('model_groups');
        $this->load->model('model_warehouse');
        $this->load->model('model_stock');
        $this->load->model('model_user');
    }

    public function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "item"));
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['itemgroup'] = $this->model_groups->selectAllForSelect();
            $data['allcurrency'] = $this->model_item->selectDistinctCurrencyUsed();
            $code = $this->input->post('code');
            $descriptions = $this->input->post('descriptions');
            $group = $this->input->post('group');
            $isstock = $this->input->post('isstock');
            $rack = $this->input->post('rack');
            $data['num_rows'] = $this->model_item->getNumRows($code, $descriptions, $group, $isstock, $rack);
            $offset = 0;
            $data['number'] = $offset + 1;
            $limit = $this->config->item('limit');
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['offset'] = $offset;
            $data['item'] = $this->model_item->search($code, $descriptions, $group, $isstock, $rack, $limit, $offset);
            $this->load->view('item/view', $data);
        }
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "item"));
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['allcurrency'] = $this->model_item->selectDistinctCurrencyUsed();
            $code = $this->input->post('code');
            $descriptions = $this->input->post('descriptions');
            $group = $this->input->post('group');
            $isstock = $this->input->post('isstock');
            $rack = $this->input->post('rack');
            $data['num_rows'] = $this->model_item->getNumRows($code, $descriptions, $group, $isstock, $rack);
            $limit = $this->config->item('limit');
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['number'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['offset'] = $offset;
            $data['item'] = $this->model_item->search($code, $descriptions, $group, $isstock, $rack, $limit, $offset);
            $this->load->view('item/search', $data);
        }
    }

    public function add() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['unit'] = $this->model_unit->selectAll();
            $data['group'] = $this->model_groups->selectAll();
            $data['warehouse'] = $this->model_warehouse->selectAll();
            $this->load->view('item/add', $data);
        }
    }

    public function save() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_stock');
            $isstock = $this->input->post('isstock');
            $partnumber = $this->input->post('partnumber');
            $rack = $this->input->post('rack');
            $reorderpoint = $this->input->post('reorderpoint');
            $groupid = $this->input->post('groupid');
            $woodid = $this->input->post('woodid');
            $description = trim($this->input->post('description'));
            $unitid = $this->input->post('unitid');
            $balance = $this->input->post('balance');
            $whs = $this->input->post('whs');
            $moq = (double) $this->input->post('moq');
            $lt = (double) $this->input->post('lt');
            $expdate = $this->input->post('expdate');
            $qccheck = $this->input->post('qccheck');

            $arr_whs = explode('|', $whs);
            $arr_balance = explode('|', $balance);

            $file_element_name = 'fileupload';
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            //echo "count_whs " . count($arr_whs);
            if (!$this->upload->do_upload($file_element_name)) {
                if ($this->model_item->save($isstock, $partnumber, $groupid, $description, $rack, $reorderpoint, "", $moq, $lt, $expdate, $qccheck, $woodid)) {
                    $itemid = $this->model_item->get_last_id();
                    $data_stock = array();
                    for ($i = 0; $i < count($arr_whs); $i++) {
                        if ($arr_whs[$i] != "0") {
                            $data_stock[] = array("itemid" => $itemid,
                                "unitfrom" => $unitid,
                                "unitto" => $unitid,
                                "conversionvalue" => 1,
                                "stock" => (double) $arr_balance[$i],
                                "warehouseid" => (double) $arr_whs[$i]);
                        }
                    }
                    if ($this->model_stock->insertunit_batch($data_stock)) {
                        echo json_encode(array('success' => true));
                    } else {
                        $this->delete($itemid);
                        echo json_encode(array('msg' => $this->db->_error_message()));
                    }
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            } else {
                $data = $this->upload->data();
                //$itemid = $this->model_item->save($isstock, $partnumber, $groupid, $description, $rack, $reorderpoint, $data['file_name'], $moq, $lt, $expdate, $qccheck, $woodid);
                if ($this->model_item->save($isstock, $partnumber, $groupid, $description, $rack, $reorderpoint, $data['file_name'], $moq, $lt, $expdate, $qccheck, $woodid)) {
                    $itemid = $this->model_item->get_last_id();
                    $data_stock = array();
                    for ($i = 0; $i < count($arr_whs); $i++) {
                        if ($arr_whs[$i] != "0") {
                            $data_stock[] = array("itemid" => $itemid,
                                "unitfrom" => $unitid,
                                "unitto" => $unitid,
                                "conversionvalue" => 1,
                                "stock" => (double) $arr_balance[$i],
                                "warehouseid" => (double) $arr_whs[$i]);
                        }
                    }
                    if ($this->model_stock->insertunit_batch($data_stock)) {
                        echo json_encode(array('success' => true));
                    } else {
                        $this->delete($itemid);
                        echo json_encode(array('msg' => $this->db->_error_message()));
                    }
                } else {
                    unlink($data['full_path']);
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_unit');
            $data['group'] = $this->model_groups->selectAll();
            $data['item'] = $this->model_item->selectById($id);
            $data['unit'] = $this->model_unit->selectAll();
            $data['allunit'] = $this->model_item->selectAllUnitAsc($id);
            $data['num_rows'] = count($data['allunit']);
            $data['smallestunit'] = $this->model_item->selectSmallestUnit($id);
            $data['warehouse'] = $this->model_warehouse->selectAll();
            $this->load->view('item/edit', $data);
        }
    }

    public function update() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $id = $this->input->post('id');
            $partnumber = $this->input->post('partnumber');
            $names = $this->input->post('names');
            $groupid = $this->input->post('groupid');
            $description = trim($this->input->post('description'));
            $rack = $this->input->post('rack');
            $isstock = $this->input->post('isstock');
            $reorderpoint = $this->input->post('reorderpoint');
            $moq = (double) $this->input->post('moq');
            $lt = (double) $this->input->post('lt');
            $expdate = $this->input->post('expdate');
            $yield = (double) $this->input->post('yield');
            $qccheck = $this->input->post('qccheck');
            $image = $this->input->post('image');

            $file_element_name = 'fileupload';
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $data_update = array(
                "partnumber" => $partnumber,
                "names" => $names,
                "groupsid" => $groupid,
                "descriptions" => $description,
                "rack" => $rack,
                "isstock" => $isstock,
                "reorderpoint" => $reorderpoint,
                "moq" => $moq,
                "lt" => $lt,
                "expdate" => empty($expdate) ? NULL : $expdate,
                "qccheck" => $qccheck,
                "yield" => $yield,
                "updated_by" => $this->session->userdata("id"),
                "updated_time" => "now()"
            );

            if (!$this->upload->do_upload($file_element_name)) {
                if ($this->model_item->update($data_update, array("id" => $id))) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            } else {
                $data = $this->upload->data();
                $data_update["images"] = $data['file_name'];
                if ($this->model_item->update($data_update, array("id" => $id))) {
                    $filetodelete = "./files/" . $image;
                    if (file_exists($filetodelete)) {
                        @unlink($filetodelete);
                    }
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            }
        }
    }

    public function delete($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            if ($this->model_item->delete($id)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function choose_from_order_recommendation($elid) {
        $data['elid'] = $elid;
        $this->load->model('model_groups');
        $data['group'] = $this->model_groups->selectAll();
        $data['item'] = $this->model_item->selectStockNeedToReorder();
        $this->load->view("item/choose_from_order_recommendation", $data);
    }

    function searchOrderRecommendation($elid) {
        $groupid = $this->input->post('groupid');
        $isstock = $this->input->post('isstock');
        $partnumber = $this->input->post('partnumber');
        $description = $this->input->post('description');

        $query = "with t as (
                select  
                item.*,
                groups.names groupname,
                item_get_smallest_unit(item.id) unitcode,
                item_get_stock_smallest_unit(item.id) totalstock 
                from item join groups on item.groupsid=groups.id
                ) select * from t where totalstock <= reorderpoint ";
        if ($partnumber != "") {
            $query .= " and t.partnumber ilike '%$partnumber%'";
        }if ($description != "") {
            $query .= " and t.descriptions ilike '%" . $description . "%'";
        }if ($groupid != 0) {
            $query .= " and t.groupsid=$groupid ";
        }if ($isstock != 0) {
            $query .= " and t.isstock=$isstock ";
        }
        $query .= " order by t.id desc ";
        echo $query;
        $item = $this->model_item->searchStockNeedToReorder($query);
        foreach ($item as $result) {
            $allunit = $this->model_item->getAllUnit($result->id);
            ?>
            <tr>
                <td>
                    <input type="hidden" id="unitid_r<?php echo $result->id ?>" value="<?php echo $allunit ?>" />
                    <input type="hidden" id="id_r<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                    <input type="hidden" id="partnumber_r<?php echo $result->id ?>" value="<?php echo $result->partnumber ?>"/>
                    <input type="hidden" id="names_r<?php echo $result->id ?>" value="<?php echo $result->names ?>"/>
                    <input type="hidden" id="moq_r<?php echo $result->id ?>" value="<?php echo $result->moq ?>"/>
                    <input type="hidden" id="descriptions_r<?php echo $result->id ?>" value="<?php echo strip_tags($result->descriptions) ?>"/>
                    <?php echo $result->partnumber ?>
                </td>
                <td><?php echo nl2br($result->descriptions) ?></td>
                <td><?php echo ($result->isstock == 't') ? 'Stock' : 'Non Stock'; ?></td>
                <td><?php echo $result->groupname ?></td>
                <td align="center"><?php echo $result->moq ?></td>
                <td align="center"><?php echo $result->reorderpoint ?></td>
                <td align="center">
                    <?php
                    if ($result->images != "") {
                        echo "<a href=javascript:void(0) onclick=item_viewimage('" . $result->images . "')> <img src = 'images/attachment.png' class = 'miniaction'/> Image</a>";
                    }
                    ?>
                </td>
                <td align="center"><img src="images/check.png" class="miniaction" onclick="item_selectToPr(<?php echo $result->id . "," . $elid ?>)" /></td>
            </tr>
            <?php
        }
    }

    public function listSearch($elid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['elid'] = $elid;
            $data['group'] = $this->model_groups->selectAll();
            $this->load->view('item/listsearch', $data);
        }
    }

    function findlist() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $partnumber = $this->input->post('partnumber');
            $description = $this->input->post('description');
            $names = $this->input->post('description');
            $receiver = $this->input->post('receiver');

            $item = $this->model_item->searchList($partnumber, $description, $names);
            foreach ($item as $result) {
                $allunit = $this->model_item->getAllUnit($result->id);
                ?>
                <tr>
                    <td>
                        <input type="hidden" id="unitid_r<?php echo $result->id ?>" value="<?php echo $allunit ?>" />
                        <input type="hidden" id="id_r<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                        <input type="hidden" id="partnumber_r<?php echo $result->id ?>" value="<?php echo $result->partnumber ?>"/>
                        <input type="hidden" id="names_r<?php echo $result->id ?>" value="<?php echo $result->names ?>"/>
                        <input type="hidden" id="descriptions_r<?php echo $result->id ?>" value="<?php echo strip_tags($result->descriptions) ?>"/>
                        <?php echo $result->partnumber ?>
                    </td>
                    <td><?php echo $result->descriptions ?></td>                
                    <td><img src="images/check.png" onclick="item_set(<?php echo $result->id . ",'" . $receiver . "'" ?>)" /></td>
                </tr>
                <?php
            }
        }
    }

    function listitem($receiver) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['receiver'] = $receiver;
            $this->load->view('item/listitem', $data);
        }
    }
    
    function listByGroup($groupid) {
	    $data['items'] = $this->model_item->getItemsByGroup( $groupid );
	    echo json_encode($data);
    }
    
    function listByGroupForSelection($groupid) {
    	if( $groupid > -1 ){
    		$term = $this->input->get('term');
    		$key_search = strtolower($term);
    		$data['items'] = $this->model_item->getItemsByGroupForSelection( $groupid, $key_search );
    	}else{
    		$data['items'] = [];
    	}
    	echo json_encode($data);
    }
    
    function listByGroupForSelection_new_material($groupid) {
    	if( $groupid > -1 ){
	    	$term = $this->input->get('term');
	    	$key_search = strtolower($term);
	    	
	    	$data['datas']['items'] = $this->model_item->getItemsByGroup( $groupid, $key_search);
	    	$data['datas']['options'] = $this->model_item->getItemsByGroupForSelection( $groupid, $key_search );
    	}else{
    		$data['datas']['items'] = [];
    		$data['datas']['options'] = [];
    	}
    	
    	echo json_encode( $data );
    }

    public function searchList($elid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $partnumber = $this->input->post('partnumber');
            $description = $this->input->post('description');
            $soid = $this->input->post('soid');
            $item = $this->model_item->searchList($partnumber, $description, $soid);
            
            
            $data['item'] = $item;
            $data['elid'] = $elid;
            $this->load->view('item/searchList', $data);
        }
    }

    function addunit($itemid, $lastunitid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['unit'] = $this->model_unit->selectAll();
            $data['unitidref'] = $lastunitid;
            $data['itemid'] = $itemid;
            $this->load->view('item/addunit', $data);
        }
    }

    function setfirststock($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['unit'] = $this->model_item->selectAllUnitByWareHouse($itemid);
            $this->load->view('item/setfirststock', $data);
        }
    }

    function savefirststock() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $id = $this->input->post('id');
            $qty = $this->input->post('qty');
            for ($i = 0; $i < count($id); $i++) {
                $this->model_item->saveFirstStock($id[$i], $qty[$i]);
            }
        }
    }

    function setprice($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_currency');
            $data['itemid'] = $itemid;
            $data['currency'] = $this->model_currency->selectAll();
            $data['item'] = $this->model_item->selectById($itemid);
            $this->load->view('item/setprice', $data);
        }
    }

    function set_costing_price($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_currency');
            $data['itemid'] = $itemid;
            $data['currency'] = $this->model_currency->selectAll();
            $data['item'] = $this->model_item->selectById($itemid);
            $this->load->view('item/set_costing_price', $data);
        }
    }

    function do_set_costing_price() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $itemid = $this->input->post('itemid');
            $curr = $this->input->post('curr');
            $price = $this->input->post('price');
            $data = array(
                "costing_price" => $price,
                "curr_costing_price" => $curr
            );
            if ($this->model_item->update($data, array("id" => $itemid))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function do_set_costing_price_from_po() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $itemid = $this->input->post('itemid');
            $curr = $this->input->post('curr');
            $price = $this->input->post('costing_price');
            $data = array(
                "costing_price" => $price,
                "curr_costing_price" => $curr
            );
            if ($this->model_item->update($data, array("id" => $itemid))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function pricehistory($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $history = $this->model_item->selectHistory($itemid);
            ?>
            <div style="width:250px;">
                <table class="tablesorter" width="100%">
                    <thead>
                        <tr>
                            <th width="30%">Curr</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($history as $history) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $history->currency ?></td>
                                <td align="right"><?php echo number_format($history->price, 2, '.', ','); ?>&nbsp;</td>                    
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    }

    function dosetprice() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $itemid = $this->input->post('itemid');
            $curr = $this->input->post('curr');
            $price = $this->input->post('price');
            $this->model_item->setprice($itemid, $price, $curr);
        }
    }

    function itemstockforstockout($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $dt = $this->model_item->selectAllUnit($itemid);
            echo "<table width=100%>";
            foreach ($dt as $result) {
                echo "<tr>";
                echo "<td width='70%' style='border:none;'><input type=text style='width:100%;text-align:right;' value='" . $result->stock . "' readonly id='stock" . $itemid . "" . $result->unitfrom . "'/></td><td width='30%' style='border:none;font-size:14px;' align='left'><b>" . $result->codes . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    function isavailablestock($itemid, $unitid, $qtyout) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_stock');
            echo $this->model_stock->isavailable($itemid, $unitid, $qtyout);
        }
    }

    function editunit($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['allunit'] = $this->model_item->select_all_unit_distinc($itemid);
            $data['num_rows'] = count($data['allunit']);
            $data['smallestunit'] = $this->model_item->selectSmallestUnit($itemid);
            $data['unit'] = $this->model_unit->selectAll();
            $data['itemid'] = $itemid;
            $this->load->view('item/editunit', $data);
        }
    }

    function viewallrecommendedtoorder() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['item'] = $this->model_item->selectStockNeedToReorder();
            $this->load->view('item/recommendedtoorder', $data);
        }
    }

    function getOptionUnit($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $allunit = $this->model_item->selectAllUnitAsc($itemid);
            echo "<option value='0'>--UNIT--</option>";
            foreach ($allunit as $result) {
                echo "<option value='" . $result->unitfrom . "'>" . $result->codes . "</option>";
            }
        }
    }

    function savenewunit() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $itemid = $this->input->post('itemid');
            $newunitfrom = $this->input->post('newunitfrom');
            $newunitto = $this->input->post('newunitto');
            $valueconversion = $this->input->post('valueconversion');
            $this->model_item->savenewunit($itemid, $newunitfrom, $newunitto, $valueconversion);
        }
    }

    function getwarehouse($itemid) {
        echo $this->model_item->getwarehouse($itemid);
    }

    function gettotalstock($itemid) {
        echo $this->model_item->getStockInSmallestUnit($itemid);
    }

    function deleteunit($itemid, $unitid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->model_item->deleteunit($itemid, $unitid);
        }
    }

    function setwarehouse($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $warehouse_set = $this->model_item->getindexwarehouse($id);
            $data['whs'] = $this->model_warehouse->selectNotIn($warehouse_set);
            $warehouse_available = $this->model_item->selectWarehouseItem($id);
            $arr_available = array();
            foreach ($warehouse_available as $result) {
                $arr_available[] = (int) $result->warehouseid;
            }
            $data['warehouse_available'] = $arr_available;
            $data['all_warehouse'] = $this->model_warehouse->selectAll($id);
            $data['itemid'] = $id;
            $this->load->view('item/setwarehouse', $data);
        }
    }

    function doshare() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $itemid = $this->input->post('itemid');
            $whs = $this->input->post('whs');
            for ($i = 0; $i < count($whs); $i++) {
                $this->model_item->doshare($itemid, $whs[$i]);
            }
        }
    }

    function deletefromwarehouse() {
        $itemid = $this->input->post('itemid');
        $warehouseid = $this->input->post('warehouseid');
        if ($this->model_item->isAvailableToDeleteWarehouse($itemid, $warehouseid)) {
            if ($this->model_item->removeWarehouse($itemid, $warehouseid)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => 'Cannot remove warehouse with available stock'));
        }
    }

    function transferstock($itemid) {
        $data['itemid'] = $itemid;
        $warehouseid = $this->session->userdata('optiongroup');
        $data['whs'] = $this->model_item->selectAvailableWarehouse($itemid, $warehouseid);
        $data['unit'] = $this->model_item->selectAllUnitByWareHouse($itemid);
        $this->load->view('item/transferstock', $data);
    }

    function dotransfer() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $itemid = $this->input->post('itemid');
            $unitid = $this->input->post('unitid');
            $qty = $this->input->post('qty');
            $warehouseid = $this->input->post('warehouseid');
            $transferid = $this->model_item->dotransfer($itemid, $this->session->userdata('optiongroup'), $warehouseid);
            for ($i = 0; $i < count($qty); $i++) {
                $this->model_item->dotransferunit($transferid, $unitid[$i], $qty[$i]);
            }
        }
    }

    function torecive($itemid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['transfer'] = $this->model_item->selectTransferedTo($itemid, $this->session->userdata('optiongroup'), 'false');
            $this->load->view('item/torecive', $data);
        }
    }

    function approvetransfer($transferid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->model_item->approvetransfer($transferid);
        }
    }

    function viewtransfered($itemid) {
        $data['transfer'] = $this->model_item->selectTransferedFrom($itemid, $this->session->userdata('optiongroup'), 'false');
        $this->load->view('item/transfered', $data);
    }

    function viewimage($filename) {
        echo "<image src='" . base_url() . "files/$filename' style='max-width:400px;' />";
    }

    function search_autocomplete() {
        sleep(3);

        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $term = $_GET['term'];


        $key_search = strtolower($term);

        if (get_magic_quotes_gpc()) {
            $key_search = stripslashes($key_search);
        }

        $query = "
            select 
            item.*,                
            groups.names groupname 
            from item 
            join groups on item.groupsid=groups.id 
            where true 
        ";

        if ($key_search != "") {
            $query .= " and (item.partnumber ilike '%$key_search%'
                          or item.descriptions ilike '%" . $key_search . "%'
                          or groups.names ilike '%" . $key_search . "%' )";
        }

        $query .= " order by item.descriptions asc,item.partnumber asc ";

        //echo $query;

        $items = $this->db->query($query)->result();

        $row = array();
        foreach ($items as $result) {
            $allunit = $this->model_item->getAllUnit($result->id);
            $row[] = array(
                "id" => $result->id,
                "label" => $result->partnumber,
                "value" => $result->partnumber,
                "desc" => $result->descriptions,
                "all_unit" => $allunit
            );
        }

        echo json_encode($row);
    }

    function edit_this_unit($itemid, $unitid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['unit'] = $this->model_unit->selectAll();
            $data['itemid'] = $itemid;
            $data['unitfrom'] = $unitid;
            $this->load->view('item/edit_this_unit', $data);
        }
    }

    function do_edit_this_unit() {
        $itemid = $this->input->post('itemid');
        $unitfrom = $this->input->post('unitfrom');
        $new_unitid = $this->input->post('new_unitid');

        if ($this->db->query("select item_update_unit($itemid,$unitfrom,$new_unitid)")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function slowmoving() {
        $data['item'] = $this;
        $data['itemgroup'] = $this->model_groups->selectAllForSelect();
        $this->load->view('item/slow_moving', $data);
    }

    function slowmoving_search($offset) {

        $query = "
            select 
                    it.id,
                    it.groupsid,
                    g.codes group_code,
                    it.partnumber item_code,
                    it.descriptions item_description,
                    it_last.trans_time last_transaction_date,
                    (now()::date - it_last.trans_time::date) doi
            from item it
                    left join v_last_transaction it_last on it.id=it_last.itemid
                    join groups g on it.groupsid=g.id
            
        ";
        
        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " join stock on it.id=stock.itemid ";
            }
        }
        
        $query .= " where true 
                    and item_get_stock_smallest_unit(it.id) > 0 ";
        
        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and stock.warehouseid=" . $this->session->userdata('optiongroup');
            }
        }
        
        $options = $this->input->post("options");
        if (empty($options)) {
            $options = 0;
        }

        if ($options == 0) {
            $query .= " and it_last.trans_time is not null and ((now()::date - it_last.trans_time::date))>59 ";
        } else {
            $query .= " and it_last.trans_time is null";
        }



        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (it.partnumber ilike '%$item_code_description%' or it.descriptions ilike '%$item_code_description%')";
        }

        $groupid = $this->input->post("groupid");
        if ($groupid != '0') {
            $query .= " and it.groupsid=$groupid";
        }

//        echo "<pre>".$query."</pre>";exit;
        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;

        if ($options == 0) {
            $query .= "  order by it_last.trans_time asc limit $limit offset $offset";
        } else {
            $query .= "  order by it.partnumber asc limit $limit offset $offset";
        }

//        echo "<pre>".$query."</pre>";exit;

        $data['item_list'] = $this->db->query($query)->result();

        $this->load->view('item/slow_moving_search', $data);
    }

    function slowmoving_print($st) {

        $query = "
            select 
                    it.id,
                    it.groupsid,
                    g.codes group_code,
                    it.partnumber item_code,
                    it.descriptions item_description,
                    it_last.trans_time last_transaction_date,
                    (now()::date - it_last.trans_time::date) doi
            from item it
                    left join v_last_transaction it_last on it.id=it_last.itemid
                    join groups g on it.groupsid=g.id
            
        ";
        
        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " join stock on it.id=stock.itemid ";
            }
        }
        
        $query .= " where true 
                    and item_get_stock_smallest_unit(it.id) > 0 ";
        
        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and stock.warehouseid=" . $this->session->userdata('optiongroup');
            }
        }

        $options = $this->input->post("options");
        if (empty($options)) {
            $options = 0;
        }

        if ($options == 0) {
            $query .= " and it_last.trans_time is not null and ((now()::date - it_last.trans_time::date))>59 ";
        } else {
            $query .= " and it_last.trans_time is null";
        }

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (it.partnumber ilike '%$item_code_description%' or it.descriptions ilike '%$item_code_description%')";
        }

        $groupid = $this->input->post("groupid");
        if ($groupid != '0') {
            $query .= " and it.groupsid=$groupid";
        }

        if ($options == 0) {
            $query .= "  order by it_last.trans_time asc ";
        } else {
            $query .= "  order by it.partnumber asc";
        }


        $data['item_list'] = $this->db->query($query)->result();

        if ($st == 1) {
            $this->load->library('excel');
            $this->load->view('item/slow_moving_excel', $data);
        } else {
            $this->load->view('item/slow_moving_print', $data);
        }
    }

}
?>
