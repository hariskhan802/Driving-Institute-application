<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_management extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['by_venues'] = returnVenues(array('keys' => 'id, venue_name'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['Coaches'] = returnCoaches(array('format' => 'dropdown'), $this->input->get('coaches'));
        // $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['days'] = $this->db->query("SELECT * FROM days")->result_array();
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['childs'] = $this->db->query("SELECT * FROM students")->result_array();
        $data['session_time'] = $this->db->query("SELECT start_time,end_time,meta_id FROM sessions_meta")->result_array();
        loadViewComponents('attendance_management/attendance_list', $data);
    }

    public function find_date($find_day = '', $termID = '', $selected_date = '') {
        $days = ["", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $terms = (!empty($termID)) ? $termID : $this->input->post('terms');
        $getDate = $this->admin_manager->SelectByID("terms", 'id', $terms, 'ROW_A');
        $start_month = $getDate['start_month'];
        $end_month = $getDate['end_month'];
        $checkDay = (!empty($find_day)) ? $find_day : $this->input->post('days');
        $day = $days[$checkDay];
        $start_date = strtotime($start_month);
        $end_date = strtotime($end_month);
        $next = 'next ' . $day;
        while (1) {
            $start_date = strtotime($next, $start_date);
            if ($start_date >= $end_date)
                break;
            $wisedate = date("d-m", $start_date);
            $cdate = date("d M", $start_date);
            $selected = ($cdate == $selected_date) ? "active_box" : "";
            echo "<a href='#' class='yellow_box $selected'>" . date("d M", $start_date) . "</a>";
        }
        echo "<input type='hidden' id='select_date' name='select_date' value='$selected_date'/>";
    }

    public function save_attendance() {
        $term_id = $this->input->post("term_id");
        $select_date = $this->input->post("select_date");
        $child_id = $this->input->post("child_id");
        $venue_id = $this->input->post("venue_id");
        $club_id = $this->input->post("club_id");
        $program_id = $this->input->post("program_id");
        $level_id = $this->input->post("level_id");
        $day_id = $this->input->post("day_id");
        $coach_id = $this->input->post("coach_id");

        $data = array(
            'term_id' => $term_id,
            'venue_id' => $venue_id,
            'club_id' => $club_id,
            'program_id' => $program_id,
            'level_id' => $level_id,
            'day_id' => $day_id,
            'coach_id' => $coach_id,
            'child_id' => $child_id,
            'date' => $select_date,
        );
        $compare = $this->admin_manager->CompareColumns("attendance", $data);
        if (empty($compare)) {
            $this->db->insert("attendance", $data);
            echo "1";
        } else {
            echo "0";
        }
    }

    public function student_attendance() {
        $data["attendances"] = $this->db->query("SELECT 
            a.`id`,
            t.`term_name`,
            v.`venue_name`,
            c.`club_name`,
            p.`program_name`,
            l.`level_name`,
            d.`day_name`,
            u.`username` AS coach_name,
            CONCAT(s.`firstname`,' ', s.`lastname`) AS child_name 
            FROM
            `attendance` a 
            INNER JOIN `terms` t 
            ON t.`id` = a.`term_id` 
            INNER JOIN `venues` v 
            ON v.`id` = a.`venue_id` 
            INNER JOIN `clubs` c 
            ON c.`id` = a.`club_id` 
            INNER JOIN `programs` p 
            ON p.`id` = a.`program_id` 
            INNER JOIN `levels` l 
            ON p.`id` = a.`program_id` 
            INNER JOIN `days` d 
            ON d.`id` = a.`day_id` 
            INNER JOIN `students` s 
            ON s.`id` = a.`child_id` 
            INNER JOIN users u 
            ON u.`id` = a.`coach_id` 
            GROUP BY a.`id`
            ")->result_array();
        loadViewComponents('attendance_management/student_attendance', $data);
    }

    public function manage_attendance() {
        $attendance_id = $this->input->post("id");
        $attendances = $this->db->query("SELECT * FROM attendance WHERE id='$attendance_id'")->row_array();
        $terms = $this->db->query("SELECT * FROM terms")->result_array();
        $clubs = $this->db->query("SELECT * FROM clubs")->result_array();
        $venues = $this->db->query("SELECT * FROM venues")->result_array();
        $programs = $this->db->query("SELECT * FROM programs")->result_array();
        $levels = $this->db->query("SELECT * FROM levels")->result_array();
        $days = $this->db->query("SELECT * FROM days")->result_array();
        $childs = $this->db->query("SELECT * FROM students")->result_array();
        $coachs = $this->db->query("SELECT * FROM users")->result_array();
        ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Child</label>
                <select class="form-control" id="child_id" name="child_id">
                    <?php
                    if (!empty($childs)) {
                        foreach ($childs as $child) {
                            $select = ($child['id'] == $attendances['child_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $child['id'] . "' $select>" . $child['firstname'] . " " . $child['lastname'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Coach</label>
                <select class="form-control" id="coach_id" name="coach_id">
                    <?php
                    if (!empty($coachs)) {
                        foreach ($coachs as $coach) {
                            $select = ($coach['id'] == $attendances['coach_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $coach['id'] . "' $select>" . $coach['username'] . "</option>";
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Term</label>
                <select class="form-control" id="term_id"  name="term_id">
                    <?php
                    if (!empty($terms)) {
                        foreach ($terms as $term) {
                            $select = ($term['id'] == $attendances['term_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $term['id'] . "' $select>" . $term['term_name'] . "</option>";
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Club</label>
                <select class="form-control" id="club_id" name="club_id">
                    <?php
                    if (!empty($clubs)) {
                        foreach ($clubs as $club) {
                            $select = ($club['id'] == $attendances['club_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $club['id'] . "' $select>" . $club['club_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Programme</label>
                <select class="form-control" id="program_id" name="program_id">
                    <?php
                    if (!empty($programs)) {
                        foreach ($programs as $program) {
                            $select = ($program['id'] == $attendances['program_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $program['id'] . "' $select>" . $program['program_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Venue</label>
                <select class="form-control" id="venue_id" name="venue_id">
                    <?php
                    if (!empty($venues)) {
                        foreach ($venues as $venue) {
                            $select = ($venue['id'] == $attendances['venue_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $venue['id'] . "' $select>" . $venue['venue_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Level</label>
                <select class="form-control" id="level_id" name="level_id">
                    <?php
                    if (!empty($levels)) {
                        foreach ($levels as $level) {
                            $select = ($level['id'] == $attendances['level_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $level['id'] . "' $select>" . $level['level_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <label>Select Day</label>
                <select class="form-control" id="day_id" name="day_id">
                    <?php
                    if (!empty($days)) {
                        foreach ($days as $day) {
                            $select = ($day['id'] == $attendances['day_id']) ? "selected='selected'" : "";
                            echo "<option value='" . $day['id'] . "' $select>" . $day['day_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="clear clearfix"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">&nbsp;</div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="gap"></div>
                <label>Select Date</label><br/>
                <?php $this->find_date($attendances['day_id'], $attendances['term_id'], $attendances['date']); ?>
            </div>


        </div>
        <?php
    }

    public function update_attendance() {
        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $venue_id = $this->input->post('venue_id');
        $level_id = $this->input->post('level_id');
        $program_id = $this->input->post('program_id');
        $coach_id = $this->input->post('coach_id');
        $child_id = $this->input->post('child_id');
        $day_id = $this->input->post('day_id');
        $select_date = $this->input->post('select_date');
        $attend_id = $this->input->post('attend_id');

        $data = array(
            'term_id' => $term_id,
            'club_id' => $club_id,
            'venue_id' => $venue_id,
            'level_id' => $level_id,
            'program_id' => $program_id,
            'coach_id' => $coach_id,
            'child_id' => $child_id,
            'day_id' => $day_id,
            'date' => $select_date,
        );

        $this->admin_manager->Update("attendance", $data, array('id' => $attend_id));
        echo '<div class="alert alert-success  in alert-dismissible" style="margin-top:18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> Attendance has been successfully update!
        </div>';
    }

    public function get_time() {
        $day_id = $this->input->post("day_id");
        $options = $this->db->query("SELECT * FROM sessions_meta WHERE day_id='$day_id'")->result_array();
        $optionx = '<option value="">Select Time</option>';
        if (!empty($options)) {
            foreach ($options as $option) {
                $optionx .= '<option value="' . $option['start_time'] . " - " . $option['end_time'] . '">' . $option['start_time'] . " - " . $option['end_time'] . '</option>';
            }
            echo $optionx;
        }
    }
    
    public function mark_attendance(){
        $data['venue_id'] = $this->input->post("venue_id");
        $data['coach_id'] = $this->input->post("coach_id");
        $data['end_time'] = $this->input->post("end_time");
        $data['child_id'] = $this->input->post("child_id");
        $data['day_id'] = $this->input->post("day_id");
        $data['start_time'] = $this->input->post("start_time");
        $check  = $this->admin_manager->CompareColumns('attendance', $data,'ARRAY');
        if(!empty($check)){
            echo "Attendance already marked";
        }else{
            $this->db->insert("attendance",$data);
            echo "Attendance has been marked successfully";
        }
    }

     public function delete_attendance(){
        $data['venue_id'] = $this->input->post("venue_id");
        $data['coach_id'] = $this->input->post("coach_id");
        $data['end_time'] = $this->input->post("end_time");
        $data['child_id'] = $this->input->post("child_id");
        $data['day_id'] = $this->input->post("day_id");
        $data['start_time'] = $this->input->post("start_time");
        $check  = $this->admin_manager->DeleteMultiple('attendance', $data);
        echo "Attendance successfully deleted";
    }

}
