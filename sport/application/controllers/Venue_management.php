<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venue_management extends MY_Controller {

    function __construct() {
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
        $data['venues'] = $this->db->query("SELECT * FROM venues ORDER BY id DESC")->result();

        self::loadComponents('venue_management/venue-management', $data);
    }

    public function add_venue() {
        self::loadComponents('venue_management/add_venue');
    }

    public function edit_venue($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['venue_id'] = $id;
        $data['venue_hours'] = $this->db->query("SELECT * FROM venue_hours WHERE venue_id='$id'")->result_array();
        $data['school_hours'] = $this->db->query("SELECT * FROM venue_timing_school_hours WHERE venue_id='$id'")->result_array();
        $data['msa_access_hours'] = $this->db->query("SELECT * FROM venue_timing_msa_access_hours WHERE venue_id='$id'")->result_array();
        $data['venue_facilities'] = $this->db->query("SELECT * FROM venue_facilities WHERE venue_id='$id'")->result_array();
        $data['venues'] = $this->admin_manager->SelectByID('venues', 'id', $id, 'ROW_A');
        self::loadComponents('venue_management/edit_venue', $data);
    }

    public function save_venue() {
        $venue = array(
            'venue_name' => $this->input->post('venue_name'),
            'short_code' => $this->input->post('venue_short_code'),
            'located_in' => $this->input->post('located_in'),
            'google_map_url' => $this->input->post('venue_map'),
            'c_code' => $this->input->post('code'),
            'contact_number' => $this->input->post('venue_contact'),
            'email' => $this->input->post('venue_email'),
            'additional_description' => $this->input->post('venue_description'),
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
                $venue['photo_path'] = $data['upload_data']['file_name'];
            }
        }
        $this->admin_manager->Insert('venues', $venue);
        $insert_id = $this->db->insert_id();
        $venue_start_time = $this->input->post('venue_starts_time');
        $venue_end_time = $this->input->post('venue_ends_time');

        if (!empty($venue_start_time)) {
            foreach ($venue_start_time as $key => $school_time) {
                $schoolTime = array(
                    'venue_id' => $insert_id,
                    'start_time' => $school_time,
                    'end_time' => $venue_end_time[$key],
                );
                $this->admin_manager->Insert('venue_hours', $schoolTime);
            }
        }


        if (!empty($this->input->post('school_starts_time'))) {
            foreach ($this->input->post('school_starts_time') as $key => $school_time) {
                $schoolTime = array(
                    'venue_id' => $insert_id,
                    'year_group_name' => $this->input->post('years_groups')[$key],
                    'start_time' => $school_time,
                    'end_time' => $this->input->post('school_ends_time')[$key],
                );
                $this->admin_manager->Insert('venue_timing_school_hours', $schoolTime);
            }
        }

        if (!empty($this->input->post('msa_selectday'))) {
            foreach ($this->input->post('msa_selectday') as $key => $msa_selectday) {
                $schoolTime = array(
                    'venue_id' => $insert_id,
                    'day_id' => $msa_selectday,
                    'category' => $this->input->post('msa_category')[$key],
                    'start_time' => $this->input->post('msa_start_time')[$key],
                    'end_time' => $this->input->post('msa_ends_time')[$key],
                );
                $this->admin_manager->Insert('venue_timing_msa_access_hours', $schoolTime);
            }
        }


        if (!empty($this->input->post('departments'))) {
            foreach ($this->input->post('departments') as $key => $value) {
                $facilities = array(
                    'venue_id' => $insert_id,
                    'status' => $this->input->post('statuses')[$key],
                    'facility_id' => $this->input->post('departments')[$key],
                    'size' => $this->input->post('sizes')[$key],
                    'measurement' => $this->input->post('measure')[$key],
                    'features' => $this->input->post('featuress')[$key],
                    'rating' => $this->input->post('ratings')[$key],
                    'risk_assesment_active' => $this->input->post('risk_assessments')[$key],
                );
                $this->admin_manager->Insert('venue_facilities', $facilities);
            }
        }
        $this->session->set_flashdata("popup", "Venue Added Successfully!");
        redirect_to('/admin/venue-management');
    }

    public function edit_program($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $data['program'] = $this->admin_manager->SelectByID('programs', 'id', $id, 'ROW_A');
        $data['levels'] = $this->admin_manager->SelectByID('levels', 'program_id', $id, 'ARRAY');
        $data['program_session'] = $this->admin_manager->SelectByID('prog_child_sessions', 'program_id', $id, 'ARRAY');
        $this->loadComponents('program_management/edit-program', $data);
    }

    public function update_venue() {
        $venue_id = $this->input->post('venue_id');
        $venue = array(
            'venue_name' => $this->input->post('venue_name'),
            'short_code' => $this->input->post('venue_short_code'),
            'located_in' => $this->input->post('located_in'),
            'google_map_url' => $this->input->post('venue_map'),
            'c_code' => $this->input->post('code'),
            'contact_number' => $this->input->post('venue_contact'),
            'email' => $this->input->post('venue_email'),
            'additional_description' => $this->input->post('venue_description'),
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
                $venue['photo_path'] = $data['upload_data']['file_name'];
            }
        }

        // $this->admin_manager->Insert('venues', $venue);
        $this->admin_manager->Update('venues', $venue, array('id' => $venue_id));
        $venue_start_time = $this->input->post('venue_starts_time');
        $venue_end_time = $this->input->post('venue_ends_time');

        //Truncate venue_hours
        $this->db->truncate('venue_hours');

        if (!empty($venue_start_time)) {
            foreach ($venue_start_time as $key => $school_time) {
                $schoolTime = array(
                    'venue_id' => $venue_id,
                    'start_time' => $school_time,
                    'end_time' => $venue_end_time[$key],
                );
                $this->admin_manager->Insert('venue_hours', $schoolTime);
            }
        }

        //Truncate venue_timing_school_hours
        $this->db->truncate('venue_timing_school_hours');

        if (!empty($this->input->post('school_starts_time'))) {
            foreach ($this->input->post('school_starts_time') as $key => $school_time) {
                $schoolTime = array(
                    'venue_id' => $venue_id,
                    'year_group_name' => $this->input->post('years_groups')[$key],
                    'start_time' => $school_time,
                    'end_time' => $this->input->post('school_ends_time')[$key],
                );
                $this->admin_manager->Insert('venue_timing_school_hours', $schoolTime);
            }
        }

        //Truncate venue_timing_school_hours
        $this->db->truncate('venue_timing_msa_access_hours');
        if (!empty($this->input->post('msa_selectday'))) {
            foreach ($this->input->post('msa_selectday') as $key => $msa_selectday) {
                $schoolTime = array(
                    'venue_id' => $venue_id,
                    'day_id' => $msa_selectday,
                    'category' => $this->input->post('msa_category')[$key],
                    'start_time' => $this->input->post('msa_start_time')[$key],
                    'end_time' => $this->input->post('msa_ends_time')[$key],
                );
                $this->admin_manager->Insert('venue_timing_msa_access_hours', $schoolTime);
            }
        }

        //Truncate venue_facilities
        $this->db->truncate('venue_facilities');
        if (!empty($this->input->post('departments'))) {
            foreach ($this->input->post('departments') as $key => $value) {
                $facilities = array(
                    'venue_id' => $venue_id,
                    'status' => $this->input->post('statuses')[$key],
                    'facility_id' => $this->input->post('departments')[$key],
                    'size' => $this->input->post('sizes')[$key],
                    'measurement' => $this->input->post('measure')[$key],
                    'features' => $this->input->post('featuress')[$key],
                    'rating' => $this->input->post('ratings')[$key],
                    'risk_assesment_active' => $this->input->post('risk_assessments')[$key],
                );
                $this->admin_manager->Insert('venue_facilities', $facilities);
            }
        }
        $this->session->set_flashdata("popup", "Venue Updated Successfully!");
        redirect_to('/admin/venue-management/');
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

    public function delete_program($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $this->admin_manager->Delete('programs', 'id', $id);
        $this->admin_manager->Delete('levels', 'program_id', $id);
        $this->admin_manager->Delete('prog_child_sessions', 'id', $id);
        redirect_to('admin/program-management');
    }

    public function delete_venue($id) {
        deleteFnc('venues', $data = array('id' => encrypt_decrypt('decrypt', $id)));
        deleteFnc('venue_facilities', $data = array('venue_id' => encrypt_decrypt('decrypt', $id)));
        deleteFnc('venue_timing_msa_access_hours', $data = array('venue_id' => encrypt_decrypt('decrypt', $id)));
        deleteFnc('venue_timing_school_hours', $data = array('venue_id' => encrypt_decrypt('decrypt', $id)));
        redirect_to('/admin/venue-management/');
    }

    public function getVenue() {
        $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday");

        $categories = array("Venue", "Community");

        $Facility = array("Swimming Pool", "Astro - turf Pitch", "Grass Pitch", "Sports Hall", "Multi Purpose Court", "Athletics Track", "Gym", "Studio");

        $Status = array("Indoor", "Outdoor - Shaded", "Outdoor - Unshaded");

        $venue_id = $this->input->post("venue_id");
        $venue_db = $this->db->query("SELECT * FROM `venues` WHERE id='{$venue_id}'")->row_array();
        $table = '<div class="row">';
        $table .= '<div class="seprapte col-md-12">';
        $table .= '<h3>Venue Hours</h3>';
        $table .= '<table class="table">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th>ID</th>';
        $table .= '<th>Venue Start Time</th>';
        $table .= '<th>Venue End Time</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        $table .= '<tr>';
        $table .= '<td>' . $venue_db['id'] . '</td>';
        $table .= '<td>' . $venue_db['start_hours'] . '</td>';
        $table .= '<td>' . $venue_db['end_hours'] . '</td>';
        $table .= '</tr>';
        $table .= '</tbody>';
        $table .= '</table>';
        $table .= '</div>';
        // SCHOOL
        $school_dbs = $this->db->query("SELECT 
          vtsh.`year_group_name`,
          vtsh.`start_time`,
          vtsh.`end_time` 
          FROM
          `venues` v 
          LEFT JOIN `venue_timing_school_hours` vtsh 
          ON v.`id` = vtsh.`venue_id` 
          WHERE v.id = '6'")->result_array();

        $table .= '<div class="seprapte col-md-12">';
        $table .= '<h3>School Hours</h3>';
        $table .= '<table class="table">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th>Group Name</th>';
        $table .= '<th>School Start Time</th>';
        $table .= '<th>School End Time</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        foreach ($school_dbs as $school_db) {
            $table .= '<tr>';
            $table .= '<td>' . $school_db['year_group_name'] . '</td>';
            $table .= '<td>' . $school_db['start_time'] . '</td>';
            $table .= '<td>' . $school_db['end_time'] . '</td>';
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $table .= '</div>';

        // MSA HOURS
        $msa_dbs = $this->db->query("SELECT 
          vtmah.`day_id`,
          vtmah.`category`,
          vtmah.`start_time`,
          vtmah.`end_time` 
          FROM
          `venues` v 
          LEFT JOIN `venue_timing_msa_access_hours` vtmah 
          ON v.`id` = vtmah.`venue_id` 
          WHERE v.id = '6' ")->result_array();

        $table .= '<div class="seprapte col-md-12">';
        $table .= '<h3>MSA Hours</h3>';
        $table .= '<table class="table">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th>Day</th>';
        $table .= '<th>Category</th>';
        $table .= '<th>School Start Time</th>';
        $table .= '<th>School End Time</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        foreach ($msa_dbs as $msa_db) {
            $table .= '<tr>';
            $table .= '<td>' . $days[$msa_db['day_id']] . '</td>';
            $table .= '<td>' . $categories[$msa_db['category']] . '</td>';
            $table .= '<td>' . $msa_db['start_time'] . '</td>';
            $table .= '<td>' . $msa_db['end_time'] . '</td>';
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $table .= '</div>';

        // Facility
        $facility_dbs = $this->db->query("SELECT 
          vf.`facility_id`,
          vf.`status`,
          vf.`size`,
          vf.`features`,
          vf.`rating`,
          vf.`risk_assesment_active`
          FROM
          `venues` v 
          LEFT JOIN `venue_facilities` vf 
          ON v.`id` = vf.`venue_id` 
          WHERE v.id = '6' ")->result_array();

        $table .= '<div class="seprapte col-md-12">';
        $table .= '<table class="table">';
        $table .= '<h3>VENUE FACILITY</h3>';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th>Facility</th>';
        $table .= '<th>Status</th>';
        $table .= '<th>Size</th>';
        $table .= '<th>Features</th>';
        $table .= '<th>Rating</th>';
        $table .= '<th>Risk Active</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        foreach ($facility_dbs as $facility_db) {
            $table .= '<tr>';
            $table .= '<td>' . $facility_db['facility_id'] . '</td>';
            $table .= '<td>' . $facility_db['status'] . '</td>';
            $table .= '<td>' . $facility_db['size'] . '</td>';
            $table .= '<td>' . $facility_db['features'] . '</td>';
            $table .= '<td>' . $facility_db['rating'] . '</td>';
            $table .= '<td>' . $facility_db['risk_assesment_active'] . '</td>';
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $table .= '</div>';

        $table .= '</div>';
        echo $table;
    }

    public function venue_details($id) {
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['levels'] = returnLevels(array('keys' => 'id,program_id, level_name', 'format' => 'dropdown'));
        $data['venue_id'] = $id;
        $data['sessions'] = $this->db->query("SELECT 
          s.`session_name`,
          v.`venue_name`,
          c.`club_name`,
          p.`program_name`,
          l.`level_name`,
          sm.`day`,
          sm.`start_time`,
          sm.`end_time`,
          t.`term_name` 
          FROM
          `venues` v 
          INNER JOIN `sessions` s 
          ON s.`venue_id` = v.`id` 
          LEFT JOIN  sessions_meta sm
          ON s.`id`= sm.`session_id`
          INNER JOIN `clubs` c 
          ON s.`club_id` = c.`id` 
          INNER JOIN `terms` t 
          ON s.`term_id` = t.`id` 
          INNER JOIN `programs` p 
          ON s.`program_id` = p.`id` 
          INNER JOIN `levels` l 
          ON s.`level_id` = l.`id` 
          WHERE v.`id`='$id'")->result_array();

        $data['venues'] = $this->admin_manager->SelectByID('venues', 'id', $id, 'ROW_A');
        self::loadComponents('venue_management/venue_details', $data);
    }

    public function export_venue() {
        $data = $this->db->query("SELECT `venue_name`,`short_code`,`located_in`,`google_map_url`,`c_code`,`contact_number`,`email`,`additional_description` FROM venues")->result_array();
        $filename = "Venue_" . uniqid() . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $this->ExportFile($data);
    }

    public function ExportFile($records) {
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    // display field/column names as a first row
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        exit;
    }

    public function filter_venue() {
        $club_id = $this->input->post('club_id');
        $program_id = $this->input->post('program_id');
        $level_id = $this->input->post('level_id');
        $venue_id = $this->input->post('venue_id');
        $where = '';

        if (!empty($club_id)) {
            $where .= " AND s.club_id='$club_id'";
        }
        if (!empty($program_id)) {
            $where .= " AND s.program_id='$program_id'";
        }
        if (!empty($level_id)) {
            $where .= " AND s.level_id='$level_id'";
        }

        $sessions = $this->db->query("SELECT 
          s.`session_name`,
          v.`venue_name`,
          c.`club_name`,
          p.`program_name`,
          l.`level_name`
          FROM
          `venues` v 
          INNER JOIN `sessions` s 
          ON s.`venue_id` = v.`id` 
          INNER JOIN `clubs` c 
          ON s.`club_id` = c.`id` 
          INNER JOIN `programs` p 
          ON s.`program_id` = p.`id` 
          INNER JOIN `levels` l 
          ON s.`level_id` = l.`id` 
          WHERE v.`id`='$venue_id' $where")->result_array();
//        echo $this->db->last_query();
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

}
