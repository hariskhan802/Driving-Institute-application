<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_management extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function calendar($id) {
        $id = encrypt_decrypt('decrypt', $id);
        $calendar = array();
        $data['session_id'] = $id;
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['all_days'] = $this->db->query("SELECT * FROM days")->result_array();
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['staffs'] = $this->admin_manager->SelectAllQuery("SELECT u.* FROM users u INNER JOIN `staff` s ON u.`id`=s.`staff_id`", 'ARRAY');
        // print_r($data); die;
//        $this->load->view('calendar_management/calendar', $data);
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view('calendar_management/calendar', $data);
        $this->load->view("footer");
    }

    public function calendar_listings() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['sessions'] = $this->admin_manager->SelectAllQuery("SELECT 
			s.`id`,
			s.`session_name`,
			c.`club_name`,
			t.`term_name`,
			p.`program_name`,
			l.`level_name`,
			v.`venue_name`,
            v.`short_code`,
            t.`id` AS term_id,
            c.`id` AS club_id,
            p.`id` AS program_id            
			FROM
			sessions s 
			INNER JOIN `clubs` c 
			ON s.`club_id` = c.`id` 
			INNER JOIN `levels` l 
			ON l.`id` = s.`level_id`
			INNER JOIN `programs` p 
			ON p.`id` = s.`program_id` 
			INNER JOIN `venues` v 
			ON v.`id` = s.`venue_id` 
			INNER JOIN `terms` t 
			ON t.`id` = s.`term_id` 
                        WHERE s.club_id  !='4'
                        ORDER BY s.id DESC", 'ARRAY');
        loadViewComponents('calendar_management/session_calendar', $data);
    }

    public function get_timetable($day_id, $where = '') {
        $markables = $this->db->query("SELECT 
                                                s.`id`,
                                        sm.`meta_id`,
                                        sm.`day_id`,
                                        sm.`start_time`,
                                        sm.`end_time`,
                                        sm.coach_id,
                                                 l.`id` AS level_id,
                                                l.`level_name`,
                                                l.`capacity`,
                                                l.`color`,
                                                l.`duration`
                                      FROM
                                        sessions s 
                                        INNER JOIN `sessions_meta` sm 
                                                  ON s.`id` = sm.`session_id` 
                                        INNER JOIN `enrollments` e 
                                                  ON e.`session_id` = s.`id` 
                                                INNER JOIN `enrollments_meta` em 
                                                  ON em.`enroll_id` = e.`id` 
                                                INNER JOIN levels l 
                                                  ON l.`id` = s.`level_id` 
                                                INNER JOIN `clubs` c 
                                                  ON s.`club_id` = c.`id` 
                                                INNER JOIN `programs` p 
                                                  ON s.`program_id` = p.`id` 
                                                INNER JOIN `venues` v 
                                                  ON s.`venue_id` = v.`id` 
                                              WHERE sm.`day_id` = '$day_id' $where
                                      GROUP BY sm.`meta_id`")->result_array();
        
        return $markables;
    }

    public function _get_timetable($id = null, $day = null) {
        // var_dump(explode('/', $id));
        // var_dump($day);
        // die;
        // explode('/', $id);
        $markables = $this->db->query("SELECT 
                                                s.`id`,
                                        sm.`meta_id`,
                                        sm.`day_id`,
                                        sm.`start_time`,
                                        sm.`end_time`,
                                        sm.coach_id,
                                                 l.`id` AS level_id,
                                                l.`level_name`,
                                                l.`capacity`,
                                                l.`color`,
                                                l.`duration`,
                                                t.`id` AS term_id,
                                                c.`id` AS club_id,
                                                p.`id` AS program_id
                                      FROM
                                        sessions s 
                                        INNER JOIN `sessions_meta` sm 
                                                  ON s.`id` = sm.`session_id` 
                                         
                                                INNER JOIN levels l 
                                                  ON l.`id` = s.`level_id` 
                                                INNER JOIN `clubs` c 
                                                  ON s.`club_id` = c.`id` 
                                                INNER JOIN `programs` p 
                                                  ON s.`program_id` = p.`id` 
                                                INNER JOIN `venues` v 
                                                  ON s.`venue_id` = v.`id` 
                                                INNER JOIN `terms` t 
                                                  ON s.`term_id` = t.`id` 
                                              WHERE sm.`day_id` = '$day' 
                                                AND t.`id` = ".explode('/', $id)[0]." 
                                                AND c.`id` = ".explode('/', $id)[1]." 
                                                AND p.`id` = ".explode('/', $id)[2]." 
                                      GROUP BY sm.`meta_id`")->result_array();
                            // 
        return $markables;
    }
    public function calendar_ajax() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $day_id = $this->input->post('day_id');
        $all_days = $this->db->query("SELECT * FROM days WHERE id='$day_id'")->result_array();
        $club_id = $this->input->post('club_id');
        $level_id = $this->input->post('level_id');
        $program_id = $this->input->post('program_id');
        $term_id = $this->input->post('term_id');
        $session_id = $this->input->post('session_id');

        $where = '';
        if (!empty($day_id)) {
            $where .=" AND sm.`day_id` = '$day_id'";
        }
        if (!empty($club_id)) {
            $where .=" AND s.`club_id` = '$club_id'";
        }
        if (!empty($program_id)) {
            $where .=" AND s.`program_id` = '$program_id'";
        }

        if (!empty($term_id)) {
            $where .=" AND s.`term_id` = '$term_id'";
        }


        $data['staffs'] = $this->admin_manager->SelectAllQuery("SELECT u.* FROM users u INNER JOIN `staff` s ON u.`id`=s.`staff_id`", 'ARRAY');
        $days = array("", "Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday");
        $data['session_meta'] = $this->db->query("SELECT 
                                        sm.`meta_id`,
                                        sm.`day_id`,
                                        sm.`start_time`,
                                        sm.`end_time`,
                                        sm.coach_id,
                                        sm.`session_id`,
                                        e.`level_id` 
                                      FROM
                                        sessions s 
                                        INNER JOIN `sessions_meta` sm 
                                          ON s.id = sm.`session_id` 
                                        INNER JOIN `enrollments` e 
                                          ON s.`program_id` = e.`program_id` 
                                      WHERE s.status='1' $where
                                      GROUP BY sm.`meta_id`")->result_array();

        $data['staffs'] = $this->admin_manager->SelectAllQuery("SELECT u.* FROM users u INNER JOIN `staff` s ON u.`id`=s.`staff_id`", 'ARRAY');
        ob_start();
//        $CI = get_instance();
        $counts = 0;
        foreach ($all_days as $key => $day) {
            $askey = $key;
            $sessions = $CI->get_timetable($day['id']);
            ?>
            <div class="day-row row day_row_<?php echo $day['day_name']; ?>" >
                <?php if ($key < 1) { ?>
                    <div class="head-title">
                        <h3 class="pull-left">DAYS/TIME</h3>
                        <h3 class="pull-right">REASSIGN STAFF</h3>
                    </div>
                <?php } ?>
                <div class="day-title">
                    <h2><?php echo $day['day_name']; ?></h2>
                </div>
                <div class="hours row" id="row_<?php echo $key ?>">
                    <div class="col-md-10 col-sm-10 jamboo">
                        <div class="students students_<?php echo $day['id']; ?> clear clearfix">
                            <?php
                            foreach ($sessions as $session) {
                                if ($day['id'] == $session['day_id']) {
                                    $levels = $CI->getLevels($session['level_id']);
                                    $count = $levels['capacity'];
                                    $color = $levels['color'];
                                    echo $session['level_id'];
                                    $childs = $CI->getChild($session['meta_id']);
                                    ?>
                                    <div class="col-md-12 repeator"  data-meta_id="<?php echo $session['meta_id']; ?>">
                                        <div class="col-md-3 col-sm-3 pull-left">
                                            <div class="hour">
                                                <?php echo $session['start_time'] ?> - <?php echo $session['end_time'] ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8">
                                            <?php
                                            for ($i = 0; $i < $count; $i++) {
                                                $repeat = explode(",", $childs['student_name']);
                                                $child_ids = explode(",", $childs['child_id']);
                                                $name = (isset($repeat[$i])) ? $repeat[$i] : "";
                                                $child_id = (isset($child_ids[$i])) ? $child_ids[$i] : "";
                                                $valid = count($repeat);
                                                ?>
                                                <div style="color:#fff;background:<?php echo $color; ?>" class="child">
                                                    <?php
                                                    if (!empty($child_id)) {
                                                        echo "<span class='child_span childz_" . $session['day_id'] . "'>" . $name . "<input type='hidden' class='childs' value='" . $child_id . "' name='childs[$key][][{$session['meta_id']}]'/><input type='hidden' value='{$session['coach_id']}' name='coach[$key][{$session['meta_id']}]'/></span>";
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="clear clearfix"></div>
                                    <div class="gap"></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if (!empty($sessions)) {
                        $hasKey = $key;
                        ?>
                        <input type='hidden' value='<?= $key ?>' name='row[<?= $key ?>]'/>
                        <div class="col-md-2 col-sm-2">
                            <select class="form-control staff_name" name="staff_id[]">
                                <option>Select Coach</option>
                                <?php
                                foreach ($data['staffs'] as $staff) {
                                    ?>
                                    <option value="<?php echo $staff['id'] ?>" <?php echo ($staff['id'] == $session['coach_id']) ? "selected=''" : "" ?>><?php echo $staff['username']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <script>
                $(".childz_<?php echo $day['id']; ?>").draggable({
                    revert: true,
                    revertDuration: 50,
                    containment: ".jamboo"
                });
                $(".child").droppable({
                    drop: function (event, ui) {
                        $(this).append($(ui.draggable));
                        var checkMeta = $(this).parents(".repeator").attr("data-meta_id");
                        $(this).find(".childs").attr('name', 'childs[<?= $hasKey ?>][][' + checkMeta + ']');
                    }
                });
            </script>
            <?php
            $counts++;
        }

        $data['html'] = ob_get_contents();
        echo $data['html'];
    }

    public function filter_sessions() {
        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $program_id = $this->input->post('program_id');
        $level_id = $this->input->post('level_id');
        $venue_id = $this->input->post('venue_id');
        $where = '';
        if (!empty($term_id)) {
            $where .= " AND s.term_id='$term_id'";
        }
        if (!empty($club_id)) {
            $where .= " AND s.club_id='$club_id'";
        }
        if (!empty($program_id)) {
            $where .= " AND s.program_id='$program_id'";
        }
        if (!empty($level_id)) {
            $where .= " AND s.level_id='$level_id'";
        }
        if (!empty($venue_id)) {
            $where .= " AND s.venue_id='$venue_id'";
        }

        $sessions = $this->admin_manager->SelectAllQuery("SELECT 
			s.`id`,
			s.`session_name`,
			c.`club_name`,
			t.`term_name`,
			p.`program_name`,
			l.`level_name`,
			v.`venue_name`,
                        v.`short_code`
			FROM
			sessions s 
			INNER JOIN `clubs` c 
			ON s.`club_id` = c.`id` 
			INNER JOIN `levels` l 
			ON l.`id` = s.`level_id`
			INNER JOIN `programs` p 
			ON p.`id` = s.`program_id` 
			INNER JOIN `venues` v 
			ON v.`id` = s.`venue_id` 
			INNER JOIN `terms` t 
			ON t.`id` = s.`term_id` WHERE s.status='1' $where", 'ARRAY');

        if (!empty($sessions)) {
            foreach ($sessions as $session) {
                ?>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><?php echo $session['session_name']; ?></td>
                    <td class="mdl-data-table__cell--non-numeric"><?php echo $session['term_name']; ?></td>
                    <td><?php echo $session['club_name']; ?></td>
                    <td><?php echo $session['program_name']; ?></td>
                    <td><?php echo $session['level_name']; ?></td>
                    <td><?php echo $session['short_code']; ?></td>
                    <td class="actions">
                        <a href="<?php print_url('/admin/calendar-management/calendar/' . encrypt_decrypt('encrypt', $session['id'])); ?>" title="Info">
                            <i class="material-icons f-left">device_hub</i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="6"><center><i>No Records Found</i></center></td></tr>
            <?php
        }
    }

    public function getChild($meta_id) {
        $markables = $this->db->query("SELECT 
                                            em.`session_meta_id`,
                                              GROUP_CONCAT(e.`child_id`) AS child_id,
                                              GROUP_CONCAT(CONCAT(s.`firstname`,' ',s.`lastname`)) AS student_name
                                            FROM
                                              `enrollments_meta` em 
                                              INNER JOIN `enrollments` e 
                                                ON em.`enroll_id` = e.`id` 
                                              INNER JOIN `students` s 
                                                ON s.id = e.`child_id` 
                                              WHERE em.`session_meta_id`='$meta_id'
                                              GROUP BY em.`session_meta_id`")->row_array();

        return $markables;
    }

    public function save_calendar() {
        // print_r(get_parent(8)); die;
        $rows = $this->input->post("row");
        $staff_id = $this->input->post("staff_id");
        $nLevel = $this->input->post("level");
        $nHours = $this->input->post("hours");
        $records = array_filter(json_decode($this->input->post("records")));
        foreach ($rows as $key_row => $row) {
            $calendars = $this->input->post("childs");
            if (!empty($calendars[$key_row])) {
                foreach ($calendars[$key_row] as $key => $calen) {
                    foreach ($calen as $key => $cal) {
                        $meta_id = $key;
                        $child_id = $cal;
                        $staff = $staff_id[$key];
                        $nLevel = isset($nLevel[$key]) ? $nLevel[$key] : '';
                        $nHours = isset($nHours[$key]) ? $nHours[$key] : '';
                        $oLevel = !empty($records[$child_id]) ? $records[$child_id]->level : '';
                        $oHour = !empty($records[$child_id]) ? $records[$child_id]->hour : '';
                        if (!empty($records[$child_id])) {
                            if($nLevel != $oLevel || $nHours != $oHour){
                                send_notification('send_notification', get_parent($child_id)['email'], 'Booking Confirmation', parent_congrats_tmp(array_merge(get_parent($child_id), ['old_level' => $oLevel, 'new_level' => $nLevel])), true);
                            }
                        }
                        $this->update_calendar($child_id, $meta_id, $staff);
                    }
                }
            }
        }die;
        redirect_to('/admin/calendar-management/calendar-listings');
    }

    // echo '$child_id '. $child_id, ' $meta_id '.$meta_id, ' $staff '.$staff. ' <br>';
    public function update_calendar($child_id, $meta_id, $staff) {
        $this->db->simple_query("UPDATE 
                                    `enrollments` e 
                                    INNER JOIN `enrollments_meta` em 
                                      ON e.`id` = em.`enroll_id` 
                                      SET em.`session_meta_id` = '$meta_id' 
                                  WHERE e.`child_id` = '$child_id'");

        $this->db->simple_query("UPDATE 
                                        `sessions_meta` sm 
                                         SET sm.`coach_id` = '$staff' 
                                      WHERE sm.`meta_id` = '$meta_id' ");
    }
    public function getLevels($id) {
        $markables = $this->db->query("SELECT * FROM levels WHERE id='$id'")->row_array();
        return $markables;
    }

}
