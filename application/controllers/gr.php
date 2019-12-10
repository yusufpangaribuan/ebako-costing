<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mr
 *
 * @author hp
 */
class gr extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_po');
        $this->load->model('model_gr');
        $this->load->model('model_gritem');
        $this->load->model('model_user');
    }

    function index() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "gr"));
            $this->load->model('model_vendor');
            $limit = $this->config->item('limit');
            $offset = 0;
            $data['vendor'] = $this->model_vendor->select_all();
            if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != '') {
                $data['po'] = $this->model_po->selectPoUncompleteReceive();
            }
            $data['num_rows'] = $this->model_gr->getNumRows("", "", "", "", 0, "", "");
            $data['offset'] = $offset + 1;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['gr'] = $this->model_gr->search("", "", "", "", 0, "", "", $limit, $offset);
            $this->load->view('gr/view', $data);
        }
    }

    function search($offset) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "gr"));
            $grnumber = $this->input->post('grnumber');
            $date_start = $this->input->post('date_start');
            $date_end = $this->input->post('date_end');
            $ponumber = $this->input->post('ponumber');
            $vendorid = $this->input->post('vendorid');
            $letternumber = $this->input->post('letternumber');
            $receiveby = $this->input->post('receiveby');
            $data['num_rows'] = $this->model_gr->getNumRows($grnumber, $date_start, $date_end, $ponumber, $vendorid, $letternumber, $receiveby);
            $limit = $this->config->item('limit');
            $data['offset'] = $offset + 1;
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['gr'] = $this->model_gr->search($grnumber, $date_start, $date_end, $ponumber, $vendorid, $letternumber, $receiveby, $limit, $offset);
            $this->load->view('gr/search', $data);
        }
    }

    function getpoitem($poid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_warehouse');
            $this->load->model('model_employee');
            $data['warehouse'] = $this->model_warehouse->selectAll();
            $data['po'] = $this->model_po->selectById($poid);
            $data['poitem'] = $this->model_po->selectOutstandingItemByPoId($poid);
            $this->load->view('gr/poitem', $data);
        }
    }

    function getpoitembyvendor($vendorid) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_warehouse');
            $this->load->model('model_employee');
            $this->load->model('model_vendor');
            $data['warehouse'] = $this->model_warehouse->selectAll();
//            $data['po'] = $this->model_po->selectById($poid);

            $data['poitem'] = $this->model_po->selectOutstandingItemByVendorId($vendorid);
            $data['vendorid'] = $vendorid;
            $this->load->view('gr/poitembyvendor', $data);
        }
    }

    function receiveitem() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $poid = $this->input->post('poid');
            $qty = $this->input->post('qty');
            $poitemid = $this->input->post('poitemid');
            $rejectqty = $this->input->post('rejectqty');
            $letternumber = $this->input->post('letternumber');
            $receivedate = $this->input->post('receivedate');
            $note = $this->input->post('note');
            $qltid = $this->input->post('qltid');
            $error_message = "";
            $this->db->trans_start();
            $do_date = $this->input->post('do_date');
            $data = array(
                "letternumber" => $letternumber,
                "receivedate" => $receivedate,
                "receivedby" => $this->session->userdata('id'),
                "do_date" => (empty($do_date) ? null : $do_date),
                "vendorid" => $this->input->post('vendorid')
            );

            if ($this->db->insert('gr', $data)) {
                $grid = $this->model_gr->get_last_id();
                for ($i = 0; $i < count($poitemid); $i++) {
                    $tempqty = (double) $qty[$i];
                    $temprejectqt = (double) $rejectqty[$i];
                    if ($tempqty != 0 || $temprejectqt != 0) {
                        if ($this->model_gritem->insert($grid, $poitemid[$i], $tempqty, $temprejectqt, $note[$i], $qltid[$i])) {
                            if (!empty($qltid[$i])) {
                                $this->model_gritem->updateQlyReceivetoTrue($qltid[$i]);
                            }
                        } else {
                            $error_message = $this->db->_error_message();
                        }
                    } else {
                        $error_message = $this->db->_error_message();
                    }
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
    }

    function edit($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_gritem');
            $data['gr'] = $this->model_gr->selectById($id);
            $data['gritem'] = $this->model_gritem->selectByGrId($id);
            $this->load->view('gr/edit2', $data);
        }
    }

    function delete($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_gritem');
            if ($this->model_gritem->deleteByGrId($id)) {
                $this->model_gr->delete($id);
            }
        }
    }

    function deleteitem($id) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->model_gritem->delete($id);
        }
    }

    function update() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $id = $this->input->post('id');
            $qty = $this->input->post('qty');
            $gritemid = $this->input->post('gritemid');
            $rejectqty = $this->input->post('rejectqty');
            $letternumber = $this->input->post('letternumber');
            $receivedate = $this->input->post('receivedate');
            $receivedby = $this->input->post('receivedby');
            $note = $this->input->post('note');
            $error_message = "";

            $this->db->trans_start();
            if ($this->model_gr->update($id, $letternumber, $receivedate, $receivedby)) {
                for ($i = 0; $i < count($gritemid); $i++) {
                    if (!$this->model_gritem->update($gritemid[$i], $qty[$i], $rejectqty[$i], $note[$i])) {
                        $error_message = $this->db->_error_message();
                    }
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
    }

    function prints() {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $grnumber = $this->input->post('grnumber');
            $date_start = $this->input->post('date_start');
            $date_end = $this->input->post('date_end');
            $ponumber = $this->input->post('ponumber');
            $vendorid = $this->input->post('vendorid');
            $letternumber = $this->input->post('letternumber');
            $receiveby = $this->input->post('receiveby');
            $this->load->model('model_company');
            $data['company'] = $this->model_company->getDetail();
            $data['gr'] = $this->model_gr->searchforprint($grnumber, $date_start, $date_end, $ponumber, $vendorid, $letternumber, $receiveby);
            $this->load->view('gr/print', $data);
        }
    }

    function printdetail($id, $st) {
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        } else {
            $this->load->model('model_gritem');
            $data['gr'] = $this->model_gr->selectById($id);
            $data['gritem'] = $this->model_gritem->selectByGrId($id);
            $data['st'] = $st;
            $this->load->model('model_company');
            $data['company'] = $this->model_company->getDetail();
            if ($st == 1) {
                $this->load->library("pdf");
                $html = $this->load->view('gr/printdetail', $data, TRUE);
                $this->pdf->pdf_create($html, "file");
            } else if ($st == 2) {
                $html = $this->load->view('gr/printdetail', $data);
            } else if ($st == 3) {
                $this->load->library("pdf");
                $html = $this->load->view('gr/print2', $data, TRUE);
                $this->pdf->pdf_create($html, "receipt");
                $this->db->query("update gr set printed=printed+1 where id=$id");
            } else {
                $html = $this->load->view('gr/print2', $data);
            }
        }
    }

    function report() {
        $this->load->view('report');
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
        $this->load->view('gr/report_form', $data);
    }

    function rpt_generate($st) {
        $this->load->model('model_rates');
        $query = "
            select 
                gritem.id,gritem.qty,gritem.rejectqty,gritem.warehouseid,gritem.note,
                gr.date gr_date,gr.number gr_number,gr.letternumber,emp.name name_receive_by,
                gr.receivedby,gr.poid,po.ponumber po_number,vendor.name vendor_name,pr.requestnumber pr_number,
                materialrequisition.number mr_number,materialrequisition.cost_center_id,materialrequisition.dept_divisionid,
                materialrequisition.area_id,pritem.itemid,item.partnumber item_code,item.descriptions item_description,pritem.qty order_qty,
                pritem.outstanding,unit.codes unit_code,pritem.price,pritem.currency,reates_get_conversion_value_by_efective_date(pritem.currency,pritem.price,gr.date) price_in_idr,
                rates_get_last_evidence_number_by_efective_date(pritem.currency,gr.date) rate_id,materialrequisition_detail.remark mr_detail_remark,sr.number sr_number
            from gritem
                join gr on gritem.grid=gr.id
                left join pritem on gritem.poitemid=pritem.id
                left join item on pritem.itemid=item.id 
                left join unit on pritem.unitid=unit.id
                left join po on pritem.poid=po.id
                left join vendor on po.vendorid=vendor.id
                left join pr on po.prid=pr.id
                left join materialrequisition on pr.materialrequisitionid=materialrequisition.id
                left join materialrequisition_detail on pritem.materialrequisition_detail_id=materialrequisition_detail.id
                left join employee emp on gr.receivedby=emp.id
                left join servicerequestdetail srd on pritem.srd_id=srd.id
                left join servicerequest sr on srd.servicerequestid=sr.id
            where true
        ";
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');

        if (!empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date between '$date_start' and '$date_end' ";
        }if (empty($date_start) && !empty($date_end)) {
            $query .= " and gr.date = '$date_end' ";
        }if (!empty($date_start) && empty($date_end)) {
            $query .= " and gr.date = '$date_start' ";
        }

        $gr_no = $this->input->post('gr_no');
        if (!empty($gr_no)) {
            $query .= " and gr.number ilike '%$gr_no%'";
        }
        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and po.ponumber ilike '%$po_no%'";
        }
        $pr_no = $this->input->post('pr_no');
        if (!empty($pr_no)) {
            $query .= " and pr.requestnumber ilike '%$pr_no%'";
        }
        $mr_no = $this->input->post('mr_no');
        if (!empty($mr_no)) {
            $query .= " and materialrequisition.number ilike '%$mr_no%'";
        }
        $departmentid = $this->input->post('departmentid');
        if ($departmentid != 0) {
            $query .= " and pr.departmentid = $departmentid";
        }
        $sub_departmentid = $this->input->post('sub_departmentid');
        if ($sub_departmentid != 0) {
            $query .= " and pr.enduser = $sub_departmentid";
        }
        $vendorid = $this->input->post('vendorid');
        if ($vendorid != 0) {
            $query .= " and po.vendorid = $vendorid";
        }
        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }
        $groupid = $this->input->post('groupid');
        if ($groupid != 0) {
            $query .= " and item.groupsid = $groupid";
        }

        $cost_center_id = $this->input->post("cost_center_id");
        $member_cost_center_id = $this->input->post('member_cost_center_id');
        if ($cost_center_id != 0) {
            $query .= " and (materialrequisition.cost_center_id=$cost_center_id";
            if ($member_cost_center_id != 0) {
                if ($member_cost_center_id == -1) {
                    $query .= " or materialrequisition.cost_center_id in (select id from cost_center where id in (select unnest(member) from cost_center where id=$cost_center_id) order by description asc)";
                } else {
                    $query .= " or materialrequisition.cost_center_id=$member_cost_center_id";
                }
            }
            $query .= ")";
        }


        $query .= " order by gritem.id asc ";

//        echo $query;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['gr'] = $this->db->query($query)->result();
        $data['st'] = $st;
        if ($st == 1 || $st == 2) {
            $this->load->view('gr/print_report', $data);
        } else {
            $this->load->library('excel');
            $this->load->view('gr/print_report_excel', $data);
        }
    }

    function search_pending_receive() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "gr"));
        $data['po'] = $this->model_po->selectPoUncompleteReceive();
        $this->load->view('gr/search_pending_receive', $data);
    }

    function search_pending_inspection() {
        $this->load->model('model_gritemcheck');
        $data['item'] = $this->model_gritemcheck->selectPOItemForQuality();
        $this->load->view('gr/pending_inspection', $data);
    }

    function print_receipt() {
        $this->load->model('model_vendor');
        $data['vendor'] = $this->model_vendor->select_all();
        $this->load->view('gr/print_receipt', $data);
    }

    function do_print_receipt() {
        $supplier_id = $this->input->post('supplier_id');
        $do_number = $this->input->post('do_number');

        if (empty($supplier_id)) {
            $supplier_id = 0;
        }

        $query = "
            select 
                gritem.*,
                gr.number gr_no,
                gr.letternumber,
                gr.receivedate,
                gr.do_date,
                po.ponumber,
                po.vendorid,
                pritem.itemid,
                item.partnumber item_code,
                item.descriptions item_description,
                unit.codes unit_code
            from gritem
            join gr on gritem.grid=gr.id
            join pritem on gritem.poitemid=pritem.id
            join po on pritem.poid=po.id
            join item on pritem.itemid=item.id
            join unit on pritem.unitid=unit.id
            where po.vendorid=$supplier_id
            ";
        $receive_date = $this->input->post('receive_date');
        $data['receive_date'] = $receive_date;
        if (!empty($receive_date)) {
            $query .= " and gr.receivedate = '$receive_date'";
        }

        if (!empty($do_number)) {
            $r_do_number = str_replace(',', '|', $do_number);
            $query .= " and gr.letternumber similar to '%($r_do_number)%'";
        }

//        echo $query;
        $data['do_number'] = $do_number;
        $this->load->model('model_vendor');
        $data['vendor'] = $this->model_vendor->selectById($supplier_id);

        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['gritem'] = $this->db->query($query)->result();
        if (count($data['gritem']) > 0) {
            $query2 = "with t as ($query) select distinct(letternumber) from t";
            $data['sj'] = $this->db->query($query2)->result();
        }
        $this->load->model('model_employee');
        $this->load->library("pdf");
        $html = $this->load->view('gr/do_print_receipt', $data, TRUE);
        $this->pdf->pdf_create($html, "receipt");
    }

}

?>
