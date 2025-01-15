<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment_management extends MY_Controller {

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
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['assessments'] = $this->db->query("SELECT 
          asse.`id`,
          v.`venue_name`,
          v.`short_code`,
          c.`club_name`,
          t.`term_name`,
          p.`program_name`,
          asse.`day`,
          asse.`date`,
          asse.`start_time`,
          asse.`end_time`,
          asse.`club_id`,
          asse.`session_type` 
          FROM
          `assessment` asse 
          INNER JOIN terms t 
          ON t.`id` = asse.`term_id` 
          INNER JOIN `clubs` c 
          ON c.`id` = asse.`club_id` 
          LEFT JOIN `programs` p 
          ON p.`id` = asse.`program_id` 
          INNER JOIN `venues` v 
          ON v.`id` = asse.`venue_id` 
          WHERE asse.ass_type = '1' 
          GROUP BY asse.id")->result_array();
        self::loadComponents('assesment_management/assessments', $data);
    }

    public function add_assessment() {
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['childs'] = $this->admin_manager->SelectByID("users", 'role', '6');
        $data['clubs'] = $this->admin_manager->SelectAll("clubs");
        $data['terms'] = $this->admin_manager->SelectAll("terms");
        $data['programs'] = $this->admin_manager->SelectAll("programs");
        $data['days'] = returnDays(array('format' => 'dropdown'));
        self::loadComponents('assesment_management/add_assessments', $data);
    }

    public function makeup_assessment() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['assessments'] = $this->db->query("SELECT 
          asse.`id`,
          msm.`start_time`,
          msm.`end_time`,
          v.`venue_name`,
          v.`short_code`,
          msm.`venue_type`,
          c.`club_name`,
          t.`term_name`,
          msm.`day` 
          FROM
          `makeup_sessions` asse 
          INNER JOIN `makeup_sessions_meta` msm 
          ON asse.`id` = msm.`makeup_id` 
          INNER JOIN `venues` v 
          ON v.`id` = msm.`venue_id` 
          INNER JOIN `clubs` c 
          ON c.`id` = asse.`club_id` 
          INNER JOIN `terms` t 
          ON t.`id` = asse.`term_id` GROUP BY asse.`id` ")->result_array();
        self::loadComponents('assesment_management/makeup_assessments', $data);
//        self::loadComponents('assesment_management/makeup_assessments', $data);
    }

    public function add_makeup_assessment() {
        $data['childs'] = $this->admin_manager->SelectByID("users", 'role', '6');
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = $this->admin_manager->SelectAll("clubs");
        $data['terms'] = $this->admin_manager->SelectAll("terms");
        $data['programs'] = $this->admin_manager->SelectAll("programs");
        $data['levels'] = $this->admin_manager->SelectAll("levels");
        $data['days'] = returnDays(array('format' => 'dropdown'));
        self::loadComponents('assesment_management/add_makeup_assessment', $data);
    }

    public function find_dates() {
        $days = ["", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $terms = $this->input->post('terms');
        $getDate = $this->admin_manager->SelectByID("terms", 'id', $terms, 'ROW_A');
        $start_month = $getDate['start_month'];
        $end_month = $getDate['end_month'];
        $day = $this->input->post('days');
        $day = $days[$this->input->post('days')];
        $start_date = strtotime($start_month);
        $end_date = strtotime($end_month);
        $next = 'next ' . $day;
        while (1) {
            $start_date = strtotime($next, $start_date);
            if ($start_date > $end_date)
                break;
            echo "<a href='#' class='yellow_box' data-date='" . date("d M", $start_date) . "'>" . date("d M", $start_date) . "</a>";
        }
        echo "<input type='hidden' id='select_date' name='select_date' value=''/>";
    }

    public function find_All_dates() {
        $terms = $this->input->post('terms');
        $getDate = $this->admin_manager->SelectByID("terms", 'id', $terms, 'ROW_A');
        $start_month = $getDate['start_month'];
        $end_month = $getDate['end_month'];
        $day = $this->input->post('days');

        $start_date = strtotime($start_month);
        $end_date = strtotime($end_month);
        for ($i = $start_date; $i <= $end_date; $i+=86400) {
            echo "<a href='#' class='yellow_box'>" . date("d M", $i) . "</a>";
        }
        echo "<input type='hidden' id='select_date' name='select_date' value=''/>";
    }

    public function save_assessment() {
        $assessments = $this->input->post();
        $days = ["", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $select_dates = $this->input->post('select_dates');
        $data = array();
        if (!empty($select_dates)) {
            for ($i = 0; $i < count($select_dates); $i++) {
                $multidates = explode(",", $select_dates[$i]);
                foreach ($multidates as $multidate) {
                    foreach ($assessments['venues'] as $key => $assessment) {
                        $data = array(
                            'venue_id' => $assessment,
                            'club_id' => $assessments['clubez'][$key],
                            'term_id' => $assessments['termsz'][$key],
                            'date' => $multidate,
                            'start_time' => $assessments['start_times'][$key],
                            'end_time' => $assessments['end_times'][$key],
                            'day' => $days[$assessments['select_day']],
                            'capacity' => $assessments['capacities'][$key],
                            'ass_type' => '1',
                        );
                        if ($assessments['clubez'][$key] == "5") {
                            $data['session_type'] = $assessments['programs'][$key];
                        } else {
                            $data['program_id'] = $assessments['programs'][$key];
                        }
                        $this->db->insert("assessment", $data);
                    }
                }
            }
            $this->session->set_flashdata("popup", "Assessments Added Successfully!");
        }
        redirect_to('/admin/assessment-management/');
    }

    public function save_makeup_assessment() {
        $assessments = $this->input->post();
        $last_id='';
        if (!empty($assessments)) {
            $data = array(
                'club_id' => $assessments['clubs'],
                'term_id' => $assessments['terms'],
                'level_id' => $assessments['level'],
                'program_id' => $assessments['program'],
            );

            $this->db->insert('makeup_sessions', $data);
            $last_id = $this->db->insert_id();
        }

        if (!empty($last_id)) {
            if(!empty($assessments['venues'])){
                foreach ($assessments['venues'] as $key => $assessment) {
                    $data = array(
                        'makeup_id'=>$last_id,
                        'venue_type'=>'1',
                        'venue_id' => $assessment,
                        'date' => $assessments['select_dates'][$key],
                        'day_id' => $assessments['first_day'],
                        'day' => $assessments['first_day_text'][$key],
                        'start_time' => $assessments['start_times'][$key],
                        'end_time' => $assessments['end_times'][$key],
                        'capacity' => $assessments['capacities1'][$key],
                    );
                    $this->db->insert('makeup_sessions_meta', $data);
                }
            }
        }

        if (!empty($last_id)) {
            if (!empty($assessments['venues_two'])) {
                foreach ($assessments['venues_two'] as $key => $assessment) {
                    $data = array(
                        'makeup_id'=>$last_id,
                        'venue_type'=>'2',
                        'venue_id' => $assessment,
                        'date' => $assessments['select_dates_two'][$key],
                        'day_id' => $assessments['second_day'],
                        'day' => $assessments['second_days_text'][$key],
                        'start_time' => $assessments['start_times_two'][$key],
                        'end_time' => $assessments['end_times_two'][$key],
                        'capacity' => $assessments['capacities2'][$key],
                    );
                    $this->db->insert('makeup_sessions_meta',$data);
                }

            }
        }
        $this->session->set_flashdata("popup", "Assessments Added Successfully!");
        redirect_to('/admin/assessment-management/makeup-assessment/');
    }

    public function delete_assessment($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $this->admin_manager->Delete('assessment', 'id', $id);
        redirect_to('admin/assessment-management');
    }

    public function delete_makeup_assessment($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $this->admin_manager->Delete('makeup_sessions', 'id', $id);
        redirect_to('admin/assessment-management/makeup-assessment/');
    }

    public function delete_makeup() {
        $id = $this->input->post("id");
        $this->admin_manager->Delete('makeup_sessions_meta', 'id', $id);
    }

    public function filter_assessment() {
        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $venue_id = $this->input->post('venue_id');
        $day = $this->input->post('day');
        $where = '';
        if (!empty($term_id)) {
            $where .= " AND asse.term_id='$term_id'";
        }
        if (!empty($club_id)) {
            $where .= " AND asse.club_id='$club_id'";
        }

        if (!empty($venue_id)) {
            $where .= " AND asse.venue_id='$venue_id'";
        }

        if (!empty($day)) {
            $where .= " AND asse.day='$day'";
        }

        $assessments = $this->admin_manager->SelectAllQuery("SELECT 
            asse.`id`,
            v.`venue_name`,
            v.`short_code`,
            c.`club_name`,
            t.`term_name`,
            p.`program_name`,
            asse.`day`,
            asse.`date`,
            asse.`start_time`,
            asse.`end_time` 
            FROM
            `assessment` asse 
            INNER JOIN terms t 
            ON t.`id` = asse.`term_id` 
            INNER JOIN `clubs` c 
            ON c.`id` = asse.`club_id` 
            INNER JOIN `programs` p 
            ON p.`id` = asse.`program_id` 
            INNER JOIN `venues` v 
            ON v.`id` = asse.`venue_id` 
            WHERE asse.ass_type = '1' 
            $where
            GROUP BY asse.id ", 'ARRAY');

        if (!empty($assessments)) {
            foreach ($assessments as $assessment) {
                ?>
                <tr>
                    <td><?php echo $assessment['short_code']; ?></td>
                    <td><?php echo $assessment['club_name']; ?></td>
                    <td><?php echo $assessment['program_name']; ?></td>
                    <td><?php echo $assessment['term_name']; ?></td>
                    <td><?php echo $assessment['date']; ?></td>
                    <td><?php echo $assessment['day']; ?></td>
                    <td><?php echo $assessment['start_time'] . "-" . $assessment['end_time']; ?></td>
                    <td class="actions">
                        <a href="<?php print_url('/admin/assessment-management/edit_assessment/' . encrypt_decrypt('encrypt', $assessment['id'])); ?>" title="Edit">
                            <i class="material-icons f-left">edit</i>
                        </a>
                        <a href="#myModal" class="delete_me" data-url="<?php print_url('/admin/assessment-management/delete_assessment/' . encrypt_decrypt('encrypt', $assessment['id'])); ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
                            <i class="material-icons f-left">delete</i>
                        </a>
                    </td>

                </tr>

                <?php
            }
        }
    }

    public function filter_assessment_makeup() {
        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $venue_id = $this->input->post('venue_id');
        $day = $this->input->post('day');
        $where = '';
        if (!empty($term_id)) {
            $where .= " AND asse.term_id='$term_id'";
        }
        if (!empty($club_id)) {
            $where .= " AND asse.club_id='$club_id'";
        }
        if (!empty($venue_id)) {
            $where .= " AND asse.venue_id='$venue_id'";
        }
        if (!empty($day)) {
            $where .= " AND asse.day='$day'";
        }
        $assessments = $this->admin_manager->SelectAllQuery("SELECT 
            asse.`id`,
            v.`venue_name`,
            v.`short_code`,
            c.`club_name`,
            t.`term_name`,
            p.`program_name`,
            asse.`day`,
            asse.`start_time`,
            asse.`end_time` 
            FROM
            `assessment` asse 
            INNER JOIN terms t 
            ON t.`id` = asse.`term_id` 
            INNER JOIN `clubs` c 
            ON c.`id` = asse.`club_id` 
            INNER JOIN `programs` p 
            ON p.`id` = asse.`program_id` 
            INNER JOIN `venues` v 
            ON v.`id` = asse.`venue_id` 
            WHERE asse.ass_type = '2' 
            $where
            GROUP BY asse.id ", 'ARRAY');

        if (!empty($assessments)) {
            foreach ($assessments as $assessment) {
                $assessment_id = $assessment['id'];
                ?>
                <tr>
                    <td><?php echo $assessment['venue_name']; ?></td>
                    <td><?php echo $assessment['club_name']; ?></td>
                    <td><?php echo $assessment['term_name']; ?></td>
                    <td><?php echo $assessment['program_name']; ?></td>
                    <td><?php echo $assessment['start_time'] . "-" . $assessment['end_time']; ?></td>
                    <td>
                        <a href="#myModal" class="delete_me" data-url="<?php print_url('/admin/assessment-management/delete_makeup_assessment/' . encrypt_decrypt('encrypt', $assessment_id)); ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
                            <i class="material-icons f-left">delete</i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
    }

    public function edit_assessment($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['assessement_id'] = $id;
        $data['assessments'] = $this->db->query("SELECT 
            v.`venue_name`,
            v.`short_code`,
            c.`club_name`,
            t.`term_name`,
            p.`program_name`,
            ass.* 
            FROM
            `assessment` ass 
            INNER JOIN `venues` v 
            ON v.`id` = ass.`venue_id` 
            INNER JOIN `clubs` c 
            ON c.`id` = ass.`club_id` 
            INNER JOIN `terms` t 
            ON t.`id` = ass.`term_id` 
            INNER JOIN `programs` p 
            ON p.`id` = ass.`program_id` 
            WHERE ass.`id`='$id'")->row_array();
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'), $data['assessments']['venue_id']);
        $data['childs'] = $this->admin_manager->SelectByID("users", 'role', '6');
        $data['clubs'] = $this->admin_manager->SelectAll("clubs");
        $data['terms'] = $this->admin_manager->SelectAll("terms");
        $data['programs'] = $this->admin_manager->SelectAll("programs");
        $data['days'] = returnDays(array('format' => 'dropdown'));

        self::loadComponents('assesment_management/edit_assessments', $data);
    }

    public function update_assessment() {
        $assessement_id = $this->input->post('assessement_id');

        $data = array(
            'venue_id' => $this->input->post('venues'),
            'club_id' => $this->input->post('clubez'),
            'term_id' => $this->input->post('termsz'),
            'date' => $this->input->post('select_dates'),
            'start_time' => $this->input->post('start_times'),
            'end_time' => $this->input->post('end_times'),
            'day' => $this->input->post('select_day'),
            'capacity' => $this->input->post('capacities'),
            'ass_type' => '1',
        );
        if ($this->input->post('clubez') == "5") {
            $data['session_type'] = $this->input->post('programs');
        } else {
            $data['program_id'] = $this->input->post('programs');
        }
        $this->db->update("assessment", $data, array("id" => $assessement_id));
        $this->session->set_flashdata("popup", "Assessments Updated Successfully!");
        redirect_to('/admin/assessment-management/');
    }

    public function edit_makeup_assessment($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['makeup'] = $this->db->query("SELECT * FROM makeup_sessions WHERE id='$id'")->row_array();
        $data['days'] = returnDays(array('format' => 'dropdown'));
        $data['makeup_id'] = $id;
        $data['assessments_first_makeup'] = $this->db->query("SELECT 
          asse.`id`,
          msm.`meta_id`,
          msm.`start_time`,
          msm.`end_time`,
          v.`venue_name`,
          v.`short_code`,
          msm.`venue_type`,
          c.`club_name`,
          t.`term_name`,
          msm.`day`,
          p.`program_name`
          FROM
          `makeup_sessions` asse 
          INNER JOIN `makeup_sessions_meta` msm 
          ON asse.`id` = msm.`makeup_id` 
          INNER JOIN `venues` v 
          ON v.`id` = msm.`venue_id`  
          INNER JOIN `clubs` c 
          ON c.`id` = asse.`club_id` 
          INNER JOIN `programs` p 
          ON p.`id` = asse.`program_id` 
          INNER JOIN `terms` t 
          ON t.`id` = asse.`term_id` 
          WHERE asse.`id`='$id' AND msm.`venue_type`='1'")->result_array();


        $data['assessments_second_makeup'] = $this->db->query("SELECT 
          asse.`id`,
          msm.`meta_id`,
          msm.`start_time`,
          msm.`end_time`,
          v.`venue_name`,
          v.`short_code`,
          msm.`venue_type`,
          c.`club_name`,
          t.`term_name`,
          msm.`day`,
          p.`program_name`
          FROM
          `makeup_sessions` asse 
          INNER JOIN `makeup_sessions_meta` msm 
          ON asse.`id` = msm.`makeup_id` 
          INNER JOIN `venues` v 
          ON v.`id` = msm.`venue_id`  
          INNER JOIN `clubs` c 
          ON c.`id` = asse.`club_id` 
          INNER JOIN `programs` p 
          ON p.`id` = asse.`program_id` 
          INNER JOIN `terms` t 
          ON t.`id` = asse.`term_id` 
          WHERE asse.`id`='$id' AND msm.`venue_type`='2'

          ")->result_array();
        
        $data['childs'] = $this->admin_manager->SelectByID("users", 'role', '6');
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = $this->admin_manager->SelectAll("clubs");
        $data['terms'] = $this->admin_manager->SelectAll("terms");
        $data['programs'] = $this->admin_manager->SelectAll("programs");
        $data['levels'] = $this->admin_manager->SelectAll("levels");
        $data['childs'] = $this->admin_manager->SelectByID("users", 'role', '6');
        $data['clubs'] = $this->admin_manager->SelectAll("clubs");
        $data['terms'] = $this->admin_manager->SelectAll("terms");
        $data['programs'] = $this->admin_manager->SelectAll("programs");
        $data['days'] = returnDays(array('format' => 'dropdown'));
        self::loadComponents('assesment_management/edit_makeup_assessment', $data);
    }

    public function update_makeup_assessment() {
        $assessments = $this->input->post();

        $makeup_id = $this->input->post('makeup_id');
        if (!empty($makeup_id)) {
            if(!empty($assessments['venues'])){
                foreach ($assessments['venues'] as $key => $assessment) {
                    $data = array(
                        'makeup_id'=>$makeup_id,
                        'venue_type'=>'1',
                        'venue_id' => $assessment,
                        'date' => $assessments['select_dates'][$key],
                        'day_id' => $assessments['first_day'],
                        'day' => $assessments['first_day_text'][$key],
                        'start_time' => $assessments['start_times'][$key],
                        'end_time' => $assessments['end_times'][$key],
                        'capacity' => $assessments['capacities1'][$key],
                    );
                    $this->db->insert('makeup_sessions_meta', $data);
                }
            }
        }

        if (!empty($makeup_id)) {
            if (!empty($assessments['venues_two'])) {
                foreach ($assessments['venues_two'] as $key => $assessment) {
                    $data = array(
                        'makeup_id'=>$makeup_id,
                        'venue_type'=>'2',
                        'venue_id' => $assessment,
                        'date' => $assessments['select_dates_two'][$key],
                        'day_id' => $assessments['second_day'],
                        'day' => $assessments['second_days_text'][$key],
                        'start_time' => $assessments['start_times_two'][$key],
                        'end_time' => $assessments['end_times_two'][$key],
                        'capacity' => $assessments['capacities2'][$key],
                    );
                    $this->db->insert('makeup_sessions_meta',$data);
                }

            }
        }
        $this->session->set_flashdata("popup", "Makeup Session Updated Successfully!");
        redirect_to('/admin/assessment-management/makeup-assessment/');
    }

}
