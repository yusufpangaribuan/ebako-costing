<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stockout
 *
 * @author hp
 */
class stockout extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>alert('Session Expired!\\nPlease Log out and Login Again!');location.reload()</script>";
        }
        $this->load->model('model_stockout');
        $this->load->model('model_stockoutdetail');
        $this->load->model('model_user');
    }

    function index() {
        $this->load->model('model_department');
        $this->load->model('model_vendor');
        $offset = 0;
        $data['department'] = $this->model_department->selectAll();
        $data['num_rows'] = $this->model_stockout->getNumRows("", "", "", "", 0, "", "");
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['stockout'] = $this->model_stockout->search("", "", "", "", 0, "", "", $limit, $offset);
        $this->load->view('stockout/view', $data);
    }

    function search($offset) {
        $number = $this->input->post('number');
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $refno = $this->input->post('refno');
        $departmentid = $this->input->post('departmentid');
        $outby = $this->input->post('outby');
        $receiveby = $this->input->post('receiveby');
        $data['num_rows'] = $this->model_stockout->getNumRows($number, $date_start, $date_end, $refno, $departmentid, $outby, $receiveby);
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['stockout'] = $this->model_stockout->search($number, $date_start, $date_end, $refno, $departmentid, $outby, $receiveby, $limit, $offset);
        $this->load->view('stockout/search', $data);
    }

    function printlist() {
        $number = $this->input->post('number');
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $refno = $this->input->post('refno');
        $departmentid = $this->input->post('departmentid');
        $outby = $this->input->post('outby');
        $receiveby = $this->input->post('receiveby');
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['stockout'] = $this->model_stockout->searchforprint($number, $date_start, $date_end, $refno, $departmentid, $outby, $receiveby);
        $this->load->view('stockout/printlist', $data);
    }

    function add() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAll();
        $this->load->view('stockout/add', $data);
    }

    function addbychoosemr($mrid) {
        $this->load->model('model_mr');
        $this->load->model('model_mrdetail');
        $this->load->model('model_department');
        $this->load->model('model_unit');
        $this->load->model('model_item');
        $this->load->model('model_employee');
        $data['mrid'] = $mrid;
        $data['mr'] = $this->model_mr->selectById($mrid);
        $data['department'] = $this->model_department->selectAll();
        $data['mrdetail'] = $this->model_mrdetail->selectByMrId($mrid);
        $data['devision'] = $this->db->query("select * from dept_division order by name asc")->result();
        $this->load->view('stockout/addbychoosemr', $data);
    }

    function savebymrchoose() {
        $this->load->model('model_mr');
        $this->load->model('model_stockoutdetail');


        $decode = json_decode($this->input->post("data"));

        $header = $decode->header;
        $details = $decode->details;


        $stockout = array(
            "number" => $this->model_stockout->getNextNumber(),
            "mrid" => $header->mrid,
            "date" => $header->date,
            "refno" => $header->refno,
            "outby" => $header->outby,
            "receiveby" => $header->receiveby,
            "departmentid" => $header->departmentid,
            "dept_divisionid" => $header->dept_divisionid,
            "warehouseid" => $this->session->userdata('optiongroup')
        );

        $error_message = "";
        $this->db->trans_start();
        if ($this->model_stockout->insert($stockout)) {
            $stockoutid = $this->model_stockout->get_last_id();
            $stockoutitem = array();
            foreach ($details as $detail) {
                $stockoutitem[] = array(
                    "stockoutid" => $stockoutid,
                    "mrdetailid" => $detail->mrdetailid,
                    "itemid" => $detail->itemid,
                    "qty" => $detail->out,
                    "unitid" => $detail->unitid
                );
            }
            if (!$this->model_stockoutdetail->insert_batch($stockoutitem)) {
                $error_message = $this->db->_error_message();
            }
        } else {
            $error_message = $this->db->_error_message();
        }

        if (!$this->model_stockout->receive($stockoutid)) {
            $error_message = $this->db->_error_message();
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

    function save() {
        $this->load->model('model_stockoutdetail');
        $mrid = $this->input->post('mrid');
        $date = $this->input->post('date');
        $refno = $this->input->post('refno');
        $outby = $this->input->post('outby');
        $receiveby = $this->input->post('receiveby');
        $departmentid = $this->input->post('departmentid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $out = $this->input->post('out');
        $soid = $this->input->post('soid');
        $stockoutid = $this->model_stockout->savebymrchoose($mrid, $date, $refno, $outby, $receiveby, $departmentid);
        for ($i = 0; $i < count($itemid); $i++) {
            //if ($itemid[$i] != 0 && $out[$i] > 0) {
            //echo "tes";
            $this->model_stockoutdetail->save($stockoutid, $itemid[$i], $unitid[$i], $out[$i], $soid);
            //}
        }
    }

    function update() {
        $this->load->model('model_stockoutdetail');
        $id = $this->input->post('id');
        $mrid = $this->input->post('mrid');
        $date = $this->input->post('date');
        $refno = $this->input->post('refno');
        $outby = $this->input->post('outby');
        $receiveby = $this->input->post('receiveby');
        $departmentid = $this->input->post('departmentid');
        $dept_divisionid = $this->input->post('dept_divisionid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $out = $this->input->post('out');
        $stockoutdetailid = $this->input->post('stockoutdetailid');
        $this->model_stockout->update($id, $mrid, $date, $refno, $outby, $receiveby, $departmentid, $dept_divisionid);
        for ($i = 0; $i < count($stockoutdetailid); $i++) {
            if ($stockoutdetailid[$i] == 0) {
                $this->model_stockoutdetail->save($id, $itemid[$i], $unitid[$i], $out[$i]);
            } else {
                $this->model_stockoutdetail->update($stockoutdetailid[$i], $itemid[$i], $unitid[$i], $out[$i]);
            }
        }
    }

    function additem($counter) {
        $data['flag'] = $counter;
        $this->load->view('stockout/additem', $data);
    }

    function edit($id, $mrid) {
        $this->load->model('model_department');
        $this->load->model('model_stockoutdetail');
        $this->load->model('model_item');
        $data['department'] = $this->model_department->selectAll();
        $data['stockout'] = $this->model_stockout->selectById($id);
        $data['stockoutdetail'] = $this->model_stockoutdetail->selectByStockoutId($id);
        $data['devision'] = $this->db->query("select * from dept_division order by name asc")->result();
        $data['id'] = $id;
        $data['mrid'] = $mrid;
        if ($mrid == 0) {
            $this->load->view('stockout/edit', $data);
        } else {
            $this->load->view('stockout/editbychoosemr', $data);
        }
    }

    function deleteitem($id) {
        $this->load->model('model_stockoutdetail');
        $this->model_stockoutdetail->delete($id);
    }

    function delete($id) {
        $this->load->model('model_stockoutdetail');
        if ($this->model_stockoutdetail->deleteByStockOutId($id)) {
            $this->model_stockout->delete($id);
        }
    }

    function prints($id, $st) {
        $this->load->model('model_stockoutdetail');
        $this->load->model('model_department');
        $data['st'] = $st;
        $data['stockout'] = $this->model_stockout->selectById($id);
        $data['stockoutdetail'] = $this->model_stockoutdetail->selectByStockoutId($id);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        if ($st == 1) {
            $this->load->library("pdf");
            $html = $this->load->view('stockout/print', $data, true);
            $this->pdf->pdf_create($html, "file");
        } else {
            $this->load->view('stockout/print', $data);
        }
    }

    function receive($id) {
        $this->model_stockout->receive($id);
    }

    function report_form() {
        $this->load->model('model_department');
        $this->load->model('model_groups');

        $data['group'] = $this->model_groups->selectAll();
        $data['department'] = $this->model_department->selectAll();
        $data['sub_department'] = $this->db->query("select * from dept_division")->result();
        $this->load->model('model_costcenter');
        $data['costcenter'] = $this->model_costcenter->select_all();
        $this->load->view('stockout/report_form', $data);
    }

    function rpt_generate($st) {
        $this->load->model('model_rates');
        $query = "
            with t as (
            select 
            stockoutdetail.*,
            stockout.number,
            stockout.date,
            stockout.departmentid,
            stockout.refno,
            stockout.outby,
            mr.number mr_number,
            mr.requestby,
            mr.cost_center_id,
            mr.area_id,
            employee.name name_request,
            department.name departmentname,
            dept_division.name sub_department,
            item.partnumber item_code,
            item.descriptions item_description,
            item.groupsid group_id,
            unit.codes unit_code,
            mrdetail.reason,
            item_get_detail_last_purchase_price(stockoutdetail.itemid,stockoutdetail.unitid) last_price_detail
            from stockoutdetail
            join stockout on stockoutdetail.stockoutid=stockout.id
            join mr on stockout.mrid=mr.id
            join item on stockoutdetail.itemid=item.id
            join unit on stockoutdetail.unitid=unit.id
            join department on stockout.departmentid=department.id 
            left join dept_division on stockout.dept_divisionid=dept_division.id
            left join employee on mr.requestby=employee.id
            left join mrdetail on stockoutdetail.mrdetailid=mrdetail.id
            )select t.*,
		    split_part(t.last_price_detail,',',2) price,
		    split_part(t.last_price_detail,',',3) currency,
		    reates_get_conversion_value_by_efective_date(split_part(t.last_price_detail,',',3),split_part(t.last_price_detail,',',2)::double precision,t.date) price_in_idr,
		    rates_get_last_evidence_number_by_efective_date(split_part(t.last_price_detail,',',3),t.date) rate_id
	    from t where true";


        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $stock_out_no = $this->input->post('stock_out_no');
        $departmentid = $this->input->post('departmentid');
        $sto_rpt_sub_departmentid = $this->input->post('sto_rpt_sub_departmentid');

        if (!empty($stock_out_no)) {
            $query .= " and t.number ilike '%$stock_out_no' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and t.date between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and t.date = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and t.date = '$date_start' ";
        }if ($departmentid != 0) {
            $query .= " and t.departmentid = $departmentid ";
        }if ($sto_rpt_sub_departmentid != 0) {
            $query .= " and t.dept_divisionid = $sto_rpt_sub_departmentid ";
        }

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (t.item_code ilike '%$item_code_description%' or t.item_description ilike '%$item_code_description%') ";
        }
        $groupid = $this->input->post('groupid');
        if (!empty($groupid)) {
            $query .= " and t.group_id = $groupid";
        }

        $cost_center_id = $this->input->post("cost_center_id");
        $member_cost_center_id = $this->input->post('member_cost_center_id');
        if ($cost_center_id != 0) {
            $query .= " and (t.cost_center_id=$cost_center_id";
            if ($member_cost_center_id != 0) {
                if ($member_cost_center_id == -1) {
                    $query .= " or t.cost_center_id in (select id from cost_center where id in (select unnest(member) from cost_center where id=$cost_center_id) order by description asc)";
                } else {
                    $query .= " or t.cost_center_id=$member_cost_center_id";
                }
            }
            $query .= ")";
        }

        $query .= " order by t.id asc ";

//        echo $query;

        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['stockout'] = $this->db->query($query)->result();
        $data['st'] = $st;
        if ($st == 1) {
            $this->load->view('stockout/print_report', $data);
        } else if ($st == 2) {
            $this->load->view('stockout/print_report', $data);
        } else {
            ini_set('memory_limit', '2048M');
            $this->load->library('excel');
            $this->load->view('stockout/print_report_excel', $data);
        }
    }

    function do_receive() {

        if ($this->db->query("select stockout_receive(" . $this->input->post("id") . ")")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
