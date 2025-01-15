<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Parents extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
    private function returnIDbyToken($access_token){
        $id = $this->admin_manager->SelectByID('parents', 'access_token', $access_token, 'ROW_A', 'id');
        if(empty($id)) return false;
        return $id; 
    }
    public function register(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post     = $post->params;
        if(empty($post->email)) responder(205, null);
        if(empty($post->password)) responder(206, null);
        $count = $this->db->query("SELECT `email` FROM `parents` WHERE `email` = '{$post->email}' AND `email_verified` = 1")->result();
        if(!empty($count)) responder(502, null);
        $hash = encrypt_decrypt('encrypt', $post->email.date('sYdms'));
        $parent = array(
            'first_name'              => @$post->first_name,
            'last_name'               => @$post->last_name,
            'code'                    => @$post->code,
            'contact_number'          => @$post->contact_number,
            'parent_type'             => @$post->parent_type,
            'address'                 => @$post->address,
            'email'                   => $post->email,
            'email_verification_hash' => $hash,
            'email_verified'          => null,
            'password'                => password_hash($post->password, PASSWORD_DEFAULT)
        );
        $url    = site_url('/parents/email/verification/'.$hash);
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Email Verification Request</title>
        <link href="'.ASSETS.'css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        </head>
        <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
        <div class="page-wrapper">
        <img src="'.ASSETS.'images/logo-icon.png"/><img src="'.ASSETS.'images/logo.png"/>
        <h3>Email Verification Request</h3>
        <p>Please click on the following link to verify your account</p>
        <a href="'.$url.'" target="_blank">'.$url.'</a>
        </div>
        </body>
        </html>';
        if(!send_notification('taimoorimran9@gmail.com', $post->email, 'Email Verification Request', $message, true)) responder(509, 'error');
        $insert = $this->admin_manager->Insert('parents', $parent);
        if($insert) responder(200, 'Parent Registered Successfully!');
        responder(503, 'error');
    }
    public function account_verify(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post = $post->params;
        if(empty($post->encrypted_key)) responder(508, null);
        $parent = $this->admin_manager->SelectByID('parents', 'email_verification_hash', $post->encrypted_key, 'ROW');
        if(empty($parent)) responder(500, "Invalid Email Verification Link!");
        if(!empty($parent->email_verified)) responder(500, "Email Verification Link is expired!");
        $data = array('email_verification_hash' => null, 'email_verified' => 1,'update_by' => $parent->id);
        $update = $this->admin_manager->update('parents', $data, array('id' => $parent->id));
        if($update) responder(200, 'Email Verified!');
        responder(503, 'error');
    }
    public function checklogin() {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post = $post->params;
        if(empty($post->email)) responder(205, null);
        if(empty($post->password)) responder(206, null);
        // $parents  = $this->admin_manager->SelectByID('parents','email', $post->email,'ROW_A', '*');
        $parents = $this->db->query("SELECT * FROM `parents` WHERE `email` = '{$post->email}' AND `email_verified` = 1")->row_array();
        if (password_verify($post->password, $parents['password'])) {
            $access_token  = encrypt_decrypt('encrypt', $parents['id'].date('mmsyshh'));
            $enc_timestamp = encrypt_decrypt('encrypt', date('ymdhms'));
            $insert        = $this->admin_manager->Update('parents', array('is_login' => 1, 'access_token' => $access_token), array('id' => $parents['id']));
            password_hash($post->password, PASSWORD_DEFAULT);
            $this->session->set_userdata("loginID_",$parents);
            $this->session->set_userdata("userInfo_",$parents);
            $refined = array(
                'id'             => encrypt_decrypt('encrypt', $parents['id']),
                'first_name'     => $parents['first_name'],
                'last_name'      => $parents['last_name'],
                'email'          => $parents['email'],
                'parent_type'    => $parents['parent_type'],
                'code'           => $parents['code'],
                'contact_number' => $parents['contact_number'],
                'address'        => $parents['address'],
                'profile_pic'    => null
            );
            if(!empty($parents['photo_path'])) $refined['profile_pic'] = ASSETS.'uploads/profile_pictures/'.$parents['photo_path'];
            responder(200, 'success', array('timestamp' => $enc_timestamp, 'access_token' => $access_token, 'user' => $refined));
        }
        else responder(207, null);
    }
    public function get_parent_details($encrypted_key){
        $decrypted_key = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $parent = $this->admin_manager->SelectByID('parents', 'id', $decrypted_key, 'ROW_A', 'first_name, last_name, email, parent_type, code, contact_number, address, `photo_path` as profile_pic', 'access_token');
        if(empty($parent)) responder(507, null);
        $parent['id'] = $encrypted_key;
        if(!empty($parent['profile_pic'])) $parent['profile_pic'] = ASSETS.'uploads/profile_pictures/'.$parent['profile_pic'];
        responder(200, 'success', $parent);
    }
    public function logout(){
        $decrypted_key = null;
        $post = json_decode(file_get_contents("php://input"));
        if(!empty($post->params)) $decrypted_key = encrypt_decrypt('decrypt', $post->params->id);
        if(empty($decrypted_key)) responder(200, null);
        $this->admin_manager->Update('parents', array('is_login' => 0, 'access_token' => null), array('id' => $decrypted_key));
        $loggined  = $this->session->userdata("loginID_");
        $userinfod = $this->session->userdata("userInfo_");
        unset($loggined);
        unset($userinfod);
        session_destroy();
        responder(200, null);
    }
    public function password_reset(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post      = $post->params;
        $parent_id = encrypt_decrypt('decrypt', $post->encrypted_key);
        if(empty($parent_id)) responder(508, null);
        if(empty($post->password)) responder(206, null);
        $parent = array('password' => password_hash($post->password, PASSWORD_DEFAULT), 'update_by' => $parent_id);
        $update = $this->admin_manager->update('parents', $parent, array('id' => $parent_id));
        if($update) responder(200, 'Password Reset Successfully!');
        responder(503, 'error');
    }
    public function edit_profile(){
        $post      = $_POST['params'];
        $post      = json_decode($post, true);
        $filename  = null;
        if(empty($post)) responder(604, null);
        $parent_id = encrypt_decrypt('decrypt', $post['parent_id']);
        if(empty($parent_id)) responder(508, null);
        if(!empty($_FILES)){
            $config['upload_path']   = FCPATH . './assets/uploads/profile_pictures/';
            $config['max_size']      = 2000;
            $config['allowed_types'] = 'jpeg|jpg|png|pps|ppt|pptx|ods|xlr|xls|xlsx|doc|docx|pdf|txt';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')){
                echo json_encode(array('status' => 700,  'message' => $this->upload->display_errors()));
                die();
            } else {
                $upload_data = $this->upload->data();
                $filename    = $upload_data['file_name'];
            }
        }
        $parent = array(
            'first_name'     => @$post['first_name'],
            'last_name'      => @$post['last_name'],
            'code'           => @$post['code'],
            'contact_number' => @$post['contact_number'],
            'parent_type'    => @$post['parent_type'],
            'address'        => @$post['address'],
            'update_by'      => $parent_id,
        );
        if(!empty($filename)) $parent['photo_path'] = $filename;
        else if(empty($post['profile_pic'])) $parent['photo_path'] = null;
        $response = $this->admin_manager->Update('parents', $parent, array('id' => $parent_id));
        if($response){
            $p = $this->admin_manager->SelectByID('parents', 'id', $parent_id, 'ROW_A', 'first_name, last_name, email, parent_type, code, contact_number, address, photo_path as profile_pic, access_token');
            $p['id'] = $post['parent_id'];
            if(!empty($p['profile_pic'])) $p['profile_pic'] = ASSETS.'uploads/profile_pictures/'.$p['profile_pic'];
            responder(200, "Profile Updated Successfully", $p);
        }
        responder(503, 'error');
    }
    public function get_venues(){
        responder(200, 'success', $this->admin_manager->SelectAll("venues","OBJECT", "id, venue_name, short_code"));
    }
    public function get_children_by_parent_id($encrypted_key){
        $decrypted_key = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $students = $this->admin_manager->SelectByID('students', 'parent_id', $decrypted_key, 'ARRAY', 'id, firstname, lastname, photo_path as profile_pic');
        if(empty($students)) responder(200, 'success', array());
        foreach ($students as $key => &$value) {
            $value['id'] = encrypt_decrypt('encrypt', $value['id']);
            if(!empty($value['profile_pic'])) $value['profile_pic'] = ASSETS.'uploads/profile_pictures/'.$value['profile_pic'];
        }
        responder(200, 'success', $students);
    }
    public function get_child_details($encrypted_key){
        $decrypted_key = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $student = $this->admin_manager->SelectByID('students', 'id', $decrypted_key, 'ROW_A', 'firstname, lastname, date_of_birth, venue_id, other_venue, contact_number, gender, medical_condition_active, medical_condition_note, term_conditions_active, photo_path as profile_pic, photography_allowed');
        if(empty($student)) responder(507, null);
        $student['encrypted_key'] = $encrypted_key;
        if(!empty($student['profile_pic'])) $student['profile_pic'] = ASSETS.'uploads/profile_pictures/'.$student['profile_pic'];
        responder(200, 'success', $student);
    }
    public function add_or_edit_child(){
        $post      = $_POST['params'];
        $post      = json_decode($post, true);
        $filename  = null;
        if(empty($post)) responder(604, null);
        $parent_id = encrypt_decrypt('decrypt', $post['parent_id']);
        if(empty($parent_id)) responder(508, null);
        if(!empty($_FILES)){
            $config['upload_path']   = FCPATH . './assets/uploads/profile_pictures/';
            $config['max_size']      = 2000;
            $config['allowed_types'] = 'jpeg|jpg|png|pps|ppt|pptx|ods|xlr|xls|xlsx|doc|docx|pdf|txt';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')){
                echo json_encode(array('status' => 700,  'message' => $this->upload->display_errors()));
                die();
            } else {
                $upload_data = $this->upload->data();
                $filename    = $upload_data['file_name'];
            }
        }
        $student = array(
            'parent_id'                => $parent_id,
            'firstname'                => @$post['firstname'],
            'lastname'                 => @$post['lastname'],
            'date_of_birth'            => @$post['date_of_birth'],
            'venue_id'                 => @$post['venue_id'],
            'other_venue'              => @$post['other_venue'],
            'contact_number'           => @$post['contact_number'],
            'gender'                   => @$post['gender'],
            'medical_condition_active' => @$post['medical_condition_active'],
            'medical_condition_note'   => @$post['medical_condition_note'],
            'term_conditions_active'   => @$post['term_conditions_active'],
            'photography_allowed'      => @$post['photography_allowed'],
        );
        $message  = null;
        $response = false;
        if(empty(@$post['profile_pic']) && !empty($filename)) $student['photo_path'] = $filename;
        else if(empty($post['profile_pic'])) $student['photo_path'] = null;
        if(!empty(@$post['encrypted_key'])){
            $student['update_by'] = $parent_id;
            $response             = $this->admin_manager->Update('students', $student, array('id' => encrypt_decrypt('decrypt', $post['encrypted_key'])));
            $message              = "Child Updated Successfully!";
        }else{
            $student['insert_by'] = $parent_id;
            $response             = $this->admin_manager->Insert('students', $student);
            $message              = "Child Added Successfully!";
        }
        if($response) responder(200, $message);
        responder(503, 'error');
    }

    public function delete_child(){
        $post = json_decode(file_get_contents("php://input"));
        if(empty($post)) responder(604, null);
        $post = (array)$post->params;
        if(empty($post['encrypted_key'])) responder(508, null);
        $decrypted_key = encrypt_decrypt('decrypt', $post['encrypted_key']);
        $student = $this->admin_manager->SelectByID('students', 'id', $decrypted_key, 'ROW_A', 'photo_path');
        if(empty($student)) responder(507, null);
        $response = $this->admin_manager->Delete('students', 'id', $decrypted_key);
        if(!empty($student['photo_path'])) unlink('./assets/uploads/profile_pictures/'.$student['photo_path']);
        if($response) responder(200, null);
        responder(503, 'error');
    }
    public function get_coaches(){
        // $coaches = $this->db->query("SELECT u.`id`, s.`first_name`, s.`middle`, s.`last_name`, s.`designation`, s.`pro_pic` FROM `users` u INNER JOIN staff s ON s.`staff_id` = u.`id`  WHERE u.`role` = 2 AND u.`status` = 1;")->result_array();
        $coaches = $this->db->query("SELECT u.`id`, s.`first_name`, s.`middle`, s.`last_name`, s.`designation`, s.`pro_pic`, u.`status` FROM staff s INNER JOIN `users` u ON s.`staff_id` = u.`id` WHERE u.`role` = '2' AND u.`status` = 0;")->result_array();
        if(empty($coaches)) responder(200, 'success', array());
        foreach ($coaches as $key => &$value) {
            $value['id'] = encrypt_decrypt('encrypt', $value['id']);
            if(!empty($value['pro_pic'])) $value['pro_pic'] = ASSETS.'uploads/'.$value['pro_pic'];
        }
        responder(200, 'success', $coaches);
    }
    public function get_coach_details($encrypted_key){
        $decrypted_key = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $coach = $this->db->query("SELECT u.`id`, s.`first_name`, s.`middle`, s.`last_name`, s.`designation`, s.`pro_pic`, s.`gender`, s.`work_contact`, s.`email`, s.`qual_skill` FROM `users` u INNER JOIN staff s ON s.`staff_id` = u.`id` WHERE u.`role` = 2 AND u.`status` = 0 AND u.`id` = {$decrypted_key};")->row_array();
        if(empty($coach)) responder(507, null);
        $coach['id'] = encrypt_decrypt('encrypt', $coach['id']);
        if(!empty($coach['pro_pic'])) $coach['pro_pic'] = ASSETS.'uploads/'.$coach['pro_pic'];
        responder(200, 'success', $coach);
    }
    public function get_clubs(){
        responder(200, 'success', $this->db->query('SELECT id, club_name, is_assesment, concat("'.ASSETS.'uploads/clubs/", image_path) as image_path, concat("'.ASSETS.'uploads/clubs/", helper_text_image) as helper_text_image FROM `clubs` ORDER BY `sort_order`')->result());
    }
    public function get_news(){
        $news = $this->db->query("SELECT `description` FROM news ORDER BY `id` DESC LIMIT 5;")->result();
        if(empty($news)) responder(507, null);
        responder(200, 'success', $news);
    }
    public function get_terms_and_conditions(){
        $terms_and_conditions = $this->db->query("SELECT `description` FROM terms_and_conditions ORDER BY `id` ASC;")->result();
        if(empty($terms_and_conditions)) responder(507, null);
        responder(200, 'success', $terms_and_conditions);
    }
    public function get_pricelist(){
        responder(200, 'success', ASSETS.'uploads/pricelist.pdf');
    }
    public function get_msa_overview(){
        responder(200, 'success', ASSETS.'uploads/msa_overview.pdf');
    }
    public function get_terms(){
        $terms = $this->db->query("SELECT id, term_name, start_month, end_month, num_of_weeks FROM terms ORDER BY `id`;")->result();
        if(empty($terms)) responder(507, null);
        responder(200, 'success', $terms);
    }
    public function get_levels($club_id){
        $levels = $this->db->query("SELECT l.`id` as `level_id`, p.`id` as `program_id`, `level_name`, `color` FROM `levels` l INNER JOIN `programs` p ON p.`id` = l.`program_id` AND p.`club_id` = {$club_id} ORDER BY level_name;")->result();
        if(empty($levels)) responder(507, null);
        responder(200, 'success', $levels);
    }
    public function get_camps(){
        $camps = $this->db->query("SELECT `id` AS `camp_id`, `program_name` AS `camp_name` FROM `programs` WHERE `club_id` = 4 AND `status` = 1 ORDER BY `program_name`;")->result();
        if(empty($camps)) responder(507, null);
        responder(200, 'success', $camps);
    }
    public function get_tri_club_packages(){
        $programs = $this->db->query("SELECT p.`id` AS `program_id`, p.`program_name`, ps.`id` AS `session_id`, ps.`num_of_sessions`, ps.`cost_per_session`, p.`annual_reg_fee`, p.`competition_fee`, p.`session_card_cost` FROM `programs` p INNER JOIN `prog_child_sessions` ps ON ps.`program_id` = p.`id` WHERE p.`club_id` = 5;")->result_array();
        if(empty($programs)) responder(507, null);
        $refined = array();
        foreach($programs as $key => $prog){
            $refined[$prog['program_id']]['program_id']        = $prog['program_id'];
            $refined[$prog['program_id']]['program_name']      = $prog['program_name'];
            $refined[$prog['program_id']]['annual_reg_fee']    = $prog['annual_reg_fee'];
            $refined[$prog['program_id']]['competition_fee']   = $prog['competition_fee'];
            $refined[$prog['program_id']]['session_card_cost'] = $prog['session_card_cost'];
            $refined[$prog['program_id']]['packages'][]        = array(
                'session_id'       => $prog['session_id'],
                'num_of_sessions'  => $prog['num_of_sessions'],
                'cost_per_session' => $prog['cost_per_session'],
            );
        }
        // _d($refined);
        responder(200, 'success', $refined);
    }
    public function get_venues_for_enrollment($club_id, $program_id, $level_id){
        $query = "SELECT v.`id` AS `venue_id`, v.`venue_name`, s.`id` as `session_id`, p.`competition_fee`, p.`annual_reg_fee`, p.`full_week_cost`, p.`session_card_cost`, p.`daily_cost`, p.`exclusion_per_day_cost`, p.`cost_per_session`, t.`id` AS `term_id`, t.`term_name` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `programs` p ON p.`id` = s.`program_id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE s.`club_id` = {$club_id}";
        $query .= " AND s.`program_id` = {$program_id}";
        if($club_id != 5 && $club_id != 4) $query .= " AND s.`level_id` = {$level_id}";
        $query .= " GROUP BY v.`id`;";
        $venues = $this->db->query($query)->result();
        if(empty($venues)) responder(507, null);
        responder(200, 'success', $venues);
    }
    public function get_venues_for_tri_club(){
        $query = "SELECT v.`id` AS `venue_id`, v.`venue_name`, v.`google_map_url`, v.`c_code`, v.`contact_number`, v.`additional_description`, v.`photo_path`, s.`id` as `session_id`, p.`competition_fee`, p.`annual_reg_fee`, p.`full_week_cost`, p.`session_card_cost`, p.`daily_cost`, p.`exclusion_per_day_cost`, p.`cost_per_session`, t.`id` AS `term_id`, t.`term_name`, p.`id` as `program_id`, p.`program_name`, s.`level_id`, l.`level_name`, l.`color` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `programs` p ON p.`id` = s.`program_id` INNER JOIN `terms` t ON t.`id` = s.`term_id` RIGHT JOIN `levels` l ON l.`id` = s.`level_id` WHERE s.`club_id` = 5;";
        $venues = $this->db->query($query)->result_array();
        if(empty($venues)) responder(507, null);
        $session_ids = array_column($venues, 'session_id');
        $session_ids = implode(', ', $session_ids);
        $sessions = $this->db->query("SELECT s.`venue_id`, s.`id` AS `session_id`, s.`level_id`, sm.* FROM `sessions` s INNER JOIN `sessions_meta` sm ON sm.`session_id` = s.`id` WHERE s.`id` IN ({$session_ids});")->result_array();
        $refined_sessions = array();
        $refined_levels = array();
        $refined_venues = array();
        $days           = $this->db->query("SELECT * FROM days")->result_array();
        foreach($venues as $v){
            $refined_levels[$v['level_id']] = array(
                'level_id'    => $v['level_id'],
                'level_name'  => $v['level_name'],
                'level_color' => $v['color'],
            );
        }
        foreach($venues as $v){
            $refined_venues[$v['venue_id']] = array(
                'venue_id'               => $v['venue_id'],
                'venue_name'             => $v['venue_name'],
                'google_map_url'         => $v['google_map_url'],
                'c_code'                 => $v['c_code'],
                'contact_number'         => $v['contact_number'],
                'additional_description' => $v['additional_description'],
                'photo_path'             => null,
                'competition_fee'        => $v['competition_fee'],
                'annual_reg_fee'         => $v['annual_reg_fee'],
                'full_week_cost'         => $v['full_week_cost'],
                'session_card_cost'      => $v['session_card_cost'],
                'daily_cost'             => $v['daily_cost'],
                'exclusion_per_day_cost' => $v['exclusion_per_day_cost'],
                'cost_per_session'       => $v['cost_per_session'],
                'term_id'                => $v['term_id'],
                'term_name'              => $v['term_name'],
                'program_id'             => $v['program_id'],
                'program_name'           => $v['program_name']
            );
            if(!empty($v['photo_path'])) $refined_venues[$v['venue_id']]['photo_path'] = ASSETS.'uploads/'.$v['photo_path'];
            foreach($days as $k => $day){
                $temp          = array();
                $temp_venue_id = null;
                $temp['day_id']   = $day['id'];
                $temp['day_name'] = $day['day_name'];
                $temp['metas']    = array();
                foreach($sessions as $session){
                    if($session['day_id'] == $day['id'] && $session['venue_id'] == $v['venue_id']){
                        $temp['metas'][]  = array(
                            'meta_id'     => $session['meta_id'],
                            'start_time'  => $session['start_time'],
                            'end_time'    => $session['end_time'],
                            'level_id'    => $session['level_id'],
                            'level_color' => @$refined_levels[$session['level_id']]['level_color'],
                            'venue_id'    => $session['venue_id'],
                            'venue_name'  => $v['venue_name'],
                        );
                    }
                }
                $refined_venues[$v['venue_id']]['sessions'][] = $temp;
            }
        }
        // _d($refined_venues);
        // exit;
        responder(200, 'success', array('venues' => $refined_venues, 'levels' => $refined_levels));
    }
    public function get_venues_for_assessment($club_id, $session_type = 0){
        $query = "SELECT v.`id` as `venue_id`, v.`venue_name`, v.`short_code` FROM `assessment` a INNER JOIN `venues` v ON v.`id` = a.`venue_id` WHERE a.`ass_type` = 1 AND a.`status` = 1 AND `club_id` = {$club_id}";
        if($club_id == 5 && $session_type != 0) $query .= " AND `session_type` = {$session_type}";
        $query .= " GROUP BY v.`id`;";
        $venues = $this->db->query($query)->result();
        if(empty($venues)) responder(507, null);
        responder(200, 'success', $venues);
    }
    function returnDays($start_date, $end_date){
        return array_column(($this->db->query("SELECT * FROM 
            (SELECT ADDDATE('1970-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) selected_date FROM
            (SELECT 0 t0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
            (SELECT 0 t1 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
            (SELECT 0 t2 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
            (SELECT 0 t3 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
            (SELECT 0 t4 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
            WHERE selected_date BETWEEN DATE_FORMAT(STR_TO_DATE('".$start_date."', '%d-%m-%Y'), '%Y-%m-%d') AND DATE_FORMAT(STR_TO_DATE('".$end_date."', '%d-%m-%Y'), '%Y-%m-%d')")->result_array()), 'selected_date');
    }
    public function get_venues_details($club_id, $program_id, $venue_id, $session_id = 0){
        $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} GROUP BY v.`id`;";
        if($club_id == 4){
            $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} AND s.`club_id` = {$club_id} GROUP BY v.`id`;";
        }
        else if($club_id == 5){
            $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} && s.`id` = {$session_id} GROUP BY v.`id`;";
        }
        $venue = $this->db->query($venue_query)->row();
        if(empty($venue)) responder(507, null);
        if(!empty($venue->photo_path)) $venue->photo_path = ASSETS.'uploads/'.$venue->photo_path;
        $days            = $this->db->query("SELECT * FROM days")->result();
        $venue->sessions = null;
        if($club_id == 4){
            $t_days = $days;
            $days   = array();
            foreach ($t_days as $d) {
                $days[strtolower($d->day_name)] = $d->id;
            }
            $refined = array();
            $sess_id = $venue->session_id;
            if($session_id != 0) $sess_id = $session_id;
            $sessions = $this->db->query("SELECT `meta_id`, `session_id`, `week_id`, `day_name`, `start_date`, `end_date`, `start_time`, `end_time`, `exclusion_day_id`, CONCAT('< ', DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%M'), ' ', DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%d'), ' - ', DATE_FORMAT(STR_TO_DATE(end_date, '%d-%m-%Y'), '%d'), '>') AS `formatted_date` FROM `sessions_meta_holiday` WHERE `session_id` = {$sess_id};")->result_array();
            $weeks = array_column($sessions, 'week_id');
            $weeks = array_unique($weeks);
            $w     = $weeks;
            $weeks = 0;
            if(!empty($w)) $weeks = max($w);
            for($i = 1; $i <= $weeks; $i++ ){
                $refined[$i]['week_id']   = $i;
                $refined[$i]['week_name'] = "Week ".$i;
                $refined[$i]['metas']      = array();
                foreach($sessions as $session){
                    if($session['week_id'] == $i){
                        $refined[$i]['formatted_date']        = $session['formatted_date'];
                        $refined[$i]['start_date']            = $session['start_date'];
                        $refined[$i]['end_date']              = $session['end_date'];
                        $refined[$i]['exclusion_day_id']      = $session['exclusion_day_id'];
                        $refined[$i]['metas'][$session['meta_id']]['meta_id']        = $session['meta_id'];
                        $refined[$i]['metas'][$session['meta_id']]['day_name']       = $session['day_name'];
                        $refined[$i]['metas'][$session['meta_id']]['start_time']     = $session['start_time'];
                        $refined[$i]['metas'][$session['meta_id']]['end_time']       = $session['end_time'];
                        $refined[$i]['metas'][$session['meta_id']]['formatted_date'] = null;
                        $refined[$i]['days'] = $this->returnDays($session['start_date'], $session['end_date']);
                        foreach($refined[$i]['days'] as &$d){
                            if(strtolower(DateTime::createFromFormat('Y-m-d', $d)->format('l')) == strtolower($refined[$i]['metas'][$session['meta_id']]['day_name']))
                                $refined[$i]['metas'][$session['meta_id']]['formatted_date'] = DateTime::createFromFormat('Y-m-d', $d)->format('d-m-Y');
                        }
                    }
                }
            }
            $venue->sessions = $refined;
            responder(200, 'success', $venue);
        }
        $sessions = $this->db->query("SELECT sm.`meta_id`, sm.`day_id`, sm.`start_time`, sm.`end_time`, d.`day_name`, l.`color` FROM `sessions_meta` sm INNER JOIN `days` d ON d.`id` = sm.`day_id` INNER JOIN `sessions` s ON s.`id` = sm.`session_id` INNER JOIN `levels` l ON l.`id` = s.`level_id` WHERE sm.`session_id` = {$venue->session_id};")->result();
        if(!empty($sessions)){
            $refined = array();
            foreach($days as $day){
                $refined[strtolower($day->day_name)]['day_id']   = $day->id;
                $refined[strtolower($day->day_name)]['day_name'] = $day->day_name;
                $refined[strtolower($day->day_name)]['metas']    = array();
                foreach($sessions as $session){
                    if($session->day_id == $day->id){
                        $refined[strtolower($day->day_name)]['metas'][]  = array(
                            'meta_id'    => $session->meta_id,
                            'start_time' => $session->start_time,
                            'end_time'   => $session->end_time,
                            'color'      => $session->color
                        );
                    }
                }
            }
            $venue->sessions = $refined;
        }
        if(@$_GET['pre'] == true) _d($venue);
        responder(200, 'success', $venue);
    }
    public function get_venues_details_assessment($club_id, $venue_id, $session_type = 0){
        $venue = $this->db->query("SELECT v.`id` AS `venue_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, `photo_path` FROM `venues` v WHERE v.`id` = {$venue_id} GROUP BY v.`id`;")->row();
        // _d("SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} GROUP BY v.`id`;");
        if(empty($venue)) responder(507, null);
        if(!empty($venue->photo_path)) $venue->photo_path = ASSETS.'uploads/'.$venue->photo_path;
        $query = "SELECT id AS assessment_id, `ass_type`, `program_id`, `date`, `day`, `start_time`, `end_time` FROM `assessment` WHERE `ass_type` = 1 AND `venue_id` = {$venue_id} AND `club_id` = {$club_id} AND `status` = 1";
        if($club_id == 5 && $session_type != 0) $query .= " AND `session_type` = {$session_type};";
        $assessments = $this->db->query($query)->result();
        if(empty($assessments)) responder(507, null);
        $refined = array();
        foreach($assessments as $k => $assessment){
            $self_key                         = str_replace(' ', '_', strtolower($assessment->date));
            $refined[$self_key]['date']       = $assessment->date;
            $refined[$self_key]['day']        = $assessment->day;
            $refined[$self_key]['sessions'][] = array(
                'assessment_id' => $assessment->assessment_id,
                'program_id'    => $assessment->program_id,
                'day'           => $assessment->day,
                'start_time'    => $assessment->start_time,
                'end_time'      => $assessment->end_time
            );
        }
        $refined_two = array();
        foreach($refined as $r){
            $refined_two[str_replace(' ', '_', strtolower($r['day']))]['day_name'] = $r['day'];
            $refined_two[str_replace(' ', '_', strtolower($r['day']))]['dates'][] = $r;
        }
        if(@$_GET['pre'] == true) _d(array('venue' => $venue, 'assessment' => $refined_two));
        responder(200, 'success', array('venue' => $venue, 'assessment' => $refined_two));
    }

    public function add_assessment($tri = false) {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $child_id  = encrypt_decrypt('decrypt', $post->child_id);
        $parent_id = encrypt_decrypt('decrypt', $post->parent_id);
        $data = array(
            'ass_type'              => 1,
            'club_id'               => $post->club_id,
            'child_id'              => $child_id,
            'venue_id'              => $post->venue_id,
            'assessment_session_id' => @$post->assessment_id->assessment_id,
            'insert_by'             => $parent_id
        );
        if($tri){
            $data['tri_swim']    = $post->tri_swim;
            $data['tri_cycling'] = $post->tri_cycling;
            $data['tri_running'] = $post->tri_running;
        }
        $insert = $this->admin_manager->Insert('enrollment_assessments', $data);
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Assessment Confirmed</title>
        <link href="'.ASSETS.'css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        </head>
        <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
        <div class="page-wrapper">
        <img src="'.ASSETS.'images/logo-icon.png"/><img src="'.ASSETS.'images/logo.png"/>
        <h3>Assessment Confirmed</h3>
        <p>Dear <strong>'.@$post->parent->first_name.' '.@$post->parent->last_name.'</strong></p>
        <p>Thank you for scheduling an assessment with My Sports Academy on dated <strong>'.@$post->assessment_id->day . ' '. @$post->selected_date->date.'</strong> on <strong>'.@$post->venue_name.'</strong> at <strong>'.@$post->assessment_id->start_time.'</strong></p>
        <p>Feel free to call for any inquiry at 04 2447848</p>
        <p>Thanks & Best Regards,</p>
        <p>My Sports Academy Team</p>
        </div>
        </body>
        </html>';
        if(!send_notification('taimoorimran9@gmail.com', $post->parent->email, 'Assessment Confirmed!', $message, true)) responder(509, 'error');
        if($insert) responder(200, 'Assessment Confirmed!');
        responder(503, 'error');
    }
    public function get_venues_for_makeup($club_id, $level_id = 0){
        $query_one = "SELECT v.`id` as `venue_id`, v.`venue_name`, v.`short_code` FROM `assessment` a  INNER JOIN `venues` v ON v.`id` = a.`venue_id` WHERE a.`ass_type` = 2 AND a.`status` = 1";
        if(($level_id != 0)) $query_one .= " AND `level_id` = {$level_id}";
        $query_two = "SELECT v.`id` as `venue_id_two`, v.`venue_name`, v.`short_code` FROM `assessment` a  INNER JOIN `venues` v ON v.`id` = a.`venue_id_two` WHERE a.`ass_type` = 2 AND a.`status` = 1";
        if(($level_id != 0)) $query_two .= " AND `level_id` = {$level_id}";
        $venues_one = $this->db->query($query_one)->result();
        $venues_two = $this->db->query($query_two)->result();
        if(empty($venues_one)) responder(507, null);
        $refined_one = array();
        $refined_two = array();
        foreach($venues_one as $venue){
            $refined_one[$venue->venue_id]['venue_id']   = $venue->venue_id;
            $refined_one[$venue->venue_id]['venue_name'] = $venue->venue_name;
            $refined_one[$venue->venue_id]['short_code'] = $venue->short_code;
        }
        foreach($venues_two as $venue){
            $refined_two[$venue->venue_id_two]['venue_id']   = $venue->venue_id_two;
            $refined_two[$venue->venue_id_two]['venue_name'] = $venue->venue_name;
            $refined_two[$venue->venue_id_two]['short_code'] = $venue->short_code;
        }
        responder(200, 'success', array('venue_one' => array_values($refined_one), 'venue_two' => array_values($refined_two)));
    }
    public function get_timing_for_makeup($club_id, $venue_id, $type){
        if($type == 1){
            $timings = $this->db->query("SELECT id AS assessment_id, `program_id`, `date`, `day`, `start_time`, `end_time` FROM `assessment` WHERE `ass_type` = 2 AND `venue_id` = {$venue_id} AND `club_id` = {$club_id} AND `status` = 1 AND venue_id IS NOT NULL;")->result();
            if(empty($timings)) responder(507, null);
            $days = $this->db->query("SELECT * FROM days")->result();
            $refined = array();
            foreach($timings as $k => $timing){
                $refined[str_replace(' ', '_', strtolower($timing->date))]['date'] = $timing->date;
                $refined[str_replace(' ', '_', strtolower($timing->date))]['sessions'][] = array(
                    'timing_id'  => $timing->assessment_id,
                    'program_id' => $timing->program_id,
                    'date'       => $timing->date,
                    'start_time' => $timing->start_time,
                    'end_time'   => $timing->end_time
                );
            }
        }
        elseif($type == 2){
            $timings = $this->db->query("SELECT id AS assessment_id, `program_id`, `date_two`, `day_two`, `start_time_two`, `end_time_two` FROM `assessment` WHERE `ass_type` = 2 AND `venue_id_two` = {$venue_id} AND `club_id` = {$club_id} AND `status` = 1 AND venue_id_two IS NOT NULL;")->result();
            if(empty($timings)) responder(507, null);
            $days = $this->db->query("SELECT * FROM days")->result();
            $refined = array();
            foreach($timings as $k => $timing){
                $refined[str_replace(' ', '_', strtolower($timing->date_two))]['date'] = $timing->date_two;
                $refined[str_replace(' ', '_', strtolower($timing->date_two))]['sessions'][] = array(
                    'timing_id'  => $timing->assessment_id,
                    'program_id' => $timing->program_id,
                    'date'       => $timing->date_two,
                    'start_time' => $timing->start_time_two,
                    'end_time'   => $timing->end_time_two
                );
            }
        }
        if(@$_GET['pre'] == true) _d(array('timing' => $refined));
        responder(200, 'success', array('timing' => $refined));
    }
    public function add_makeup_session() {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $child_id  = encrypt_decrypt('decrypt', $post->child_id);
        $parent_id = encrypt_decrypt('decrypt', $post->parent_id);
        $data = array(
            'ass_type'                  => 2,
            'club_id'                   => $post->club_id,
            'child_id'                  => $child_id,
            'level_id'                  => $post->level_id,
            'venue_id'                  => $post->venue_one,
            'assessment_session_id'     => $post->timing_one,
            'venue_two_id'              => $post->venue_two,
            'assessment_session_two_id' => $post->timing_two,
            'reason'                    => $post->reason,
            'insert_by'                 => $parent_id
        );
        $insert = $this->admin_manager->Insert('enrollment_assessments', $data);
        if($insert) responder(200, 'Makeup Session Added Successfully!');
        responder(503, 'error');
    }
    public function send_pass_forget_hash(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post = $post->params;
        if(empty($post->email)) responder(205, null);
        $parent = $this->admin_manager->SelectByID('parents', 'email', $post->email, 'ROW');
        if(empty($parent)) responder(507, null);
        $hash   = encrypt_decrypt('encrypt', $parent->email.date('sYdms'));
        $data   = array('forget_password_hash' => $hash, 'forget_pass_hash_used' => null, 'update_by' => $parent->id);
        $url    = site_url('/parents/password/reset/'.$hash);
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Password Reset Link</title>
        <link href="'.ASSETS.'css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        </head>
        <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
        <div class="page-wrapper">
        <img src="'.ASSETS.'images/logo-icon.png"/><img src="'.ASSETS.'images/logo.png"/>
        <h3>RESET PASSWORD REQUEST</h3>
        <p>Please click on the following link to reset your password</p>
        <a href="'.$url.'" target="_blank">'.$url.'</a>
        </div>
        </body>
        </html>';
        if(!send_notification('taimoorimran9@gmail.com', $post->email, 'Password Reset Link', $message, true)) responder(509, 'error');
        $update = $this->admin_manager->update('parents', $data, array('id' => $parent->id));
        if($update) responder(200, 'Password Reset Link Sent Successfully!');
        responder(510, 'error');
    }
    public function password_verify(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post = $post->params;
        if(empty($post->encrypted_key)) responder(508, null);
        if(empty($post->password)) responder(206, null);
        $parent = $this->admin_manager->SelectByID('parents', 'forget_password_hash', $post->encrypted_key, 'ROW');
        if(empty($parent)) responder(500, "Invalid Reset Password Link!");
        if(!empty($parent->forget_pass_hash_used)) responder(500, "Reset Password Link is expired!");
        $data = array('password' => password_hash($post->password, PASSWORD_DEFAULT), 'forget_password_hash' => null, 'forget_pass_hash_used' => 1,'update_by' => $parent->id);
        $update = $this->admin_manager->update('parents', $data, array('id' => $parent->id));
        if($update) responder(200, 'Password Reset Successfully!');
        responder(503, 'error');
    }
    public function get_child_statistics(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post = $post->params;
        $decrypted_key = encrypt_decrypt('decrypt', $post->encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $post->child_id = encrypt_decrypt('decrypt', $post->child_id);
        $stats = $this->db->query("SELECT * FROM statistics WHERE term_id = {$post->term_id} AND club_id = {$post->club_id} AND student_id = {$post->child_id} ORDER BY id desc limit 1")->row();
        /*$enrollments = $this->db->query("SELECT `id` as `enrollment_id`, club_id, session_id, level_id, type FROM enrollments WHERE term_id = {$post->term_id} AND club_id = {$post->club_id} AND child_id = {$post->child_id}")->result();
        if(!empty($enrollments)){
            foreach($enrollments as $e){
                $sessions = $this->db->query("SELECT `session_meta_id` FROM `enrollments_meta` WHERE `enroll_id` = {$e->enrollment_id}")->result();
                d($sessions);
            }
        }
        d($stats);*/
        $stats->ques = array((string)$stats->n1, (string)$stats->n2, (string)$stats->n3, (string)$stats->n4, (string)$stats->n5, (string)$stats->n6, (string)$stats->n7, (string)$stats->n8, (string)$stats->n9, (string)$stats->n10);
        if(!empty($stats)) responder(200, 'success', $stats);
        responder(503, 'error');
    }
}