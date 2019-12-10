<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class materialrequisition extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_materialrequisition');
    }

    function index() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAll();
        $data['materialrequisition'] = $this;
        $this->load->view('materialrequisition/index', $data);
    }

    function search($offset) {

        $query = "
                select t.* from (
                  select 
                  materialrequisition.*,
                  employee.name employee_request_by,
                  department.name department,
                  (select name from employee where id=materialrequisition.request_by) namerequestby,
                  (select name from employee where id=materialrequisition.supervisorapproval) supervisor,
                  (select name from employee where id=materialrequisition.managerapproval) manager,
                  (select COALESCE(sum(ots_qty),0) from materialrequisition_detail where materialrequisitionid=materialrequisition.id) count_ots,
                  (select count(*) from attachment where referenceid=materialrequisition.id and reference='MR') count_attchment,	
                  (select count(*) from comment where referenceid=materialrequisition.id and reference='MR') count_comment,
                  (select sum(qty) total_qty from materialrequisition_detail where materialrequisitionid=materialrequisition.id),
                  (select sum(ots_qty) ots_qty from materialrequisition_detail where materialrequisitionid=materialrequisition.id) from materialrequisition
                  left join employee on materialrequisition.request_by=employee.id
                  left join department on materialrequisition.departmentid=department.id
          ) t where true 
        ";

        $status = $this->input->post('status');

        if ($this->session->userdata('id') != "admin") {
//            $query .= " and ((t.request_by = '" . $this->session->userdata('id') . "') or 
//                             (t.supervisorapproval='" . $this->session->userdata('id') . "') or 
//                             (t.managerapproval='" . $this->session->userdata('id') . "'))";
            if ($this->session->userdata('department') == 8 || $this->session->userdata('department') == 5) {
                $query .= " and (((t.request_by = '" . $this->session->userdata('id') . "') or 
                             (t.supervisorapproval='" . $this->session->userdata('id') . "') or 
                             (t.managerapproval='" . $this->session->userdata('id') . "')) or t.status = 1)";

                //echo "masuk <br/>".$this->session->userdata('department');
                $add_query = "";
                if ($status == '4') {
                    $query .= " and t.ots_qty > 0 ";
                } else if ($status === '-1') {
                    $query .= " and (t.status=0 and (t.supervisorstatusapproval = 0 or t.managerstatusapproval=0))";
                }

//                echo "status: " . $status;
//                $query .= " and (t.status = 1 $add_query)";
                $query .= " $add_query";
            } else {
                $query .= " and ((t.request_by = '" . $this->session->userdata('id') . "') or 
                             (t.supervisorapproval='" . $this->session->userdata('id') . "') or 
                             (t.managerapproval='" . $this->session->userdata('id') . "'))";
                if (!empty($status)) {
                    if ($status == '-1') {
                        $query .= " and t.status = 0 and ((t.supervisorstatusapproval = 0 and t.supervisorapproval='" . $this->session->userdata('id') . "')
                                                         or t.supervisorstatusapproval = 1 and t.managerstatusapproval=0 and t.managerapproval='" . $this->session->userdata('id') . "')";
                    } else if ($status == '4') {
                        $query .= " and t.ots_qty > 0 ";
                    } else {
                        if ($status != '0') {
                            $query .= " and ((t.supervisorapproval='" . $this->session->userdata('id') . "' and t.supervisorstatusapproval = $status) 
                                        or (t.managerapproval='" . $this->session->userdata('id') . "' and t.managerstatusapproval = $status))";
                        }
                    }
                }
            }
        }

        $number = $this->input->post('number');
        if (!empty($number)) {
            $query .= " and t.number ilike '%$number%' ";
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

        $departmentid = $this->input->post('departmentid');
        if ($departmentid != 0) {
            $query .= " and t.departmentid=$departmentid";
        }

        $approval1 = $this->input->post('approval1');
        if (!empty($approval1)) {
            $query .= " and t.supervisor ilike '%$approval1%' ";
        }

        $approval2 = $this->input->post('approval2');
        if (!empty($approval2)) {
            $query .= " and t.manager ilike '%$approval2%' ";
        }
        $data['item_view'] = 0;
        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and t.id in ("
                    . "select materialrequisitionid from materialrequisition_detail "
                    . "join item on materialrequisition_detail.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
            $data['item_view'] = 1;
        }
//        echo "<pre>" . $query . "</pre>";
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
        $data['mat_req'] = $this->db->query($query)->result();

        $this->load->view('materialrequisition/search', $data);
    }

    function add() {
        $data['devision'] = $this->db->query("select * from dept_division order by name asc")->result();
        $this->load->model('model_costcenter');
        $data['costcenter'] = $this->model_costcenter->select_all();
        $data['approval'] = $this->model_materialrequisition->getLastApprovalByEmployee($this->session->userdata('id'));
        $this->load->view('materialrequisition/add', $data);
    }

    function additem($counter) {
        $data['flag'] = $counter;
        $this->load->view('materialrequisition/additem', $data);
    }

    function insert() {
        $data_mr = array(
            "date" => $this->input->post('mat_req_date'),
            "must_receive_date" => $this->input->post('mat_req_must_receive_date'),
            "reason_requirement" => $this->input->post('mat_req_reason_requirement'),
            "request_by" => $this->session->userdata('id'),
            "departmentid" => $this->session->userdata('department'),
            "supervisorapproval" => $this->input->post('supervisor'),
            "managerapproval" => $this->input->post('manager'),
            "dept_divisionid" => $this->input->post('dept_divisionid'),
            "cost_center_id" => $this->input->post('cost_center_id'),
            "area_id" => $this->session->userdata('areaid')
        );

        $itemid = $this->input->post('itemid');
        $qty = $this->input->post('qty');
        $unitid = $this->input->post('unitid');
        $reason = $this->input->post('reason');

        $error_message = "";
        $data_mr_item = array();

        $this->db->trans_start();
        if ($this->model_materialrequisition->insert($data_mr)) {
            $materialrequisition_id = $this->model_materialrequisition->get_last_id();
            for ($i = 0; $i < count($itemid); $i++) {
                $data_mr_item[] = array(
                    "materialrequisitionid" => $materialrequisition_id,
                    "itemid" => $itemid[$i],
                    "qty" => $qty[$i],
                    "ots_qty" => $qty[$i],
                    "unitid" => $unitid[$i],
                    "remark" => $reason[$i]
                );
            }


            if (!$this->model_materialrequisition->insert_detail_batch($data_mr_item)) {
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

    function edit($id) {
        $this->load->model('model_unit');
        $data['mat_req'] = $this->model_materialrequisition->select_by_id($id);
        $data['mat_req_detail'] = $this->model_materialrequisition->select_detail_by_mat_req_id($id);
        $data['devision'] = $this->db->query("select * from dept_division order by name asc")->result();
        $this->load->model('model_costcenter');
        $data['costcenter'] = $this->model_costcenter->select_all();
        $this->load->view('materialrequisition/edit', $data);
    }

    function update() {

        $data_mr = array(
            "date" => $this->input->post('mat_req_date'),
            "must_receive_date" => $this->input->post('mat_req_must_receive_date'),
            "reason_requirement" => $this->input->post('mat_req_reason_requirement'),
            "supervisorapproval" => $this->input->post('supervisor'),
            "managerapproval" => $this->input->post('manager'),
            "dept_divisionid" => $this->input->post('dept_divisionid'),
            "cost_center_id" => $this->input->post('cost_center_id'),
            "area_id" => $this->session->userdata('areaid')
        );

        $detailid = $this->input->post('detailid');
        $itemid = $this->input->post('itemid');
        $qty = $this->input->post('qty');
        $unitid = $this->input->post('unitid');
        $reason = $this->input->post('reason');

        $error_message = "";

        $this->db->trans_start();
        if ($this->model_materialrequisition->update($data_mr, array("id" => $this->input->post('id')))) {
            for ($i = 0; $i < count($detailid); $i++) {
                $data_mr_item = array(
                    "itemid" => $itemid[$i],
                    "qty" => $qty[$i],
                    "ots_qty" => $qty[$i],
                    "unitid" => $unitid[$i],
                    "remark" => $reason[$i]
                );
                //echo $detailid[$i]."<br/>";
                if ($detailid[$i] == 0) {
                    $data_mr_item["materialrequisitionid"] = $this->input->post("id");
                    //print_r($data_mr_item);
                    if (!$this->model_materialrequisition->insert_detail($data_mr_item)) {
                        $error_message = $this->db->_error_message();
                    }
                } else {
                    if (!$this->model_materialrequisition->update_detail($data_mr_item, array("id" => $detailid[$i]))) {
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

    function delete($id) {
        if ($this->model_materialrequisition->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function approve() {
        $this->load->model('model_approval');
        $materialrequisitionid = $this->input->post('materialrequisitionid');
        $approvalid = $this->input->post('approvalid');
        $status = $this->input->post('status');
        $who = $this->input->post('who');
        $notes = "";

        if ($who == 1) {
            $data = array(
                "supervisorstatusapproval" => $status,
                "supervisortimeapproved" => date('Y-m-d h:i:s')
            );
        } else {
            $data = array(
                "managerstatusapproval" => $status,
                "managertimeapproved" => date('Y-m-d h:i:s'),
                "status" => 1
            );
        }

        if ($this->model_materialrequisition->update($data, array("id" => $materialrequisitionid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function rejectOrPending($materialrequisitionid, $approvalid, $status, $who, $flag) {
        $data['materialrequisitionid'] = $materialrequisitionid;
        $data['approvalid'] = $approvalid;
        $data['status'] = $status;
        $data['flag'] = $flag;
        $data['who'] = $who;
        $this->load->view('materialrequisition/reject_or_pending', $data);
    }

    function do_reject_or_pending() {
        $materialrequisitionid = $this->input->post('materialrequisitionid');
        $approvalid = $this->input->post('approvalid');
        $status = $this->input->post('status');
        $who = $this->input->post('who');
        $notes = $this->input->post('notes');

        if ($who == 1) {
            $data = array(
                "supervisorstatusapproval" => $status,
                "supervisortimeapproved" => date('Y-m-d h:i:s')
            );
        } else {
            $data = array(
                "managerstatusapproval" => $status,
                "managertimeapproved" => date('Y-m-d h:i:s')
            );
        }

        if ($status == '2') {
            $data['status'] = -1;
        }

        $error_message = "";

        $this->db->trans_start();
        if ($this->model_materialrequisition->update($data, array("id" => $materialrequisitionid))) {
            $data_notes = array(
                "materialrequisitionid" => $materialrequisitionid,
                "employeeid" => $approvalid,
                "timeapprove" => date('Y-m-d h:i:s'),
                "notes" => $notes
            );
            if (!$this->db->insert("materialrequisitionapprovalnotes", $data_notes)) {
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

    function view_notes($mat_req_id, $employee) {
        $query = "
            select 
            materialrequisitionapprovalnotes.*
            from materialrequisitionapprovalnotes
            where materialrequisitionid=$mat_req_id
            and employeeid='$employee' 
            order by materialrequisitionapprovalnotes.id desc
            ";
        $notes = $this->db->query($query)->result();
        ?>
        <div style="width: 200px;height: 300px;">
            <?php
            foreach ($notes as $result) {
                echo "<p>" . nl2br($result->notes) . "</p><br/>";
            }
            ?>
        </div>
        <?php
    }

    function submit() {
        if ($this->model_materialrequisition->update(array("status" => 0), array("id" => $this->input->post('materialrequisitionid')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id, $status) {
        $this->load->model('model_employee');
        $data['id'] = $id;
        $data['mr'] = $this->model_materialrequisition->select_by_id($id);
        $data['status'] = $status;
        $data['mrdetail'] = $this->model_materialrequisition->select_detail_by_mat_req_id($id);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        //$this->load->view('materialrequisition/print', $data);
        if ($status == "prints") {
            $this->load->library("pdf");
            $html = $this->load->view('materialrequisition/print', $data, TRUE);
            $this->pdf->pdf_create($html, "file");
        } else {
            $this->load->view('materialrequisition/print', $data);
        }
    }

    function item_delete() {
        if ($this->model_materialrequisition->delete_detail(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function otscreatepr() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAll();
        $data['materialrequisition'] = $this;
//        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "com"));
        $this->load->view('materialrequisition/otscreatepr', $data);
    }

    function search_ots($offset) {
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
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by materialrequisition_detail.id desc limit $limit offset $offset";
        $data['otscreatepr'] = $this->db->query($query)->result();
        $this->load->view('materialrequisition/searchots', $data);
    }

    function otscreatepr_print($st) {
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
        $query .= "  order by materialrequisition_detail.id desc";
        $data['otscreatepr'] = $this->db->query($query)->result();
        if ($st == 1) {
            $this->load->library('excel');
            $this->load->view('materialrequisition/otscreatepr_excel', $data);
        } else {
            $this->load->view('materialrequisition/otscreatepr_print', $data);
        }
    }

}
