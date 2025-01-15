<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_projections extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        $where = '';
        if ($this->input->get('term')) {
            $where .= " AND e.term_id={$this->input->get('term')}";
        }
        if ($this->input->get('venues')) {
            $where .= " AND ev.`venue_id`={$this->input->get('venues')}";
        }
        if ($this->input->get('club')) {
            $where .= " AND e.club_id={$this->input->get('club')}";
        }
        if ($this->input->get('levelx')) {
            $where .= " AND e.level_id={$this->input->get('levelx')}";
        }
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'), $this->input->get('term'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'), $this->input->get('venues'));
        $data['clubz'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'), $this->input->get('club'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['levels'] = returnLevels(array('keys' => 'id,program_id, level_name', 'format' => 'dropdown'), $this->input->get('levelx'));

        $data['students'] = $this->db->query("SELECT COUNT(*) AS `count` FROM students")->row_array();
        $data['clubs'] = $this->db->query("SELECT 
                                                    COUNT(
                                                      CASE
                                                        WHEN e.`club_id` = '1' 
                                                        THEN e.`club_id` 
                                                      END
                                                    ) AS swim_count,
                                                    COUNT(
                                                      CASE
                                                        WHEN e.`club_id` = '2' 
                                                        THEN e.`club_id` 
                                                      END
                                                    ) AS football_count,
                                                    COUNT(
                                                      CASE
                                                        WHEN e.`club_id` = '3' 
                                                        THEN e.`club_id` 
                                                      END
                                                    ) AS netball_count,
                                                    COUNT(
                                                      CASE
                                                        WHEN e.`club_id` = '4' 
                                                        THEN e.`club_id` 
                                                      END
                                                    ) AS holiday_count,
                                                    COUNT(
                                                      CASE
                                                        WHEN e.`club_id` = '5' 
                                                        THEN e.`club_id` 
                                                      END
                                                    ) AS tri_count 
                                                  FROM
                                                    students s 
                                                    INNER JOIN `enrollments` e 
                                                      ON e.`child_id` = s.`id`
                                                    INNER JOIN `enrollments_venue` ev
                                                    ON ev.`enroll_id` = e.`id`                                      
                                                    WHERE e.status='1' $where")->row_array();


        $data['sessions'] = $this->db->query("SELECT 
                                                COUNT(
                                                  CASE
                                                    WHEN e.`club_id` = '1' 
                                                    THEN e.`club_id` 
                                                  END
                                                ) AS swim_count,
                                                COUNT(
                                                  CASE
                                                    WHEN e.`club_id` = '2' 
                                                    THEN e.`club_id` 
                                                  END
                                                ) AS football_count,
                                                COUNT(
                                                  CASE
                                                    WHEN e.`club_id` = '3' 
                                                    THEN e.`club_id` 
                                                  END
                                                ) AS netball_count,
                                                COUNT(
                                                  CASE
                                                    WHEN e.`club_id` = '4' 
                                                    THEN e.`club_id` 
                                                  END
                                                ) AS holiday_count,
                                                COUNT(
                                                  CASE
                                                    WHEN e.`club_id` = '5' 
                                                    THEN e.`club_id` 
                                                  END
                                                ) AS tri_count 
                                              FROM
                                                students s 
                                                INNER JOIN `enrollments` e 
                                                  ON e.`child_id` = s.`id`  
                                                INNER JOIN `enrollments_venue` ev
                                                    ON ev.`enroll_id` = e.`id`         
                                                WHERE e.status='1' $where
                                              ")->row_array();


        loadViewComponents('business_projection', $data);
    }

    public function project_by_child() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['levels'] = returnLevels(array('keys' => 'id,program_id, level_name', 'format' => 'dropdown'));
        $data['child_projects'] = $this->db->query("SELECT 
                                                CONCAT(s.`firstname`,' ',s.`lastname`) AS child_name,
                                                c.`club_name`,
                                                l.`level_name`,
                                                e.`package`,
                                                e.`cost_per_session`,
                                                e.`daily_cost`,
                                                e.`competition_fee`,
                                                e.`annual_reg_fee`,
                                                e.`discount`,
                                                e.`vat_total`,
                                                v.`venue_name`,
                                                e.`individual_total`,
                                                e.`gross_total`
                                              FROM
                                                `enrollments_transactions` et 
                                                INNER JOIN `enrollments` e 
                                                  ON et.`transaction_id` = e.`transaction_id` 
                                                INNER JOIN `enrollments_venue` ev 
                                                  ON ev.`enroll_id` = e.`id` 
                                                INNER JOIN `programs` p 
                                                  ON p.`id` = e.`program_id` 
                                                INNER JOIN `clubs` c 
                                                  ON c.`id` = e.`club_id` 
                                                INNER JOIN levels l 
                                                  ON l.`id` = e.`level_id` 
                                                INNER JOIN `students` s 
                                                  ON s.`id` = e.`child_id` 
                                                INNER JOIN `venues` v 
                                                  ON v.`id` = ev.`venue_id`
                                                 
                                                    ")->result_array();
        loadViewComponents('business_projection_child', $data);
    }

    public function find_by_child() {

        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $level_id = $this->input->post('level_id');
        $venue_id = $this->input->post('venue_id');
        $where = '';

        if (!empty($term_id)) {
            $where .= " AND e.term_id='$term_id'";
        }
        if (!empty($club_id)) {
            $where .= " AND e.club_id='$club_id'";
        }
        if (!empty($level_id)) {
            $where .= " AND e.level_id='$level_id'";
        }
        if (!empty($venue_id)) {
            $where .= " AND v.id='$venue_id'";
        }

        $child_projects = $this->db->query("SELECT 
                                          CONCAT(s.`firstname`,' ',s.`lastname`) AS child_name,
                                          c.`club_name`,
                                          l.`level_name`,
                                          e.`package`,
                                          e.`cost_per_session`,
                                          e.`daily_cost`,
                                          e.`competition_fee`,
                                          e.`annual_reg_fee`,
                                          e.`discount`,
                                          e.`vat_total`,
                                          v.`venue_name`,
                                          e.`individual_total`,
                                          e.`gross_total`,
                                          e.`term_id`
                                        FROM
                                          `enrollments_transactions` et 
                                          INNER JOIN `enrollments` e 
                                            ON et.`transaction_id` = e.`transaction_id` 
                                          INNER JOIN `enrollments_venue` ev 
                                            ON ev.`enroll_id` = e.`id` 
                                          INNER JOIN `programs` p 
                                            ON p.`id` = e.`program_id` 
                                          INNER JOIN `clubs` c 
                                            ON c.`id` = e.`club_id` 
                                          INNER JOIN levels l 
                                            ON l.`id` = e.`level_id` 
                                          INNER JOIN `students` s 
                                            ON s.`id` = e.`child_id` 
                                          INNER JOIN `venues` v 
                                            ON v.`id` = ev.`venue_id`
                                            INNER JOIN `terms` t
                                            ON t.`id`= e.`term_id` 
                                            WHERE e.status='1'
                                            $where")->result_array();

        if (!empty($child_projects)) {
            foreach ($child_projects as $child_project) {
                ?>
                <tr>
                    <td><?= $child_project['child_name']; ?></td>
                    <td><?= $child_project['venue_name']; ?></td>
                    <td><?= $child_project['club_name']; ?></td>
                    <td><?= $child_project['level_name']; ?></td>
                    <td><?= $child_project['package']; ?></td>
                    <td><?= $child_project['daily_cost']; ?></td>
                    <td><?= $child_project['competition_fee']; ?></td>
                    <td><?= $child_project['annual_reg_fee']; ?></td>
                    <td><?= $child_project['discount']; ?></td>
                    <td><?= (int) $child_project['gross_total'] - (int) $child_project['discount']; ?></td>
                    <td><?= $child_project['individual_total']; ?></td>
                    <td><?= $child_project['vat_total']; ?></td>
                    <td><?= $child_project['vat_total']; ?></td>
                </tr>
                <?php
            }
        }
    }

    public function project_by_parents() {
        $data['parents_projects'] = $this->db->query("SELECT 
                                                        p.*,
                                                        s.`guardian_type`
                                                      FROM
                                                        `students` s 
                                                        INNER JOIN `parents` p 
                                                          ON p.`id` = s.`parent_id`")->result_array();
        loadViewComponents('business_projection_parent', $data);
    }

    public function assessment_entries() {
        $data['enroll_assessment'] = $this->db->query("SELECT 
                                                        CONCAT(s.`firstname`, ' ', s.`lastname`) AS child_name,
                                                        c.`club_name`,
                                                        l.`level_name`,
                                                        v.`venue_name`, 
                                                        ass.`date`,
                                                        ass.`day`,
                                                        ass.`start_time`,
                                                        ass.`end_time`
                                                      FROM
                                                        `enrollment_assessments` ea 
                                                        INNER JOIN `assessment` ass 
                                                          ON ass.`id` = ea.`assessment_session_id` 
                                                        INNER JOIN students s 
                                                          ON s.`id` = ea.`child_id` 
                                                        INNER JOIN `clubs` c 
                                                          ON c.`id` = ea.`club_id` 
                                                        INNER JOIN `levels` l 
                                                          ON l.`id` = ea.`level_id` 
                                                        INNER JOIN `venues` v 
                                                          ON v.`id` = ea.`venue_id` 
                                                          WHERE ea.`ass_type`='1'")->result_array();
        loadViewComponents('assessment_entries', $data);
    }

    public function makeup_session_entries() {
        $data['enroll_makeup'] = $this->db->query("SELECT 
                                                    CONCAT(s.`firstname`, ' ', s.`lastname`) AS child_name,
                                                    c.`club_name`,
                                                    l.`level_name`,
                                                    v.`venue_name`, 
                                                    ass.`date`,
                                                    ass.`day`,
                                                    ass.`start_time`,
                                                    ass.`end_time`
                                                  FROM
                                                    `enrollment_assessments` ea 
                                                    INNER JOIN `assessment` ass 
                                                      ON ass.`id` = ea.`assessment_session_id` 
                                                    INNER JOIN students s 
                                                      ON s.`id` = ea.`child_id` 
                                                    INNER JOIN `clubs` c 
                                                      ON c.`id` = ea.`club_id` 
                                                    INNER JOIN `levels` l 
                                                      ON l.`id` = ea.`level_id` 
                                                    INNER JOIN `venues` v 
                                                      ON v.`id` = ea.`venue_id` 
                                                      WHERE ea.`ass_type`='2'")->result_array();
        loadViewComponents('makeup_session_entries', $data);
    }

}
