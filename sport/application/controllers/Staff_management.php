<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_management extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    private function loadComponents($view, $data = array()) {
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

    public function index() {
        $data['staffs'] = $this->db->query("SELECT s.*,u.`status`,u.`id` AS user_id FROM `staff` s
            INNER JOIN users u ON s.`staff_id`=u.`id` ORDER BY s.first_name")->result();
        self::loadComponents('staff_management/staff-management', $data);
    }

    public function add_staff() {
        self::loadComponents('staff_management/add_staff');
    }

    public function edit_staff($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['staffs'] = $this->db->query("SELECT s.*,u.`status`,u.`id` AS user_id,u.`role` FROM `staff` s
            INNER JOIN users u ON s.`staff_id`=u.`id` WHERE s.`staff_id`='$id'")->row_array();
        $data['staff_id'] = $id;
        $data['documents'] = $this->db->query("SELECT * FROM documents WHERE staff_id='$id'")->result_array();
        // d($data['staffs']);
        self::loadComponents('staff_management/edit_staff', $data);
    }

    public function update_staff() {
        $email = $this->input->post('email');
        $firstname = $this->input->post('firstname');
        $staffID = $this->input->post('staff_id');
        $order_id = $this->input->post('order_id');

        $staff = array(
            'first_name' => $firstname,
            'order_id' => $order_id,
            'middle' => $this->input->post('middle'),
            'last_name' => $this->input->post('lastname'),
            'dob' => $this->input->post('dob'),
            'designation' => $this->input->post('rollNo'),
            'gender' => $this->input->post('gender'),
            'personal_contact' => $this->input->post('personal_phone'),
            'p_code' => $this->input->post('p_code'),
            'work_contact' => $this->input->post('contact_phone'),
            'w_code' => $this->input->post('w_code'),
            'email' => $this->input->post('email'),
            'contract_start_date' => $this->input->post('contract_start_date'),
            'contract_end_date' => $this->input->post('contract_end_date'),
            'sal_curr' => $this->input->post('sal_curr'),
            'salary' => $this->input->post('salary'),
            'bonus' => $this->input->post('bonus'),
            'bonus_curr' => $this->input->post('bonus_curr'),
            'passport_no' => $this->input->post('passport'),
            'emirate_id' => $this->input->post('emirate_id'),
            'qual_skill' => $this->input->post('qualification'),
            'kin_first_name' => $this->input->post('kin_firstname'),
            'kin_phone' => $this->input->post('kin_phone'),
            'k_code' => $this->input->post('k_code'),
            'kin_address' => $this->input->post('kin_address'),
            'medial_condition' => $this->input->post('med_con'),
            'medical_address' => $this->input->post('med_address'),
            'annual_leave' => $this->input->post('annual_leaves'),
            'replationship' => $this->input->post('replationship'),
            'status' => 1,
        );

        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (!empty($_FILES['userfile'])) {
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $staff['pro_pic'] = $data['upload_data']['file_name'];
            }
        }
        $this->admin_manager->Update('staff', $staff, array('staff_id' => $staffID));

        if ($this->input->post('documentsImage')) {
            foreach ($this->input->post('documentsImage') as $images) {
                $filePath = './assets/uploads/';
                $Base64MIMI = explode(",", $images)[0];
                $Base64Encoded = explode(",", $images)[1];
                $ext = '';
                if ($Base64MIMI == "data:image/png;base64") {
                    $ext = '.png';
                } else if ($Base64MIMI == "data:image/jpeg;base64") {
                    $ext = '.jpg';
                } else if ($Base64MIMI == "data:application/pdf;base64") {
                    $ext = '.pdf';
                }
                $filename = uniqid() . $ext;
                $file = $filePath . $filename;
                $base64Decode = base64_decode($Base64Encoded);
                @file_put_contents($file, $base64Decode);
                //$levels['file_path'] = $filename;
                $document = array(
                    'staff_id' => $staffID,
                    'document_path' => $filename,
                );
                $this->admin_manager->Insert('documents', $document);
            }
        }
        $this->session->set_flashdata("popup", "Staff Updated Successfully!");
        redirect_to('/admin/staff-management');
    }

    public function save_staff() {

        $email = $this->input->post('email');
        $firstname = $this->input->post('firstname');
        $order_id = $this->input->post('order_id');

        $CheckAvail = $this->admin_manager->SelectByID('users', 'email', $email, 'ROW_A', '*');
        $defined_role = $this->input->post('defined_role');
        if (empty($CheckAvail)) {
            $user = array(
                'role' => $defined_role,
                'username' => $firstname,
                'email' => $email,
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            );

            $this->admin_manager->Insert('users', $user);
            $staffID = $this->db->insert_id();

            $staff = array(
                'staff_id' => $staffID,
                'order_id' => $order_id,
                'first_name' => $firstname,
                'middle' => $this->input->post('middle'),
                'last_name' => $this->input->post('lastname'),
                'dob' => $this->input->post('dob'),
                'designation' => $this->input->post('rollNo'),
                'gender' => $this->input->post('gender'),
                'personal_contact' => $this->input->post('personal_phone'),
                'p_code' => $this->input->post('p_code'),
                'work_contact' => $this->input->post('contact_phone'),
                'w_code' => $this->input->post('w_code'),
                'email' => $this->input->post('email'),
                'contract_start_date' => $this->input->post('contract_start_date'),
                'contract_end_date' => $this->input->post('contract_end_date'),
                'sal_curr' => $this->input->post('sal_curr'),
                'salary' => $this->input->post('salary'),
                'bonus' => $this->input->post('bonus'),
                'bonus_curr' => $this->input->post('bonus_curr'),
                'passport_no' => $this->input->post('passport'),
                'emirate_id' => $this->input->post('emirate_id'),
                'qual_skill' => $this->input->post('qualification'),
                'kin_first_name' => $this->input->post('kin_firstname'),
                'kin_phone' => $this->input->post('kin_phone'),
                'k_code' => $this->input->post('k_code'),
                'kin_address' => $this->input->post('kin_address'),
                'medial_condition' => $this->input->post('med_con'),
                'medical_address' => $this->input->post('med_address'),
                'annual_leave' => $this->input->post('annual_leaves'),
                'replationship' => $this->input->post('replationship'),
                'status' => 1,
            );

            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if (!empty($_FILES['userfile'])) {
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $staff['pro_pic'] = $data['upload_data']['file_name'];
                }
            }
            $this->admin_manager->Insert('staff', $staff);
            $insert_id = $this->db->insert_id();

            if ($this->input->post('documentsImage')) {
                foreach ($this->input->post('documentsImage') as $images) {
                    $filePath = './assets/uploads/';
                    $Base64MIMI = explode(",", $images)[0];
                    $Base64Encoded = explode(",", $images)[1];
                    $ext = '';
                    if ($Base64MIMI == "data:image/png;base64") {
                        $ext = '.png';
                    } else if ($Base64MIMI == "data:image/jpeg;base64") {
                        $ext = '.jpg';
                    } else if ($Base64MIMI == "data:application/pdf;base64") {
                        $ext = '.pdf';
                    }
                    $filename = uniqid() . $ext;
                    $file = $filePath . $filename;
                    $base64Decode = base64_decode($Base64Encoded);
                    @file_put_contents($file, $base64Decode);
                    //$levels['file_path'] = $filename;
                    $document = array(
                        'staff_id' => $staffID,
                        'document_path' => $filename,
                    );
                    $this->admin_manager->Insert('documents', $document);
                }
            }
            $this->session->set_flashdata("popup", "Staff Added Successfully!");
        } else {
            $this->session->set_flashdata("error_popup", "This staff is already exist!");
        }

        redirect_to('/admin/staff-management');
    }

    public function edit_program($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['program'] = $this->admin_manager->SelectByID('programs', 'id', $id, 'ROW_A');
        $data['levels'] = $this->admin_manager->SelectByID('levels', 'program_id', $id, 'ARRAY');
        $data['program_session'] = $this->admin_manager->SelectByID('prog_child_sessions', 'program_id', $id, 'ARRAY');
        $this->loadComponents('program_management/edit-program', $data);
    }

    public function duplicationProgram($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $last_id = $this->DuplicateMySQLRecord('programs', 'id', $id);
        $CheckLevels = $this->admin_manager->SelectAll('levels', 'ROW_A', $params = 'COUNT(*) AS counts');
        $CheckChildSession = $this->admin_manager->SelectAll('prog_child_sessions', 'ROW_A', $params = 'COUNT(*) AS counts');
        if ($CheckLevels['counts'] > 0) {
            $this->DuplicateMySQLRecord('levels', 'id', $id, 1, array('program_id' => $last_id));
        }
        if ($CheckChildSession['counts'] > 0) {
            $this->DuplicateMySQLRecord('prog_child_sessions', 'id', $id, 1, array('program_id' => $last_id));
        }
        redirect_to('/admin/program-management');
    }

    public function DuplicateMySQLRecord($table, $primary_key_field, $primary_key_val, $extra = '', $param = array()) {
        /* generate the select query */
        $this->db->where($primary_key_field, $primary_key_val);
        $query = $this->db->get($table);
        foreach ($query->result() as $row) {
            foreach ($row as $key => $val) {
                if ($key != $primary_key_field) {
                    /* $this->db->set can be used instead of passing a data array directly to the insert or update functions */
                    @$this->db->set($key, $val);
                }//endif              
            }//endforeach
        }//endforeach
        /* insert the new record into table */
        if (empty($extra)) {
            $this->db->insert($table);
        } else {
            @$this->db->set($param);
            $this->db->insert($table);
        }
        return $this->db->insert_id();
    }

    public function delete_staff($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $unlinkImage = $this->admin_manager->SelectByID("staff", 'id', $id, 'ROW_A');
        @unlink(site_url('/assets/uploads/' . $unlinkImage['pro_pic']));
        $this->admin_manager->Delete('staff', 'id', $id);
        $this->admin_manager->Delete('documents', 'staff_id', $id);
        redirect_to('admin/staff-management/');
    }

    public function delete_document() {
        $id = $this->input->post('document_id');
        $this->admin_manager->Delete('documents', 'id', $id);
    }

    public function delete_absense() {
        $id = $this->input->post('absense_id');
        $this->admin_manager->Delete('absense', 'id', $id);
        $this->admin_manager->Delete('documents', 'absense_id', $id);
    }

    public function leave_application($id) {
        $data['staff_id'] = $id = encrypt_decrypt('decrypt', $id);
        $data['staffs'] = $this->db->query("SELECT * FROM staff WHERE staff_id='$id'")->row_array();
        self::loadComponents('staff_management/leave_application', $data);
    }

    public function save_leave() {
        $sid = encrypt_decrypt('encrypt', $this->input->post('staff_id'));
        $leave_application = array(
            'staff_id' => $this->input->post('staff_id'),
            'full_name' => $this->input->post('firstname'),
            'select_date' => $this->input->post('select_date'),
            'joining_date' => $this->input->post('joining_date'),
            'paid_leave' => $this->input->post('department'),
            'reason_leave' => $this->input->post('reason'),
            'total_leave_day' => $this->input->post('total_leave_days'),
            'date_leave_from' => $this->input->post('leave_date_from'),
            'date_leave_to' => $this->input->post('leave_date_to'),
            'person_covering' => $this->input->post('person_covering'),
            'extra_info' => $this->input->post('extra_info'),
            'resume_date' => $this->input->post('resume_date'),
            'staff_sign' => $this->input->post('staff_sign'),
            'management_sign' => $this->input->post('mangement_sign'),
            'status' => 0,
        );

        $this->admin_manager->Insert('leave_application', $leave_application);
        $insert_id = $this->db->insert_id();

        if ($this->input->post('documentsImage')) {
            foreach ($this->input->post('documentsImage') as $images) {
                $filePath = './assets/uploads/';
                $Base64MIMI = explode(",", $images)[0];
                $Base64Encoded = explode(",", $images)[1];
                $ext = '';
                if ($Base64MIMI == "data:image/png;base64") {
                    $ext = '.png';
                } else if ($Base64MIMI == "data:image/jpeg;base64") {
                    $ext = '.jpg';
                } else if ($Base64MIMI == "data:application/pdf;base64") {
                    $ext = '.pdf';
                }
                $filename = uniqid() . $ext;
                $file = $filePath . $filename;
                $base64Decode = base64_decode($Base64Encoded);
                @file_put_contents($file, $base64Decode);
                //$levels['file_path'] = $filename;
                $document = array(
                    'leave_id' => $insert_id,
                    'document_path' => $filename,
                );
                $this->admin_manager->Insert('documents', $document);
            }
        }

        $this->session->set_flashdata("message", "Application has been successfully submitted");
        redirect_to('/admin/staff-management/leave-application/' . $sid);
    }

    public function Add_absense() {
        $staff_id = $this->input->post('staff_id');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $reason = $this->input->post('reason');
        $start = strtotime($startDate);
        $end = strtotime($endDate);

        $days_between = ceil(abs($end - $start) / 86400);
//        echo $startDate . " " . $endDate . "---" . $days_between;
//        die();
        $absense = array(
            'staff_id' => $staff_id,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'days' => $days_between,
            'reason' => $reason
        );
        $this->admin_manager->Insert("absense", $absense);
        $insert_id = $this->db->insert_id();
        if ($this->input->post('documentsImage')) {
            foreach ($this->input->post('documentsImage') as $images) {
                $filePath = './assets/uploads/';
                $Base64MIMI = explode(",", $images)[0];
                $Base64Encoded = explode(",", $images)[1];
                $ext = '';
                if ($Base64MIMI == "data:image/png;base64") {
                    $ext = '.png';
                } else if ($Base64MIMI == "data:image/jpeg;base64") {
                    $ext = '.jpg';
                } else if ($Base64MIMI == "data:application/pdf;base64") {
                    $ext = '.pdf';
                }
                $filename = uniqid() . $ext;
                $file = $filePath . $filename;
                $base64Decode = base64_decode($Base64Encoded);
                @file_put_contents($file, $base64Decode);
                //$levels['file_path'] = $filename;
                $document = array(
                    'absense_id' => $insert_id,
                    'document_path' => $filename,
                );
                $this->admin_manager->Insert('documents', $document);
            }
        }
        echo $days_between;
    }

    public function edit_absense($id) {
        $data['absense'] = $this->db->query("SELECT 
                                                a.*,
                                                GROUP_CONCAT(d.`document_path`) AS documents,
                                                GROUP_CONCAT(d.`id`) AS document_id
                                              FROM
                                                absense a 
                                                LEFT JOIN `documents` d 
                                                  ON a.`id` = d.`absense_id` 
                                              WHERE a.id = '$id'")->row_array();
        loadViewComponents('/staff_management/edit_absense', $data);
    }

    public function update_absense() {
        $staff_id = $this->input->post('staff_id');
        $absense_id = $this->input->post('absense_id');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $reason = $this->input->post('reason');
        $start = strtotime($startDate);
        $end = strtotime($endDate);

        $days_between = ceil(abs($end - $start) / 86400);
//        echo $startDate . " " . $endDate . "---" . $days_between;
//        die();
        $absense = array(
            'staff_id' => $staff_id,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'days' => $days_between,
            'reason' => $reason
        );

        $this->admin_manager->Update("absense", $absense, array('staff_id' => $staff_id));

        if ($this->input->post('documentsImage')) {
            foreach ($this->input->post('documentsImage') as $images) {
                $filePath = './assets/uploads/';
                $Base64MIMI = explode(",", $images)[0];
                $Base64Encoded = explode(",", $images)[1];
                $ext = '';
                if ($Base64MIMI == "data:image/png;base64") {
                    $ext = '.png';
                } else if ($Base64MIMI == "data:image/jpeg;base64") {
                    $ext = '.jpg';
                } else if ($Base64MIMI == "data:application/pdf;base64") {
                    $ext = '.pdf';
                }
                $filename = uniqid() . $ext;
                $file = $filePath . $filename;
                $base64Decode = base64_decode($Base64Encoded);
                @file_put_contents($file, $base64Decode);
                //$levels['file_path'] = $filename;
                $document = array(
                    'absense_id' => $absense_id,
                    'document_path' => $filename,
                );
                $this->admin_manager->Insert('documents', $document);
            }
        }
        $this->session->set_flashdata("popup", "Absense has been updated");
        redirect('/admin/staff-management/absense');
    }

    public function absense() {
        $data['staffs'] = $this->admin_manager->SelectAll("staff");
        self::loadComponents('staff_management/staff_absense', $data);
    }

    public function get_absense() {
        $staff_id = $this->input->post("staff_id");
        $days = $this->admin_manager->SelectByID('absense', 'staff_id', $staff_id, 'ARRAY', $params = '*');
        //print_r($days);
        $days_array = array();
        if (!empty($days)) {
            foreach ($days as $key => $day) {
                $days_array[] = "<span class='squarebox'><a href='" . site_url('/admin/staff-management/edit-absense/' . $day['id']) . "'>" . $day['days'] . "</a><a href='#' class='delete_absense' data-id='" . $day['id'] . "'>x<a></span>";
            }
            print_r(json_encode($days_array));
        } else {
            print_r(json_encode($days_array));
        }
    }

    public function get_staff_absense() {
        $staff_id = $this->input->post("staff_id");
        $query = $this->admin_manager->SelectByID('absense', 'staff_id', $staff_id, 'ARRAY');
        print_r(json_encode($query));
    }

    public function staf_leave($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $staff_id = $this->input->post("staff_id");
        $data['leave_request'] = $this->admin_manager->SelectByID('leave_application', 'staff_id', $id, 'ARRAY', $params = '*');
        self::loadComponents('staff_management/staf_leave', $data);
    }

    public function staff_leave_request() {
        $data['leave_applications'] = $this->db->query("SELECT st.*,la.id AS leave_id,la.status as leave_status,la.`date_leave_from`,la.`date_leave_to` FROM staff st INNER JOIN `leave_application` la
            ON st.`staff_id` = la.`staff_id`")->result_array();
        self::loadComponents('staff_management/leave_request_list', $data);
    }

    public function staff($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['staff'] = $this->admin_manager->SelectByID('staff', 'staff_id', $id, 'ARRAY', $params = '*');
        $data['documents'] = $this->admin_manager->SelectByID('documents', 'staff_id', $id, 'ARRAY', $params = '*');
        $data['absense'] = $this->db->query("SELECT SUM(days) AS total_leaves FROM absense WHERE staff_id='$id'")->row_array();
        $data['leaves'] = $this->admin_manager->SelectByID('leave_application', 'staff_id', $id, 'ARRAY', $params = '*');
        $data['staff_id'] = $id;
        self::loadComponents('staff_management/staff', $data);
    }

    public function view_leave_request($id) {
        $data['leave_request'] = $this->db->query("SELECT st.*,la.id AS leave_id,la.* FROM staff st INNER JOIN `leave_application` la
            ON st.`staff_id` = la.`staff_id` WHERE la.id='$id'")->row_array();
        $this->load->view('/staff_management/leave_view', $data);
    }

    public function change_status($id) {
        $status_array = array("disapproved", "approved");
        $status = $this->input->get("status");
        $this->admin_manager->Update("leave_application", array('status' => $status), array('id' => $id));
        $this->session->set_flashdata("popup", "Leave request has been " . $status_array[$status]);
        redirect_to('/admin/staff-management/staff-leave-request');
    }

    public function change_record() {
        $status = $this->input->get('status');
        $id = $this->input->get('id');
        $this->admin_manager->Update("users", array("status" => $status), array('id' => $id));
        $status_array = array("Activated", "De-activated");
        $this->session->set_flashdata("popup", "Staff $status_array[$status] Successfully!");
        redirect_to('/admin/staff-management/');
    }

    public function filter_status() {
        $status = $this->input->post('status');
        $where='';
        if(!empty($status) || $status=="1"){
            $where .=" AND u.`status`='{$status}'";
        }else if(!empty($status) || $status=="0"){
            $where .=" AND u.`status`='{$status}'";
        }
        $staffs = $this->db->query("SELECT s.*,u.`status`,u.`id` AS user_id FROM `staff` s
            INNER JOIN users u ON s.`staff_id`=u.`id` WHERE role='2' $where")->result();

        if (!empty($staffs)) {
            foreach ($staffs as $staff):
                ?>
               <tr>
                                            <td class="patient-img sorting_1">
                                                <img src="<?php echo site_url("/assets/uploads/" . $staff->pro_pic); ?>" alt="">
                                            </td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $staff->first_name . " " . $staff->middle . " " . $staff->last_name ?></td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $staff->gender; ?></td>
                                            <td><?php echo $staff->designation; ?></td>
                                            <td><?php echo "(" . $staff->w_code . ")" . $staff->work_contact; ?></td>
                                            <td><?php echo ($staff->status == 1) ? '<a href="' . site_url('staff_management/change_record/?status=0&id=' . $staff->user_id) . '"><i class="material-icons">lock</i></a>' : '<a href="' . site_url('staff_management/change_record/?status=1&id=' . $staff->user_id) . '"><i class="material-icons">lock_open</i></a>'; ?></td>
                                            <td class="actions">

                                                <a href="<?php echo site_url("/admin/staff-management/staff/" . encrypt_decrypt('encrypt', $staff->staff_id)); ?>" class="" data-toggle="tooltip" title="Info">
                                                    <i class="material-icons f-left">info</i>
                                                </a>
                                                <a href="<?php echo site_url("/admin/staff-management/edit-staff/" . encrypt_decrypt('encrypt', $staff->staff_id)); ?>" class="" data-toggle="tooltip" title="Info">
                                                    <i class="material-icons f-left">edit</i>
                                                </a>
                                                <a href="#myModal" data-url="<?php echo site_url('/admin/staff-management/delete-staff/' . encrypt_decrypt('encrypt', $staff->id)) ?>" data-toggle="modal" class="delete_me" title="Delete">
                                                    <i class="material-icons f-left">delete</i>
                                                </a>

                                            </td>
                                        </tr>
                <?php
            endforeach;
        } else {
            echo "<tr><td colspan='7'>No Record Found</td></tr>";
        }
    }

    public function makedata($userID = '') {
        $days = $this->db->query("SELECT * FROM days")->result_array();
        $serialArray = array();
        $sessionArray = array();
        foreach ($days as $key => $day) {
            $serialArray[$day['day_name']]['meta'] = $this->CallSessionMeta($day['id'], '5');
        }
        foreach ($serialArray as $keys => $serial) {
            if (is_array($serial['meta'])) {
                $count = 0;
                foreach ($serial as $key => $s) {
                    if (isset($s[$count])) {
                        $serialArray[$keys]['session'] = $this->CallSession($s[$count]['session_id'], $userID);
                    }
                    $count++;
                }
            }
        }
        d($serialArray);
    }

    public function CallSessionMeta($id, $userID = '') {
        $sessions_meta = $this->db->query("SELECT * FROM sessions_meta WHERE day_id='$id' AND coach_id='$userID'")->result_array();
        return $sessions_meta;
    }

    public function CallSession($sessionID, $userID = '') {
        $query = $this->db->query("SELECT s.*,l.color FROM sessions s INNER JOIN levels l ON s.level_id=l.id WHERE s.id='$sessionID'")->row_array();
        return $query;
    }

    public function CallLevels($levelID) {
        $query = $this->db->query("SELECT * FROM levels WHERE id='$levelID'")->result_array();
        return $query;
    }

}
