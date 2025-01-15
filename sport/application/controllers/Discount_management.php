<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_management extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        
    }

    public function venues_discount() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['discounts'] = $this->db->query("SELECT
        ds.`id`, 
        t.`term_name`,
        c.`club_name`,
        p.`program_name`,
        v.`venue_name`,
        ds.`value`,
        ds.`discount_by`
        FROM
        discounts ds 
        INNER JOIN `venues` v 
        ON ds.`venue_id` = v.`id` 
        INNER JOIN `terms` t 
        ON t.`id` = ds.`term_id` 
        INNER JOIN `clubs` c 
        ON ds.`club_id` = c.`id` 
        INNER JOIN `programs` p 
        ON ds.`program_id` = p.`id` 
        WHERE ds.discount_for = 'venue' ")->result_array();

        loadViewComponents('discount_management/discounts', $data);
    }

    public function add_venue_discount() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        loadViewComponents('discount_management/add_venue_discounts', $data);
    }

    public function save_venue_discount() {
        if ($this->input->post('terms_id')) {
            $terms = $this->input->post('terms_id');
            foreach ($terms as $key => $term) {
                $data = array(
                    'venue_id' => $this->input->post('venues_id')[$key],
                    'term_id' => $term,
                    'club_id' => $this->input->post('clubs_id')[$key],
                    'program_id' => $this->input->post('programs_id')[$key],
                    'value' => $this->input->post('values')[$key],
                    'discount_by' => $this->input->post('type')[$key],
                    'discount_for' => 'venue',
                );
                $this->db->insert("discounts", $data);
            }
            $this->session->set_flashdata("popup", "Discount Added Successfully!");
        }

        redirect_to('/admin/discount-management/venues-discount');
    }

    //===================================================//////

    public function student_discount() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['discounts'] = $this->db->query("SELECT 
        CONCAT(s.`firstname`,' ',s.`lastname`) AS full_name,
        t.`term_name`,
        c.`club_name`,
        l.`level_name`,
        v.`venue_name`,
        ds.`value`,
        ds.`discount_by` 
        FROM
        discounts ds 
        INNER JOIN `venues` v 
        ON ds.`venue_id` = v.`id` 
        INNER JOIN `terms` t 
        ON t.`id` = ds.`term_id` 
        INNER JOIN `clubs` c 
        ON ds.`club_id` = c.`id` 
        INNER JOIN `levels` l 
        ON l.`id` = ds.`level_id`
        INNER JOIN `students` s
        ON ds.`student_id` = s.`id`
        WHERE ds.discount_for = 'student'")->result_array();

        loadViewComponents('discount_management/student_discounts', $data);
    }

    public function add_student_discount() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['levels'] = returnLevels(array('keys' => 'id,program_id, level_name', 'format' => 'dropdown'));
        $data['students'] = $this->db->query("SELECT * FROM students")->result_array();
        loadViewComponents('discount_management/add_student_discounts', $data);
    }

    public function save_student_discount() {
        $this->db->delete("discounts", array('student_id' => $this->input->post('child_id')));
        if ($this->input->post('terms_id')) {
            $terms = $this->input->post('terms_id');
            foreach ($terms as $key => $term) {
                $data = array(
                    'term_id' => $term,
                    'venue_id' => $this->input->post('venues_id')[$key],
                    'club_id' => $this->input->post('clubs_id')[$key],
                    'level_id' => $this->input->post('levels_id')[$key],
                    'value' => $this->input->post('values')[$key],
                    'student_id' => $this->input->post('child_id'),
                    'discount_by' => $this->input->post('type')[$key],
                    'discount_for' => 'student',
                );
                $this->db->insert("discounts", $data);
            }
            $this->session->set_flashdata("popup", "Discount Added Successfully!");
        }
        redirect_to('/admin/child-management/');
    }

    public function Training_fee() {
        $data['siblings'] = $this->db->query("SELECT * FROM other_discounts WHERE discount_type='sibling'")->result_array();
        $data['multi_session'] = $this->db->query("SELECT * FROM other_discounts WHERE discount_type='mutli-session'")->result_array();
        loadViewComponents('discount_management/training_fee', $data);
    }

    public function delete($id) {
        $this->admin_manager->Delete("discounts", 'id', $id);
        $this->session->set_flashdata("popup", "Deleted Successfully");
        redirect_to('admin/discount-management/venues-discount');
    }

    public function filter_sessions() {
        $where = '';
        $term_id = $this->input->post('term_id');
        $club_id = $this->input->post('club_id');
        $program_id = $this->input->post('program_id');
        $discount_type = $this->input->post('discount_type');
        $venue_id = $this->input->post('venue_id');
        $where = '';
        if (!empty($term_id)) {
            $where .= " AND d.term_id='$term_id'";
        }
        if (!empty($club_id)) {
            $where .= " AND d.`club_id`='$club_id'";
        }
        if (!empty($program_id)) {
            $where .= " AND d.program_id='$program_id'";
        }

        if (!empty($venue_id)) {
            $where .= " AND d.venue_id='$venue_id'";
        }
        $discounts = $this->db->query("SELECT 
      d.*,
      c.`id` AS club_id,
      c.`club_name`,
      t.`term_name`,
      p.`program_name`,
      v.`venue_name`,
      v.`short_code` 
      FROM
      discounts d 
      INNER JOIN `clubs` c 
      ON d.`club_id` = c.`id` 
      INNER JOIN `programs` p 
      ON p.`id` = d.`program_id` 
      INNER JOIN `venues` v 
      ON v.`id` = d.`venue_id` 
      INNER JOIN `terms` t 
      ON t.`id` = d.`term_id` 
      WHERE discount_for = 'venue' 
      $where")->result_array();
        if (!empty($discounts)) {
            foreach ($discounts as $discount) {
                ?>
                <tr>
                    <td><?php echo $discount['term_name']; ?></td>
                    <td><?php echo $discount['club_name']; ?></td>
                    <td><?php echo $discount['program_name']; ?></td>
                    <td><?php echo $discount['venue_name']; ?></td>
                    <td><?php echo $discount['value']; ?></td>
                    <td><?php echo $discount['discount_by']; ?></td>
                    <td>
                        <a href="#myModal" class="delete_me" data-url="<?= site_url('/admin/discount-management/delete/' . $discount['id']); ?>" data-toggle="modal" title="Delete">
                            <i class="material-icons f-left">delete</i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='7'>Not Found</td></tr>";
        }
    }

    public function delete_quick() {
        $id = $this->input->post('id');
        $this->db->delete("other_discounts", array('id' => $id));
    }

}
