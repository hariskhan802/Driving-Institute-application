<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Child_management extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['students'] = $this->db->query("SELECT 
                                                s.*,
                                                v.`short_code`,
                                                v.`venue_name`,
                                                c.`club_name`
                                              FROM
                                                `students` s 
                                                INNER JOIN `venues` v 
                                                  ON v.`id` = s.`venue_id` 
                                                INNER JOIN `enrollments` e 
                                                  ON e.`child_id` = s.`id` 
                                                  INNER JOIN `clubs` c
                                                  ON c.`id` = e.`club_id`
                                              GROUP BY s.id 
                                              ORDER BY s.id DESC ")->result_array();
        loadViewComponents('child_management/child_list', $data);
    }

    public function delete_child($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $this->admin_manager->Delete('students', 'id', $id);
        redirect_to('admin/child-management');
    }

    public function child_details($id) {
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['levels'] = returnLevels(array('keys' => 'id,program_id, level_name', 'format' => 'dropdown'));
        $id = encrypt_decrypt('decrypt', $id);

        $data['child_id'] = $id;
        $data['child'] = $this->db->query("SELECT 
                                            s.*,
                                            v.`short_code`,
                                            l.`color`,
                                            l.level_name,
                                            c.club_name,
                                            par.`parent_type`,
                                            par.`email`,
                                            par.`first_name`,
                                            par.`last_name`,
                                            par.`contact_number`,
                                            par.`code`,
                                            par.`email`,
                                            par.address 
                                          FROM
                                            `students` s 
                                            INNER JOIN `parents` par 
                                              ON par.`id` = s.`parent_id` 
                                            INNER JOIN `venues` v 
                                              ON v.`id` = s.`venue_id` 
                                            INNER JOIN `enrollments` e 
                                              ON e.`child_id` = s.`id` 
                                            INNER JOIN `clubs` c 
                                              ON `e`.`club_id` = c.id 
                                            INNER JOIN `programs` p 
                                              ON `e`.`program_id` = p.id 
                                            INNER JOIN `levels` l 
                                              ON `e`.`level_id` = l.id 
                                                WHERE s.id='{$id}'")->row_array();
        $data['sessions'] = $this->db->query("SELECT 
  DISTINCT ss.`id`,  
  c.`club_name`,
  p.`program_name`,
  l.`level_name`,
  st.id AS student_id,
  sm.`date`,
  sm.`day`,
  sm.`start_time`,
  sm.`end_time`,
  t.`term_name`
  
FROM
  `enrollments` e
  INNER JOIN `sessions` ss
  ON ss.`id` = e.`session_id`
    INNER JOIN `terms` t 
    ON t.`id` = e.`term_id` 
  INNER JOIN `sessions_meta` sm
  ON sm.`session_id` = ss.`id`
  INNER JOIN `students` st 
    ON st.`id` = e.`child_id` 
  INNER JOIN `clubs` c 
    ON e.`club_id` = c.`id` 
  INNER JOIN `programs` p 
    ON e.`program_id` = p.`id` 
  INNER JOIN `levels` l 
    ON e.`level_id` = l.`id` 
     WHERE e.child_id = '$id' 
    GROUP BY e.`id`,ss.`id`
                                             ")->result_array();

        $data['coach_comment'] = $this->db->query("SELECT 
                                                    CONCAT(
                                                      st.`first_name`,
                                                      ' ',
                                                      st.last_name
                                                    ) AS coach_name 
                                                  FROM
                                                    `students` s 
                                                    INNER JOIN `enrollments` e 
                                                      ON e.`child_id` = s.`id` 
                                                    INNER JOIN `enrollments_meta` em 
                                                      ON em.enroll_id=e.`id`
                                                    INNER JOIN `sessions_meta` sm 
                                                      ON sm.`meta_id` = em.session_meta_id
                                                    INNER JOIN staff st 
                                                      ON st.`staff_id` = sm.`coach_id` 
                                                  WHERE s.`id` = '1' 
                                                  GROUP BY sm.`coach_id`")->row_array();
        $data['statistics'] = $this->db->query("SELECT * FROM statistics WHERE student_id='$id'")->row_array();
        $data['discounts'] = $this->db->query("SELECT 
                                                        c.`club_name`,
                                                        l.`level_name`,
                                                        c.`club_name`,
                                                        v.`venue_name`,
                                                        v.`short_code`,
                                                        t.`term_name`,
                                                        d.*
                                                      FROM
                                                        `discounts` d 
                                                        INNER JOIN `clubs` c 
                                                          ON c.`id` = d.`club_id` 
                                                        INNER JOIN levels l 
                                                          ON l.`id` = d.`level_id` 
                                                        INNER JOIN `venues` v 
                                                          ON v.`id` = d.`venue_id` 
                                                        INNER JOIN `terms` t 
                                                          ON t.`id` = d.`term_id` 
                                                       WHERE student_id='$id'")->result_array();
        loadViewComponents('child_management/child_details', $data);
    }

    public function filter_child() {
        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $program_id = $this->input->post('program_id');
        $level_id = $this->input->post('level_id');
        $venue_id = $this->input->post('venue_id');
        $where = '';

        if (!empty($club_id)) {
            $where .= " AND e.club_id='$club_id'";
        }
        if (!empty($program_id)) {
            $where .= " AND e.program_id='$program_id'";
        }
        if (!empty($level_id)) {
            $where .= " AND e.level_id='$level_id'";
        }
        if (!empty($venue_id)) {
            $where .= " AND s.venue_id='$venue_id'";
        }

        $students = $this->db->query("SELECT  s.*,v.venue_name
                                                      FROM
                                                        `students` s 
                                                        LEFT JOIN `enrollments` e 
                                                          ON e.`child_id` = s.`id` 
                                                        INNER JOIN clubs c 
                                                          ON c.`id` = e.`child_id`
                                                          INNER JOIN venues v
                                                          ON s.venue_id = v.id 
                                                      WHERE s.`status` = '1' 
                                                        $where GROUP BY s.`id`")->result_array();
    
        if (!empty($students)) {
            $gender = array('m' => 'Male', 'f' => 'Female');
            foreach ($students as $student) {
                ?>
                <tr>
                    <td class="patient-img sorting_1">
                        <img src="<?php echo site_url("/assets/uploads/profile_pictures/" . $student['photo_path']); ?>" alt="">
                    </td>
                    <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
                    <td><?php echo $gender[$student['gender']]; ?></td>
                    <td><?php echo $student['venue_name']; ?></td>
                    <td><?php echo $student['contact_number']; ?></td>
                    <td class="actions">
                        <a href="<?php echo site_url("/admin/child-management/child-details/" . encrypt_decrypt('encrypt', $student['id'])); ?>" class="" data-toggle="tooltip" title="Info">
                            <i class="material-icons f-left">info</i>
                        </a>
                        <a href="<?php echo site_url("/admin/child-management/delete-child/" . encrypt_decrypt('encrypt', $student['id'])); ?>" data-toggle="tooltip" title="Delete">
                            <i class="material-icons f-left">delete</i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
    }

    public function filter_students() {
        $club_id = $this->input->post('club_id');
        $program_id = $this->input->post('program_id');
        $level_id = $this->input->post('level_id');
        $child_id = $this->input->post('child_id');
        $where = '';
        if (!empty($club_id)) {
            $where .= " AND e.club_id='$club_id'";
        }
        if (!empty($program_id)) {
            $where .= " AND e.program_id='$program_id'";
        }
        if (!empty($level_id)) {
            $where .= " AND e.level_id='$level_id'";
        }
        $sessions = $this->db->query("SELECT 
                                        s.`session_name`,
                                        c.`club_name`,
                                        p.`program_name`,
                                        l.`level_name` 
                                            FROM
                                        `enrollments` e 
                                        INNER JOIN sessions s 
                                          ON e.`sesssion_id` = s.`id` 
                                        INNER JOIN `students` st 
                                          ON st.`id` = e.`child_id` 
                                        INNER JOIN `clubs` c 
                                          ON e.`club_id` = c.`id` 
                                        INNER JOIN `programs` p 
                                          ON e.`program_id` = p.`id` 
                                        INNER JOIN `levels` l 
                                          ON e.`level_id` = l.`id` 
                                          WHERE e.child_id='$child_id' $where")->result_array();

        echo $this->db->last_query();
        if (!empty($sessions)) {
            foreach ($sessions as $session) {
                ?>
                <tr>
                    <td><?= $session['session_name']; ?></td>
                    <td><?= $session['club_name']; ?></td>
                    <td><?= $session['program_name']; ?></td>
                    <td><?= $session['level_name']; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="6"><center><i>No Records Found</i></center></td></tr>
            <?php
        }
    }

    public function students() {
        $data['students'] = $this->db->query("SELECT 
                                                st.*,
                                                v.venue_name
                                              FROM
                                                `enrollments` e 
                                                INNER JOIN sessions s 
                                                  ON e.`sesssion_id` = s.`id` 
                                                INNER JOIN `students` st 
                                                  ON st.`id` = e.`child_id` 
                                                INNER JOIN `clubs` c 
                                                  ON e.`club_id` = c.`id` 
                                                  INNER JOIN `venues` v 
                                                  ON s.venue_id = v.id 
                                                INNER JOIN `programs` p 
                                                  ON e.`program_id` = p.`id` 
                                                INNER JOIN `levels` l 
                                                  ON e.`level_id` = l.`id` 
                                                INNER JOIN sessions_meta sm 
                                                  ON sm.`session_id` = s.`id` 
                                                INNER JOIN `staff` stf
                                                ON stf.`staff_id` = sm.`coach_id`
                                                GROUP BY sm.`coach_id`")->result_array();
        loadViewComponents('child_management/student_list', $data);
    }

    public function child_statistics($id = '') {
        $did = encrypt_decrypt('decrypt', $id);
        $data['student_id'] = $did;
        if ($this->input->method() == "post") {
            $data['strength'] = $this->input->post("strength");
            $data['strength'] = $this->input->post("strength");
            $data['development'] = $this->input->post("development");
            $data['comments'] = $this->input->post("comments");
            $this->db->insert("statistics", $data);
            $this->session->set_flashdata("popup", "Updated Statistics");
            redirect_to('/admin/child_management/students');
        } else {
            $data['child_data'] = $this->db->query("SELECT * FROM statistics WHERE student_id='$did'")->row_array();
            loadViewComponents('child_management/statistics', $data);
        }
    }

    public function update_child_review() {
        $id = $this->input->post('child_id');
        $did = encrypt_decrypt('encrypt', $id);
        $data['student_id'] = $id;
        if (!empty($this->input->post("strength")))
            $data['strength'] = $this->input->post("strength");

        if (!empty($this->input->post("development")))
            $data['development'] = $this->input->post("development");
        if (!empty($this->input->post("comments")))
            $data['comments'] = $this->input->post("comments");

        $data['n1'] = $this->input->post("n1");
        $data['n2'] = $this->input->post("n2");
        $data['n3'] = $this->input->post("n3");
        $data['n4'] = $this->input->post("n4");
        $data['n5'] = $this->input->post("n5");
        $data['n6'] = $this->input->post("n6");
        $data['n7'] = $this->input->post("n7");
        $data['n8'] = $this->input->post("n8");
        $data['n9'] = $this->input->post("n9");
        $data['n10'] = $this->input->post("n10");
        $this->db->update("statistics", $data, array('id' => '1'));
        $this->session->set_flashdata("popup", "Updated Statistics");
        redirect_to('/admin/child-management/child-details/' . $did);
    }

    public function edit_child($id) {
        $did = encrypt_decrypt('decrypt', $id);
        $data['child_id'] = $did;
        $data['venues'] = $this->db->query("SELECT * FROM venues")->result_array();
        $data['students'] = $this->db->query("SELECT * FROM students WHERE id='$did'")->row_array();
        loadViewComponents('child_management/edit_child', $data);
    }

    public function update_child() {

        $child_id = $this->input->post("child_id");
        $data['firstname'] = $this->input->post("firstname");
        $data['lastname'] = $this->input->post("lastname");
        $data['date_of_birth'] = $this->input->post("dob");
        $data['venue_id'] = $this->input->post("school_name");
        $data['contact_number'] = $this->input->post("contact_no");
        $data['gender'] = $this->input->post("gender");
        $data['medical_condition_active'] = $this->input->post("medical");
        $data['photography_allowed'] = $this->input->post("photograph");
        $data['medical_condition_note'] = $this->input->post("note");
        $config['upload_path'] = './assets/uploads/profile_pictures/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if (!empty($_FILES['userfile'])) {
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $datas = array('upload_data' => $this->upload->data());
                $data['photo_path'] = $datas['upload_data']['file_name'];
            }
        }

        $this->db->update('students', $data, array('id' => $child_id));
        $this->session->set_flashdata("popup", "Child has been update Successfully");
        redirect_to('/admin/child-management');
    }

    public function collect_statistics(){

       $this->db->query("SELECT 
                            * 
                          FROM
                            `statistics` en 
                            INNER JOIN `terms` t 
                              ON t.`id` = en.`term_id` 
                            INNER JOIN `clubs` c 
                              ON c.`id` = en.`club_id` 
                            INNER JOIN `students` s 
                              ON s.`id` = en.`student_id` ");
    }

}
