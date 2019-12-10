<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pr
 *
 * @author admin
 */
class pr extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_pr');
        $this->load->model('model_pricecomp');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "pr"));
        $this->load->model('model_comment');
        $this->load->model('model_attachment');
        $this->load->model('model_approval');
        $this->load->model('model_pritem');
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAll();
        $data['pr'] = $this;
        $this->load->view('pr/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "pr"));
        $this->load->model('model_pritem');
        $this->load->model('model_comment');
        $this->load->model('model_attachment');
        $this->load->model('model_approval');
        $this->load->model('model_department');


        $state = $this->input->post('state');


        $query = "
            select 
                pr.*,
                (prgetmatreqnumberpritembyprid_2(pr.id)) mr_number,
                pr.enduser,
                dept.code endusercode
                from pr 
                left join department dept on pr.enduser=dept.id
            where true
        ";
//        echo $query;
        $requestnumber = $this->input->post('requestnumber');
        if ($requestnumber != "") {
            $query .= " and pr.requestnumber ilike '%" . $requestnumber . "%'";
        }

        $requestdatestart = $this->input->post('requestdatestart');
        $requestdateend = $this->input->post('requestdateend');
        if (!empty($requestdatestart) && !empty($requestdateend)) {
            $query .= " and pr.requestdate between '" . $requestdatestart . "' and '" . $requestdateend . "'";
        }if (!empty($requestdatestart) && empty($requestdateend)) {
            $query .= " and pr.requestdate = '" . $requestdatestart . "'";
        }if (empty($requestdatestart) && !empty($requestdateend)) {
            $query .= " and pr.requestdate = '" . $requestdateend . "'";
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
            $query .= " and pr.id in ("
                    . "select prid from pritem pritem "
                    . "join item on pritem.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
            $data['item_view'] = 1;
        }

        if ($state != 0) {
            $query .= " and pr.isclose=$state ";
        }

        $mr_no = $this->input->post('mr_no');
        if (!empty($mr_no)) {
            $query .= " and (pr.id in (select
            pr.id
            from pritem
            join pr on pritem.prid=pr.id
            join materialrequisition_detail mrd on pritem.materialrequisition_detail_id=mrd.id
            join materialrequisition mr on mrd.materialrequisitionid=mr.id
            where mr.number ilike '%$mr_no') or pr.id in (select
            pr.id
            from pritem
            join pr on pritem.prid=pr.id
            join servicerequestdetail srd on pritem.srd_id=srd.id
            join servicerequest sr on srd.servicerequestid=sr.id
            where sr.number ilike '%$mr_no'))";
        }
//        echo $query;
        $data['num_rows'] = $this->db->query($query)->num_rows();

        $limit = $this->config->item('limit');
        $query .= " order by pr.id desc limit $limit offset $offset ";
        $data['offset'] = $offset;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;

        $data['pr'] = $this->db->query($query)->result();
        $this->load->view('pr/search', $data);
    }

    function create() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAll();
        $data['nextpr'] = $this->model_pr->getNextPr();
        $this->load->view('pr/create', $data);
    }

    function insert() {
        $this->load->model('model_pritem');
        $requestnumber = $this->model_pr->getNextPr();
        $requestdate = $this->input->post('requestdate');
        $departmentid = $this->input->post('departmentid');
        $enduser = $this->input->post('enduser');
        $capex = $this->input->post('capex');
        $jsa = $this->input->post('jsa');
        $remark = $this->input->post('remark');
        $sonumber = $this->input->post('sonumber');
        $mrnumber = $this->input->post('mrnumber');
        $item = $this->input->post('item');
        $itempartnumber = $this->input->post('itempartnumber');
        $itemdescription = $this->input->post('itemdescription');
        $idunit = $this->input->post('idunit');
        $qty = $this->input->post('qty');

        $data_pr = array(
            "requestnumber" => $requestnumber,
            "requestdate" => $requestdate,
            "departmentid" => $departmentid,
            "enduser" => $enduser,
            "capex" => $capex,
            "jsa" => $jsa,
            "remark" => $remark,
            "sonumber" => $sonumber,
            "mrnumber" => $mrnumber,
            "created_by" => $this->session->userdata('id')
        );
        $error_message = "";
        $this->db->trans_start();
        if ($this->model_pr->insert($data_pr)) {
            $prid = $this->model_pr->getLastId();
            $pritem = array();
            for ($i = 0; $i < count($item); $i++) {
                $pritem[] = array(
                    "prid" => $prid,
                    "itemid" => $item[$i],
                    "itempartnumber" => $itempartnumber[$i],
                    "itemdescription" => $itemdescription[$i],
                    "unitid" => $idunit[$i],
                    "qty" => $qty[$i],
                    "outstanding" => $qty[$i]
                );
            }
            if (!$this->model_pritem->insert_batch($pritem)) {
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

    function update() {
        $this->load->model('model_pritem');

        $pritemid = $this->input->post('pritemid');
        $item = $this->input->post('item');
        $itempartnumber = $this->input->post('itempartnumber');
        $itemdescription = $this->input->post('itemdescription');
        $idunit = $this->input->post('idunit');
        $qty = $this->input->post('qty');

        $data = array(
            "requestnumber" => $this->input->post('requestnumber'),
            "requestdate" => $this->input->post('requestdate'),
            "departmentid" => $this->input->post('departmentid'),
            "enduser" => $this->input->post('enduser'),
            "remark" => $this->input->post('remark')
        );

        $error_message = "";
        $this->db->trans_start();

        if ($this->model_pr->update2($data, array('id' => $this->input->post('id')))) {
            for ($i = 0; $i < count($pritemid); $i++) {
                $data_item = array(
                    "prid" => $this->input->post('id'),
                    "itemid" => $item[$i],
                    "itempartnumber" => $itempartnumber[$i],
                    "itemdescription" => $itemdescription[$i],
                    "unitid" => $idunit[$i],
                    "qty" => $qty[$i],
                    "outstanding" => $qty[$i]
                );
                if ($pritemid[$i] == 0) {
                    if (!$this->model_pritem->insert2($data_item)) {
                        $error_message = $this->db->_error_message();
                    }
                } else {
                    if (!$this->model_pritem->update2($data_item, array("id" => $pritemid[$i]))) {
                        $error_message = $this->db->_error_message();
                    }
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

    function additem($counter) {
        $data['flag'] = $counter;
        $this->load->view('pr/additem', $data);
    }

    function selectApproval($r_id) {
        $data['rid'] = $r_id;
        $this->load->view('pr/selectapproval', $data);
    }

    function searchEmployee($rid) {
        $this->load->model('model_employee');
        $employeeid = $this->input->post('employeeid');
        $employeename = $this->input->post('employeename');
        $employee = $this->model_employee->searchToPr($employeeid, $employeename);
        foreach ($employee as $record) {
            ?>
            <tr>
                <td>
                    <input type="hidden" name="id" id="id<?php echo $record->id ?>" value="<?php echo $record->id ?>"/>
                    <input type="hidden" name="name" id="name<?php echo $record->id ?>" value="<?php echo $record->name ?>"/>
                    <?php echo $record->id ?>
                </td>
                <td><?php echo $record->name ?></td>
                <td><?php echo $record->position ?></td>
                <td align="center" width="30"><img src="images/check.png" onclick="pr_selectEmployee(<?php echo "'" . $record->id . "'," . $rid; ?>)" class="miniaction"/></td>
            </tr>
            <?php
        }
    }

    function preview($prid, $st) {
        if ($st == 1) {
            echo "<link type=text/css rel=stylesheet href='" . base_url() . "css/print.css'>";
        }
        $this->load->model('model_department');
        $this->load->model('model_pritem');
        $this->load->model('model_approval');
        $data['pritem'] = $this->model_pritem->selectByPrId($prid);
        $data['pr'] = $this->model_pr->selectById($prid);
        $data['st'] = $st;
        $data['prid'] = $prid;
        $data['approval'] = $this->model_approval->selectApprovalPr($prid);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $this->load->view('pr/preview', $data);
    }

    function edit($id) {
        $this->load->model('model_department');
        $this->load->model('model_item');
        $this->load->model('model_pritem');
        $this->load->model('model_unit');
        $this->load->model('model_approval');
        $data['pr'] = $this->model_pr->selectById($id);
        $data['department'] = $this->model_department->selectAll();
        $data['pritem'] = $this->model_pritem->selectByPrId($id);
        $data['approval'] = $this->model_approval->selectApprovalPr($id);
        $this->load->view('pr/edit', $data);
    }

    function changestate($state, $prid) {
        $this->model_pr->updatestate($prid, $state);
    }

    function delete($prid) {
        if ($this->model_pr->delete($prid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function approvepr() {
        $this->load->model('model_approval');
        $prid = $this->input->post('prid');
        $approvalid = $this->input->post('approvalid');
        $status = $this->input->post('status');
        $notes = "";
        $this->model_approval->approvepr($prid, $approvalid, $status, $notes);
    }

    function setprapproval($prid) {
        $this->load->model('model_employee');
        $data['prid'] = $prid;
        $data['defaultapproval'] = $this->model_pr->getPrDefaultApproval();
        $this->load->view('pr/setapproval', $data);
    }

    function saveapproval() {
        $this->load->model('model_approval');
        $prid = $this->input->post('id');
        $idapprovalarray = $this->input->post('idapprovalarray');

        $error_message = "";
        $this->db->trans_start();
        for ($i = 0; $i < count($idapprovalarray); $i++) {
            if ($i == 0) {
                if (!$this->model_approval->insert($prid, $idapprovalarray[$i], 'TRUE')) {
                    $error_message = $this->db->_error_message();
                }
            } else {
                if (!$this->model_approval->insert($prid, $idapprovalarray[$i], 'FALSE')) {
                    $error_message = $this->db->_error_message();
                }
            }
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

    function updateapproval() {
        $this->load->model('model_approval');
        $prid = $this->input->post('prid');
        $idarray = $this->input->post('idarray');
        $idapprovalarray = $this->input->post('idapprovalarray');

        $error_message = "";
        $this->db->trans_start();

        for ($i = 0; $i < count($idapprovalarray); $i++) {
            if (!$this->model_approval->update($prid, $idarray[$i], $idapprovalarray[$i])) {
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

    function editapproval($prid) {
        $this->load->model('model_approval');
        $this->load->model('model_employee');
        $data['prid'] = $prid;
        $data['approval'] = $this->model_approval->selectApprovalPr($prid);
        $this->load->view('pr/editapproval', $data);
    }

    function configapproval() {
        $this->load->model('model_employee');
        $data['defaultapproval'] = $this->model_pr->getPrDefaultApproval();
        $this->load->view('pr/configapproval', $data);
    }

    function saveconfigapproval() {
        $idapproval = $this->input->post('idapproval');
        $checked = $idapproval[0];
        $acknowledge = $idapproval[1];
        $approved = $idapproval[2];
        $this->model_pr->saveConfigApproval($checked, $acknowledge, $approved);
    }

    function rejectOrPending($prid, $approvalid, $status, $flag) {
        $data['prid'] = $prid;
        $data['approvalid'] = $approvalid;
        $data['status'] = $status;
        $data['flag'] = $flag;
        $this->load->view('pr/reject_or_pending', $data);
    }

    function do_reject_or_pending() {
        $this->load->model('model_approval');
        $prid = $this->input->post('prid');
        $approvalid = $this->input->post('approvalid');
        $status = $this->input->post('status');
        $notes = $this->input->post('notes');
        $this->model_approval->approvepr($prid, $approvalid, $status, $notes);
    }

    function viewNotes($approvalid) {
        $this->load->model('model_approval');
        echo "<div style='width: 300px;height:300px;background:padding:5px;'><p>" . nl2br($this->model_approval->viewNotes($approvalid)) . "</p></div>";
    }

    function dialogsearchpr($temp) {
        $data['temp'] = $temp;
        $this->load->view('pr/dialogsearchpr', $data);
    }

    function deleteitem($id) {
        $this->load->model('model_pritem');
        $this->model_pritem->delete($id);
    }

    function create_from_requisition($mrid) {
        $this->load->model('model_materialrequisition');
        $this->load->model('model_unit');
        $this->load->model('model_department');
        $data['mat_req'] = $this->model_materialrequisition->select_by_id($mrid);
        $query = "
            select 
            materialrequisition_detail.*,
            item.partnumber item_code,
            item.descriptions item_description,
            item.moq,
            unit.codes unit_code
            from materialrequisition_detail
            join item on materialrequisition_detail.itemid=item.id
            join unit on materialrequisition_detail.unitid=unit.id
            where materialrequisition_detail.materialrequisitionid=$mrid 
            and materialrequisition_detail.ots_qty > 0
            order by materialrequisition_detail.id asc
        ";
        $data['mat_req_detail'] = $this->db->query($query)->result();
        $data['department'] = $this->model_department->selectAll();
        $this->load->view('pr/create_from_requisition', $data);
    }

    function pr_save_from_mr() {
        $data_mr = $this->input->post('data_mr');
        $data_mr_decoded = json_decode($data_mr);

        $mr_header = $data_mr_decoded->mr_header;
        $mr_details = $data_mr_decoded->mr_detail;

        $this->load->model('model_pritem');
        $requestnumber = $this->model_pr->getNextPr();

        $data_pr = array(
            "requestnumber" => $requestnumber,
            "requestdate" => $mr_header->requestdate,
            "remark" => $mr_header->remark,
            "materialrequisitionid" => $mr_header->mat_req_id,
            "created_by" => $this->session->userdata('id')
        );

        $error_message = "";
        $this->db->trans_start();
        if ($this->model_pr->insert($data_pr)) {
            $prid = $this->model_pr->getLastId();
            $pritem = array();
            foreach ($mr_details as $mr_detail) {
                $pritem[] = array(
                    "prid" => $prid,
                    "materialrequisition_detail_id" => $mr_detail->mr_id,
                    "itemid" => $mr_detail->itemid,
                    "unitid" => $mr_detail->unitid,
                    "qty" => $mr_detail->qty,
                    "outstanding" => $mr_detail->qty
                );
            }
            if (!$this->model_pritem->insert_batch($pritem)) {
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

    function create_from_service($srid) {
        $this->load->model('model_servicerequest');
        $this->load->model('model_unit');
        $this->load->model('model_department');
        $data['sr'] = $this->model_servicerequest->select_by_id($srid);
        $query = "
            select srd.*,s_item.partnumber source_item_code,s_item.descriptions source_item_description,
            s_unit.codes source_unit_code,t_item.partnumber target_item_code,t_item.descriptions target_item_description,
            t_unit.codes target_unit_code,t_item.moq from servicerequestdetail srd
            join item s_item on srd.source_itemid=s_item.id
            join item t_item on srd.target_itemid=t_item.id
            join unit s_unit on srd.source_unitid=s_unit.id
            join unit t_unit on srd.target_unitid=t_unit.id
            where srd.servicerequestid=$srid and srd.ots_qty > 0
            order by srd.id asc
        ";
        $data['sr_detail'] = $this->db->query($query)->result();
        $data['department'] = $this->model_department->selectAll();
        $this->load->view('pr/create_from_service', $data);
    }

    function save_from_sr() {
        $this->load->model('model_pritem');

        $decode = json_decode($this->input->post("data"));

        $header = $decode->header;
        $details = $decode->details;

        $pr = array(
            "requestnumber" => $this->model_pr->getNextPr(),
            "requestdate" => $header->date,
            "remark" => $header->remark,
            "created_by" => $this->session->userdata('id')
        );


        $error_message = "";
        $this->db->trans_start();
        if ($this->model_pr->insert($pr)) {
            $prid = $this->model_pr->getLastId();
            $pritem = array();
            foreach ($details as $detail) {
                $pritem[] = array(
                    "prid" => $prid,
                    "srd_id" => $detail->srd_id,
                    "itemid" => $detail->itemid,
                    "unitid" => $detail->unitid,
                    "qty" => $detail->qty,
                    "outstanding" => $detail->qty
                );
            }
            if (!$this->model_pritem->insert_batch($pritem)) {
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

    function config_tax_and_ppn($prid) {
        $query = "
            select 
            po_temp.*,
            pr.requestnumber pr_no,
            pr.materialrequisitionid,
            materialrequisition.number mr_no,
            (select sum(total) from pritem where prid=po_temp.prid and vendorid=po_temp.vendorid and currency=po_temp.currency) amount,
            vendor.name vendor
            from po_temp 
            join vendor on po_temp.vendorid=vendor.id
            join pr on po_temp.prid=pr.id
            left join materialrequisition on pr.materialrequisitionid=materialrequisition.id
            where prid=$prid order by vendor.name asc
        ";
        $data['po_temp'] = $this->db->query($query)->result();
        $this->load->view('pr/config_tax_and_ppn', $data);
    }

    function view_po_plan($prid) {
        $query = "
            select 
            po_temp.*,
            pr.requestnumber pr_no,
            pr.materialrequisitionid,
            materialrequisition.number mr_no,
            (select sum(total) from pritem where prid=po_temp.prid and vendorid=po_temp.vendorid and currency=po_temp.currency) amount,
            vendor.name vendor
            from po_temp 
            join vendor on po_temp.vendorid=vendor.id
            join pr on po_temp.prid=pr.id
            left join materialrequisition on pr.materialrequisitionid=materialrequisition.id
            where prid=$prid order by vendor.name asc
        ";
        $data['po_temp'] = $this->db->query($query)->result();
        $this->load->view('pr/view_po_plan', $data);
    }

    function save_prepare_po() {
        $po_temp_id = $this->input->post('po_temp_id');
        $pr_disc_percent = $this->input->post('pr_disc_percent');
        $pr_discount = $this->input->post('pr_discount');
        $pr_sub_total = $this->input->post('pr_sub_total');
        $pr_ppn = $this->input->post('pr_ppn');
        $pr_ppn_percent = $this->input->post('pr_ppn_percent');
        $pr_grand_total = $this->input->post('pr_grand_total');

        $this->db->trans_start();
        for ($i = 0; $i < count($po_temp_id); $i++) {
            $data = array(
                "sub_total" => $pr_sub_total[$i],
                "discount_percent" => $pr_disc_percent[$i],
                "discount" => $pr_discount[$i],
                "tax_percent" => $pr_ppn_percent[$i],
                "tax" => $pr_ppn[$i],
                "total_amount" => $pr_grand_total[$i]
            );

            if (!$this->db->update("po_temp", $data, array("id" => $po_temp_id[$i]))) {
                $error_message = $this->db->_error_message();
            }
        }

        $error_message = "";

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

    function is_complete_comparison($prid) {
        if ($this->model_pr->iscompletepricecomparison($prid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    function add_item($prid) {
        $data['prid'] = $prid;
        $data['pr'] = $this;
        $this->load->view('pr/item_available_to_add', $data);
    }

    function search_mr_item_available($offset) {
        $data['offset'] = $offset;
        $query = "
            select 
            materialrequisition.number mr_number,
            materialrequisition.date,
            to_char(materialrequisition.date,'DD/MM/YYY') date_f,
            materialrequisition_detail.*,
            employee.name employee_request_by,
            emp.name approval1_name,
            emp2.name approval2_name,
            item.partnumber item_code,
            item.descriptions item_description,
            unit.codes unit_code,
            department.name departmentname
            from materialrequisition_detail
            join item on materialrequisition_detail.itemid=item.id
            join unit on materialrequisition_detail.unitid=unit.id
            join materialrequisition on materialrequisition_detail.materialrequisitionid=materialrequisition.id
            left join employee emp on materialrequisition.supervisorapproval=emp.id
            left join employee emp2 on materialrequisition.managerapproval=emp2.id
            left join employee on materialrequisition.request_by=employee.id
            join department on materialrequisition.departmentid=department.id
            where materialrequisition_detail.ots_qty > 0 and materialrequisition.status=1
        ";

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%') ";
        }
        $number = $this->input->post('number');
        if (!empty($number)) {
            $query .= " and materialrequisition.number ilike '%$number' ";
        }

        $date_from = $this->input->post('start_date');
        $date_to = $this->input->post('end_date');

        if (!empty($date_from) && !empty($date_to)) {
            $query .= " and materialrequisition.date between '" . $date_from . "' and '" . $date_to . "' ";
        }if (!empty($date_from) && empty($date_to)) {
            $query .= " and materialrequisition.date = '" . $date_from . "' ";
        }if (empty($date_from) && !empty($date_to)) {
            $query .= " and materialrequisition.date = '" . $date_to . "' ";
        }

        $departmentid = $this->input->post('departmentid');
        if ($departmentid != 0) {
            $query .= " and materialrequisition.departmentid=$departmentid";
        }

        $approval1 = $this->input->post('approval1');
        if (!empty($approval1)) {
            $query .= " and emp.name ilike '%$approval1%' ";
        }

        $approval2 = $this->input->post('approval2');
        if (!empty($approval2)) {
            $query .= " and emp2.name ilike '%$approval2%' ";
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = 15;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by materialrequisition_detail.id desc limit $limit offset $offset";
        $data['item'] = $this->db->query($query)->result();
        $this->load->view('pr/search_item_available', $data);
    }

    function save_item() {
        $data_mr_detail = $this->input->post("data");
        $data = json_decode($data_mr_detail, true);
        if ($this->db->insert_batch('pritem', $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add_service_item($prid) {
        $data['prid'] = $prid;
        $data['pr'] = $this;
        $this->load->view('pr/service_item_available_to_add', $data);
    }

    function search_sr_item_available($offset) {
        $query = "select sr.id srid,sr.number sr_no,sr.date,to_char(sr.date,'DD/MM/YYY') date_f,srd.*,
        s_item.partnumber source_item_code,s_item.descriptions source_item_description,
        s_unit.codes source_unit_code,t_item.partnumber target_item_code,t_item.descriptions target_item_description,
        t_unit.codes target_unit_code,employee.name employee_request_by,emp.name approval1_name,emp2.name approval2_name
        from servicerequestdetail srd join servicerequest sr on srd.servicerequestid=sr.id join item s_item on srd.source_itemid=s_item.id
        join item t_item on srd.target_itemid=t_item.id join unit s_unit on srd.source_unitid=s_unit.id
        join unit t_unit on srd.target_unitid=t_unit.id left join employee emp on sr.approval1=emp.id left join employee emp2 on sr.approval2=emp2.id
        left join employee on sr.request_by=employee.id where sr.status=2 and srd.ots_qty > 0";
        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = 15;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by srd.id desc limit $limit offset $offset";
        $data['item'] = $this->db->query($query)->result();
        $this->load->view('pr/search_sr_item_available', $data);
    }

    function save_sr_item() {
        $srd_id = $this->input->post('srd_id');
        $unitid = $this->input->post('unitid');
        $itemid = $this->input->post('itemid');
        $qty = $this->input->post('qty');
        $data = array();

        for ($i = 0; $i < count($srd_id); $i++) {
            $data[] = array(
                "prid" => $this->input->post('prid'),
                "srd_id" => $srd_id[$i],
                "unitid" => $unitid[$i],
                "itemid" => $itemid[$i],
                "qty" => $qty[$i],
                "outstanding" => $qty[$i]
            );
        }

        if ($this->db->insert_batch('pritem', $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
?>
