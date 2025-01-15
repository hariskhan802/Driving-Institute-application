<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
define('DEVELOPMENT', true);

function d($var) {
    if (!DEVELOPMENT)
        return;
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

function _die($var) {
    if (!DEVELOPMENT)
        return;
    d($var);
    die();
}

function _d($var) {
    if (!DEVELOPMENT)
        return;
    _die($var);
}

function redirect_to($url) {
    redirect(site_url($url));
}

function encrypt_decrypt($action, $string) {
    $encrypt_method = "AES-256-CBC";
    $secret_key = '!@#$%^&UHJM,';
    $secret_iv = '9e33$$22qw%^&*(';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt')
        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    else if ($action == 'decrypt')
        return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return false;
}

function loadViewComponents($view_name, $data = array()) {
    $ci = & get_instance();
    $ci->load->view('header');
    $ci->load->view('sidebar');
    $ci->load->view($view_name, $data);
    $ci->load->view('footer');
}

function uploadFileHelper($Base64MIMI, $Base64Encoded, $filePath = './assets/uploads/') {
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
    return $filename;
}

function returnClubs($args = array(), $selected_id = '') {
    $ci = & get_instance();
    $ci->load->database();
    $keys = '*';
    if (!empty($args['keys']))
        $keys = $args['keys'];
    $query = "SELECT {$keys} FROM `clubs`";
    $assesment = false;
    if (!empty($args['is_assesment']) && $args['is_assesment'])
        $query .= " WHERE `is_assesment` = 1";
    $order_by = 'club_name';
    if (!empty($args['order_by']))
        $order_by = $args['order_by'];
    $order = 'ASC';
    if (!empty($args['order_type']))
        $order = $args['order_type'];
    $query .= " ORDER BY sort_order";
    $data = $ci->db->query($query)->result_array();
    if (!empty($args['format'])) {
        if ($args['format'] == 'dropdown') {
            $select = '';
            $dropdown = "<option value=''>All</option>";
            foreach ($data as $op) {
                if (!empty($selected_id) && @$op['id'] == $selected_id) {
                    $select = 'selected=""';
                } else {
                    $select = '';
                }
                $dropdown .= "<option value='" . @$op['id'] . "' $select>" . $op['club_name'] . "</option>";
            }
            return $dropdown;
        }
    }
    return $data;
}

function returnPrograms($args = array(), $selected_id = '') {
    $ci = & get_instance();
    $ci->load->database();
    $keys = '*';
    if (!empty($args['keys']))
        $keys = $args['keys'];
    $query = "SELECT 
    `programs`.*
    FROM
    `programs` 
    INNER JOIN `clubs` 
    ON `programs`.`club_id` = `clubs`.`id`
    LEFT JOIN `levels` 
    ON `programs`.`id` = `levels`.`program_id`";
    if (!empty($args['where']))
        $query .= ' WHERE ' . implode(' AND ', $args['where']);
    $order_by = 'program_name';
    if (!empty($args['order_by']))
        $order_by = $args['order_by'];
    $order = 'ASC';
    if (!empty($args['order_type']))
        $order = $args['order_type'];
    $query .= " GROUP BY programs.`id` ORDER BY programs.`id`";
    $data = $ci->db->query($query)->result_array();
    if (!empty($args['format'])) {
        if ($args['format'] == 'dropdown') {
            $dropdown = "<option value=''>All</option>";
            if (!empty($data)) {
                $select = '';
                foreach ($data as $op) {
                    if (!empty($selected_id) && @$op['id'] == $selected_id) {
                        $select = 'selected=""';
                    } else {
                        $select = '';
                    }
                    $dropdown .= "<option value='" . @$op['id'] . "' $select>" . $op['program_name'] . "</option>";
                }
            } else
                $dropdown .= "<option value=''>No Programs</option>";
            return $dropdown;
        }
    }
    return $data;
}

function returnCoaches($args = array(), $selected_id = '') {
    $ci = & get_instance();
    $ci->load->database();
    $keys = '*';
    if (!empty($args['keys']))
        $keys = $args['keys'];
    $query = "SELECT u.*,s.first_name,s.last_name FROM `users` u INNER JOIN staff s ON u.id=s.staff_id WHERE u.role='2' GROUP BY u.id";
    $data = $ci->db->query($query)->result_array();
    if (!empty($args['format'])) {
        if ($args['format'] == 'dropdown') {
            $dropdown = "<option value='' selected='selected'>Select Staff</option>";
            if (!empty($data)) {
                foreach ($data as $op) {
                    if (!empty($selected_id) && @$op['id'] == $selected_id) {
                        $select = 'selected=""';
                    } else {
                        $select = '';
                    }
                    $dropdown .= "<option value='" . @$op['id'] . "' $select>" . $op['first_name'] . " " . $op['last_name'] . "</option>";
                }
            } else
                $dropdown .= "<option value=''>No Coach</option>";
            return $dropdown;
        }
    }
    return $data;
}

function returnDays($args = array(), $selected_id = '') {
    $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    if ($args['format'] == 'dropdown') {
        $dropdown = "<option value='' selected='selected'>Select Day</option>";
        if (!empty($days)) {
            $select = '';
            foreach ($days as $key => $op) {
                if (!empty($selected_id) && ($key + 1) == $selected_id) {
                    $select = 'selected=""';
                }
                $dropdown .= "<option value='" . ($key + 1) . "' $select>" . $op . "</option>";
            }
        } else
            $dropdown .= "<option value=''>No Programs</option>";
        return $dropdown;
    }
}

function returnLevels($args = array(), $selected_id = '') {
    $ci = & get_instance();
    $ci->load->database();
    $keys = '*';
    if (!empty($args['keys']))
        $keys = $args['keys'];
    $query = "SELECT {$keys} FROM `levels`";
    if (!empty($args['where']))
        $query .= ' WHERE ' . implode(' AND ', $args['where']);
    $order_by = 'level_name';
    if (!empty($args['order_by']))
        $order_by = $args['order_by'];
    $order = 'ASC';
    if (!empty($args['order_type']))
        $order = $args['order_type'];
    $query .= " ORDER BY {$order_by} {$order}";
    $data = $ci->db->query($query)->result_array();
    if (!empty($args['format'])) {
        if ($args['format'] == 'dropdown') {
            $dropdown = "<option value='' selected='selected'>All</option>";
            if (!empty($data)) {
                $select = '';
                foreach ($data as $op) {
                    if (!empty($selected_id) && @$op['id'] == $selected_id) {
                        $select = 'selected=""';
                    } else {
                        $select = '';
                    }
                    $dropdown .= "<option data-duration='" . @$op['duration'] . "' value='" . @$op['id'] . "' $select>" . $op['level_name'] . "</option>";
                }
            } else
                $dropdown .= "<option value=''>No Clubs</option>";
            return $dropdown;
        }
    }
    return $data;
}

function returnTerms($args = array(), $selected_id = '') {
    $ci = & get_instance();
    $ci->load->database();
    $keys = '*';
    if (!empty($args['keys']))
        $keys = $args['keys'];
    $query = "SELECT {$keys} FROM `terms`";
    if (!empty($args['where']))
        $query .= ' WHERE ' . implode(' AND ', $args['where']);
    $order_by = 'term_name';
    if (!empty($args['order_by']))
        $order_by = $args['order_by'];
    $order = 'ASC';
    if (!empty($args['order_type']))
        $order = $args['order_type'];
    $query .= " ORDER BY {$order_by} {$order}";
    $data = $ci->db->query($query);
    if ($data->num_rows() > 0)
        $data = $data->result_array();
    if (!empty($args['format'])) {
        if ($args['format'] == 'dropdown') {
            $dropdown = "<option value='' selected='selected'>All</option>";
            $select = '';
            foreach ($data as $op) {
                if (!empty($selected_id) && @$op['id'] == $selected_id) {
                    $select = 'selected=""';
                } else {
                    $select = '';
                }
                $dropdown .= "<option value='" . @$op['id'] . "' $select>" . @$op['term_name'] . "</option>";
            }
            return $dropdown;
        }
    }
    return $data;
}

// function returnDays($args = array()) {
//     $ci = & get_instance();
//     $ci->load->database();
//     $keys = '*';
//     if (!empty($args['keys']))
//         $keys = $args['keys'];
//     $query = "SELECT {$keys} FROM `days`";
//     $order_by = 'id';
//     if (!empty($args['order_by']))
//         $order_by = $args['order_by'];
//     $order = 'ASC';
//     if (!empty($args['order_type']))
//         $order = $args['order_type'];
//     $query .= " ORDER BY {$order_by} {$order}";
//     $data = $ci->db->query($query)->result_array();
//     if (!empty($args['format'])) {
//         if ($args['format'] == 'dropdown') {
//             $dropdown = "<option value='' selected='selected'>Select Day</option>";
//             foreach ($data as $op)
//                 $dropdown .= "<option value='" . @$op['id'] . "'>" . $op['day_name'] . "</option>";
//             return $dropdown;
//         }
//     }
//     return $data;
// }
function returnVenues($args = array(), $selected_id = '') {
    $ci = & get_instance();
    $ci->load->database();
    $keys = '*';
    if (!empty($args['keys']))
        $keys = $args['keys'];
    $query = "SELECT * FROM `venues`";
    $order_by = 'venue_name';
    if (!empty($args['order_by']))
        $order_by = $args['order_by'];
    $order = 'ASC';
    if (!empty($args['order_type']))
        $order = $args['order_type'];
    $query .= " ORDER BY {$order_by} {$order}";
    $data = $ci->db->query($query)->result_array();
    if (!empty($args['format'])) {
        if ($args['format'] == 'dropdown') {
            $dropdown = "<option value=''>All</option>";
            $selectd = '';
            foreach ($data as $op) {
// if(!empty($selected_id))
                $selectd = ($selected_id == $op['id']) ? "selected='selected'" : "";
                $dropdown .= "<option value='" . @$op['id'] . "' $selectd>" . $op['short_code'] . "</option>";
            }
            return $dropdown;
        }
    }
    return $data;
}

function print_dropdown($options = "<option value='' selected='selected'>Select</option>") {
    if (!empty($options))
        echo $options;
}

function print_url($url) {
    echo site_url($url);
}

function toaster_success($msg) {
    if (empty($msg))
        return;
    echo '<script>toaster("Success", "' . $msg . '");</script>';
}

function toaster_error($msg) {
    if (empty($msg))
        return;
    echo '<script>toaster("Error", "' . $msg . '");</script>';
}

function getControllerName() {
    $ci = & get_instance();
    return $ci->router->fetch_class();
}

function write($array = array()) {
    $res = array('status' => 500, 'data' => array());
    if (!empty($array))
        $res = array('status' => 200, 'data' => $array);
// _d($res);
    echo json_encode($res);
}

function return_time_picker() {
    $hours = "<option value='' selected=''>Hour</option>";
    for ($hour = 0; $hour <= 12; $hour++) {
        $t = sprintf("%02d", $hour);
        $hours .= "<option value='{$t}'>{$t}</option>";
    }
    $mins = "<option value='' selected=''>Minute</option>";
    for ($min = 0; $min < 60; $min++) {
        $t = sprintf("%02d", $min);
        $mins .= "<option value='{$t}'>{$t}</option>";
    }
    $periods = "<option value='' selected=''>Period</option>";
    $periods .= "<option>AM</option>";
    $periods .= "<option>PM</option>";
    return array("hours" => $hours, "mins" => $mins, "periods" => $periods);
}

function deleteFnc($table, $data = array(), $redirect = "") {
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->delete($table, $data);
    if (!empty($redirect)) {
        redirect(site_url($redirect));
    }
}

function api_write($response) {
    header('Content-type: application/json');
    echo json_encode($response);
    die();
}

function responder($error_code, $message, $data = array()) {
    $response = array('status' => 200, 'message' => $message);
    switch ($error_code) {
        case 200:
            $response = array('status' => 200, 'message' => $message, 'data' => $data);
            break;
        case 205:
            $response = array('status' => 205, 'message' => "Username Field is empty!");
            break;
        case 206:
            $response = array('status' => 206, 'message' => "Password Field is empty!");
            break;
        case 207:
            $response = array('status' => 207, 'message' => "Sorry! You have entered a wrong username or password!");
            break;
        case 208:
            $response = array('status' => 208, 'message' => "User is already logged in!");
            break;
        case 604:
            $response = array('status' => 604, 'message' => "Unauthorized Access!");
            break;
        case 500:
            $response = array('status' => 500, 'message' => $message);
            break;
        case 502:
            $response = array('status' => 502, 'message' => "Email is already in use!");
            break;
        case 503:
            $response = array('status' => 503, 'message' => "Error in Adding Record!");
            break;
        case 504:
            $response = array('status' => 504, 'message' => "Error in Updating Record!");
            break;
        case 505:
            $response = array('status' => 505, 'message' => "Error in Deleting Record!");
            break;
        case 506:
            $response = array('status' => 506, 'message' => "Error in Getting Record!");
            break;
        case 507:
            $response = array('status' => 507, 'message' => "No Record Found!");
            break;
        case 508:
            $response = array('status' => 508, 'message' => "No id selected!");
            break;
        case 509:
            $response = array('status' => 509, 'message' => "Error in sending mail!");
            break;
        case 510:
            $response = array('status' => 510, 'message' => "Error in sending reset link!");
            break;
        default:
            $response = array('status' => 500, 'message' => 'error');
            break;
    }
    api_write($response);
}

function send_notification($from = '', $to = '', $subject = '', $message = '', $api = false) {
    $ci = & get_instance();
    $ci->load->library('email');
    /* $config['protocol']     = 'smtp';
      $config['smtp_host']    = 'ssl://smtp.gmail.com';
      $config['smtp_port']    = '465';
      $config['smtp_timeout'] = '7';
      $config['smtp_user']    = 'taimoorimran9@gmail.com';
      $config['smtp_pass']    = 'zaidbhai2009/';
      $config['charset']      = 'utf-8';
      $config['newline']      = "\r\n";
      $config['mailtype']     = 'text';
      $config['validation']   = TRUE;
      $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'taimoorimran9@gmail.com',
      'smtp_pass' => 'zaidbhai2009/',
      'mailtype'  => 'html',
      'charset'   => 'iso-8859-1'
      ); */
    $ci->email->initialize();
    $ci->email->set_mailtype("html");
    $ci->email->set_newline("\r\n");
    $ci->email->from('info@freebigdisplay.com', 'MSA');
    $ci->email->to($to);
    $ci->email->subject($subject);
    $ci->email->message($message);
    $send = $ci->email->send();
    if ($api)
        return $send;
    if ($send) {
        echo "Success";
    } else {
        echo "Failed";
    }
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
      $interval can be:
      yyyy - Number of full years
      q    - Number of full quarters
      m    - Number of full months
      y    - Difference between day numbers
      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
      d    - Number of full days
      w    - Number of full weekdays
      ww   - Number of full weeks
      h    - Number of full hours
      n    - Number of full minutes
      s    - Number of full seconds (default)
     */
    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds
    $months_difference = 0;
    switch ($interval) {
        case 'yyyy': // Number of full years
            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                $years_difference--;
            }
            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                $years_difference++;
            }
            $datediff = $years_difference;
            break;
        case "q": // Number of full quarters
            $quarters_difference = floor($difference / 8035200);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $quarters_difference--;
            $datediff = $quarters_difference;
            break;
        case "m": // Number of full months
            $months_difference = floor($difference / 2678400);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $months_difference--;
            $datediff = $months_difference;
            break;
        case 'y': // Difference between day numbers
            $datediff = date("z", $dateto) - date("z", $datefrom);
            break;
        case "d": // Number of full days
            $datediff = floor($difference / 86400);
            break;
        case "w": // Number of full weekdays
            $days_difference = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day = date("w", $datefrom);
            $days_remainder = floor($days_difference % 7);
            $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
            if ($odd_days > 7) { // Sunday
                $days_remainder--;
            }
            if ($odd_days > 6) { // Saturday
                $days_remainder--;
            }
            $datediff = ($weeks_difference * 5) + $days_remainder;
            break;
        case "ww": // Number of full weeks
            $datediff = floor($difference / 604800);
            break;
        case "h": // Number of full hours
            $datediff = floor($difference / 3600);
            break;
        case "n": // Number of full minutes
            $datediff = floor($difference / 60);
            break;
        default: // Number of full seconds (default)
            $datediff = $difference;
            break;
    }
    return $datediff;
}
function level_by_id($id){
    $ci = & get_instance();
    $ci->load->database();
    return $ci->db->query('SELECT level_name from levels WHERE id = '.$id)->row_array();
}
function get_parent($child){
    $ci = & get_instance();
    $ci->load->database();
    return $ci->db->query("SELECT 
                              parents.`id`, 
                              CONCAT(parents.`first_name`, ' ', parents.`last_name`) AS p_name,
                              parents.`email`,
                              clubs.`club_name`,
                              CONCAT(students.`firstname`, ' ', students.`lastname`) AS name,
                            CASE 
                                WHEN students.`gender` = 'f' THEN 'Her'
                                WHEN students.`gender` = 'm' THEN 'Him'
                                ELSE 'Him'
                            END as gender
                            FROM
                              `students` 
                              INNER JOIN `parents` 
                                ON `parents`.`id` = `students`.`parent_id` 
                              INNER JOIN `enrollments` 
                                ON `enrollments`.`child_id` = `students`.`id`
                              INNER JOIN `clubs` 
                                ON `clubs`.`id` = `enrollments`.`club_id`   
                            WHERE `students`.`id` = $child ")->row_array();
}
function parent_congrats_tmp($args){
    return "<h3>Dear $args[p_name],</h3>
        <p>CONGRATULATIONS!!!</p>
        <p>$args[name] has completed ".level_by_id($args['old_level'])['level_name']." and is ready to move to the next level with $args[club_name] . $args[gender]  new level is ".level_by_id($args['old_level'])['level_name']." .</p>
        <p>
        If halfway through a school term kindly speak to your coach to select your new session time or if at the end of term please visit My Sports Hub and book your next session at the new level.</p>
        <p>
        Thank you for being part of My Sports Academy and supporting a child-centered environment focused on learning through fun.</p>
         <br />
        <p>The MSA Team</p>
        <p>#Aspire #Inspire</p>
        <br />
        <p>@MySportsAcademyDubai %Facebook%</p>
        <p>@MySportsAcademy %Instagram%</p>
        ";
}