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
        $count = $this->admin_manager->SelectByID('parents', 'email', $post->email, 'ROW');
        if(!empty($count)) responder(502, null);
        $hash = encrypt_decrypt('encrypt', $post->email.date('sYdms'));
        $parent = array(
            'first_name'              => @$post->first_name,
            'last_name'               => @$post->last_name,
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
        <img src="'.ASSETS.'images/logo.png"/>
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
        if($update) responder0(200, 'Email Verified!');
        responder(503, 'error');
    }
    public function checklogin() {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $post = $post->params;
        if(empty($post->email)) responder(205, null);
        if(empty($post->password)) responder(206, null);
        $parents  = $this->admin_manager->SelectByID('parents','email', $post->email,'ROW_A', '*');
        if (password_verify($post->password, $parents['password'])) {
            $access_token  = encrypt_decrypt('encrypt', $parents['id'].date('mmsyshh'));
            $enc_timestamp = encrypt_decrypt('encrypt', date('ymdhms'));
            $insert        = $this->admin_manager->Update('parents', array('is_login' => 1, 'access_token' => $access_token), array('id' => $parents['id']));
            password_hash($post->password, PASSWORD_DEFAULT);
            $this->session->set_userdata("loginID",$parents['id']);
            $this->session->set_userdata("userInfo",$parents);
            $refined = array(
                'id'             => encrypt_decrypt('encrypt', $parents['id']),
                'first_name'     => $parents['first_name'],
                'last_name'      => $parents['last_name'],
                'email'          => $parents['email'],
                'parent_type'    => $parents['parent_type'],
                'contact_number' => $parents['contact_number'],
                'address'        => $parents['address'],
                'profile_pic'    => ASSETS.'uploads/profile_pictures/'.$parents['photo_path']
            );
            responder(200, 'success', array('timestamp' => $enc_timestamp, 'access_token' => $access_token, 'user' => $refined));
        } //else if($parents['is_login']) responder(208, null);
        else responder(207, null);
    }
    public function get_parent_details($encrypted_key){
        $decrypted_key = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $parent = $this->admin_manager->SelectByID('parents', 'id', $decrypted_key, 'ROW_A', 'first_name, last_name, email, parent_type, contact_number, address, concat("'.ASSETS.'uploads/profile_pictures/", photo_path) as profile_pic', 'access_token');
        if(empty($parent)) responder(507, null);
        $parent['id'] = $encrypted_key;
        responder(200, 'success', $parent);
    }
    public function logout(){
        $decrypted_key = null;
        $post = json_decode(file_get_contents("php://input"));
        if(!empty($post->params)) $decrypted_key = encrypt_decrypt('decrypt', $post->params->id);
        if(empty($decrypted_key)) responder(200, null);
        $this->admin_manager->Update('parents', array('is_login' => 0, 'access_token' => null), array('id' => $decrypted_key));
        $loggined = $this->session->userdata("loginID");
        unset($loggined);
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
            'contact_number' => @$post['contact_number'],
            'parent_type'    => @$post['parent_type'],
            'address'        => @$post['address'],
            'update_by'      => $parent_id,
        );
        if(!empty($filename)) $parent['photo_path'] = $filename;
        $response = $this->admin_manager->Update('parents', $parent, array('id' => $parent_id));
        if($response){
            $p = $this->admin_manager->SelectByID('parents', 'id', $parent_id, 'ROW_A', 'first_name, last_name, email, parent_type, contact_number, address, concat("'.ASSETS.'uploads/profile_pictures/", photo_path) as profile_pic, access_token');
            $p['id'] = $post['parent_id'];
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
        $students = $this->admin_manager->SelectByID('students', 'parent_id', $decrypted_key, 'ARRAY', 'id, firstname, lastname, concat("'.ASSETS.'uploads/profile_pictures/", photo_path) as profile_pic');
        if(empty($students)) responder(200, 'success', array());
        foreach ($students as $key => &$value) {
            $value['id'] = encrypt_decrypt('encrypt', $value['id']);
        }
        responder(200, 'success', $students);
    }
    public function get_child_details($encrypted_key){
        $decrypted_key = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($decrypted_key)) responder(508, null);
        $student = $this->admin_manager->SelectByID('students', 'id', $decrypted_key, 'ROW_A', 'firstname, lastname, date_of_birth, venue_id, other_venue, contact_number, gender, medical_condition_active, medical_condition_note, term_conditions_active, concat("'.ASSETS.'uploads/profile_pictures/", photo_path) as profile_pic');
        if(empty($student)) responder(507, null);
        $student['encrypted_key'] = $encrypted_key;
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
        );
        $message  = null;
        $response = false;
        if(empty(@$post['profile_pic']) && !empty($filename)) $student['photo_path'] = $filename;
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
        $coaches = $this->db->query("SELECT u.`id`, s.`first_name`, s.`middle`, s.`last_name`, s.`designation`, s.`pro_pic` FROM `users` u INNER JOIN staff s ON s.`staff_id` = u.`id`  WHERE u.`role` = 2 AND u.`status` = 1;")->result_array();
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
        $coach = $this->db->query("SELECT u.`id`, s.`first_name`, s.`middle`, s.`last_name`, s.`designation`, s.`pro_pic`, s.`gender`, s.`personal_contact`, s.`email`, s.`qual_skill` FROM `users` u INNER JOIN staff s ON s.`staff_id` = u.`id` WHERE u.`role` = 2 AND u.`status` = 1 AND u.`id` = {$decrypted_key};")->row_array();
        if(empty($coach)) responder(507, null);
        $coach['id'] = encrypt_decrypt('encrypt', $coach['id']);
        if(!empty($coach['pro_pic'])) $coach['pro_pic'] = ASSETS.'uploads/'.$coach['pro_pic'];
        responder(200, 'success', $coach);
    }
    public function get_clubs(){
        responder(200, 'success', $this->admin_manager->SelectAll('clubs', 'ARRAY', 'id, club_name, is_assesment, concat("'.ASSETS.'uploads/clubs/", image_path) as image_path, concat("'.ASSETS.'uploads/clubs/", helper_text_image) as helper_text_image'));
    }
    public function get_news(){
        $news = $this->db->query("SELECT `description` FROM news ORDER BY `id` DESC LIMIT 5;")->result();
        if(empty($news)) responder(507, null);
        responder(200, 'success', $news);
    }
    public function get_terms_and_conditions(){
        $terms_and_conditions = $this->db->query("SELECT `description` FROM terms_and_conditions ORDER BY `id` DESC LIMIT 5;")->result();
        if(empty($terms_and_conditions)) responder(507, null);
        responder(200, 'success', $terms_and_conditions);
    }
    public function get_pricelist(){
        $pricelist = $this->db->query("SELECT `id`, `item`, `price` FROM price_list ORDER BY `item`;")->result();
        if(empty($pricelist)) responder(507, null);
        responder(200, 'success', $pricelist);
    }
    public function get_terms(){
        $terms = $this->db->query("SELECT id, term_name, start_month, end_month FROM terms ORDER BY `id`;")->result();
        if(empty($terms)) responder(507, null);
        responder(200, 'success', $terms);
    }
    public function get_levels($club_id){
        $levels = $this->db->query("SELECT l.`id` as `level_id`, p.`id` as `program_id`, `level_name`, `color` FROM `levels` l INNER JOIN `programs` p ON p.`id` = l.`program_id` AND p.`club_id` = {$club_id} ORDER BY level_name;")->result();
        if(empty($levels)) responder(507, null);
        responder(200, 'success', $levels);
    }
    public function get_tri_club_packages(){
        $programs = $this->db->query("SELECT p.`id` AS `program_id`, p.`program_name`, ps.`id` AS `session_id`, ps.`num_of_sessions`, ps.`cost_per_session`, p.`annual_reg_fee`, p.`competition_fee`, p.`daily_cost` FROM `programs` p INNER JOIN `prog_child_sessions` ps ON ps.`program_id` = p.`id` WHERE p.`club_id` = 5;")->result_array();
        if(empty($programs)) responder(507, null);
        $refined = array();
        foreach($programs as $key => $prog){
            $refined[$prog['program_id']]['program_id']      = $prog['program_id'];
            $refined[$prog['program_id']]['program_name']    = $prog['program_name'];
            $refined[$prog['program_id']]['annual_reg_fee']  = $prog['annual_reg_fee'];
            $refined[$prog['program_id']]['competition_fee'] = $prog['competition_fee'];
            $refined[$prog['program_id']]['daily_cost']      = $prog['daily_cost'];
            $refined[$prog['program_id']]['packages'][]      = array(
                'session_id'       => $prog['session_id'],
                'num_of_sessions'  => $prog['num_of_sessions'],
                'cost_per_session' => $prog['cost_per_session'],
            );
        }
        // _d($refined);
        responder(200, 'success', $refined);
    }
    public function get_venues_for_enrollment($club_id, $program_id, $level_id){
        $query = "SELECT v.`id` AS `venue_id`, v.`venue_name`, p.`competition_fee`, p.`annual_reg_fee`, p.`full_week_cost`, p.`session_card_cost`, p.`daily_cost`, p.`exclusion_per_day_cost`, p.`cost_per_session`, t.`id` AS `term_id`, t.`term_name` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `programs` p ON p.`id` = s.`program_id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE s.`club_id` = {$club_id} AND s.`program_id` = {$program_id}";
        if($club_id != 5) $query .= " AND s.`level_id` = {$level_id}";
        $query .= " GROUP BY v.`id`;";
        /*if($club_id == 5){
            $query = "SELECT v.`id` AS `venue_id`, v.`venue_name`, p.`competition_fee`, p.`annual_reg_fee`, p.`full_week_cost`, p.`session_card_cost`, p.`daily_cost`, p.`exclusion_per_day_cost`, ps.`num_of_sessions`, p.`cost_per_session`, t.`id` AS `term_id`, t.`term_name` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `programs` p ON p.`id` = s.`program_id` INNER JOIN prog_child_sessions ps on ps.`program_id` = p.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE s.`club_id` = {$club_id} AND s.`program_id` = {$program_id} AND s.`level_id` = {$level_id}  GROUP BY v.`id`;";
        }*/
        $venues = $this->db->query($query)->result();
        if(empty($venues)) responder(507, null);
        responder(200, 'success', $venues);
    }
    public function get_venues_for_assessment($club_id){
        $query = "SELECT v.`id` AS `venue_id`, v.`venue_name`, p.`competition_fee`, p.`annual_reg_fee`, p.`full_week_cost`, p.`session_card_cost`, p.`daily_cost`, p.`exclusion_per_day_cost` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `programs` p ON p.`id` = s.`program_id` WHERE s.`club_id` = {$club_id} GROUP BY v.`id`;";
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
    public function get_venues_details($club_id, $program_id, $venue_id){
        $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} GROUP BY v.`id`;";
        if($club_id == 4){
            $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} AND s.`club_id` = {$club_id} GROUP BY v.`id`;";
        }
        $venue = $this->db->query($venue_query)->row();
        if(empty($venue)) responder(507, null);
        if(!empty($venue->photo_path)) $venue->photo_path = ASSETS.'uploads/'.$venue->photo_path;
        if(!empty($venue->google_map_url)){
            $google = $venue->google_map_url;
            $venue->google_map_url = null;
            $matches = [];
            preg_match("/@(.*?),(.*?),/",$google,$matches);
            if(!empty($matches)){
                $place = $matches[1];
                preg_match("/@(.*?),(.*?),/",$google,$matches);
                $lat  = $matches[1];
                $long = $matches[2];
                $venue->google_map_url = "https://www.google.com/maps/embed/v1/place?q='.$place.'&center='.$lat.','.$long.'&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU&zoom=8";
            }
        }
        $days            = $this->db->query("SELECT * FROM days")->result();
        $venue->sessions = null;
        if($club_id == 4){
            $refined  = array();
            $sessions = $this->db->query("SELECT `meta_id`, `session_id`, `week_id`, `start_date`, `end_date`, `start_time`, `end_time`, `exclusion_day_id`, CONCAT('< ', DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%M'), ' ', DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%d'), ' - ', DATE_FORMAT(STR_TO_DATE(end_date, '%d-%m-%Y'), '%d'), '>') AS `formatted_date` FROM `sessions_meta_holiday` WHERE `session_id` = {$venue->session_id};")->result_array();
            $weeks = array_column($sessions, 'week_id');
            $weeks = array_unique($weeks);
            $weeks = max($weeks);
            for($i = 1; $i <= $weeks; $i++ ){
                $refined[$i]['week_id']   = $i;
                $refined[$i]['week_name'] = "Week ".$i;
                foreach($sessions as $session){
                    if($session['week_id'] == $i){
                        $refined[$i]['formatted_date'] = $session['formatted_date'];
                        $refined[$i]['meta_id'] = $session['meta_id'];
                        $refined[$i]['start_date'] = $session['meta_id'];
                        $refined[$i]['end_date'] = $session['end_date'];
                        $refined[$i]['start_time'] = $session['start_time'];
                        $refined[$i]['end_time'] = $session['end_time'];
                        $refined[$i]['exclusion_day_id'] = $session['exclusion_day_id'];
                        $refined[$i]['days'] = $this->returnDays($session['start_date'], $session['end_date']);
                        foreach($refined[$i]['days'] as &$d) $d = DateTime::createFromFormat('Y-m-d', $d)->format('d-m-Y');
                    }
                }
            }
            $venue->sessions = $refined;
            responder(200, 'success', $venue);
        }
        $sessions = $this->db->query("SELECT sm.`meta_id`, sm.`day_id`, sm.`start_time`, sm.`end_time`, d.`day_name` FROM `sessions_meta` sm INNER JOIN `days` d ON d.`id` = sm.`day_id` WHERE sm.`session_id` = {$venue->session_id};")->result();
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
                            'end_time'   => $session->end_time
                        );
                    }
                }
            }
            $venue->sessions = $refined;
        }
        if(@$_GET['pre'] == true) _d($venue);
        responder(200, 'success', $venue);
    }
    public function get_venues_details_assessment($club_id, $venue_id){
        $venues = $this->db->query("SELECT id AS assessment_id, `ass_type`, `program_id`, `date`, `day`, `start_time`, `end_time` FROM `assessment` WHERE `ass_type` = 1 AND `venue_id` = 1 AND `club_id` = 1 AND `status` = 1;")->result();
        if(empty($venues)) responder(507, null);
        $days = $this->db->query("SELECT * FROM days")->result();
        $refined = array();
        foreach($days as $day){
            $refined[strtolower($day->day_name)]['day_id']   = $day->id;
            $refined[strtolower($day->day_name)]['day_name'] = $day->day_name;
            $refined[strtolower($day->day_name)]['metas']    = array();
            foreach($venues as $venue){
                if(strtolower($venue->day) == strtolower($day->day_name)){
                    $refined[strtolower($day->day_name)]['metas'][]  = array(
                        'assessment_id' => $venue->assessment_id,
                        'ass_type'      => $venue->ass_type,
                        'program_id'    => $venue->program_id,
                        'date'          => $venue->date,
                        'day'           => $venue->day,
                        'start_time'    => $venue->start_time,
                        'end_time'      => $venue->end_time
                    );
                }
            }
        }
        if(@$_GET['pre'] == true) _d($refined);
        responder(200, 'success', $refined);
    }
    public function flatten_array(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $refined = array();
        foreach($post as $p){
            $refined[] = $p[0];
        }
        responder(200, 'success', array_values($refined));
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
            'assessment_session_id' => $post->assessment_id,
            'insert_by'             => $parent_id
        );
        if($tri){
            $data['tri_swim']    = $post->tri_swim;
            $data['tri_cycling'] = $post->tri_cycling;
            $data['tri_running'] = $post->tri_running;
        }
        $insert = $this->admin_manager->Insert('enrollment_assessments', $data);
        if($insert) responder(200, 'Assessment Confirmed!');
        responder(503, 'error');
    }
    public function proceed_checkout() {
        $post = json_decode(file_get_contents("php://input"));
/*if (empty($post)) responder(604, null);
_d($post);*/
responder(200, 'Booked Succesfully!');
}
public function get_venues_for_makeup(){
    $query = "SELECT a.*, v.`venue_name`, v.`short_code` FROM `assessment` a  INNER JOIN `venues` v ON v.`id` = a.`venue_id` WHERE a.`ass_type` = 2 AND a.`status` = 1;";
    $venues = $this->db->query($query)->result();
    if(empty($venues)) responder(507, null);
    $refined = array();
    foreach($venues as $venue){
        $refined[$venue->venue_id]['venue_id']   = $venue->venue_id;
        $refined[$venue->venue_id]['venue_name'] = $venue->venue_name;
        $refined[$venue->venue_id]['short_code'] = $venue->short_code;
        $refined[$venue->venue_id]['timings'][] = array(
            'assessment_id' => $venue->id,
            'club_id'       => $venue->club_id,
            'term_id'       => $venue->term_id,
            'program_id'    => $venue->program_id,
            'level_id'      => $venue->level_id,
            'date'          => $venue->date,
            'day'           => $venue->day,
            'start_time'    => $venue->start_time,
            'end_time'      => $venue->end_time
        );
    }
    responder(200, 'success', array_values($refined));
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
    $url    = site_url('/parents/email/verification/'.$hash);
    $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Password Reset Link</title>
    <link href="'.ASSETS.'css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    </head>
    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
    <img src="'.ASSETS.'images/logo.png"/>
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
}