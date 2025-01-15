<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        $loggined = $this->session->userdata("loginID");

        if ($loggined == "1") {
            $data['profile'] = $this->db->query("SELECT * FROM admin_profile")->row_array();
            loadViewComponents('admin_profile', $data);
        } else {
            $data['profile'] = $this->db->query("SELECT * FROM staff WHERE staff_id='$loggined'")->row_array();
            loadViewComponents('profile', $data);
        }
    }

    public function save_profile() {
        $loggined = $this->session->userdata("loginID");
        $data['first_name'] = $this->input->post("first_name");
        $data['last_name'] = $this->input->post("last_name");
        $data['w_code'] = $this->input->post("w_code");
        $data['p_code'] = $this->input->post("p_code");
        $data['work_contact'] = $this->input->post("work_contact_number");
        $data['personal_contact'] = $this->input->post("personal_contact_number");
        $config['upload_path'] = './assets/uploads/profile_pics/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 500;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
        if (!empty($_FILES["profile_pic"])) {
            if (!$this->upload->do_upload('profile_pic')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $datas = array('upload_data' => $this->upload->data());
                $data['pro_pic'] = $datas['upload_data']['file_name'];
            }
        }
        $this->db->update("staff", $data, array('staff_id' => $loggined));
        $this->session->set_flashdata("popup", "Profile has been updated successfully");
        redirect_to('/admin/profile/');
    }

    public function save_admin_profile() {
        $data['first_name'] = $this->input->post("first_name");
        $data['last_name'] = $this->input->post("last_name");
        $data['code'] = $this->input->post("code");
        $data['contact'] = $this->input->post("contact_number");
        $data['address'] = $this->input->post("address");
        $config['upload_path'] = './assets/uploads/profile_pics/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 500;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
        if (!empty($_FILES["profile_pic"])) {
            if (!$this->upload->do_upload('profile_pic')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $datas = array('upload_data' => $this->upload->data());
                $data['pic'] = $datas['upload_data']['file_name'];
            }
        }

        $this->db->update("admin_profile", $data, array('id' => '1'));
        $this->session->set_flashdata("popup", "Profile has been updated successfully");
        redirect_to('/admin/profile/');
    }

    public function settings() {
        if ($this->input->method() == "post") {
            $passwordx = $this->input->post("password");
            $password = password_hash($passwordx, PASSWORD_DEFAULT);
            $this->db->update("users", array('password' => $password), array('id' => '1'));
            $this->session->set_flashdata("popup", "Password has been updated successfully");
            redirect_to("/admin/settings");
        } else {
            loadViewComponents('settings');
        }
    }

}
