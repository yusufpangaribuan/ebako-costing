<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attachment
 *
 * @author hp
 */
class attachment extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            echo "<script>location.reload()</script>";
        }
        $this->load->model('model_attachment');
        $this->load->model('model_user');
    }

    function view($id, $reference) {
        $data['files'] = $this->model_attachment->selectByReference($id, $reference);
        $data['id'] = $id;
        $data['reference'] = $reference;
        $this->load->view('attachment/view', $data);
    }

    function getlist($id, $reference) {
        $data['files'] = $this->model_attachment->selectByReference($id, $reference);
        $data['id'] = $id;
        $data['reference'] = $reference;
        $this->load->view('attachment/listfiles', $data);
    }

    function save() {
        $status = "";
        $msg = "";
        $file_element_name = 'fileupload';
        $title = $this->input->post('title');
        $id = $this->input->post('id');
        $reference = $this->input->post('reference');
        if (empty($title)) {
            $status = "error";
            $msg = "Please enter a title";
        }

        if ($status != "error") {
            $config['upload_path'] = './files/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                if ($this->model_attachment->insert_file($id, $reference, $data['file_name'], $this->input->post('title'))) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function getfiles() {
        $files = $this->model_attachment->getfiles();
        $this->load->view('attachment/listfiles', array('files' => $files));
    }

    public function delete() {
        $id = $this->input->post('id');
        $filename = $this->input->post('filename');
        $this->load->helper("file");
        delete_files("files/" . $filename);
        $this->model_attachment->delete($id);
    }

}

?>
