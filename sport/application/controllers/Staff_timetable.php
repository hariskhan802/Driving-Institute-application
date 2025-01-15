<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_timetable extends MY_Controller {

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
        $data['days'] = $this->db->query("SELECT * FROM days")->result_array();
        $data['Coaches'] = returnCoaches(array('key' => 'u.*,s.first_name,s.last_name', 'format' => 'dropdown'));
        loadViewComponents('staff_management/staff-timetable', $data);
    }

    public function get_timetable($day_id, $where = '') {
//        $markables = $this->db->query("SELECT 
//                                            sm.*,
//                                            st.`first_name`,
//                                            st.`last_name`,
//                                            l.`color`,
//                                            c.`club_name`,
//                                            p.`program_name`,
//                                            v.`venue_name`,
//                                            s.`level_id` 
//                                          FROM
//                                            sessions s 
//                                            INNER JOIN `sessions_meta` sm 
//                                              ON s.`id` = sm.`session_id` 
//                                            INNER JOIN users u 
//                                              ON sm.`coach_id` = u.`id` 
//                                            INNER JOIN `staff` st 
//                                              ON st.`staff_id` = u.`id` 
//                                            INNER JOIN levels l 
//                                              ON l.`id` = s.`level_id` 
//                                            INNER JOIN `clubs` c 
//                                              ON s.`club_id` = c.`id` 
//                                            INNER JOIN `programs` p 
//                                              ON s.`program_id` = p.`id` 
//                                               INNER JOIN `venues` v 
//                                              ON s.`venue_id` = v.`id`
//                                          WHERE sm.`day_id` = '$day_id' $where")->result_array();
        $markables = $this->db->query("SELECT 
  sm.*,
  GROUP_CONCAT(sm.`start_time`) AS start_time,
  GROUP_CONCAT(sm.`end_time`) AS end_time,
  st.`first_name`,
  st.`last_name`,
  l.`color`,
  c.`club_name`,
  p.`program_name`,
  v.`venue_name`,
  s.`level_id` 
FROM
  sessions s 
  INNER JOIN `sessions_meta` sm 
    ON s.`id` = sm.`session_id` 
  INNER JOIN users u 
    ON sm.`coach_id` = u.`id` 
  INNER JOIN `staff` st 
    ON st.`staff_id` = u.`id` 
  INNER JOIN levels l 
    ON l.`id` = s.`level_id` 
  INNER JOIN `clubs` c 
    ON s.`club_id` = c.`id` 
  INNER JOIN `programs` p 
    ON s.`program_id` = p.`id` 
  INNER JOIN `venues` v 
    ON s.`venue_id` = v.`id` 
WHERE sm.`day_id` = '$day_id' $where
GROUP BY c.`club_name`,p.`program_name`,v.`venue_name`,s.`id`,sm.`coach_id`")->result_array();
        return $markables;
    }

    public function timetable($id) {
        $days = $this->db->query("SELECT * FROM days")->result_array();
        $serialArray = array();
        $sessionArray = array();
        foreach ($days as $key => $day) {
            $serialArray[$day['day_name']]['meta'] = $this->CallSessionMeta($day['id'], $id);
        }
        foreach ($serialArray as $keys => $serial) {
            if (is_array($serial['meta'])) {
                $count = 0;
                foreach ($serial as $key => $s) {
                    if (isset($s[$count])) {
                        $serialArray[$keys]['session'] = $this->CallSession($s[$count]['session_id']);
                    }
                    $count++;
                }
            }
        }
        $data['timetable'] = $serialArray;
        loadViewComponents('staff_management/timetable', $data);
    }

    public function CallSessionMeta($id, $userID = '') {
        $sessions_meta = $this->db->query("SELECT * FROM sessions_meta WHERE day_id='$id' AND coach_id='$userID'")->result_array();
        return $sessions_meta;
    }

    public function CallSession($sessionID) {
        $query = $this->db->query("SELECT s.*,l.color FROM sessions s INNER JOIN levels l ON s.level_id=l.id WHERE s.id='$sessionID'")->row_array();
        return $query;
    }

    public function CallLevels($levelID) {
        $query = $this->db->query("SELECT * FROM levels WHERE id='$levelID'")->row_array();
        return $query;
    }

    public function timetable_result() {

        $get = $this->input->post();
        $where = '';
        if (isset($get['terms']) && !empty($get['terms'])) {
            $where .=" AND s.term_id=" . $get['terms'];
        } else {
            $get['terms'] = '';
        }
        if (isset($get['clubs']) && !empty($get['clubs'])) {
            $where .=" AND s.club_id=" . $get['clubs'];
        } else {
            $get['clubs'] = '';
        }
        if (isset($get['programs']) && !empty($get['programs'])) {
            $where .=" AND s.program_id=" . $get['programs'];
        } else {
            $get['programs'] = '';
        }
        if (isset($get['levels']) && !empty($get['levels'])) {
            $where .=" AND s.level_id=" . $get['levels'];
        } else {
            $get['levels'] = '';
        }
        if (isset($get['coaches']) && !empty($get['coaches'])) {
            $where .=" AND sm.coach_id=" . $get['coaches'];
        } else {
            $get['coaches'] = '';
        }
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'), $get['terms']);
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'), $get['clubs']);
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id, club_id, program_name', 'format' => 'dropdown'), $get['programs']);
        $data['days'] = $this->db->query("SELECT * FROM days")->result_array();
        $data['Coaches'] = returnCoaches(array('format' => 'dropdown'), $get['coaches']);
        $data['days'] = $this->db->query("SELECT * FROM days")->result_array();
        ob_start();
        foreach ($data['days'] as $day) {
            $sessions = $this->get_timetable($day['id'], $where);
            ?>
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12 col-12" style="">
                    <h3 class="paddar"><?php echo $day['day_name'] ?></h3>
                </div>
                <?php foreach ($sessions as $session) { ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 box_session" style="background:<?php echo $session['color'] ?>">
                        <h4><?php echo $session['club_name']; ?></h4>
                        <p><strong><?php echo $session['program_name']; ?> | </strong><strong><?php echo $session['venue_name']; ?></strong> </p>
                        <h2><?php echo $session['first_name'] . " " . $session['last_name']; ?></h2>
                        <span><?php echo $session['start_time'] ?> - <?php echo $session['end_time']; ?></span>
                    </div>

                    <?php
                }
                ?>
            </div>
            <?php
        }
        $data['html'] = ob_get_clean();
        loadViewComponents('staff_management/staff-timetable', $data);
    }

}
