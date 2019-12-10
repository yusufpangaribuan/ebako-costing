<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stockopname
 *
 * @author operational
 */
class stockopname extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_stockopname');
    }

    function index() {
        $data['stockopname'] = $this;
        $this->load->view('stockopname/index', $data);
    }

    function search($offset) {

        $this->load->model('model_user');

        $data['offset'] = $offset;

        $query = "
            with t as(
                    select 
                    stockopname.*,
                    warehouse.name warehouse_name
                    from
                    stockopname join
                    warehouse on stockopname.warehouseid=warehouse.id 
            ) select t.* from t where true
        ";

        $stockopname_no = $this->input->post("stockopname_no");
        if (!empty($stockopname_no)) {
            $query .= " and t.stockopname_no ilike '%$stockopname_no%' ";
        }

        $date_from = $this->input->post('start_date');
        $date_to = $this->input->post('end_date');
        if (!empty($date_from) && !empty($date_to)) {
            $query .= " and t.date between '" . $date_from . "' and '" . $date_to . "' ";
        }if (!empty($date_from) && empty($date_to)) {
            $query .= " and t.date = '" . $date_from . "' ";
        }if (empty($date_from) && !empty($date_to)) {
            $query .= " and t.date = '" . $date_to . "' ";
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $data['offset'] = $offset;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by t.id desc limit $limit offset $offset";
        //echo $query;
        $data['stockopname'] = $this->db->query($query)->result();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "stockopname"));
        $this->load->view('stockopname/search', $data);
    }

    function add() {
        $this->load->model('model_warehouse');
        $data['warehouse'] = $this->model_warehouse->selectAll();
        $this->load->view('stockopname/add', $data);
    }

    function save() {
        $data = array(
            "date" => $this->input->post('date'),
            "description" => $this->input->post('description'),
            "warehouseid" => $this->input->post('warehouseid')
        );
        if ($this->model_stockopname->insert($data)) {
            $last_id = $this->model_stockopname->get_last_id();
            echo json_encode(array('success' => true, 'id' => $last_id));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $data['stockopname'] = $this->model_stockopname->select_by_id($id);
        $data['stockopnameid'] = $id;
        $data['detail'] = $this->model_stockopname->select_item($id);
        $this->load->view('stockopname/edit', $data);
    }

    function add_item($stockopnameid) {
        $this->load->model('model_groups');
        $data['group'] = $this->model_groups->selectAll();
        $data['stockopnameid'] = $stockopnameid;
        $this->load->view("stockopname/add_item", $data);
    }

    function find_item() {
        $query = "
        select 
        stock.*,
        item.partnumber item_code,
        item.descriptions item_description,
        groups.names group_name,
        unitfrom unitid,
        unit.codes unit_code
        from 
        stock join item on stock.itemid=item.id
        join unit on stock.unitfrom=unit.id
        join groups on item.groupsid=groups.id
        where true
     ";

        $item_code = $this->input->post('item_code');
        if (!empty($item_code)) {
            $query .= " and (item.partnumber ilike '%$item_code%' or item.descriptions ilike '%$item_code%')";
        }

        $groupid = $this->input->post('groupid');
        if ($groupid != 0) {
            $query .= " and item.groupsid=$groupid";
        }

        $query .= " and stock.warehouseid=1";

        $query .= " order by id asc limit 100";
        $item = $this->db->query($query)->result();

        foreach ($item as $result) {
            ?>
            <tr>
                <td><input type="checkbox" name="chk_z56[]" value="<?php echo $result->id . '/' . $result->itemid . '/' . $result->unitid . '/' . $result->stock ?>"/></td>
                <td><?php echo $result->group_name ?></td>
                <td><?php echo $result->item_code ?></td>
                <td><?php echo $result->item_description ?></td>
                <td><?php echo $result->unit_code ?></td>
            </tr>
            <?php
        }
    }

    function save_item($stockopnameid) {
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $stock = $this->input->post('stock');
        $warehouseid = 1;
        $data = array();
        for ($i = 0; $i < count($itemid); $i++) {
            $data[] = array(
                "itemid" => $itemid[$i],
                "unitid" => $unitid[$i],
                "stock" => (double) $stock[$i],
                "stockopnameid" => $stockopnameid,
                "warehouseid" => $warehouseid,
            );
        }

        if ($this->model_stockopname->item_insert_batch($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function load_list_not_in() {
        $detail_ids = $this->input->post('detail_ids');
        $stockopnameid = $this->input->post('stockopnameid');
        $detail = $this->model_stockopname->select_not_in_list($detail_ids, $stockopnameid);
        $counter = $this->db->query("select count(*) ct from stockopnamedetail where stockopnamedetail.stockopnameid=$stockopnameid
            and stockopnamedetail.id in ($detail_ids)")->row()->ct;
        $counter++;
        foreach ($detail as $result) {
            ?>
            <tr>
                <td>
                    <input type="hidden" name="sop_detail8_id[]" value="<?php echo $result->id ?>"/>
                    <?php echo $result->item_code ?>
                </td>
                <td><?php echo $result->item_description ?></td>
                <td><?php echo $result->unit_code ?></td>
                <td><input type="text" style="width: 100%;text-align: right;" id="sopd_stock<?php echo $result->id ?>" readonly="" value="<?php echo $result->stock ?>"></td>
                <td><input type="text" style="width: 100%;text-align: right;" name="sopd_real_stock[]" id="sopd_real_stock<?php echo $result->id ?>" value="<?php echo $result->stock ?>" onkeyup="stockopname_calc_diff(<?php echo $result->id ?>)"></td>
                <td><input type="text" style="width: 100%;text-align: right;" name="sopd_diff_stock[]" id="sopd_diff_stock<?php echo $result->id ?>"  value="0" readonly=""></td>
                <td>
                    <a href="javascript:void(0)" onclick="stockopname_detail_delete(<?php echo $result->id ?>, this)"><img src="images/delete.png">Delete</a>
                </td>
            </tr>
            <?php
        }
    }

    function delete($id) {
        if ($this->model_stockopname->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_delete($id) {
        if ($this->model_stockopname->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_update() {
        $ids = $this->input->post('ids');
        $real_stock = $this->input->post('real_stock');
        $diff_stock = $this->input->post('diff_stock');


        $error_message = "";
        $this->db->trans_start();
        for ($i = 0; $i < count($ids); $i++) {
            $data = array(
                "real_stock" => $real_stock[$i],
                "difference" => $diff_stock[$i]
            );
            if (!$this->model_stockopname->detail_update($data, array("id" => $ids[$i]))) {
                $error_message = $this->db->_error_message();
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

    function posting($id) {
        if ($this->model_stockopname->posting($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id, $type) {
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['stockopname'] = $this->model_stockopname->select_by_id($id);
        $data['detail'] = $this->model_stockopname->select_item($id);
        $data['type'] = $type;
        $this->load->view('stockopname/print', $data);
    }

    function excel($id) {
        $this->load->model('model_company');
        $this->load->library('excel');
        $data['company'] = $this->model_company->getDetail();
        $data['stockopname'] = $this->model_stockopname->select_by_id($id);
        $data['detail'] = $this->model_stockopname->select_item($id);
        $this->load->view('stockopname/excel', $data);
    }

}
