<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class mr extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_mr');
        $this->load->model('model_mrdetail');
        $this->load->model('model_user');
    }

    function index() {
        $departmentid = 0;
        if ($this->session->userdata('department') != 8 && $this->session->userdata('id') != 'admin') {
            $departmentid = $this->session->userdata('department');
        }
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "mr"));
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAll();
        $data['mrstatus'] = $this->config->item('mrstatus');
        $data['mr'] = $this;
        $this->load->view('mr/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "mr"));
        $data['mrstatus'] = $this->config->item('mrstatus');
        
        $query = "select 
        mr.*,
        department.name departmentname,
        department.code departmentcode,
        reasonrequirement.description reasonrequirement,
        er.name namerequestby,
        es.name supervisor,
        em.name manager,
        dev.code dev_code,
        dev.name dev_name,
        cc.code cost_center_code
        from mr join department on mr.departmentid=department.id
        left join reasonrequirement on mr.reasonrequirementid=reasonrequirement.id
        left join employee er on mr.requestby=er.id
        left join employee es on mr.supervisorapproval=es.id
        left join employee em on mr.managerapproval=em.id
        left join dept_division dev on mr.dept_divisionid=dev.id
        left join cost_center cc on mr.cost_center_id=cc.id
        where true ";
        
//        if ($departmentid != 0) {
//            $query .= " and t.departmentid=$departmentid";
//        }


        $number = $this->input->post('number');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $departmentid = $this->input->post('departmentid');
        $requestby = $this->input->post('requestby');
        $supervisorapproval = $this->input->post('supervisorapproval');
        $managerapproval = $this->input->post('managerapproval');
        $status = $this->input->post('status');
        
        if (!empty($number)) {
            $query .= " and mr.number ilike '%$number%' ";
        }if (!empty($start_date) && !empty($end_date)) {
            $query .= " and mr.date between '$start_date' and '$end_date' ";
        }if (!empty($start_date) && empty($end_date)) {
            $query .= " and mr.date = '$start_date' ";
        }if (empty($start_date) && !empty($end_date)) {
            $query .= " and mr.date = '$end_date' ";
        }if ($departmentid != 0) {
            $query .= " and mr.departmentid = $departmentid ";
        }if (!empty($requestby)) {
            $query .= " and er.name ilike '%$requestby%' ";
        }if (!empty($supervisorapproval)) {
            $query .= " and es.name ilike '%$supervisorapproval%' ";
        }if (!empty($managerapproval)) {
            $query .= " and em.name ilike '%$managerapproval%' ";
        }if ($status != "") {
            $query .= " and mr.status = $status ";
        }if ($this->session->userdata('id') != 'admin' && $this->session->userdata('department') != 10) {
            $query .= " and (mr.requestby='" . $this->session->userdata('id') . "' or mr.supervisorapproval='" . $this->session->userdata('id') . "' or mr.managerapproval='" . $this->session->userdata('id') . "') ";
        }
        
        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            $query .= " and (((select count(*) from mrdetail where mrdetail.mrid=mr.id and mrdetail.warehouseid=" . $this->session->userdata('optiongroup') . ") > 0) or mr.requestby='" . $this->session->userdata('id') . "')";
            //$query .= " or t.requestby='" . $this->session->userdata('id') . "'";
        }
        $item_code_description = $this->input->post('item_code_description');

        if (!empty($item_code_description)) {
            $query .= " and mr.id in ("
                    . "select mrid from mrdetail join item on mrdetail.itemid=item.id "
                    . "where item.partnumber ilike '%$item_code_description%' or item.descriptions ilike '%$item_code_description%')";
        }
        //echo $query;
        $data['num_rows'] = $this->db->query($query)->num_rows();
        //exit;
        $limit = $this->config->item('limit');
        $query .= "order by mr.id desc limit $limit offset $offset;";
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['mr'] = $this->db->query($query)->result();
        $this->load->view('mr/search', $data);

        //echo $query;
        //exit;
//        $data['num_rows'] = $this->model_mr->getNumRows($number, $start_date, $end_date, $departmentid, $requestby, $supervisorapproval, $managerapproval, $status);
//        $limit = $this->config->item('limit');
//        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
//        $data['offset'] = $offset;
//        $data['first'] = 0;
//        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
//        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
//        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
//        $data['page'] = (int) ceil($offset / $limit) + 1;
//        $data['mr'] = $this->model_mr->search($number, $start_date, $end_date, $departmentid, $requestby, $supervisorapproval, $managerapproval, $status, $limit, $offset);
//        $this->load->view('mr/search', $data);
    }

    function printlist() {
        $data['mrstatus'] = $this->config->item('mrstatus');
        $number = $this->input->post('number');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $departmentid = $this->input->post('departmentid');
        $requestby = $this->input->post('requestby');
        $supervisorapproval = $this->input->post('supervisorapproval');
        $managerapproval = $this->input->post('managerapproval');
        $status = $this->input->post('status');
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        $data['mr'] = $this->model_mr->searchforprint($number, $start_date, $end_date, $departmentid, $requestby, $supervisorapproval, $managerapproval, $status);
        $this->load->view('mr/printlist', $data);
    }

    function add($request_type) {
        $this->load->model('model_department');
        $this->load->model('model_reasonrequirement');
        $this->load->model('model_costcenter');
        $data['department'] = $this->model_department->selectAll();
        $data['reasonrequirement'] = $this->model_reasonrequirement->selectAll();
        $data['nextmr'] = $this->model_mr->getNextNumber();
        $data['devision'] = $this->db->query("select * from dept_division order by name asc")->result();
        $data['approval'] = $this->model_mr->getLastApprovalByEmployee($this->session->userdata('id'));
        $data['request_type'] = $request_type;
        $data['costcenter'] = $this->model_costcenter->select_all();
        $this->load->view('mr/add', $data);
    }

    function additem($counter) {
        $data['flag'] = $counter;
        $this->load->view('mr/additem', $data);
    }

    function save() {

        $data = json_decode($this->input->post("data"));

        $header = $data->header;
        $details = $data->details;


        $mr = array(
            "date" => $header->date,
            "departmentid" => $this->session->userdata('department'),
            "dept_divisionid" => $header->dept_divisionid,
            "requestby" => $this->session->userdata('id'),
            "supervisorapproval" => $header->supervisor,
            "managerapproval" => $header->manager,
            "reasonrequirementid" => $header->reasonrequirementid,
            "datemustreceive" => $header->datemustreceive,
            "soid" => $header->soid,
            "request_type" => $header->request_type,
            "batch_time" => $header->batch_time,
            "cost_center_id" => $header->cost_center_id,
            "area_id" => $this->session->userdata('areaid')
        );

        if ($header->request_type == 2) {
            $mr["warehouse_request_id"] = $this->session->userdata('optiongroup');
        }

        $error_message = "";

        $this->db->trans_start();
        if ($this->model_mr->insert_new($mr)) {
            $mrid = $this->model_mr->get_last_id();
            $mrdetail = array();
            foreach ($details as $detail) {
                $mrdetail[] = array(
                    "mrid" => $mrid,
                    "itemid" => $detail->itemid,
                    "qty" => $detail->qty,
                    "ots" => $detail->qty,
                    "unitid" => $detail->unitid,
                    "reason" => $detail->reason,
                    "warehouseid" => $detail->warehouseid
                );
            }
            if (!$this->model_mrdetail->insert_batch($mrdetail)) {
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
        //$mrid = $this->model_mr->insert($number, $date, $requestby, $departmentid, $supervisor, $manager, $reasonrequirementid, $datemustreceive, $soid, $request_type, $batch_time);
//        for ($i = 0; $i < count($itemid); $i++) {
//            $this->model_mrdetail->insert($mrid, $itemid[$i], $qty[$i], $unitid[$i], $reason[$i], $warehouseid[$i]);
//        }
    }

    function update() {

        $data = json_decode($this->input->post("data"));

        $id = $data->id;
        $header = $data->header;
        $details = $data->details;

        $mr = array(
            "date" => $header->date,
            "dept_divisionid" => $header->dept_divisionid,
            "supervisorapproval" => $header->supervisor,
            "managerapproval" => $header->manager,
            "reasonrequirementid" => $header->reasonrequirementid,
            "datemustreceive" => $header->datemustreceive,
            "soid" => $header->soid,
            "request_type" => $header->request_type,
            "batch_time" => $header->batch_time,
            "cost_center_id" => $header->cost_center_id
        );

        //$this->model_mr->update($id, $number, $date, $requestby, $departmentid, $supervisor, $manager, $reasonrequirementid, $datemustreceive, $soid, $batch_time);

        $error_message = "";

        $this->db->trans_start();
        if ($this->model_mr->update_new($mr, array("id" => $id))) {
            foreach ($details as $detail) {
                $mrdetail = array(
                    "itemid" => $detail->itemid,
                    "qty" => $detail->qty,
                    "ots" => $detail->qty,
                    "unitid" => $detail->unitid,
                    "reason" => $detail->reason,
                    "warehouseid" => $detail->warehouseid
                );
                if ($detail->mrdetailid == 0) {
                    $mrdetail["mrid"] = $id;
                    if (!$this->model_mrdetail->insert_detail($mrdetail)) {
                        $error_message = $this->db->_error_message();
                    }
                } else {
                    if (!$this->model_mrdetail->update_detail($mrdetail, array("id" => $detail->mrdetailid))) {
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

    function edit($id) {
        $data['mrid'] = $id;
        $this->load->model('model_department');
        $this->load->model('model_unit');
        $this->load->model('model_mrdetail');
        $this->load->model('model_reasonrequirement');
        $this->load->model('model_warehouse');
        $data['reasonrequirement'] = $this->model_reasonrequirement->selectAll();
        $data['department'] = $this->model_department->selectAll();
        $data['devision'] = $this->db->query("select * from dept_division order by name asc")->result();
        $data['mr'] = $this->model_mr->selectById($id);
        $data['mrdetail'] = $this->model_mrdetail->selectByMrId($id);
        $this->load->model('model_costcenter');
        $data['costcenter'] = $this->model_costcenter->select_all();
        $this->load->view('mr/edit', $data);
    }

    function approve() {
        $mrid = $this->input->post('mrid');
        $status = $this->input->post('status');
        $approval = $this->input->post('approval');
        if ($this->model_mr->approve($mrid, $status, $approval)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        $this->model_mr->delete($id);
    }

    function viewmropen() {
        $this->load->model('model_department');
        $data['mr'] = $this->model_mr->selectOpenMr("", 0, "");
        $data['department'] = $this->model_department->selectAll();
        $this->load->view('mr/viewmropen', $data);
    }

    function prints($id, $status) {
        $this->load->model('model_employee');
        $data['id'] = $id;
        $data['mr'] = $this->model_mr->selectById($id);
        $data['status'] = $status;
        $data['mrdetail'] = $this->model_mrdetail->selectByMrId($id);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->getDetail();
        if ($status == "prints") {
            $this->load->library("pdf");
            $html = $this->load->view('mr/print', $data, TRUE);
            $this->pdf->pdf_create($html, "file");
        } else {
            $this->load->view('mr/print', $data);
        }
    }

    function searcfordialog($temp) {
        $mrvnumber = $this->input->post('mrvnumber');
        $mr = $this->model_mr->searchByMrNumber($mrvnumber);
        $no = 1;
        foreach ($mr as $mr) {
            ?>
            <tr>
                <td align="right"><?php echo $no++ ?></td>
                <td align="center"><?php echo $mr->number ?></td>
                <td align="center"><img src="images/check.png" class="miniaction" onclick="$('#<?php echo $temp ?>').val('<?php echo $mr->number ?>');
                        $('#dialog').dialog('close')"/></td>
            </tr>
            <?php
        }
    }

    function changestatus($mrid, $status) {
        $this->model_mr->changestatus($mrid, $status);
    }

    function searchmropen() {
        $mrno = $this->input->post('mrno');
        $departmentid = $this->input->post('departmentid');
        $date = $this->input->post('date');
        $mr = $this->model_mr->selectOpenMr($mrno, $departmentid, $date);
        $no = 1;
        foreach ($mr as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $no++ ?></td>
                <td align="center"><?php echo $result->number ?></td>
                <td><?php echo $result->departmentname ?></td>
                <td align="center"><?php echo $result->date ?></td>
                <td align="center"><img src="images/check.png" onclick="stockout_mrchoose(<?php echo $result->id ?>, 1)" class="miniaction"/></td>
            </tr>
            <?php
        }
    }

    function newreceive($mrid) {
        $this->load->model('model_stockoutdetail');
        $data['mrid'] = $mrid;
        $data['stockout'] = $this->model_mr->selectStockOutUnreceiveByMrId($mrid);
        $this->load->view("mr/newreceive", $data);
    }

    function detailreceive($mrid) {
        $this->load->model('model_stockoutdetail');
        $data['stockout'] = $this->model_mr->selectDetailReceive($mrid);
        $data['mrid'] = $mrid;
        $this->load->view("mr/detailreceive", $data);
    }

    function printdetailreceive($mrid) {
        $query = "select 
                stockoutdetail.*,
                stockout.number stockoutnumber,
                stockout.receivedate,
                stockout.received,
                item.partnumber itemcode,
                item.descriptions itemdescription,
                unit.codes unitcode
                from stockoutdetail 
                join stockout on stockoutdetail.stockoutid=stockout.id
                join item on stockoutdetail.itemid=item.id
                join unit on stockoutdetail.unitid=unit.id 
                where stockout.received=true and stockout.mrid=$mrid";
        $data['mrdetail'] = $this->model_mr->selectQuery($query);
        $data['mr'] = $this->model_mr->selectById($mrid);
        $this->load->model('model_company');
        $this->load->model('model_employee');
        $data['company'] = $this->model_company->getDetail();
        $this->load->view('mr/printdetailreceive', $data);
    }

    function item_delete() {
        if ($this->model_mrdetail->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function rejectOrPending($mrid, $approvalid, $status, $who, $flag) {
        $data['mrid'] = $mrid;
        $data['approvalid'] = $approvalid;
        $data['status'] = $status;
        $data['flag'] = $flag;
        $data['who'] = $who;
        $this->load->view('mr/reject_or_pending', $data);
    }

    function do_reject_or_pending() {
        $mrid = $this->input->post('mrid');
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

        $error_message = "";

        $this->db->trans_start();
        if ($this->db->update('mr', $data, array("id" => $mrid))) {
            $data_notes = array(
                "mrid" => $mrid,
                "employeeid" => $approvalid,
                "timeapprove" => date('Y-m-d h:i:s'),
                "notes" => $notes
            );
            if (!$this->db->insert("mrapprovalnotes", $data_notes)) {
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
            mrapprovalnotes.*
            from mrapprovalnotes
            where mrid=$mat_req_id
            and employeeid='$employee' 
            order by mrapprovalnotes.id desc
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

}
?>
