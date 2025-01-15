<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General_settings extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_manager'));
    }

    public function index() {
        loadViewComponents('general_settings/general_settings');
    }

    public function vat_discount_setting() {
        $data['vats'] = $this->db->query("SELECT * FROM general_setting_discount")->row_array();
        loadViewComponents('general_settings/vat_discount_setting', $data);
    }

    public function terms_duration() {
        $data['terms'] = $this->db->query("SELECT * FROM terms")->result_array();
        loadViewComponents('general_settings/terms_duration', $data);
    }

    public function club_images() {
        $data['swim_club'] = $this->db->query("SELECT * FROM clubs WHERE id='1'")->row_array();
        $data['football_club'] = $this->db->query("SELECT * FROM clubs WHERE id='2'")->row_array();
        $data['netball_club'] = $this->db->query("SELECT * FROM clubs WHERE id='3'")->row_array();
        $data['holiday_club'] = $this->db->query("SELECT * FROM clubs WHERE id='4'")->row_array();
        $data['tri_club'] = $this->db->query("SELECT * FROM clubs WHERE id='5'")->row_array();
        loadViewComponents('general_settings/club_images', $data);
    }

    public function restriction() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['staffs'] = $this->admin_manager->SelectAllQuery("SELECT u.* FROM users u INNER JOIN `staff` s ON u.`id`=s.`staff_id`", 'ARRAY');
        $data['restrictions'] = $this->db->query("SELECT 
            n.`club_id`,
            c.`club_name`,
            n.`program_id`,
            p.`program_name`,
            n.`venue_id`,
            v.`venue_name`,
            n.`staff_id`,
            CONCAT(s.`first_name`,' ',s.`last_name`) AS staff_name
            FROM
            `access_control_restrictions` n 
            INNER JOIN `clubs` c 
            ON n.`club_id` = c.`id` 
            INNER JOIN `programs` p 
            ON n.`program_id` = p.`id` 
            INNER JOIN `venues` v 
            ON n.`venue_id` = v.`id` 
            INNER JOIN `staff` s 
            ON n.`staff_id` = s.`staff_id`")->result_array();
        loadViewComponents('general_settings/restriction', $data);
    }

    public function notification() {
        $data['terms'] = returnTerms(array('keys' => 'id, term_name', 'format' => 'dropdown'));
        $data['venues'] = returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'));
        $data['clubs'] = returnClubs(array('keys' => 'id, club_name', 'format' => 'dropdown'));
        $data['days'] = returnDays(array('keys' => 'id, day_name', 'format' => 'dropdown'));
        $data['programs'] = returnPrograms(array('keys' => 'id,club_id, program_name', 'format' => 'dropdown'));
        $data['Coaches'] = $this->db->query("SELECT u.*,s.email FROM `users` u INNER JOIN staff s ON u.id=s.staff_id WHERE u.role='2' GROUP BY u.id")->result_array();
        $data['notifications'] = $this->db->query("SELECT 
            n.`club_id`,
            c.`club_name`,
            n.`program_id`,
            p.`program_name`,
            n.`venue_id`,
            v.`venue_name`,
            n.`email_address` 
            FROM
            notifications n 
            INNER JOIN `clubs` c 
            ON n.`club_id` = c.`id` 
            INNER JOIN `programs` p 
            ON n.`program_id` = p.`id` 
            INNER JOIN `venues` v 
            ON n.`venue_id` = v.`id`")->result_array();
        loadViewComponents('general_settings/notification', $data);
    }

    public function news() {
        $data['news'] = $this->db->query("SELECT * FROM news")->result_array();
        loadViewComponents('general_settings/news', $data);
    }

    public function save_news() {
        $news = $this->input->post('news');
        $this->db->truncate('news');
        foreach ($news as $new) {
            $this->db->insert("news", array("description" => $new));
        }
        $this->session->set_flashdata("popup", "News has been created");
        redirect_to('/admin/general-settings/');
    }

    public function save_notification() {
        $clubs = $this->input->post('clubs');
        $this->db->truncate('notifications');
        foreach ($clubs as $key => $club) {
            $data = array(
                "club_id" => $club,
                "program_id" => $this->input->post('programs')[$key],
                "venue_id" => $this->input->post('venue')[$key],
                "email_address" => $this->input->post('email')[$key],
            );
            $this->db->insert("notifications", $data);
        }
        $this->session->set_flashdata("popup", "Notification has been created successfully");
        redirect_to('/admin/general-settings/');
    }

    public function save_restriction() {
        $clubs = $this->input->post('clubs');
        $this->db->truncate('access_control_restrictions');
        foreach ($clubs as $key => $club) {
            $data = array(
                "club_id" => $club,
                "program_id" => $this->input->post('programs')[$key],
                "venue_id" => $this->input->post('venue')[$key],
                "staff_id" => $this->input->post('staff')[$key],
            );
            $this->db->insert("access_control_restrictions", $data);
        }
        $this->session->set_flashdata("popup", "Restrictions has been created successfully");
        redirect_to('/admin/general-settings/');
    }

    public function save_terms() {
        $termone_start_date = $this->input->post('termone_start_date');
        $termone_end_date = $this->input->post('termone_end_date');
        $termone_fee = $this->input->post('termone_fee');

        $termtwo_start_date = $this->input->post('termtwo_start_date');
        $termtwo_end_date = $this->input->post('termtwo_end_date');
        $termtwo_fee = $this->input->post('termtwo_fee');

        $termthree_start_date = $this->input->post('termthree_start_date');
        $termthree_end_date = $this->input->post('termthree_end_date');
        $termthree_fee = $this->input->post('termthree_fee');

        $termfour_start_date = $this->input->post('termfour_start_date');
        $termfour_end_date = $this->input->post('termfour_end_date');
        $termfour_fee = $this->input->post('termfour_fee');

        $updateOne = array(
            "start_month" => $termone_start_date,
            "end_month" => $termone_end_date,
            "num_of_weeks" => $termone_fee,
        );
        $this->db->update('terms', $updateOne, array('id' => 1));

        $updateOne = array(
            "start_month" => $termone_start_date,
            "end_month" => $termone_end_date,
            "num_of_weeks" => $termone_fee,
        );
        $this->db->update('terms', $updateOne, array('id' => 1));

        $updateTwo = array(
            "start_month" => $termtwo_start_date,
            "end_month" => $termtwo_end_date,
            "num_of_weeks" => $termtwo_fee,
        );
        $this->db->update('terms', $updateTwo, array('id' => 2));

        $updateThree = array(
            "start_month" => $termthree_start_date,
            "end_month" => $termthree_end_date,
            "num_of_weeks" => $termthree_fee,
        );
        $this->db->update('terms', $updateThree, array('id' => 3));

        $updateFour = array(
            "start_month" => $termfour_start_date,
            "end_month" => $termfour_end_date,
            "num_of_weeks" => $termfour_fee,
        );
        $this->db->update('terms', $updateFour, array('id' => 4));

        $this->session->set_flashdata("popup", "Terms has been updated successfully");
        redirect_to('/admin/general-settings/');
    }

    public function save_vat_discount_setting() {
        $vat = $this->input->post('vat');
        $sibling_fee = $this->input->post('sibling_fee');
        $sibling_venue = $this->input->post('sibling_venue');
        $sibling_currency = $this->input->post('sibling_currency');


        $mulit_fee = $this->input->post('mulit_fee');
        $sibling_currency = $this->input->post('mulit_venue');
        $mulit_currency = $this->input->post('mulit_currency');
        $statusRirect = '';
        if (!empty($vat)) {
            $data['vat'] = $vat;
            $statusRirect = 'general_settings';
        } else {
            if ($this->input->post('sibling_fees')) {
                foreach ($this->input->post('sibling_fees') as $key => $fee) {
                    $otherDiscounts = array(
                        "discount" => $fee,
                        "venue_id" => $this->input->post('sibling_venues')[$key],
                        "currency" => $this->input->post('sibling_curr')[$key],
                        "discount_type" => 'sibling',
                    );
                    $this->db->insert("other_discounts", $otherDiscounts);
                }
            }

            if ($this->input->post('mulit_fees')) {
                foreach ($this->input->post('mulit_fees') as $key => $fee) {
                    $otherDiscounts = array(
                        "discount" => $fee,
                        "venue_id" => $this->input->post('mulit_venues')[$key],
                        "currency" => $this->input->post('mulit_curr')[$key],
                        "discount_type" => 'mutli-session',
                    );
                    $this->db->insert("other_discounts", $otherDiscounts);
                }
            }


            $statusRirect = 'discount_management';
        }
        $this->db->update("general_setting_discount", $data);

        if ($statusRirect == "general_settings") {
            $this->session->set_flashdata("popup", "VAT has been updated successfully");
            redirect_to('/admin/general-settings/');
        } else {
            $this->session->set_flashdata("popup", "Discounts has been updated successfully");
            redirect_to('/admin/discount-management/training-fee');
        }
    }

    public function save_club_images() {
        $swim_data = array();
        $config['upload_path'] = './assets/uploads/clubs/';
        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size'] = 100;
//        $config['max_width'] = 1024;
//        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (!empty($_FILES['swim_upload'])) {
            if (!$this->upload->do_upload('swim_upload')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $swim_data['image_path'] = $data['upload_data']['file_name'];
            }
        }

        if (!empty($_FILES['swim_upload_header'])) {
            if (!$this->upload->do_upload('swim_upload_header')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $swim_data['helper_text_image'] = $data['upload_data']['file_name'];
            }
        }

        $swim_data['color'] = $this->input->post('swim_color');
        $this->db->update('clubs', $swim_data, array('id' => '1'));

        if (!empty($_FILES['football_upload'])) {
            if (!$this->upload->do_upload('football_upload')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $football_data['image_path'] = $data['upload_data']['file_name'];
            }
        }
        if (!empty($_FILES['football_upload_header'])) {
            if (!$this->upload->do_upload('football_upload_header')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $football_data['helper_text_image'] = $data['upload_data']['file_name'];
            }
        }

        $football_data['color'] = $this->input->post('football_color');
        $this->db->update('clubs', $football_data, array('id' => '2'));

        if (!empty($_FILES['netball_upload'])) {
            if (!$this->upload->do_upload('netball_upload')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $netball_color['image_path'] = $data['upload_data']['file_name'];
            }
        }
        if (!empty($_FILES['netball_upload_header'])) {
            if (!$this->upload->do_upload('netball_upload_header')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $netball_color['helper_text_image'] = $data['upload_data']['file_name'];
            }
        }

        $netball_color['color'] = $this->input->post('netball_color');
        $this->db->update('clubs', $netball_color, array('id' => '3'));

        if (!empty($_FILES['tri_upload'])) {
            if (!$this->upload->do_upload('tri_upload')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $tri_color['image_path'] = $data['upload_data']['file_name'];
            }
        }

        if (!empty($_FILES['tri_upload_header'])) {
            if (!$this->upload->do_upload('tri_upload_header')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $tri_color['helper_text_image'] = $data['upload_data']['file_name'];
            }
        }

        $tri_color['color'] = $this->input->post('tri_color');
        $this->db->update('clubs', $tri_color, array('id' => '5'));

        if (!empty($_FILES['holiday_upload'])) {
            if (!$this->upload->do_upload('holiday_upload')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $holiday_color['image_path'] = $data['upload_data']['file_name'];
            }
        }

        if (!empty($_FILES['holiday_upload_header'])) {
            if (!$this->upload->do_upload('holiday_upload_header')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $holiday_color['helper_text_image'] = $data['upload_data']['file_name'];
            }
        }

        $holiday_color['color'] = $this->input->post('holiday_color');
        $this->db->update('clubs', $holiday_color, array('id' => '4'));

        $this->session->set_flashdata("popup", "Club has been updated successfully");
        redirect_to('/admin/general-settings/');
    }

    public function price_list() {
        $data['price_lists'] = $this->db->query("SELECT * FROM price_list")->result_array();
        $data['price_document'] = $this->db->query("SELECT * FROM general_document WHERE reference_name='price_list'")->row_array();
        loadViewComponents('general_settings/price_list', $data);
    }

    public function terms_condition() {
        $data['terms_and_conditions'] = $this->db->query("SELECT * FROM terms_and_conditions")->result_array();
        loadViewComponents('general_settings/terms_condition', $data);
    }

    public function save_price_list() {
        $otherDoc = array();

        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc|ppt';
        $this->load->library('upload', $config);

        if (!empty($_FILES['uploaddoc'])) {
            if (!$this->upload->do_upload('uploaddoc')) {
                $error = array('error' => $this->upload->display_errors());
                echo $error;
            } else {
                $data = array('upload_data' => $this->upload->data());
                $otherDoc['document'] = $data['upload_data']['file_name'];
                $otherDoc["reference_name"] = 'price_list';
            }
        }

        $checkCount = $this->db->query('SELECT * FROM general_document')->result_array();
        if (empty($checkCount)) {
            $this->db->insert("general_document", $otherDoc);
        } else {
            $this->admin_manager->Update("general_document", $otherDoc, array("id" => "1"));
        }
        $terms = $this->input->post('itemz');
        $price = $this->input->post('pricez');
        if (!empty($terms)) {
            $this->db->truncate('price_list');
            foreach ($terms as $key => $term) {
                echo $term;
                if (isset($price[$key])) {
                    $this->db->insert("price_list", array("item" => $term, "price" => $price[$key]));
                }
            }
        }
        $this->session->set_flashdata("popup", "Added Items successfully");
        redirect_to('/admin/general-settings/');
    }

    public function save_terms_condition() {
        $terms = $this->input->post('terms');
        $this->db->truncate('terms_and_conditions');
        foreach ($terms as $term) {
            $this->db->insert("terms_and_conditions", array("description" => $term));
        }
        $this->session->set_flashdata("popup", "Added Terms & Condition successfully");
        redirect_to('/admin/general-settings/');
    }

    public function getWeeks() {
        $start_date = $this->input->post("start_data");
        $end_date = $this->input->post("end_data");
        echo datediff('ww', $start_date, $end_date, false);
    }

}
