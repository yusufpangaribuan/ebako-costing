<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rfq
 *
 * @author hp
 */
class rfq extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('model_rfq');
        $this->load->model('model_rfqdetail');
        $this->load->model('model_user');
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rfq"));
        $offset = 0;
        $this->load->model('model_testing');
        $this->load->model('model_customer');
        $data['testing'] = $this->model_testing->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $data['num_rows'] = $this->model_rfq->getNumRows("", "", "", 0, 0);
        $limit = $this->config->item('limit');
        $data['offset'] = $offset;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['rfqstatus'] = $this->config->item("rfqstatus");
        $data['rfq'] = $this->model_rfq->search("", "", "", 0, 0, $limit, $offset);
        $this->load->view('rfq/view', $data);
    }

    function searh($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rfq"));
        $this->load->model('model_testing');
        $data['testing'] = $this->model_testing->selectAll();
        $rfqno = $this->input->post('rfqno');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $customerid = $this->input->post('customerid');
        $status = $this->input->post('status');
        $data['num_rows'] = $this->model_rfq->getNumRows($rfqno, $datefrom, $dateto, $customerid, $status);
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['rfqstatus'] = $this->config->item("rfqstatus");
        $data['rfq'] = $this->model_rfq->search($rfqno, $datefrom, $dateto, $customerid, $status, $limit, $offset);
        $this->load->view('rfq/search', $data);
    }

    function add() {
        $this->load->model('model_testing');
        $this->load->model('model_customer');
        $this->load->model('model_paymentterm');
        $data['paymentterm'] = $this->model_paymentterm->selectAll();
        $data['testing'] = $this->model_testing->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $data['shipmentvia'] = $this->config->item("shipmentvia");
        $this->load->view('rfq/add', $data);
    }

    function insert() {
        $billto = $this->input->post('billto');
        $shipto = $this->input->post('shipto');
        $shippingaddress = $this->input->post('shippingaddress');
        $promiseddate = $this->input->post('promiseddate');
        $shipvia = $this->input->post('shipvia');
        $number = $this->input->post('number');
        $date = $this->input->post('date');
        $salesperson = $this->input->post('salesperson');
        $arrtesting = $this->input->post('arrtesting');
        $paymenttermid = $this->input->post('paymenttermid');
        $testing = "{";
        if (!empty($arrtesting)) {
            foreach ($arrtesting as $val) {
                $testing .= $val . ",";
            }
        }
        $testing .= "0}";
        try {
            $this->model_rfq->insert($billto, $shipto, $shippingaddress, $promiseddate, $shipvia, $number, $date, $salesperson, $testing, $paymenttermid);
        } catch (Exception $e) {
            echo "The exception code is: " . $e->getCode();
        }
    }

    function edit($id) {
        $this->load->model('model_testing');
        $this->load->model('model_customer');
        $this->load->model('model_model');
        $this->load->model('model_paymentterm');
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "rfq"));
        $data['paymentterm'] = $this->model_paymentterm->selectAll();
        $data['testing'] = $this->model_testing->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $data['shipmentvia'] = $this->config->item("shipmentvia");
        $data['rfq'] = $this->model_rfq->selectById($id);
        $data['rfqdetail'] = $this->model_rfqdetail->selectByIdRfq($id);
        $this->load->view('rfq/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $billto = $this->input->post('billto');
        $shipto = $this->input->post('shipto');
        $shippingaddress = $this->input->post('shippingaddress');
        $promiseddate = $this->input->post('promiseddate');
        $shipvia = $this->input->post('shipvia');
        $number = $this->input->post('number');
        $date = $this->input->post('date');
        $salesperson = $this->input->post('salesperson');
        $arrtesting = $this->input->post('arrtesting');
        $paymenttermid = $this->input->post('paymenttermid');
        $testing = "{";
        if (!empty($arrtesting)) {
            foreach ($arrtesting as $val) {
                $testing .= $val . ",";
            }
        }
        $testing .= "0}";
        try {
            echo $this->model_rfq->update($id, $billto, $shipto, $shippingaddress, $promiseddate, $shipvia, $number, $date, $salesperson, $testing, $paymenttermid);
        } catch (Exception $e) {
            echo "The exception code is: " . $e->getCode();
        }
    }

    function adddetail($rfqid, $type) {
        $data['rfqid'] = $rfqid;
        if ($type == 1) {
            $this->load->view('rfq/addexisting', $data);
        } else if ($type == 2) {
            $this->load->view('rfq/addcustomize', $data);
        } else {
            $this->load->view('rfq/addnew', $data);
        }
    }

    function savefornewmodel() {
        $custcode = $this->input->post('custcode');
        $rfqid = $this->input->post('rfqid');
        $description = $this->input->post('description');
        $qty = $this->input->post('qty');
        $type = 3;
        $modelid = 0;
        $this->model_rfqdetail->insert($rfqid, $modelid, $type, $description, $qty, $custcode);
    }

    function savecustomizemodel() {
        $rfqid = $this->input->post('rfqid');
        $description = $this->input->post('description');
        $qty = $this->input->post('qty');
        $type = 2;
        $modelid = $this->input->post('modelid');
        $custcode = $this->input->post('custcode');
        $this->model_rfqdetail->insert($rfqid, $modelid, $type, $description, $qty, $custcode);
    }

    function saveexistingmodel() {
        $rfqid = $this->input->post('rfqid');
        $description = "";
        $qty = $this->input->post('qty');
        $custcode = $this->input->post('custcode');
        $type = 1;
        $modelid = $this->input->post('modelid');
        $this->model_rfqdetail->insert($rfqid, $modelid, $type, $description, $qty, $custcode);
    }

    function edititem($id, $type) {
        $data['rfqdetail'] = $this->model_rfqdetail->selectById($id);
        if ($type == 1) {
            $this->load->view('rfq/editexisting', $data);
        } else if ($type == 2) {
            $this->load->view('rfq/editcustomize', $data);
        } else {
            $this->load->view('rfq/editnew', $data);
        }
    }

    function updatefornewmodel() {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $qty = $this->input->post('qty');
        $modelid = 0;
        $custcode = $this->input->post('custcode');
        $this->model_rfqdetail->update($id, $modelid, $description, $qty, $custcode);
    }

    function updatecustomizemodel() {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $qty = $this->input->post('qty');
        $modelid = $this->input->post('modelid');
        $custcode = $this->input->post('custcode');
        $this->model_rfqdetail->update($id, $modelid, $description, $qty, $custcode);
    }

    function updateexistingmodel() {
        $id = $this->input->post('id');
        $description = "";
        $qty = $this->input->post('qty');
        $modelid = $this->input->post('modelid');
        $custcode = $this->input->post('custcode');
        $this->model_rfqdetail->update($id, $modelid, $description, $qty, $custcode);
    }

    function deleteitem($rfqdetailid) {
        echo $this->model_rfqdetail->delete($rfqdetailid);
    }

    function detailnotes($rfqdetailid) {
        echo "<div style='width: 450px; min-height: 100px; height: 380px;'>";
        echo nl2br($this->model_rfqdetail->notes($rfqdetailid));
        echo "</div>";
    }

    function process($rfqid) {
        $this->model_rfq->process($rfqid);
    }

    function doapprove() {
        $rfqid = $this->input->post('rfqid');
        $dateapprove = $this->input->post('dateapprove');
        $pocustomer = $this->input->post('pocustomer');
        $modelid = $this->input->post('modelid');

        $file_element_name = 'fileupload';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
            if ($this->model_rfq->doApprove($rfqid, $dateapprove, $pocustomer, '')) {
                $msg = "Error When Upload File";
            } else {
                $msg = "Update status and Upload File Faild!";
            }
        } else {
            $data = $this->upload->data();
            if ($this->model_rfq->doApprove($rfqid, $dateapprove, $pocustomer, $data['file_name'])) {
                $status = "success";
                $msg = "File successfully uploaded";
            } else {
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        $modelid = explode(',', $modelid);
        for ($i = 0; $i < count($modelid); $i++) {
            $this->model_rfqdetail->approve($modelid[$i]);
        }
        @unlink($_FILES[$file_element_name]);
        echo '1';
    }

    function quotation($rfqid, $ischeck, $st = 0) {
        $this->load->model('model_costing');
        $this->load->model('model_model');
        $this->load->model('model_company');
        $data['rfq'] = $this->model_rfq->selectById($rfqid);
        $data['rfqdetail'] = $this->model_rfqdetail->selectByIdRfq($rfqid);
        $data['company'] = $this->model_company->getDetail();
        $data['st'] = $st;
        if ($ischeck == 'true') {
            $this->load->view('rfq/quotation3', $data);
        } else if ($ischeck == 'false') {
            $this->load->view('rfq/quotation2', $data);
        }
    }

    function approve($rfqid) {
        $data['rfqid'] = $rfqid;
        $data['rfqdetail'] = $this->model_rfqdetail->selectByIdRfq($rfqid);
        $this->load->view("rfq/approve", $data);
    }

    function getdetail($rfqid) {
        $rfq = $this->model_rfq->selectById($rfqid);
        echo $rfq->id . "||" . $rfq->number . "||" . $rfq->customerid . "||" . $rfq->shiptoid . "||" . $rfq->shippingaddress . "||" . $rfq->shipvia . "||" . $rfq->salesperson . "||" . str_replace(array('{', '}'), '', $rfq->testing) . "||" . $rfq->paymenttermid . "||" . $rfq->ponumber;
    }

    function loadmodeltoso($rfqid) {
        $rfqdetail = $this->model_rfqdetail->selectByIdRfqAndApprove($rfqid);
        foreach ($rfqdetail as $result) {
            ?>
            <tr>
                <td>
                    <input type="text" style="width: 80%" id="modelcode" name="modelcode[]" value="<?php echo $result->no; ?>"/>
                    <input type="hidden" id="modelid" name="modelid[]" value="<?php echo $result->modelid; ?>"/>
                    <input type="hidden" id="rfqdetailid" name="rfqdetailid[]" value="<?php echo $result->id; ?>"/>
                </td>                                    
                <td><textarea id="modeldescription"style="width: 100%" readonly=""><?php echo $result->modeldescription ?></textarea></td>                                
                <td><textarea id="modelfinishing" style="width: 100%" readonly=""></textarea></td>
                <td><textarea id="modelfabrication" style="width: 100%" readonly=""></textarea></td>
                <td>                    
                    <input type="text" style="width: 100%;text-align: center" id="qty" onfocus="$('#input').val($(this).val())" name="qty[]" value="<?php echo $result->qty; ?>" onchange="if($(this).val()=='' || parseInt($(this).val()) <= 0 || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val($('#input').val())}"/></td>
                <td>&nbsp;</td>
            </tr>
            <?php
        }
    }

    function close($rfqid) {
        $this->model_rfq->close($rfqid);
    }

    function delete($rfqid) {
        $this->model_rfq->delete($rfqid);
    }

    function detail_attachment($rfqdetailid, $rfqid) {
        $this->load->model('model_rfqitemattachment');
        $data['rfqitemattachment'] = $this->model_rfqitemattachment->selectByDetailId($rfqdetailid);
        $data['rfqdetailid'] = $rfqdetailid;
        $data['rfqid'] = $rfqid;
        $this->load->view('rfq/detail_attachment', $data);
    }

    function upload_detail_attachment() {
        $this->load->model('model_rfqitemattachment');
        $rfqdetailid = $this->input->post('rfqdetailid');
        $title = $this->input->post('title');
        $file_element_name = 'fileupload';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file_element_name)) {
            $data = $this->upload->data();
            $this->model_rfqitemattachment->upload_detail_attachment(array(
                "rfqdetailid" => $rfqdetailid,
                "filename" => $data['file_name'],
                "title" => $title));
        }
        @unlink($_FILES[$file_element_name]);
    }

    function delete_detail_attachment() {
        $this->load->model('model_rfqitemattachment');
        $id = $this->input->post('id');
        $filename = $this->input->post('filename');
        $path = "./files/$filename";
        if (@unlink($path)) {
            if ($this->model_rfqitemattachment->delete_detail_attachment($id)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => 'Delete File Faild!'));
        }
    }

}
?>
