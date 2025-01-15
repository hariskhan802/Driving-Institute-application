<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $userinfo;
    public $current_user;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('pagination'));
        $this->load->model(array('admin_manager'));
        $this->load->helper(array('custom', 'url'));
        $this->userinfo = $this->session->userdata("userInfo");
        unset($this->userinfo['password']);
        $this->current_user = $this->session->userdata("loginID");
        //$this->islogged();
    }

   public function islogged()
    {
      $admin_id = $this->session->userdata('userInfo');
      if (empty($admin_id)) {
        redirect(site_url('/login'));
      }
    }

}
