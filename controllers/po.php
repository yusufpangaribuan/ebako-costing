<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of po
 *
 * @author hp
 */
class po extends CI_Controller {

    //put your code herev
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->library('component');
        $this->load->model('model_po');
        $this->load->model('model_vendor');
        $this->load->model('model_employee');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "po"));
        $this->load->model('model_department');
        $this->load->model('model_vendor');
        $data['department'] = $this->model_department->selectAll();
        $data['vendor'] = $this->model_vendor->select_all();
        $data['postatus'] = $this->config->item('postatus');
        $data['po'] = $this;
        $this->load->view('po/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "po"));
        $data['postatus'] = $this->config->item('postatus');
        $ponumber = $this->input->post('ponumber');
        $prnumber = $this->input->post('prnumber');
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');

        $vendorid = $this->input->post('vendorid');
        $status = $this->input->post('status');

        $query = "select po.*,pr.requestdate,pr.departmentid,
                pr.capex,pr.jsa,pr.requestnumber,po_get_all_department_by_po_id(po.id) departmentcode,
                vendor.vendornumber,vendor.name vendorname
                from po join pr on po.prid=pr.id join vendor 
                on po.vendorid=vendor.id ";
        if (!empty($ponumber)) {
            $query .= " and po.ponumber ilike '%$ponumber%' ";
        }if (!empty($prnumber)) {
            $query .= " and pr.requestnumber ilike '%$prnumber%' ";
        }if (!empty($date_start) && !empty($date_end)) {
            $query .= " and po.dates between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and po.dates = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and po.dates = '$date_start' ";
        }if ($vendorid != 0) {
            $query .= " and po.vendorid = $vendorid ";
        }if ($status != "") {
            $query .= " and po.status = $status ";
        }

        $departmentid = (int) $this->input->post('departmentid');
        if ($departmentid != 0) {
            $query .= " and pr.id in (select prid from pritem 
		left join materialrequisition_detail on pritem.materialrequisition_detail_id=materialrequisition_detail.id
		left join materialrequisition on materialrequisition_detail.materialrequisitionid=materialrequisition.id
		where materialrequisition.departmentid=$departmentid
		union 
		select prid from pritem
		left join servicerequestdetail srd on pritem.srd_id=srd.id
		left join servicerequest sr on srd.servicerequestid=sr.id
		where sr.departmentid=$departmentid)";
        }

        $data['item_view'] = 0;
        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and po.id in ("
                    . "select poid from pritem pritem "
                    . "join item on pritem.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
            $data['item_view'] = 1;
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $query .= " order by po.id desc limit $limit offset $offset ";
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['po'] = $this->db->query($query)->result();
        $this->load->view('po/search', $data);
    }

    function printpo($poid, $st) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "po"));
        $this->load->library("pdf");
        $this->load->library("mytcpdf");
        $this->load->model('model_approval');
        $this->load->model('model_employee');
        $data['po'] = $this->model_po->selectById($poid);
        $data['poitem'] = $this->model_po->selectItemByPoId($poid);
        $data['st'] = $st;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();

        if ($st == 3) {
            //$html = $this->load->view('po/print', $data, TRUE);
           // $this->pdf->pdf_create($html, "file");
            $this->load->view('po/print_tcpdf_lib', $data);
            $this->db->query("update po set printed=printed+1 where id=$poid");
            //$this->db->update('po', array("printed" => 1), array("id" => $poid));
        } else if ($st == 1) {
            $this->load->view('po/print2', $data);
        } else if ($st == 4) {
            $this->load->view('po/print_tcpdf_lib', $data);
            $this->db->query("update po set printed=printed+1 where id=$poid");
        }else if ($st == 5) {
            $html = $this->load->view('po/print', $data, TRUE);
            $this->pdf->pdf_create($html, "file");
           // $this->load->view('po/print_tcpdf_lib', $data);
            $this->db->query("update po set printed=printed+1 where id=$poid");
            //$this->db->update('po', array("printed" => 1), array("id" => $poid));
        }  
	else {
            $html = $this->load->view('po/print', $data, TRUE);
            echo $html;

            //.$this->pdf->pdf_create($html, "file");
        }
    }

    function view_detail($poid, $st) {
        $this->load->model('model_approval');
        $this->load->model('model_employee');
        $data['po'] = $this->model_po->selectById($poid);
        $data['poitem'] = $this->model_po->selectItemByPoId($poid);
        $data['st'] = $st;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $this->load->view('po/view_detail', $data);
    }

    function create($prid) {
        $this->load->model('model_vendor');
        if ($this->model_po->poCreate($prid)) {
            $data['po'] = $this->model_po->selectPoByPrid($prid);
            $this->load->view('po/create', $data);
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function savenew() {
        $id = $this->input->post('id');
        $payterm = $this->input->post('payterm');
        $deliverterm = $this->input->post('deliverterm');
        $sumof = $this->input->post('sumof');
        for ($i = 0; $i < count($id); $i++) {
            $this->model_po->setPaymentAndDeliveryTermAndSumOf($id[$i], $payterm[$i], $deliverterm[$i], $sumof[$i]);
        }
    }

    function edit($id) {
        $data['po'] = $this->model_po->selectById($id);
        $data['podetail'] = $this->model_po->selectItemByPoId($id);
        $data['vendor'] = $this->model_vendor->selectAll();
        $this->load->view('po/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $payterm = $this->input->post('payterm');
        $deliveryterm = $this->input->post('deliveryterm');
        $grandtotal = (double) $this->input->post('grandtotal');
        $all_total_price = (double) $this->input->post('all_total_price');
        //echo $all_total_price . "<br/>";
        $sumof = $this->component->convert_number_to_words($all_total_price);
        $data = array(
            "payterm" => $payterm,
            "deliveryterm" => $deliveryterm,
            "sumof" => $sumof,
            "all_total_price" => $all_total_price,
            "grandtotal" => $grandtotal
        );
        if ($this->model_po->updatePayAndDelivery($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function changestatus($poid, $status) {
        $data['status'] = $status;
        $data['poid'] = $poid;
        $this->load->view('po/changestatus', $data);
    }

    function savepostatus() {
        $this->load->model('model_pocloseapproval');
        $poid = $this->input->post('poid');
        $status = $this->input->post('status');
        $notes = $this->input->post('notes');
        $approval = $this->model_pocloseapproval->selectAll();
        $this->model_po->savePoStatus($poid, $status, $notes, $approval->level1, $approval->level2);
    }

    function viewstatus($poid) {
        echo $this->model_po->getPoStatus($poid);
    }

    function configureCloseApproval() {
        $data['approval'] = $this->model_po->selectDefaultApproval();
        $this->load->view('po/configure_close_approval', $data);
    }

    function saveconfigpoapproval() {
        $this->load->model('model_pocloseapproval');
        $approval = $this->input->post('approval');
        $this->model_pocloseapproval->update($approval[0], $approval[1]);
    }

    function approveclose() {
        $poid = $this->input->post('poid');
        $status = $this->input->post('status');
        $level = $this->input->post('level');
        $approvallevel2 = $this->input->post('approvallevel2');
        $this->model_po->approvelclose($poid, $status, $level, $approvallevel2);
    }

    function viewreceiveitem($poid) {
        $data['item'] = $this->model_po->selectReceive($poid);
        $this->load->view('po/viewreceiveitem', $data);
    }

    function report_form() {
        $this->load->model('model_department');
        $this->load->model('model_vendor');
        $this->load->model('model_groups');

        $data['group'] = $this->model_groups->selectAll();
        $data['department'] = $this->model_department->selectAll();
        $data['vendor'] = $this->model_vendor->select_all();
        $data['sub_department'] = $this->db->query("select * from dept_division")->result();
        $this->load->model('model_costcenter');
        $data['costcenter'] = $this->model_costcenter->select_all();
        $this->load->view('po/report_form', $data);
    }

    function rpt_generate($st) {
        $query = "
                with t as (
                    select
                    pr.requestnumber pr_no,
                    pr.departmentid,
                    po.ponumber po_no,
                    po.dates po_date,
                    po.status,
                    pritem.*,
                    unit.codes unit_code,
                    vendor.name vendor_name,
                    materialrequisition.number mr_no,
                    materialrequisition.date mr_date,
                    department.name department_request,
                    (select coalesce(sum(qty),0) from gritem where poitemid=pritem.id) qtyreceive,
                    po_get_date_receive_item(pritem.id) date_receive,
                    materialrequisition_detail.remark,
                    reates_get_conversion_value_by_efective_date(pritem.currency,pritem.total,po.dates) total_in_idr,
                    rates_get_last_evidence_number_by_efective_date(pritem.currency,po.dates) rate_id,
                    item.groupsid group_id,
                    materialrequisition.cost_center_id,
                    materialrequisition.dept_divisionid,
                    materialrequisition.area_id,
                    servicerequest.number sr_number,
                    servicerequest.date sr_date,
                    dept.name dept_name_service,
                    item.partnumber,
                    item.descriptions item_description
                    from pritem 
                    join pr on pritem.prid=pr.id
                    join item on pritem.itemid=item.id
                    left join po on pritem.poid=po.id
                    join unit on pritem.unitid=unit.id
                    join vendor on pritem.vendorid=vendor.id
                    left join materialrequisition_detail on pritem.materialrequisition_detail_id=materialrequisition_detail.id
                    left join materialrequisition on materialrequisition_detail.materialrequisitionid=materialrequisition.id
                    left join department on materialrequisition.departmentid=department.id
                    left join servicerequestdetail on pritem.srd_id = servicerequestdetail.id
                    left join servicerequest on servicerequestdetail.servicerequestid=servicerequest.id
                    left join department dept on servicerequest.departmentid=dept.id
                    where poid is not null
                ) select t.*,(case when t.status = 0 then 'OPEN' when t.status=1 then 'FINISH' when t.status=2 then 'Close' end) status_desc,rates.exchange_rate 
                from t left join rates on t.rate_id=rates.evidence_number where (t.status in (0,1) or (t.status = 2 and t.qtyreceive > 0))
        ";

        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');

        if (!empty($date_start) && !empty($date_end)) {
            $query .= " and t.po_date between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and t.po_date = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and t.po_date = '$date_start' ";
        }

        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and t.po_no ilike '%$po_no%'";
        }
        $pr_no = $this->input->post('pr_no');
        if (!empty($pr_no)) {
            $query .= " and t.pr_no ilike '%$pr_no%'";
        }
        $mr_no = $this->input->post('mr_no');
        if (!empty($mr_no)) {
            $query .= " and t.mr_no ilike '%$mr_no%'";
        }
        $vendorid = (int) $this->input->post('vendorid');
        if ($vendorid != 0) {
            $query .= " and t.vendorid = $vendorid ";
        }
        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (t.partnumber ilike '%$item_code_description%' or t.itemdescription ilike '%$item_code_description%')";
        }
        $groupid = $this->input->post('groupid');
        if ($groupid != 0) {
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

        $query .= " order by t.poid desc ";

//        echo $query;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['po'] = $this->db->query($query)->result();
        $data['st'] = $st;
        if ($st == 1) {
            $this->load->view('po/print_report', $data);
        } else if ($st == 2) {
            $this->load->view('po/print_report', $data);
        } else {
            $this->load->library('excel');
            $this->load->view('po/print_report_excel', $data);
        }
    }

    function critical() {
        $data['po'] = $this;
        $this->load->view('po/critical', $data);
    }

    function critical_search($offset) {

        $query = "
          with t as (
            select 
            pritem.id,
            pritem.itemid,
            item.partnumber item_code,
            item.descriptions item_description,
            pritem.unitid,
            pritem.qty,
            pritem.outstanding,
            unit.codes unit_code,
            pritem.poid,
            po.ponumber po_number,
            po.deliveryterm,
            po.dates po_date,
            po.vendorid,
            vendor.name vendor_name,
            is_valid_date(po.deliveryterm) delivery_date_valid
            from 
            pritem
            join po on pritem.poid=po.id
            join vendor on po.vendorid=vendor.id
            join item on pritem.itemid=item.id
            join unit on pritem.unitid=unit.id
            where pritem.outstanding > 0 and po.status=0
            ) select t.* from t where true and ((case when t.delivery_date_valid is true then (((t.deliveryterm::date) - now()::date) < 14) end)
              or (now()::date - t.po_date::date) > 14)
        ";

        $po_critical_no = $this->input->post('po_critical_no');
        if (!empty($po_critical_no)) {
            $query .= " and t.po_number ilike '%$po_critical_no' ";
        }

        $vendor = $this->input->post('vendor');
        if (!empty($vendor)) {
            $query .= " and t.vendor_name ilike '%$vendor%' ";
        }

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (t.item_code ilike '%$item_code_description%' or t.item_description ilike '%$item_code_description%')";
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by t.id asc limit $limit offset $offset";

        $data['po_critical'] = $this->db->query($query)->result();

        $this->load->view('po/critical_search', $data);
    }

    
    function critical_print($st) {

        $query = "
          with t as (
            select 
            pritem.id,
            pritem.itemid,
            item.partnumber item_code,
            item.descriptions item_description,
            pritem.unitid,
            pritem.qty,
            pritem.outstanding,
            unit.codes unit_code,
            pritem.poid,
            po.ponumber po_number,
            po.deliveryterm,
            po.dates po_date,
            po.vendorid,
            vendor.name vendor_name,
            is_valid_date(po.deliveryterm) delivery_date_valid
            from 
            pritem
            join po on pritem.poid=po.id
            join vendor on po.vendorid=vendor.id
            join item on pritem.itemid=item.id
            join unit on pritem.unitid=unit.id
            where pritem.outstanding > 0 and po.status=0
            ) select t.* from t where true and ((case when t.delivery_date_valid is true then (((t.deliveryterm::date) - now()::date) < 14) end)
              or (now()::date - t.po_date::date) > 14)
        ";

        $po_critical_no = $this->input->post('po_critical_no');
        if (!empty($po_critical_no)) {
            $query .= " and t.po_number ilike '%$po_critical_no' ";
        }

        $vendor = $this->input->post('vendor');
        if (!empty($vendor)) {
            $query .= " and t.vendor_name ilike '%$vendor%' ";
        }

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (t.item_code ilike '%$item_code_description%' or t.item_description ilike '%$item_code_description%')";
        }

        $query .= "  order by t.id asc";
        $data['po_critical'] = $this->db->query($query)->result();

        if ($st == 1) {
            $this->load->library('excel');
            $this->load->view('po/critical_excel', $data);
        } else {
            $this->load->view('po/critical_print', $data);
        }
    }
}
