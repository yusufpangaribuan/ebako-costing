<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cost_center
 *
 * @author operational
 */
class costcenter extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_costcenter');
    }

    function index() {
        $this->load->model('model_user');
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costcenter"));
        $data['costcenter'] = $this;
        $this->load->view('costcenter/index', $data);
    }

    function search($offset) {
        $this->load->model('model_user');
        $data['offset'] = $offset;

        $query = "
            select 
            costcenter.*,
            (SELECT string_agg(code,', ') FROM cost_center WHERE id in (select unnest(member) from cost_center where id=costcenter.id)) member_list
            from cost_center costcenter where true";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (costcenter.code ilike '%$q%' or costcenter.description ilike '%$q%')";
        }

        $data['num_rows'] = $this->db->query($query)->num_rows();
        $limit = $this->config->item('limit');
        $data['offset'] = $offset;
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $query .= "  order by costcenter.id desc limit $limit offset $offset";
//        echo $query;
        $data['costcenter'] = $this->db->query($query)->result();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costcenter"));
        $this->load->view('costcenter/search', $data);
    }

    function add() {
        $this->load->view('costcenter/add');
    }

    function save() {
        $data = array(
            "code" => $this->input->post('code'),
            "description" => $this->input->post('description')
        );
        if ($this->model_costcenter->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $data['costcenter'] = $this->model_costcenter->select_by_id($id);
        $this->load->view('costcenter/edit', $data);
    }

    function update() {
        $data = array(
            "code" => $this->input->post('code'),
            "description" => $this->input->post('description')
        );
        if ($this->model_costcenter->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete($id) {
        if ($this->model_costcenter->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function set_member($id) {
        $data["id"] = $id;
        $data['costcenter'] = $this->model_costcenter->select_not_member($id);
        $this->load->view('costcenter/set_member', $data);
    }

    function do_set_member() {
        $id = $this->input->post("id");
        $costcenter = $this->input->post("member");
        $query = "update cost_center set member=member || $costcenter::bigint where id=$id";
        if ($this->db->query($query)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function load_member($cost_center_id) {
        $costcenter = $this->model_costcenter->select_member_result($cost_center_id);
        echo "<option value='0'>None</option>";
        echo "<option value='-1'>All</option>";
        foreach ($costcenter as $result) {
            echo "<option value='" . $result->id . "'>" . $result->code . " - " . $result->description . "</option>";
        }
    }

}
