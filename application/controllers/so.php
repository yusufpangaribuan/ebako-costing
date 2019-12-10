<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of so
 *
 * @author hp
 */
class so extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_customer');
        $this->load->model('model_so');
        $this->load->model('model_quotationvalidity');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "so"));
        $this->load->model('model_testing');
        $data['sostatus'] = $this->config->item('sostatus');
        $data['customer'] = $this->model_customer->selectAll();
        $data['testing'] = $this->model_testing->selectAll();

        $limit = $this->config->item('limit');
        $offset = 0;
        if ($this->session->userdata('department') == 2) {
            $data['num_rows'] = $this->model_so->getNumRowsAllFinishByRnd("", 0, "", "", "", 0);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAllFinishByRnd("", 0, "", "", "", 0, $limit, $offset);
        } else if ($this->session->userdata('department') == 4) {
            $data['num_rows'] = $this->model_so->getNumRowsAllFinishByMarketing("", 0, "", "", "", 0);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAllFinishByMarketing("", 0, "", "", "", 0, $limit, $offset);
        } else if ($this->session->userdata('department') == 3) {
            $data['num_rows'] = $this->model_so->getNumRowsFinishByPPC("", 0, "", "", "", 0);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAllFinishByPPC("", 0, "", "", "", 0, $limit, $offset);
        } else {
            $data['num_rows'] = $this->model_so->getNumRowsAll("", 0, "", "", "", 0);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAll("", 0, "", "", "", 0, $limit, $offset);
        }
        $this->load->view('so/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "so"));
        $this->load->model('model_testing');
        $data['testing'] = $this->model_testing->selectAll();
        $so = $this->input->post('so');
        $customerid = $this->input->post('customerid');
        $shipto = $this->input->post('shipto');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $status = $this->input->post('status');
        $limit = $this->config->item('limit');
        $data['offset'] = $offset + 1;
        if ($this->session->userdata('department') == 2) {
            $data['num_rows'] = $this->model_so->getNumRowsAllFinishByRnd($so, $customerid, $shipto, $datefrom, $dateto, $status);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAllFinishByRnd($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset);
        } else if ($this->session->userdata('department') == 4) {
            $data['num_rows'] = $this->model_so->getNumRowsAllFinishByMarketing($so, $customerid, $shipto, $datefrom, $dateto, $status);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAllFinishByMarketing($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset);
        } else if ($this->session->userdata('department') == 3) {
            $data['num_rows'] = $this->model_so->getNumRowsFinishByPPC($so, $customerid, $shipto, $datefrom, $dateto, $status);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAllFinishByPPC($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset);
        } else {
            $data['num_rows'] = $this->model_so->getNumRowsAll($so, $customerid, $shipto, $datefrom, $dateto, $status);
            $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
            $data['offset'] = $offset + 1;
            $data['first'] = 0;
            $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
            $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
            $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
            $data['page'] = (int) ceil($offset / $limit) + 1;
            $data['so'] = $this->model_so->selectAll($so, $customerid, $shipto, $datefrom, $dateto, $status, $limit, $offset);
        }
        $this->load->view('so/search', $data);
    }

    function add() {
        $this->load->model('model_testing');
        $this->load->model('model_paymentterm');
        $this->load->model('model_quotationvalidity');
        $this->load->model('model_testing');
        $data['shipmentvia'] = $this->config->item("shipmentvia");
        $data['testing'] = $this->model_testing->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $data['paymentterm'] = $this->model_paymentterm->selectAll();
        $data['quotationvalidity'] = $this->model_quotationvalidity->selectAll();
        $this->load->view('so/add', $data);
    }

    function edit($id) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "so"));
        $this->load->model('model_testing');
        $this->load->model('model_paymentterm');
        $this->load->model('model_quotationvalidity');
        $this->load->model('model_testing');
        $data['soid'] = $id;
        $data['shipmentvia'] = $this->config->item("shipmentvia");
        $data['testing'] = $this->model_testing->selectAll();
        $data['customer'] = $this->model_customer->selectAll();
        $data['paymentterm'] = $this->model_paymentterm->selectAll();
        $data['quotationvalidity'] = $this->model_quotationvalidity->selectAll();
        $data['so'] = $this->model_so->selectById($id);
        $data['shipmentvia'] = $this->config->item("shipmentvia");
        $data['sodetail'] = $this->model_so->selectItemBySoId($id);
        $data['sodetailstatus'] = $this->config->item('sodetailstatus');
        $data['iscompletestatus'] = $this->model_so->isCompleteStatus($id);
        if ($this->session->userdata('department') == 1) {
            $this->load->view('so/edit', $data);
        } else if ($this->session->userdata('department') == 2) {
            $this->load->view('so/editbyppc', $data);
        } else {
            $this->load->view('so/editbyrnd', $data);
        }
    }

    function delete($id) {
        $this->model_so->delete($id);
    }

    function deleteitem($id) {
        $this->model_so->deleteitem($id);
    }

    function additem($counter) {
        $data['counter'] = $counter;
        $this->load->view('so/additem', $data);
    }

    function insert() {
        $number = $this->input->post('number');
        $customerid = $this->input->post('billto');
        $shipto = $this->input->post('shipto');
        $shippingaddress = $this->input->post('shippingaddress');
        $shipmentschedule = $this->input->post('shipmentschedule');
        $shipvia = $this->input->post('shipvia');
        $date = $this->input->post('date');
        $salesperson = $this->input->post('salesperson');
        $arrtesting = $this->input->post('arrtesting');
        $ponumber = $this->input->post('ponumber');
        $paymenttermid = $this->input->post('paymenttermid');
        $modelid = $this->input->post('modelid');
        $qty = $this->input->post('qty');
        $rfqdetailid = $this->input->post('rfqdetailid');

        $testing = "{";
        if (!empty($arrtesting)) {
            foreach ($arrtesting as $val) {
                $testing .= $val . ",";
            }
        }
        $testing .= "0}";
        $id = $this->model_so->insert($customerid, $shipto, $shippingaddress, $shipmentschedule, $shipvia, $number, $date, $salesperson, $testing, $ponumber, $paymenttermid);
        for ($i = 0; $i < count($modelid); $i++) {
            $this->model_so->insertdetail($id, $modelid[$i], $qty[$i], $rfqdetailid[$i]);
        }
    }

    function viewitem($soid) {
        $data['model'] = $this->model_so->selectItemBySoId($soid);
        $this->load->view('so/viewitem', $data);
    }

    function load($soid) {
        $data['model'] = $this->model_so->selectItemBySoId($soid);
        $data['so'] = $this->model_so->selectById($soid);
        $this->load->view('so/load', $data);
    }

    function noteitem($soid, $modelid) {
        $this->load->model('model_sodetailnotes');
        $data['soid'] = $soid;
        $data['modelid'] = $modelid;
        $data['notes'] = $this->model_sodetailnotes->selectBySoIdModelId($soid, $modelid);
        $this->load->view('so/noteitem', $data);
    }

    function update() {
        $soid = $this->input->post('soid');
        $number = $this->input->post('number');
        $customerid = $this->input->post('billto');
        $shipto = $this->input->post('shipto');
        $shippingaddress = $this->input->post('shippingaddress');
        $shipmentschedule = $this->input->post('shipmentschedule');
        $shipvia = $this->input->post('shipvia');
        $date = $this->input->post('date');
        $salesperson = $this->input->post('salesperson');
        $testing = $this->input->post('arrtesting');
        $ponumber = $this->input->post('ponumber');
        $paymenttermid = $this->input->post('paymenttermid');
        $sodetailid = $this->input->post('sodetailid');
        $modelid = $this->input->post('modelid');
        $qty = $this->input->post('qty');
        $testing = empty($testing) ? "{0}" : "{" . join(',', $testing) . "}";
        $this->model_so->update($soid, $customerid, $shipto, $shippingaddress, $shipmentschedule, $shipvia, $number, $date, $salesperson, $testing, $ponumber, $paymenttermid);
//        print_r($sodetailid);
        for ($i = 0; $i < count($sodetailid); $i++) {
            if ($sodetailid[$i] == 0) {
                //echo "Insert<br/>";
                $this->model_so->insertdetail($soid, $modelid[$i], $qty[$i]);
            } else {
                //echo "Update<br/>";
                $this->model_so->updatedetail($sodetailid[$i], $modelid[$i], $qty[$i]);
            }
        }
    }

    function addquotationvalidity($flag) {
        $data['qv'] = $this->model_quotationvalidity->selectAll();
        $data['flag'] = $flag;
        $this->load->view('so/quotationvalidity', $data);
    }

    function savequotationvalidity() {
        $description = $this->input->post('description');
        $this->model_quotationvalidity->insert($description);
    }

    function quotationvalidityoption() {
        $quotationvalidity = $this->model_quotationvalidity->selectAll();
        echo "<option value='0'></option>";
        foreach ($quotationvalidity as $result) {
            echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
        }
    }

    function deletequotationvalidity($id) {
        $this->model_quotationvalidity->delete($id);
    }

    function editquotationvalidity($id, $flag) {
        $data['flag'] = $flag;
        $data['qv'] = $this->model_quotationvalidity->selectById($id);
        $this->load->view('so/editquotationvalidity', $data);
    }

    function updatequotationvalidity() {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $this->model_quotationvalidity->update($id, $description);
    }

    function addloadability($flag) {
        $data['qv'] = $this->model_loadability->selectAll();
        $data['flag'] = $flag;
        $this->load->view('so/loadability', $data);
    }

    function saveloadability() {
        $description = $this->input->post('description');
        $this->model_loadability->insert($description);
    }

    function loadabilityoption() {
        $loadability = $this->model_loadability->selectAll();
        echo "<option value='0'></option>";
        foreach ($loadability as $result) {
            echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
        }
    }

    function deleteloadability($id) {
        $this->model_loadability->delete($id);
    }

    function editloadability($id, $flag) {
        $data['flag'] = $flag;
        $data['qv'] = $this->model_loadability->selectById($id);
        $this->load->view('so/editloadability', $data);
    }

    function updateloadability() {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $this->model_loadability->update($id, $description);
    }

    function searchonproduction() {
        $sonumber = $this->input->post('sonumber');
        $customerid = $this->input->post('customerid');
        $date = $this->input->post('date');
        $so = $this->model_so->selectOnProduction($sonumber, $customerid, $date);
        foreach ($so as $result) {
            ?>
            <tr>
                <td><?php echo $result->number ?></td>
                <td><?php echo $result->customername ?></td>
                <td><?php echo $result->date ?></td>
                <td align="center">
                    <img src="images/check.png" class="miniaction" onclick="if($('#soid').val() != <?php echo $result->id ?>){$('#mrtablebody').empty();}$('#soid').val('<?php echo $result->id ?>');$('#sonumber').val('<?php echo $result->number ?>');$('#dialog').dialog('close');"/>
                </td>
            </tr>
            <?php
        }
    }

    function choosequotation() {
        $this->load->model('model_rfq');
        $data['rfq'] = $this->model_rfq->selectAvailabel();
        $this->load->view('so/choosequotation', $data);
    }

    function updatedetailstatus($sodetailid, $status, $customerid, $modelid) {
        $this->model_so->updatedetailstatus($sodetailid, $status, $customerid, $modelid);
    }

    function createfinalebom($soid) {
        $this->model_so->createFinalBom($soid);
    }

    function finishByRnd($soid) {
        $this->model_so->finishByRnd($soid);
    }

    function finishByMarketing($soid) {
        $this->model_so->finishByMarketing($soid);
    }

    function createmrp($soid) {
        $this->model_so->createmrp($soid);
    }

    function viewmrp($soid, $st) {
        $this->load->model('model_company');
        $this->load->model('model_unit');
        $this->load->model('model_item');
        $data['so'] = $this->model_so->selectById($soid);
        $data['somaterial'] = $this->model_so->selectMRPforSO($soid);
        $data['company'] = $this->model_company->getDetail();
        $data['st'] = $st;
        $this->load->view('so/mrp', $data);
    }

    function viewonproduction() {
        $data['customer'] = $this->model_customer->selectAll();
        $this->load->view('so/viewonproduction', $data);
    }

    function updatestatus($soid, $status) {
        $data = array("status" => $status);
        $where = array("id" => $soid);
        $this->model_so->updatestatus($data, $where);
    }

}
?>
