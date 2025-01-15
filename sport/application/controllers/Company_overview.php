<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_overview extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        $data['overview'] = $this->db->query("SELECT * FROM company_overview")->row_array();
        $data['policies'] = $this->db->query("SELECT * FROM policy")->result_array();
        $data['documents'] = $this->db->query("SELECT * FROM policy_document")->result_array();
        loadViewComponents('company_overview/company_overview', $data);
    }

    public function save_overview() {
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $trade = $this->input->post('trade');
        $expiry = $this->input->post('expiry');
        $image_name = $this->input->post('image_name');
        $off_address = $this->input->post('off_address');
        $data = array(
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'license' => $trade,
            'expiry' => $expiry,
            'off_add' => $off_address,
        );
        $this->db->update("company_overview", $data, array('id' => 1));
        $this->db->truncate('policy');
        if (!empty($this->input->post('Policies'))) {
            foreach ($this->input->post('Policies') as $key => $policy) {
                $data = array(
                    'policy_name' => $policy,
                    'policy_number' => $this->input->post('policy_nums')[$key],
                    'expiry_date' => $this->input->post('policy_dates')[$key],
                );
                $this->db->insert("policy", $data);
            }
        }
        if ($this->input->post('upload_multiples')) {
            $images = $this->input->post('upload_multiples');
            $filePath = './assets/uploads/';
            foreach ($images as $key => $image) {
                $Base64MIMI = explode(",", $image)[0];
                $Base64Encoded = explode(",", $image)[1];
                $ext = '';
                if ($Base64MIMI == "data:image/png;base64") {
                    $ext = '.png';
                } else if ($Base64MIMI == "data:image/jpeg;base64") {
                    $ext = '.jpg';
                }
                $filename = uniqid() . $ext;
                $file = $filePath . $filename;
                $base64Decode = base64_decode($Base64Encoded);
                @file_put_contents($file, $base64Decode);
                $gallery = array(
                    'documents' => $filename,
                    'image_name' => $image_name[$key],
                );
                $this->db->insert('policy_document', $gallery);
            }
        }
        $this->session->set_flashdata("popup", "Saved successfully");
        redirect_to('/admin/company-overview');
    }

    public function delete() {
        $id = $this->input->get('id');
        $this->admin_manager->Delete('policy_document', 'id', $id);
        $this->session->set_flashdata("popup", "Deleted successfully");
        redirect_to('/admin/company-overview');
    }

}
