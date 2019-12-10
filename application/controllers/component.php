<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of component
 *
 * @author hp
 */
class component extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_component');
        $this->load->model('model_user');
    }

    function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "component"));
        $this->load->model('model_groups');
        $offset = 0;
        $limit = $this->config->item('limit');
        $data['num_rows'] = $this->model_component->getNumRows("", "", 0);
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['number'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['type'] = $this->model_groups->selectAllInCondition();
        $data['component'] = $this->model_component->search("", "", 0, $limit, $offset);
        $data['offset'] = $offset;
        $this->load->view("component/view", $data);
    }

    function search($offset) {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "component"));
        $code = $this->input->post('code');
        $description = $this->input->post('description');
        $type = $this->input->post('type');
        $limit = $this->config->item('limit');
        $data['num_rows'] = $this->model_component->getNumRows($code, $description, $type);
        $data['num_page'] = (int) ceil($data['num_rows'] / $limit);
        $data['number'] = $offset + 1;
        $data['first'] = 0;
        $data['prev'] = (($offset - $limit) < 0) ? 0 : ($offset - $limit);
        $data['next'] = (($offset + $limit) > $data['num_rows']) ? $offset : ($offset + $limit);
        $data['last'] = ($data['num_page'] * $limit) > $data['num_rows'] ? (($data['num_page'] - 1) * $limit) : ($data['num_page'] * $limit);
        $data['page'] = (int) ceil($offset / $limit) + 1;
        $data['offset'] = $offset;
        $data['component'] = $this->model_component->search($code, $description, $type, $limit, $offset);
        $this->load->view("component/search", $data);
    }

    function add() {
        $this->load->model('model_unit');
        $this->load->model('model_currency');
        $this->load->model('model_componentcategory');
        $data['curr'] = $this->model_currency->selectAll();
        $data['unit'] = $this->model_unit->selectAll();
        $data['componentcategory'] = $this->model_componentcategory->selectAll();
        $data['componentdesc'] = $this->model_component->selectDescriptionComponent("");
        $this->load->view("component/add", $data);
    }

    function filterdescription() {
        $desc = $this->input->post('desc');
        $descrcd = $this->model_component->selectDescriptionComponent($desc);
        foreach ($descrcd as $result) {
            echo "<option value='" . $result->description . "'>" . $result->description . "</option>";
        }
    }

    function save() {
        $partnumber = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $itemid = $this->input->post('itemid');
        $turn = $this->input->post('turn');
        $lam = $this->input->post('lam');
        $carv = $this->input->post('carv');
        $mall = $this->input->post('mall');
        $ft = (double) $this->input->post('ft');
        $fw = (double) $this->input->post('fw');
        $fl = (double) $this->input->post('fl');
        $rt = (double) $this->input->post('rt');
        $rw = (double) $this->input->post('rw');
        $rl = (double) $this->input->post('rl');
        $ven_itemid = $this->input->post('ven_id');
        $ven_type = $this->input->post('ven_type');
        $ven_s1s = $this->input->post('ven_s1s');
        $ven_dgb = $this->input->post('ven_dgb');
        $ven_s2s = $this->input->post('ven_s2s');
        $mhmd = $this->input->post('mhmd');
        $sq_ven_a = $this->input->post('sq_ven_a');
        $sq_ven_dgb = $this->input->post('sq_ven_dgb');

        $data_component = array(
            'partnumber' => $partnumber,
            'description' => $description,
            'turn' => $turn,
            'lam' => $lam,
            'carv' => $carv,
            'mall' => $mall,
            'ft' => $ft,
            'fw' => $fw,
            'fl' => $fl,
            'rt' => $rt,
            'rw' => $rw,
            'rl' => $rl,
            'itemid' => $itemid,
            'ven_type' => $ven_type,
            'ven_s1s' => $ven_s1s,
            'ven_dgb' => $ven_dgb,
            'ven_s2s' => $ven_s2s,
            'mhmd' => $mhmd,
            'sq_ven_a' => $sq_ven_a,
            'sq_ven_dgb' => $sq_ven_dgb,
            'ven_itemid' => $ven_itemid
        );
        $file_element_name = 'fileupload';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            if ($this->model_component->insert($data_component)) {
                echo json_encode(array('nofile' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
                unlink($data['full_path']);
            }
        } else {
            $data = $this->upload->data();
            $data_component['image'] = $data['file_name'];
            if ($this->model_component->insert($data_component)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
                unlink($data['full_path']);
            }
        }
        @unlink($_FILES[$file_element_name]);
    }

    function edit($id) {
        $data['component'] = $this->model_component->selectById($id);
        $this->load->view('component/edit', $data);
    }

    function update() {
        $id = $this->input->post('id');
        $partnumber = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $itemid = $this->input->post('itemid');
        $turn = $this->input->post('turn');
        $lam = $this->input->post('lam');
        $carv = $this->input->post('carv');
        $mall = $this->input->post('mall');
        $ft = (double) $this->input->post('ft');
        $fw = (double) $this->input->post('fw');
        $fl = (double) $this->input->post('fl');
        $rt = (double) $this->input->post('rt');
        $rw = (double) $this->input->post('rw');
        $rl = (double) $this->input->post('rl');
        $ven_id = $this->input->post('ven_id');
        $ven_type = $this->input->post('ven_type');
        $ven_s1s = $this->input->post('ven_s1s');
        $ven_dgb = $this->input->post('ven_dgb');
        $ven_s2s = $this->input->post('ven_s2s');
        $mhmd = $this->input->post('mhmd');
        $sq_ven_a = $this->input->post('sq_ven_a');
        $sq_ven_dgb = $this->input->post('sq_ven_dgb');
        $filename = $this->input->post('filename');

        $data_component = array(
            'partnumber' => $partnumber,
            'description' => $description,
            'turn' => $turn,
            'lam' => $lam,
            'carv' => $carv,
            'mall' => $mall,
            'ft' => $ft,
            'fw' => $fw,
            'fl' => $fl,
            'rt' => $rt,
            'rw' => $rw,
            'rl' => $rl,
            'itemid' => $itemid,
            'ven_type' => $ven_type,
            'ven_s1s' => $ven_s1s,
            'ven_dgb' => $ven_dgb,
            'ven_s2s' => $ven_s2s,
            'mhmd' => $mhmd,
            'sq_ven_a' => $sq_ven_a,
            'sq_ven_dgb' => $sq_ven_dgb,
            'ven_itemid' => $ven_id
        );
        
        $file_element_name = 'fileupload';
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name)) {
            if ($this->model_component->update($data_component, array("id" => $id))) {
                echo json_encode(array('nofile' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $data = $this->upload->data();
            $data_component['image'] = $data['file_name'];
            if ($this->model_component->update($data_component, array("id" => $id))) {
                echo json_encode(array('success' => true));
                $filetodelete = "./files/" . $filename;
                if (file_exists($filetodelete)) {
                    @unlink($filetodelete);
                }
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
                unlink($data['full_path']);
            }
        }
        @unlink($_FILES[$file_element_name]);
    }

    function delete($id) {
        $this->model_component->delete($id);
    }

    function addmaterial($componentid) {
        $this->load->model('model_unit');
        $this->load->model('model_item');
        $data['unit'] = $this->model_unit->selectAll();
        $data['item'] = $this->model_item->selectAll();
        $data['componentid'] = $componentid;
        $this->load->view("component/addmaterial", $data);
    }

    function itemlist($el) {
        $data['elid'] = $el;
        $this->load->view('component/itemlist', $data);
    }

    function findlist() {
        $partnumber = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $names = $this->input->post('description');
        $receiver = $this->input->post('receiver');
        $this->load->model('model_item');
        $item = $this->model_item->searchList($partnumber, $description, $names);
        foreach ($item as $result) {
            $allunit = $this->model_item->getAllUnit($result->id);
            ?>
            <tr>
                <td>
                    <input type="hidden" id="unitid_r<?php echo $result->id ?>" value="<?php echo $allunit ?>" />
                    <input type="hidden" id="id_r<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                    <input type="hidden" id="partnumber_r<?php echo $result->id ?>" value="<?php echo $result->partnumber ?>"/>
                    <input type="hidden" id="names_r<?php echo $result->id ?>" value="<?php echo $result->names ?>"/>
                    <input type="hidden" id="descriptions_r<?php echo $result->id ?>" value="<?php echo strip_tags($result->descriptions) ?>"/>
                    <?php echo $result->partnumber ?>
                </td>
                <td><?php echo nl2br($result->descriptions) ?></td>                
                <td align="center"><img src="images/check.png"  class="miniaction" onclick="component_set(<?php echo $result->id . ",'" . $receiver . "'" ?>)"/></td>
            </tr>
            <?php
        }
    }

    function findcomponentlist() {
        $id = $this->input->post('id');
        $receiver = $this->input->post('el');
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $this->load->model('model_item');
        $this->load->model('model_unit');
        $component = $this->model_component->searchComponent($id, $code, $name);
        foreach ($component as $result) {
            $allunit = $this->model_item->getAllUnit($result->id);
            ?>
            <tr>
                <td>
                    <input type="hidden" id="unitid_r<?php echo $result->id ?>" value="<?php echo $allunit ?>" />
                    <input type="hidden" id="id_r<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                    <input type="hidden" id="partnumber_r<?php echo $result->id ?>" value="<?php echo $result->partnumber ?>"/>                    
                    <input type="hidden" id="descriptions_r<?php echo $result->id ?>" value="<?php echo strip_tags($result->description) ?>"/>
                    <?php echo $result->partnumber ?>
                </td>
                <td><?php echo $result->description ?></td>
                <td align="center"><?php echo $this->model_unit->getCodeById($result->unitid); ?></td>
                <td>&nbsp;</td>
                <td align="center"><img src="images/check.png"  class="miniaction" onclick="component_setcomponent(<?php echo $result->id . ",'" . $receiver . "'" ?>)"/></td>
            </tr>
            <?php
        }
    }

    function insertitem() {
        $componentid = $this->input->post('componentid');
        $itemid = $this->input->post('itemid');
        $unitid = $this->input->post('unitid');
        $qty = $this->input->post('qty');
        $this->model_component->insertitem($componentid, $itemid, $unitid, $qty);
    }

    function componentlist($element, $id) {
        $data['elid'] = $element;
        $data['id'] = $id;
        $this->load->view('component/componentlist', $data);
    }

    function detail($componentid) {
        $this->load->model('model_unit');
        $data['material'] = $this->model_component->selectMaterial($componentid);
        $this->load->view('component/detail', $data);
    }

    function deleteitem($id) {
        $this->model_component->deleteItem($id);
    }

    function searchfordialog() {
        $code = $this->input->post('code');
        $description = $this->input->post('description');
        $component = $this->model_component->searchfordialog($code, $description);
        foreach ($component as $component) {
            ?>
            <tr>                    
                <td>
                    <?php echo $component->partnumber ?>
                    <input type="hidden" name="idcomponent<?php echo $component->id ?>" id="idcomponent<?php echo $component->id ?>" value="<?php echo $component->id ?>"/>
                </td>
                <td>
                    <?php echo $component->description ?>
                    <input type="hidden" value="<?php echo strip_tags($component->description) ?>" id="descriptioncomponent<?php echo $component->id ?>" />
                </td>
                <td><?php echo $component->woodname; ?></td>
                <td align="center"><?php echo $component->ven_type; ?></td>
                <td align="center"><?php echo $component->ven_s1s; ?></td>
                <td align="center"><?php echo $component->ven_dgb; ?></td>
                <td align="center"><?php echo $component->ven_s2s; ?></td>
                <td align="center"><?php echo $component->ft; ?></td>
                <td align="center"><?php echo $component->fw; ?></td>
                <td align="center"><?php echo $component->fl; ?></td>
                <td align="center"><?php echo $component->rt; ?></td>
                <td align="center"><?php echo $component->rw; ?></td>
                <td align="center"><?php echo $component->rl; ?></td>
                <td align="center"><?php echo $component->turn; ?></td>
                <td align="center"><?php echo $component->lam; ?></td>
                <td align="center"><?php echo $component->carv; ?></td>
                <td align="center"><?php echo $component->mall; ?></td>                
                <td align="center"><img src="images/check.png" class="miniaction" onclick="model_bomsetitem('component',<?php echo $component->id ?>)" /></td>
            </tr>
            <?php
        }
    }

}
?>
