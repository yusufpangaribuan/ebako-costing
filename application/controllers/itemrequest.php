<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemrequest
 *
 * @author hp
 */
class itemrequest extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_itemrequest');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "itemrequest"));
        $this->load->model('model_unit');
        $this->load->model('model_groups');
        $data['unit'] = $this->model_unit->selectAll();
        $data['group'] = $this->model_groups->selectAll();

        $groupid = $this->input->post('groupid');
        $description = $this->input->post('description');
        $unitid = $this->input->post('unitid');

        $query = "select 
                itemrequest.*,
                groups.names groupname,
                groups.codes groupcode,
                unit.codes unitcode,
                unit.names unitname,
                employee.name requestname,
                (select name from employee where id=itemrequest.statusby) statusbyname from itemrequest
                join groups on itemrequest.groupid=groups.id
                join unit on itemrequest.unitid=unit.id 
                join employee on itemrequest.requestby=employee.id ";
        if ($groupid != 0 && !empty($groupid)) {
            $query .= " and itemrequest.groupid=" . $this->input->post('groupid');
        }if (!empty($description)) {
            $query .= " and itemrequest.description ilike '%" . $this->input->post('description') . "%'";
        }if ($unitid != 0 && !empty($unitid)) {
            $query .= " and itemrequest.unitid=" . $this->input->post('unitid');
        }if (!($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0)) {
            $query .= " and itemrequest.requestby='" . $this->session->userdata('id') . "'";
        }
        $query .= " order by id desc ";
        $data['num_rows'] = $this->model_itemrequest->getNumRows($query);
        $limit = $this->config->item('limit');
        $offset = 0;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= " limit $limit offset $offset";
        $data['itemrequest'] = $this->model_itemrequest->search($query);
        $this->load->view('itemrequest/view', $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "itemrequest"));
        $groupid = $this->input->post('groupid');
        $description = $this->input->post('description');
        $unitid = $this->input->post('unitid');
        $query = "
                select 
                itemrequest.*,
                groups.names groupname,
                groups.codes groupcode,
                unit.codes unitcode,
                unit.names unitname,
                employee.name requestname,
                (select name from employee where id=itemrequest.statusby) statusbyname from itemrequest
                join groups on itemrequest.groupid=groups.id
                join unit on itemrequest.unitid=unit.id 
                join employee on itemrequest.requestby=employee.id 
            ";

        if ($groupid != 0 && !empty($groupid)) {
            $query .= " and itemrequest.groupid=" . $this->input->post('groupid');
        }if (!empty($description)) {
            $query .= " and itemrequest.description ilike '%" . $this->input->post('description') . "%'";
        }if ($unitid != 0 && !empty($unitid)) {
            $query .= " and itemrequest.unitid=" . $this->input->post('unitid');
        }if (!($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0)) {
            $query .= " and itemrequest.requestby='" . $this->session->userdata('id') . "'";
        }
        $data['num_rows'] = $this->model_itemrequest->getNumRows($query);
        $limit = $this->config->item('limit');
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['offset'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;

        $query .= " order by id desc  limit $limit offset $offset";

        //echo $query;
        $data['itemrequest'] = $this->model_itemrequest->search($query);
        $this->load->view('itemrequest/search', $data);
    }

    function add() {
        $this->load->model('model_unit');
        $this->load->model('model_groups');
        $data['unit'] = $this->model_unit->selectAll();
        $data['group'] = $this->model_groups->selectAll();
        $this->load->view('itemrequest/add', $data);
    }

    function save() {
        $groupid = $this->input->post('groupid');
        $description = $this->input->post('description');
        $unitid = $this->input->post('unitid');
        $data = array(
            "groupid" => $groupid,
            "description" => $description,
            "unitid" => $unitid,
            "requestby" => $this->session->userdata('id')
        );
        if ($this->model_itemrequest->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function approve($id) {
        $this->load->model('model_unit');
        $this->load->model('model_groups');
        $this->load->model('model_warehouse');
        $data['unit'] = $this->model_unit->selectAll();
        $data['group'] = $this->model_groups->selectAll();
        $data['warehouse'] = $this->model_warehouse->selectAll();
        $data['itemrequest'] = $this->model_itemrequest->selectById($id);
        $this->load->view('itemrequest/approve', $data);
    }

    function doapprove() {
        $this->load->model('model_stock');
        $this->load->model('model_item');
        $itemrequestid = $this->input->post('itemrequestid');
        $isstock = $this->input->post('isstock');
        $partnumber = $this->input->post('partnumber');
        $rack = $this->input->post('rack');
        $reorderpoint = $this->input->post('reorderpoint');
        $groupid = $this->input->post('groupid');
        $woodid = $this->input->post('woodid');
        $description = $this->input->post('description');
        $unitid = $this->input->post('unitid');
        $balance = $this->input->post('balance');
        $whs = $this->input->post('whs');
        $moq = (double) $this->input->post('moq');
        $lt = (double) $this->input->post('lt');
        $expdate = $this->input->post('expdate');
        $qccheck = $this->input->post('qccheck');
        $notes = $this->input->post('notes');
        if ($this->model_item->save($isstock, $partnumber, $groupid, $description, $rack, $reorderpoint, "", $moq, $lt, $expdate, $qccheck, $woodid)) {
            $itemid = $this->model_item->get_last_id();
            $stock = array();
            for ($i = 0; $i < count($whs); $i++) {
                $stock[] = array(
                    "itemid" => $itemid,
                    "unitfrom" => $unitid,
                    "unitto" => $unitid,
                    "conversionvalue" => 1,
                    "stock" => $balance[$i],
                    "warehouseid" => $whs[$i]
                );
            }

            if ($this->model_stock->insertunit_batch($stock)) {
                $data = array(
                    "status" => 1,
                    "datestatus" => date('Y-m-d H:i:s'),
                    "statusby" => $this->session->userdata('id'),
                    "notes" => $notes
                );
                if ($this->model_itemrequest->update($data, array("id" => $itemrequestid))) {
                    echo json_encode(array('success' => true));
                } else {
                    echo $this->db->_error_message();
                }
            } else {
                echo $this->db->_error_message();
            }
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function doreject() {
        $itemrequestid = $this->input->post('itemrequestid');
        $notes = $this->input->post('notes');
        $data = array(
            "status" => 2, //Flag Reject
            "datestatus" => date('Y-m-d H:i:s'),
            "statusby" => $this->session->userdata('id'),
            "notes" => $notes
        );
        if ($this->model_itemrequest->update($data, array("id" => $itemrequestid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($itemrequestid) {
        $this->load->model('model_unit');
        $this->load->model('model_groups');
        $data['unit'] = $this->model_unit->selectAll();
        $data['group'] = $this->model_groups->selectAll();
        $data['itemrequest'] = $this->model_itemrequest->selectById($itemrequestid);
        $this->load->view('itemrequest/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $groupid = $this->input->post('groupid');
        $description = $this->input->post('description');
        $unitid = $this->input->post('unitid');
        $data = array(
            "groupid" => $groupid,
            "description" => $description,
            "unitid" => $unitid,
            "requestby" => $this->session->userdata('id')
        );
        $data = array(
            "groupid" => $groupid,
            "description" => $description,
            "unitid" => $unitid,
            "requestby" => $this->session->userdata('id')
        );
        if ($this->model_itemrequest->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        if ($this->model_itemrequest->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
