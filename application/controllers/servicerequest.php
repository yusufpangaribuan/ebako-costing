<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicerequest
 *
 * @author hp
 */
class servicerequest extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->model('model_servicerequest');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "servicerequest"));
        $data['servicerequest'] = $this;
        $data['department'] = $this->model_department->selectAll();
        $this->load->view('servicerequest/index', $data);
    }

    function search($offset) {

        $query = "
                with t as (
                  select 
                  servicerequest.*,
                  employee.name employee_request_by,
                  department.name department,
                  emp1.name name_approval1,
                  emp2.name name_approval2,
                  (select COALESCE(sum(ots_qty),0) from servicerequestdetail where servicerequestid=servicerequest.id) count_ots,
                  (select count(*) from attachment where referenceid=servicerequest.id and reference='SR') count_attchment,	
                  (select count(*) from comment where referenceid=servicerequest.id and reference='SR') count_comment,
                  (select sum(ots_qty) from servicerequestdetail where servicerequestid=servicerequest.id) ots_qty 
                  from servicerequest
                  left join employee on servicerequest.request_by=employee.id
                  left join employee emp1 on servicerequest.approval1=emp1.id
                  left join employee emp2 on servicerequest.approval2=emp2.id
                  left join department on servicerequest.departmentid=department.id
          ) select * from t where true 
        ";
        $status = $this->input->post('status');
        if ($this->session->userdata('id') != "admin") {
            $query .= " and ((t.request_by = '" . $this->session->userdata('id') . "') or 
                             (t.approval1='" . $this->session->userdata('id') . "') or 
                             (t.approval2='" . $this->session->userdata('id') . "'))";

            if ($this->session->userdata('department') == 8 || $this->session->userdata('department') == 5) {
                $add_query = "";
                if ($status === '2') {
                    $add_query = " and t.count_ots > 0 ";
                }
                $query .= " or (t.status = 2 $add_query)";
            } else {
                if (!empty($status)) {
                    if ($status == '-1') {
                        $query .= " and t.status = 0 and ((t.approval1_status = 0 and t.approval1='" . $this->session->userdata('id') . "')
                                                         or t.approval1_status = 1 and t.approval2_status=0 and t.approval2='" . $this->session->userdata('id') . "')";
                    } else if ($status === '4') {
                        $query .= " and t.ots_qty > 0 ";
                    } else {
                        if ($status != '0') {
                            $query .= " and ((t.approval1='" . $this->session->userdata('id') . "' and t.approval1_status = $status) 
                                        or (t.approval12='" . $this->session->userdata('id') . "' and t.approval2_status = $status))";
                        }
                    }
                }
            }
        }

        $number = $this->input->post('number');
        if (!empty($number)) {
            $query .= " and t.number ilike '%$number'";
        }

        $start_date = $this->input->post('start_date');
        $stop_date = $this->input->post('stop_date');
        if (!empty($start_date) && !empty($stop_date)) {
            $query .= " and t.date between '$start_date' and '$stop_date' ";
        }if (!empty($start_date) && empty($stop_date)) {
            $query .= " and t.date = '$stop_date' ";
        }if (empty($start_date) && !empty($stop_date)) {
            $query .= " and t.date = '$stop_date' ";
        }

        $departmentid = $this->input->post('departmentid');
        if ($departmentid != 0) {
            $query .= " and t.departmentid=$departmentid";
        }

        $approval1 = $this->input->post('approval1');
        if (!empty($approval1)) {
            $query .= " and (t.approval1 ilike '%$approval1%' or t.name_approval1 ilike '%$approval1%')";
        }

        $approval2 = $this->input->post('approval2');
        if (!empty($approval2)) {
            $query .= " and (t.approval1 ilike '%$approval2%' or t.name_approval1 ilike '%$approval1%')";
        }

        $item_code_description = $this->input->post('item_code_description');
        if (!empty($item_code_description)) {
            $query .= " and (t.id in ("
                    . "select servicerequestid from servicerequestdetail "
                    . "join item on servicerequestdetail.source_itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')"
                    . ") or t.id in ("
                    . "select servicerequestid from servicerequestdetail "
                    . "join item on servicerequestdetail.target_itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }


//        echo $query;
        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $query .= " order by t.id desc limit $limit offset $offset";
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;

        $data['servicerequest'] = $this->db->query($query)->result();
        $this->load->view('servicerequest/search', $data);
    }

    function add() {
        $this->load->model('model_department');
        $data['subdepartment'] = $this->model_department->select_sub_department();
        $this->load->view('servicerequest/add', $data);
    }

    function save() {
        $data = array(
            "date" => $this->input->post('date'),
            "must_receive_date" => $this->input->post('must_receive_date'),
            "reason_requirement" => $this->input->post('reason_requirement'),
            "request_by" => $this->session->userdata('id'),
            "departmentid" => $this->session->userdata('department'),
            "enduser" => $this->input->post('enduser')
        );
        $id = $this->input->post('id');
        if (empty($id)) {
            if ($this->model_servicerequest->insert($data)) {
                echo json_encode(array('success' => true, 'id' => $this->model_servicerequest->get_last_id()));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $data["approval1"] = $this->input->post('approval1');
            $data["approval2"] = $this->input->post('approval2');
            if ($this->model_servicerequest->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function edit($id) {
        $data['servicerequest'] = $this->model_servicerequest->select_by_id($id);
        $this->load->model('model_department');
        $data['subdepartment'] = $this->model_department->select_sub_department();
        $data['sr'] = $this;
        $this->load->view('servicerequest/edit', $data);
    }

    function delete() {
        if ($this->model_servicerequest->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function submit() {
        if ($this->model_servicerequest->update(array("status" => 1), array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function reload_item($service_request_id) {
        $data['servicerequestdetail'] = $this->model_servicerequest->select_detail_by_service_request_id($service_request_id);
        $this->load->view('servicerequest/reload_item', $data);
    }

    function additem($servicerequestid) {
        $data['servicerequestid'] = $servicerequestid;
        $this->load->view('servicerequest/additem', $data);
    }

    function saveitem() {

        $data = array(
            "source_itemid" => $this->input->post('source_itemid'),
            "source_unitid" => $this->input->post('source_unitid'),
            "target_itemid" => $this->input->post('target_itemid'),
            "target_unitid" => $this->input->post('target_unitid'),
            "qty" => $this->input->post('qty'),
            "ots_qty" => $this->input->post('qty'),
            "remark" => $this->input->post('remark')
        );
        $id = $this->input->post('id');
        if (empty($id)) {
            $data["servicerequestid"] = $this->input->post('servicerequestid');
            if ($this->model_servicerequest->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_servicerequest->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function edititem($id) {
        $data['srd'] = $this->model_servicerequest->detail_select_by_id($id);
        $this->load->view('servicerequest/edititem', $data);
    }

    function deleteitem() {
        $id = $this->input->post('id');
        if ($this->model_servicerequest->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function set_approval($servicerequestid) {
        $this->load->model('model_employee');
        $data['servicerequestid'] = $servicerequestid;
        $data['defaultapproval'] = $this->model_servicerequest->getServiceRequestDefaultApproval();
        $this->load->view('servicerequest/set_approval', $data);
    }

    function edit_approval($servicerequestid) {
        $this->load->model('model_employee');
        $data['servicerequestid'] = $servicerequestid;
        $data['approval'] = $this->model_servicerequest->selectApproval($servicerequestid);
        $this->load->view('servicerequest/edit_approval', $data);
    }

    function rejectOrPending($servicerequestid, $approvalid, $status, $who, $flag) {
        $data['servicerequestid'] = $servicerequestid;
        $data['approvalid'] = $approvalid;
        $data['status'] = $status;
        $data['flag'] = $flag;
        $data['who'] = $who;
        $this->load->view('servicerequest/reject_or_pending', $data);
    }

    function saveapproval() {
        $servicerequestid = $this->input->post('servicerequestid');
        $idapprovalarray = $this->input->post('idapprovalarray');
//        print_r($idapprovalarray);
        for ($i = 0; $i < count($idapprovalarray); $i++) {
            echo $idapprovalarray[$i] . "<br/>";
            if ($i == 0) {
                $data = array("servicerequestid" => $servicerequestid, "employeeid" => $idapprovalarray[$i], "outstanding" => 'TRUE');
                $this->model_servicerequest->insertapprove($data);
            } else {
                $data = array("servicerequestid" => $servicerequestid, "employeeid" => $idapprovalarray[$i], "outstanding" => 'FALSE');
                $this->model_servicerequest->insertapprove($data);
            }
        }
    }

    function approve() {
        $who = $this->input->post('who');

        $data = array(
            "approval" . $who . "_status" => $this->input->post('status'),
            "approval" . $who . "_time" => "now()"
        );

        if ($who == 2) {
            $data['status'] = 2;
        }

        if ($this->model_servicerequest->update($data, array("id" => $this->input->post('servicerequestid')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function do_reject_or_pending() {
        $servicerequestid = $this->input->post('servicerequestid');
        $status = $this->input->post('status');

        $data = array(
            "approval" . $this->input->post('who') . "_status" => $status,
            "approval" . $this->input->post('who') . "_time" => "now()"
        );

        if ($status == '2') {
            $data['status'] = -1;
        }

        $error_message = "";

        $this->db->trans_start();
        if ($this->model_servicerequest->update($data, array("id" => $servicerequestid))) {
            $comment = array(
                "referenceid" => $servicerequestid,
                "reference" => 'SR',
                "employeeid" => $this->input->post('approvalid'),
                "content" => $this->input->post('notes')
            );
            if (!$this->db->insert("comment", $comment)) {
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

    function prints($id, $status) {
        $data['id'] = $id;
        $data['sr'] = $this->model_servicerequest->select_by_id($id);
        $data['status'] = $status;
        $data['srdetail'] = $this->model_servicerequest->select_detail_by_service_request_id($id);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $this->load->view('servicerequest/print', $data);
    }

}
