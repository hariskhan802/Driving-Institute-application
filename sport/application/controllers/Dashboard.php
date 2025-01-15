<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
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

        // d($data); 
        loadViewComponents('dashboard', $data);
    }

    public function filter_dashboard() {
        
    }

}
