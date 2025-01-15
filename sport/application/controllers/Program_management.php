<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_management extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    private function loadComponents($view, $data = array()) {
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

    public function index() {
        $data['programs'] = $this->db->query("SELECT 
  `programs`.*,
  `clubs`.`club_name`,
  GROUP_CONCAT(REPLACE(levels.`color`, ',', '|')) AS colors 
FROM
  `programs` 
  LEFT JOIN `clubs` 
    ON `programs`.`club_id` = `clubs`.`id` 
  LEFT JOIN `levels` 
    ON levels.`program_id` = programs.`id` 
GROUP BY programs.`id` 
ORDER BY programs.`id` DESC ")->result_array();
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));

        $this->loadComponents('program_management/program-management', $data);
    }

    public function create_program() {
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $this->loadComponents('program_management/program-creation', $data);
    }

    public function save_program() {
        $program = array(
            'program_name' => $this->input->post('program_name'),
            'club_id' => $this->input->post('club'),
            'cost_per_session' => $this->input->post('cost_per_session'),
            'annual_reg_fee' => $this->input->post('annual_reg_free'),
            'competition_fee' => $this->input->post('competition_fee'),
            'full_week_cost' => $this->input->post('full_week_cost'),
            'session_card_cost' => $this->input->post('session_card_cost'),
            'daily_cost' => $this->input->post('daily_cost'),
            'exclusion_per_day_cost' => $this->input->post('per_day_cost'),
            'insert_by' => '1',
            'update_by' => '1',
            'status' => '1'
        );
        $this->admin_manager->Insert('programs', $program);
        $insert_id = $this->db->insert_id();
        if (!empty($this->input->post('num_session'))) {
            foreach ($this->input->post('num_session') as $key => $value) {
                $child_session = array(
                    'program_id' => $insert_id,
                    'num_of_sessions' => $value,
                    'cost_per_session' => $this->input->post('cost_per_sessions')[$key],
                );
                $this->admin_manager->Insert('prog_child_sessions', $child_session);
            }
        }
        if (!empty($this->input->post('level_name'))) {
            foreach ($this->input->post('level_name') as $key => $level) {
                $levels = array(
                    'program_id' => $insert_id,
                    'level_name' => $level,
                    'capacity' => $this->input->post('enter_capacity')[$key],
                    'age_min' => $this->input->post('min_age')[$key],
                    'age_max' => $this->input->post('max_age')[$key],
                    'duration' => $this->input->post('duration')[$key],
                    'color' => $this->input->post('colors')[$key],
                    'insert_by' => '1',
                    'update_by' => '1',
                );
                if (!empty($this->input->post('document')[$key])) {
                    $filePath = './assets/uploads/';
                    $Base64MIMI = explode(",", $this->input->post('document')[$key])[0];
                    $Base64Encoded = explode(",", $this->input->post('document')[$key])[1];
                    $ext = '';
                    if ($Base64MIMI == "data:image/png;base64")
                        $ext = '.png';
                    else if ($Base64MIMI == "data:image/jpeg;base64")
                        $ext = '.jpg';
                    else if ($Base64MIMI == "data:application/pdf;base64")
                        $ext = '.pdf';
                    $filename = uniqid() . $ext;
                    $file = $filePath . $filename;
                    $base64Decode = base64_decode($Base64Encoded);
                    @file_put_contents($file, $base64Decode);
                    $levels['file_path'] = $filename;
                    $levels['filename'] = $this->input->post('documentname')[$key];
                }
                $this->admin_manager->Insert('levels', $levels);
            }
        }
        $this->session->set_flashdata("popup", "Programme has been created successfully");
        redirect_to('/admin/program-management');
    }

    public function edit_program($id) {

        $id = encrypt_decrypt('decrypt', $id);
        $data['program'] = $this->admin_manager->SelectByID('programs', 'id', $id, 'ROW_A');
        $data['levels'] = $this->admin_manager->SelectByID('levels', 'program_id', $id, 'ARRAY');
        $data['program_session'] = $this->admin_manager->SelectByID('prog_child_sessions', 'program_id', $id, 'ARRAY');
        $this->loadComponents('program_management/edit-program', $data);
    }

    public function update_program() {
        $program = array(
            'program_name' => $this->input->post('program_name'),
            'club_id' => $this->input->post('club'),
            'cost_per_session' => $this->input->post('cost_per_session'),
            'annual_reg_fee' => $this->input->post('annual_reg_free'),
            'competition_fee' => $this->input->post('competition_fee'),
            'full_week_cost' => $this->input->post('full_week_cost'),
            'session_card_cost' => $this->input->post('session_card_cost'),
            'daily_cost' => $this->input->post('daily_cost'),
            'exclusion_per_day_cost' => $this->input->post('per_day_cost'),
            'insert_by' => '1',
            'update_by' => '1',
        );
        $levels = array();
        $insert_id = $this->input->post('program_id');
        if (!empty($this->input->post('level_name'))) {
            foreach ($this->input->post('level_name') as $key => $level) {
                $levels[] = array(
                    'program_id' => $insert_id,
                    'level_name' => $level,
                    'capacity' => $this->input->post('enter_capacity')[$key],
                    'age_min' => $this->input->post('min_age')[$key],
                    'age_max' => $this->input->post('max_age')[$key],
                    'duration' => $this->input->post('duration')[$key],
                    'color' => $this->input->post('colors')[$key],
                    'file_path' => $this->input->post('document')[$key],
                    'filename' => $this->input->post('documentname')[$key],
                    'insert_by' => '1',
                    'update_by' => '1',
                );
            }
            $this->session->set_userdata("levels", $levels);
        }


        $this->admin_manager->Delete('prog_child_sessions', 'program_id', $insert_id);
        $where = array('id' => $insert_id);
        $this->admin_manager->Update('programs', $program, $where);
        if (!empty($this->input->post('num_session'))) {
            foreach ($this->input->post('num_session') as $key => $value) {
                $child_session = array(
                    'program_id' => $insert_id,
                    'num_of_sessions' => $value,
                    'cost_per_session' => $this->input->post('cost_per_sessions')[$key],
                );
                $this->admin_manager->Insert('prog_child_sessions', $child_session);
            }
        }
        if (!empty($this->input->post('level_name'))) {
            foreach ($this->input->post('level_name') as $key => $level) {
                $levels = array(
                    'program_id' => $insert_id,
                    'level_name' => $level,
                    'capacity' => $this->input->post('enter_capacity')[$key],
                    'age_min' => $this->input->post('min_age')[$key],
                    'age_max' => $this->input->post('max_age')[$key],
                    'duration' => $this->input->post('duration')[$key],
                    'color' => $this->input->post('colors')[$key],
                    'insert_by' => '1',
                    'update_by' => '1',
                );

                if (!empty($this->input->post('document')[$key])) {
                    $filePath = './assets/uploads/';
                    $isBaseSixtyFour = explode("data:image", $this->input->post('document')[$key]);
                    $Base64MIMI = explode(",", $this->input->post('document')[$key])[0];
                    $Base64Encoded = @explode(",", $this->input->post('document')[$key])[1];

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
                    $levels['file_path'] = $filename;
                    $levels['filename'] = $this->input->post('documentname')[$key];
                }

                $this->admin_manager->Insert('levels', $levels);
            }
        }
        $levels = $this->session->userdata("levels");
        $this->session->set_flashdata("msg", "updated");
        redirect_to('/admin/program-management/edit_program/' . encrypt_decrypt('encrypt', $insert_id));
    }

    public function duplicationProgram($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $last_id = $this->DuplicateMySQLRecord('programs', 'id', $id);
        $all_previous_Levels = $this->db->query("SELECT * FROM levels WHERE program_id='$id'")->result_array();
        $all_previous_prog_child_sessions = $this->db->query("SELECT * FROM prog_child_sessions WHERE program_id='$id'")->result_array();
        if (!empty($all_previous_Levels)) {
            foreach ($all_previous_Levels as $previous_Levels) {
                $dataLevels = array(
                    'program_id' => $last_id,
                    'level_name' => $previous_Levels['level_name'],
                    'capacity' => $previous_Levels['capacity'],
                    'age_min' => $previous_Levels['age_min'],
                    'age_max' => $previous_Levels['age_max'],
                    'duration' => $previous_Levels['duration'],
                    'file_path' => $previous_Levels['file_path'],
                    'filename' => $previous_Levels['filename'],
                    'color' => $previous_Levels['color'],
                    'insert_at' => $previous_Levels['insert_at'],
                    'insert_by' => $previous_Levels['insert_by'],
                    'update_at' => $previous_Levels['update_at'],
                    'update_by' => $previous_Levels['update_by'],
                    'status' => $previous_Levels['status'],
                );
                $this->db->insert("levels", $dataLevels);
            }
        }
        if (!empty($all_previous_prog_child_sessions)) {
            foreach ($all_previous_prog_child_sessions as $previous_Levels) {
                $dataLevels = array(
                    'program_id' => $last_id,
                    'num_of_sessions' => $previous_Levels['num_of_sessions'],
                    'cost_per_session' => $previous_Levels['cost_per_session'],
                    'status' => $previous_Levels['status'],
                );
                $this->db->insert("prog_child_sessions", $dataLevels);
            }
        }

//        $CheckLevels = $this->db->query("SELECT COUNT(*) AS counts FROM levels levels WHERE program_id='$id'")->row_array();
//        $CheckChildSession = $this->db->query("SELECT COUNT(*) AS counts FROM prog_child_sessions WHERE program_id='$id'")->row_array();
//        if ($CheckLevels['counts'] > 0) {
//            $this->DuplicateMySQLRecord('levels', 'program_id', $id, 1, array('program_id' => $last_id));
//        }
//        if ($CheckChildSession['counts'] > 0) {
//            $this->DuplicateMySQLRecord('prog_child_sessions', 'program_id', $id, 1, array('program_id' => $last_id));
//        }
        redirect_to('/admin/program-management');
    }

    public function DuplicateMySQLRecord($table, $primary_key_field, $primary_key_val, $extra = '', $param = array()) {
        /* generate the select query */
        $this->db->where($primary_key_field, $primary_key_val);
        $query = $this->db->get($table);
        foreach ($query->result() as $row) {
            foreach ($row as $key => $val) {
                if ($key != $primary_key_field) {
                    if ($key != "id")
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
        $this->admin_manager->Update('programs', array('status' => 0), array('id' => $id));
        $this->admin_manager->Update('levels', array('status' => 0), array('program_id' => $id));
        $this->admin_manager->Update('prog_child_sessions', array('status' => 0), array('program_id' => $id));
        redirect_to('admin/program-management');
    }

    public function getLevels() {
        $table = '';
        $program_id = $this->input->post("program_id");
        $programs = $this->db->query("SELECT p.*,c.`club_name` FROM programs p
                                        INNER JOIN `clubs` c
                                        ON c.`id` = p.`club_id`
                                        WHERE p.`id`='$program_id'")->row_array();

        if (!empty($programs)) {
            $table .= '<h2><strong>' . $programs['club_name'] . '</strong></h2>';
            $table .= '<table  class="table">';
            $table .= '<thead>';
            $table .= '<tr>';
            $table .= '<th>Programme Name</th>';
            if ($programs['club_id'] == "4") {
                $table .= '<th>Full Week Cost</th>';
                $table .= '<th>Daily Cost</th>';
                $table .= '<th>Exclusive per day cost</th>';
            } else if ($programs['club_id'] == "5") {
                $table .= '<th>Session Card Cost</th>';
                $table .= '<th>Annual Fee</th>';
                $table .= '<th>Competition Fee</th>';
            } else {
                $table .= '<th>Cost Per Session</th>';
                $table .= '<th>Annual Reg Fee</th>';
                $table .= '<th>Competition Fee</th>';
            }
            $table .= '</tr>';
            $table .= '</thead>';
            $table .= '<tbody>';

            $table .= '<tr>';
            $table .= '<td>' . $programs['program_name'] . '</td>';
            if ($programs['club_id'] == "4") {
                $table .= '<td>' . $programs['full_week_cost'] . " AED " . '</td>';
                $table .= '<td>' . $programs['daily_cost'] . " AED " . '</td>';
                $table .= '<td>' . $programs['exclusion_per_day_cost'] . " AED " . '</td>';
            } else if ($programs['club_id'] == "5") {
                $table .= '<td>' . $programs['session_card_cost'] . " AED " . '</td>';
                $table .= '<td>' . $programs['annual_reg_fee'] . " AED " . '</td>';
                $table .= '<td>' . $programs['competition_fee'] . " AED " . '</td>';
            } else {
                $table .= '<td>' . $programs['cost_per_session'] . " AED " . '</td>';
                $table .= '<td>' . $programs['annual_reg_fee'] . " AED " . '</td>';
                $table .= '<td>' . $programs['competition_fee'] . " AED " . '</td>';
            }
            $table .= '</tr>';
            $table .= '</tbody>';
            $table .= '</table>';
        }

        if ($programs['club_id'] == "5") {
            $program_sessions = $this->admin_manager->SelectByID("prog_child_sessions", 'program_id', $program_id, 'ARRAY');
            if (!empty($program_sessions)) {
                $table .= '<div class="gap"></div>';
                $table .= '<h3><strong>Tri Club Sessions</strong></h3>';
                $table .= '<table  class="table">';
                $table .= '<thead>';
                $table .= '<tr>';
                $table .= '<th>Number of Sessions</th>';
                $table .= '<th>Cost Per Session</th>';
                $table .= '</tr>';
                $table .= '</thead>';
                $table .= '<tbody>';
                foreach ($program_sessions as $query) {
                    $table .= '<tr>';
                    $table .= '<td>' . $query['num_of_sessions'] . '</td>';
                    $table .= '<td>' . $query['cost_per_session'] . '</td>';
                    $table .= '</tr>';
                }
                $table .= '</tbody>';
                $table .= '</table>';
            }
        }
        $queries = $this->admin_manager->SelectByID("levels", 'program_id', $program_id, 'ARRAY');
        if (!empty($queries)) {
            $table .= '<div class="gap"></div>';
            $table .= '<h3><strong>Level Details</strong></h3>';
            $table .= '<table  class="table">';
            $table .= '<thead>';
            $table .= '<tr>';
            $table .= '<th>Level Name</th>';
            $table .= '<th>Capacity</th>';
            $table .= '<th>Min Age</th>';
            $table .= '<th>Max Age</th>';
            $table .= '<th>Duration</th>';
            $table .= '<th>Color</th>';
            $table .= '<th>Document</th>';
            $table .= '</tr>';
            $table .= '</thead>';
            $table .= '<tbody>';
            foreach ($queries as $query) {
                $table .= '<tr>';
                $table .= '<td>' . $query['level_name'] . '</td>';
                $table .= '<td>' . $query['capacity'] . '</td>';
                $table .= '<td>' . $query['age_min'] . '</td>';
                $table .= '<td>' . $query['age_max'] . '</td>';
                $table .= '<td>' . $query['duration'] . " mins" . '</td>';
                $table .= '<td><span class="colorbox" style="background:' . $query['color'] . '"></span></td>';
                $table .= '<td>';
                if (!empty($query['file_path'])) {
                    $table .='<a target="_blank" href="' . site_url('/assets/uploads/' . $query['file_path']) . '">View document</a>';
                } else {
                    $table .="None";
                }
                $table .= '</td>';
                $table .= '</tr>';
            }
            $table .= '</tbody>';
            $table .= '</table>';

            
        }
        echo $table;
    }

    public function get_program_by_club() {
        $club_id = $this->input->post('club_id');
        $where = '';
        if(!empty($club_id)){
             $where = " AND `clubs`.`id`='$club_id'";
        }else{
             $where = "";
        }


        $programs = $this->db->query("SELECT 
          `programs`.*,
          `clubs`.`club_name`,
          GROUP_CONCAT(REPLACE(levels.`color`, ',', '|')) AS colors
          FROM
          `programs` 
          INNER JOIN `clubs` 
          ON `programs`.`club_id` = `clubs`.`id` 
          LEFT JOIN `levels` 
          ON levels.`program_id` = programs.`id` 
          WHERE programs.`status` = '1' 
          $where
          GROUP BY programs.`id` 
          ORDER BY programs.`id` DESC")->result_array();
        if (!empty($programs)) {
            foreach ($programs as $program) {
                $colours = explode(",", $program['colors']);
                ?>
                <tr>
                    <td><?php echo $program['program_name']; ?></td>
                    <td><?php echo $program['club_name']; ?></td>
                    <td><?php echo $program['cost_per_session']; ?></td>
                    <td>
                        <?php
                        foreach ($colours as $colour) {
                            echo '<span class="colorbox" style="background:' . str_replace("|", ',', $colour) . '"></span>';
                        }
                        ?>
                    </td>
                    <td><?php echo count($colours); ?></td>
                    <td class="actions">
                        <a href="<?php echo site_url('/admin/program-management/edit_program/' . encrypt_decrypt('encrypt', $program['id'])); ?>" class="" data-toggle="tooltip" title="Edit">
                            <i class="material-icons f-left">edit</i>
                        </a> 
                        <a href="<?php echo site_url('/admin/program-management/duplicate-record/' . encrypt_decrypt('encrypt', $program['id'])); ?>" class="" data-toggle="tooltip" title="Duplicate">
                            <i class="material-icons f-left">library_add</i>
                        </a>
                        <a href="#myModal" class="delete_me" data-url="<?php echo site_url('/admin/program-management/delete_program/' . encrypt_decrypt('encrypt', $program['id'])); ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
                            <i class="material-icons f-left">delete</i>
                        </a>
                        <a href="#" class="fetch_levels" data-id="<?php echo $program['id']; ?>" data-toggle="modal" data-target="#programInfo" title="Info">
                            <i class="material-icons f-left">info</i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='6'><span style='display:block;text-align:center !important;'>Not Found</span></td></tr>";
        }
    }

    public function delete_level() {
        $id = $this->input->post('id');
        $this->admin_manager->Delete("levels", 'id', $id);
        echo "1";
    }
}
