<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
         $this->load->library(array('pagination'));
        $this->load->model(array('admin_manager'));
        $this->load->helper(array('custom', 'url'));
        $this->userinfo = $this->session->userdata("userInfo");
        unset($this->userinfo['password']);
        $this->current_user = $this->session->userdata("loginID");
    }

    public function index() {
        $this->load->view('login_view');
        $loggined = $this->session->userdata("loginID");
        if (!empty($loggined)) {
            redirect(site_url('/admin/dashboard'));
        }
    }

    public function checklogin() {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $remember = $this->input->post('remember');
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $users = $this->admin_manager->SelectByID('users', 'email', $email, 'ROW_A', '*');
        if (password_verify($password, $users['password'])) {
            if (!empty($remember)) {
                set_cookie("userlogin", $email, time() + (10 * 365 * 24 * 60 * 60));
                set_cookie("userpass", $password, time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE['userlogin'])) {
                    set_cookie("userlogin", "");
                }
                if (isset($_COOKIE['userpass'])) {
                    set_cookie("userpass", "");
                }
            }
            $this->session->set_userdata("loginID", $users['id']);
            $this->session->set_userdata("userInfo", $users);
            redirect(site_url('/admin/dashboard'));
        } else {
            $this->session->set_flashdata("message", "Sorry! You have entered a wrong username or password");
            redirect(site_url('/'));
        }
    }

    public function logout() {
        $loggined = $this->session->userdata("loginID");
        $userInfo = $this->session->userdata("userInfo");
        unset($loggined);
        unset($userInfo);
        session_destroy();
        redirect(site_url('/'));
    }

    public function forgot_password() {
        $this->load->view('forgot_password');
    }

    public function recover_password() {
        $email = $this->input->post("email");
        $checkData = $this->db->query("SELECT * FROM users WHERE email='$email'")->row_array();
        if (!empty($checkData)) {
            $message = '<strong>Hi Jack</strong><br/>'
                    . '<p>You recently requested to reset your password for your account. Click the button below to reset it.</p>'
                    . '<p><a href="' . site_url('password_recovery') . '">Reset your password</a></p>';
            send_notification('info@msa.com', $email, 'Account Password Recovery - My Sports Academy HUB', $message, false);
            $this->session->set_flashdata("messages", "Please check reset password email has been sent");
            redirect(site_url('/forgot-password'));
        } else {
            $this->session->set_flashdata("message", "Email address not exist");
            redirect(site_url('/forgot-password'));
        }
    }

}
