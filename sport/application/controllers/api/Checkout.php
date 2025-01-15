<?php
include('Parents.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkout extends Parents {
    function __construct(){
        parent::__construct();
    }    
    public function flatten_array($encrypted_key ){
        $parent_id = encrypt_decrypt('decrypt', $encrypted_key);
        if(empty($parent_id)) responder(508, null);
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $enrollments = $post->params;
        $vat = $this->db->query("SELECT vat FROM general_setting_discount ORDER BY id DESC LIMIT 1;")->row()->vat;
        // $if_annual_fee_paid = $this->db->query("SELECT count(*) as count FROM annual_fee_log WHERE parent_id = {} ORDER BY id DESC LIMIT 1;")->row()->count;
        $refined = array('enrollments' => array(), 'payments' => array('grand_total' => 0, 'default_symbol' => 'AED'));
        foreach($enrollments as $p){
            $enroll = array(
                'type'                   => $p->type,
                'club_id'                => null,
                'club_name'              => null,
                'club_is_assesment'      => null,
                'club_image_path'        => null,
                'club_helper_text_image' => null,
                'child_id'               => null,
                'child_firstname'        => null,
                'child_lastname'         => null,
                'child_profile_pic'      => null,
                'skill_level'            => $p->skill_level,
                'skill_level_name'       => $p->skill_level_name,
                'skill_level_color'      => $p->skill_level_color,
                'program_id'             => $p->program_id,
                'venues'                 => array(),
                'venue_display_name'     => null,
                'term_id'                => @$p->term_id,
                'term_name'              => @$p->term_name,
                'session_id'             => @$p->session_id,
                // 'sessions'               => array(),
                'competition_fee'        => $p->competition_fee,
                'annual_reg_fee'         => 0,
                'full_week_cost'         => 0,
                'session_card_cost'      => 0,
                'daily_cost'             => 0,
                'exclusion_per_day_cost' => 0,
                'package'                => null,
                'package_display_name'   => null,
                'enroll_for_competition' => $p->enroll_for_competition,
                'cost_per_session'       => 0,
                'num_of_sessions'        => 0,
                'session_per_week'       => 0,
                'session_details'        => $p->session_details,
                'days' => array(
                    'Sunday'    => '-',
                    'Monday'    => '-',
                    'Tuesday'   => '-',
                    'Wednesday' => '-',
                    'Thursday'  => '-',
                    'Friday'    => '-',
                    'Saturday'  => '-'
                ),
                'session_metas'     => array(),
                'all_selected_days' => null,
                'schedule'          => null,
                'week_selected'     => null,
                'training_fee'      => 0,
                'discount'          => 0,
                'savings'           => 0,
                'gross_total'       => 0,
                'vat_total'         => 0,
                'individual_total'  => 0
            );
            if($enroll['enroll_for_competition'] != 'yes') $enroll['competition_fee'] = 0;
            if(!empty($p->club)){
                $enroll['club_id']                = $p->club->id;
                $enroll['club_name']              = $p->club->club_name;
                $enroll['club_is_assesment']      = $p->club->is_assesment;
                $enroll['club_image_path']        = $p->club->image_path;
                $enroll['club_helper_text_image'] = $p->club->helper_text_image;
            }
            if(!empty($p->child)){
                $enroll['child_id']          = $p->child->id;
                $enroll['child_firstname']   = $p->child->firstname;
                $enroll['child_lastname']    = $p->child->lastname;
                $enroll['child_profile_pic'] = $p->child->profile_pic;
            }
            if($p->type == 'first' || $p->type == 'second'){                
                if(!empty($p->session_details)){
                    if(!empty($p->session_details->days)){
                        foreach ($p->session_details->days as $key => $value){
                            foreach($value as $v){
                                $enroll['display_days'][$key][] = $v->start_time . ' - ' . $v->end_time;
                                $enroll['session_metas'][]      = $v->meta_id;
                                $enroll['num_of_sessions']++;
                            }
                            if(!empty($enroll['display_days'][$key])) $enroll['days'][$key] = implode(', ', $enroll['display_days'][$key]);
                        }
                    }
                }
                $enroll['session_id']               = $p->session_id;
                $enroll['annual_reg_fee']           = $p->annual_reg_fee;
                $enroll['venue_display_name']       = $p->venue_name;
                $enroll['venues'][]                 = array('venue_id' => $p->venue_id, 'venue_name' => $p->venue_name);
                $enroll['cost_per_session']         = $p->cost_per_session;
                $enroll['training_fee']             = $p->cost_per_session * $enroll['num_of_sessions'];
                $enroll['gross_total']              = $enroll['training_fee'] + $enroll['competition_fee'] + $enroll['annual_reg_fee'];
                $enroll['vat_total']                = (($vat / 100) * $enroll['gross_total']);
                $enroll['individual_total']         = $enroll['vat_total'] + $enroll['gross_total'];
                $refined['payments']['grand_total'] = $refined['payments']['grand_total'] + $enroll['individual_total'];
                $enroll['discount']                 = 0;
                $enroll['savings']                  = 0;
                $enroll['all_selected_days']        = '-';
                $enroll['session_per_week']         = '-';
                $enroll['package']                  = '-';
                $enroll['package_display_name']     = '-';
                $enroll['cost']                     = '-';
                $enroll['week_selected']            = '-';
                $enroll['schedule']                 = $enroll['package_display_name'];
            }
            else if($p->type == 'third'){
                $enroll['cost']                   = $p->full_week_cost;
                $enroll['daily_cost']             = $p->daily_cost;
                $enroll['venue_display_name']     = $p->venue_name;
                $enroll['venues'][]               = array('venue_id' => $p->venue_id, 'venue_name' => $p->venue_name);
                $enroll['exclusion_per_day_cost'] = $p->exclusion_per_day_cost;
                $enroll['package']                = $p->package;
                if($p->package == 'full_week'){
                    if(!empty($p->session_details)){
                        $t = array();
                        if(!empty($p->session_details)){
                            if(!empty($p->session_details->weeks)){
                                foreach ($p->session_details->weeks as $week){
                                    if(empty($week)) continue;
                                    foreach($week as $w){
                                        $enroll['week_selected'][] = $w->week_name;
                                        foreach ($w->metas as $value){
                                            if($value){
                                                $enroll['session_metas'][] = $key;
                                            }
                                        }
                                    }
                                }
                                if(!empty($enroll['week_selected'])) $enroll['week_selected'] = implode(', ', array_unique($enroll['week_selected']));
                            }
                        }
                    }
                    $enroll['package_display_name']     = "Full Week";
                    $enroll['gross_total']              = $enroll['cost'] + $enroll['competition_fee'] + $enroll['annual_reg_fee'];
                    $enroll['vat_total']                = ($vat / 100) * $enroll['gross_total'];
                    $enroll['individual_total']         = $enroll['vat_total'] + $enroll['gross_total'];
                    $refined['payments']['grand_total'] = $refined['payments']['grand_total'] + $enroll['individual_total'];
                    $enroll['all_selected_days']        = '-';
                }
                elseif($p->package == 'daily'){
                    if(!empty($p->session_details)){
                        if(!empty($p->session_details->days)){
                            foreach ($p->session_details->days as $key => $value){
                                foreach($value as $v){
                                    $enroll['all_selected_days'][] = $v->formatted_date;
                                    $enroll['session_metas'][]     = $v->meta_id;
                                }
                            }
                            if(!empty($enroll['all_selected_days'])) $enroll['all_selected_days'] = implode(', ', $enroll['all_selected_days']);
                        }
                    }
                    $enroll['package_display_name']     = "Daily";
                    $enroll['gross_total']              = $enroll['cost'] + $enroll['competition_fee'] + $enroll['annual_reg_fee'];
                    $enroll['vat_total']                = ($vat / 100) * $enroll['gross_total'];
                    $enroll['individual_total']         = $enroll['vat_total'] + $enroll['gross_total'];
                    $refined['payments']['grand_total'] = $refined['payments']['grand_total'] + $enroll['individual_total'];
                    $enroll['session_per_week']         = count($enroll['session_metas']);
                }
                $enroll['num_of_sessions']  = '-';
                $enroll['training_fee']     = '-';
                $enroll['discount']         = 0;
                $enroll['savings']          = 0;
                $enroll['cost_per_session'] = '-';
                $enroll['session_per_week'] = '-';
                $enroll['week_selected']    = '-';
                $enroll['schedule']         = $enroll['package_display_name'];
                $package_display_name       = '-';
            }
            else if($p->type == 'fourth'){
                if($p->payment_option == 'termly_option'){
                    if(!empty($p->session_details)){
                        $enroll['venue_display_name'] = array();
                        $enroll['venues']             = null;
                        if(!empty($p->session_details)){
                            if(!empty($p->session_details->days)){
                                foreach ($p->session_details->days as $value){
                                    if($value){
                                        foreach($value as $key => $v){
                                            if(empty($v->venue_name)) continue;
                                            $enroll['session_metas'][] = $key;
                                            $enroll['venues'][$v->venue_id] = array('venue_id' => $v->venue_id, 'venue_name' => $v->venue_name);
                                            $enroll['venue_display_name'][$v->venue_id] = $v->venue_name;
                                        }
                                    }
                                }
                            }
                            if(!empty($enroll['venue_display_name'])) $enroll['venue_display_name'] = implode(', ', $enroll['venue_display_name']);
                        }
                    }
                    $p->package                         = $p->package;
                    $enroll['session_id']               = $p->package->session_id;
                    $enroll['cost_per_session']         = $p->package->cost_per_session;
                    $enroll['session_per_week']         = $p->package->num_of_sessions;
                    $enroll['annual_reg_fee']           = $p->annual_reg_fee;
                    $enroll['package_display_name']     = "Termly";
                    $enroll['gross_total']              = $enroll['cost_per_session'] + $enroll['competition_fee'] + $enroll['annual_reg_fee'];
                    $enroll['vat_total']                = ($vat / 100) * $enroll['gross_total'];
                    $enroll['individual_total']         = $enroll['vat_total'] + $enroll['gross_total'];
                    $refined['payments']['grand_total'] = $refined['payments']['grand_total'] + $enroll['individual_total'];
                    $enroll['num_of_sessions']          = '-';
                    $enroll['training_fee']             = '-';
                    $enroll['discount']                 = 0;
                    $enroll['savings']                  = 0;
                    $enroll['cost']                     = '-';
                    $enroll['skill_level']              = null;
                    $enroll['skill_level_name']         = '-';
                    $enroll['skill_level_color']        = null;
                    $enroll['all_selected_days']        = '-';
                    $enroll['term_id']                  = null;
                    $enroll['term_name']                = '-';
                    $enroll['week_selected']            = '-';
                    $enroll['schedule']                 = '-';
                }
                else if($p->payment_option == 'ten_session_card_option'){
                    $enroll['venue_display_name']       = null;
                    $enroll['venues']                   = array();
                    $enroll['package_display_name']     = "10 Session Card";
                    $enroll['session_card_cost']        = $p->session_card_cost;
                    $enroll['gross_total']              = $enroll['session_card_cost'] + $enroll['annual_reg_fee'];
                    $enroll['vat_total']                = ($vat / 100) * $enroll['gross_total'];
                    $enroll['individual_total']         = $enroll['vat_total'] + $enroll['gross_total'];
                    $refined['payments']['grand_total'] = $refined['payments']['grand_total'] + $enroll['individual_total'];
                    // $enroll['sessions']                 = array();
                    $enroll['cost_per_session']         = '-';
                    $enroll['session_per_week']         = '-';
                    $enroll['num_of_sessions']          = '-';
                    $enroll['training_fee']             = '-';
                    $enroll['discount']                 = '-';
                    $enroll['savings']                  = '-';
                    $enroll['cost']                     = '-';
                    $enroll['skill_level']              = '-';
                    $enroll['skill_level_name']         = '-';
                    $enroll['skill_level_color']        = '-';
                    $enroll['all_selected_days']        = '-';
                    $enroll['term_id']                  = null;
                    $enroll['term_name']                = '-';
                    $enroll['week_selected']            = '-';
                    $enroll['schedule']                 = '-';
                }
            }
            $enroll['unrefined'] = $p;
            if(!empty($enroll)) $refined['enrollments'][] = $enroll;
        }
        // _d($refined);
        responder(200, 'success', $refined);
    }
    public function save_enrollment(){
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) responder(604, null);
        $parent_id = encrypt_decrypt('decrypt', $post->parent_id);
        if(empty($parent_id)) responder(508, null);
        $enrollments = $post->data->enrollments;
        if(empty($enrollments)) responder(500, "No bookings found!");
        $access_token     = encrypt_decrypt('encrypt', date('Ymdhs'));
        $email_content = '<div class="col-md-12">
        <div class="booking-summary">
        <div class="row">
        <div class="club-sum-b">
        <h3>Summary</h3>
        <ul class="summary-list">
        <li class="lb"><strong>Child\'s Name</strong></li>
        <li class="lb"><strong>Term</strong></li>
        <li class="lb"><strong>Club/Camp</strong></li>
        <li class="lb"><strong>Venue</strong></li>
        <li class="lb"><strong>Level</strong></li>
        <li class="lb"><strong>Sunday</strong></li>
        <li class="lb"><strong>Monday</strong></li>
        <li class="lb"><strong>Tuesday</strong></li>
        <li class="lb"><strong>Wednesday</strong></li>
        <li class="lb"><strong>Thursday</strong></li>
        <li class="lb"><strong>Friday</strong></li>
        <li class="lb"><strong>Saturday</strong></li>
        <li class="lb"><strong>All Selected Dates</strong></li>
        <li class="lb"><strong>Cost Per Session</strong></li>
        <li class="lb"><strong>Session Per Week</strong></li>
        <li class="lb"><strong>Schedule</strong></li>
        <li class="lb"><strong>Week Selected</strong></li>
        <li class="lb"><strong>Cost</strong></li>
        <li class="lb"><strong>Package</strong></li>
        <li class="lb"><strong>Total No. of Sessions</strong></li>
        <li class="lb"><strong>Training Fee(Termly)</strong></li>
        <li class="lb"><strong>REG Fee(Annual)</strong></li>
        <li class="lb"><strong>Discount Applied</strong></li>
        <li class="lb"><strong>Savings</strong></li>
        <li class="lb"><strong>Total</strong></li>
        <li class="lb"><strong>VAT</strong></li>
        </ul>
        </div>';
        $symbol = $post->data->payments->default_symbol;
        if(!empty($post->data->enrollments)){
            foreach($post->data->enrollments as $enroll){
                // d($enroll);
                $email_content .= 
                '<div class="club-sum-b">
                <ul class="center booked">
                <li class="lb">'.$enroll->child_firstname . ' ' .$enroll->child_lastname.'</li>
                <li class="lb">'.$enroll->term_name.'</li>
                <li class="lb">'.$enroll->club_name.'</li>
                <li class="lb">'.$enroll->venue_display_name.'</li>
                <li class="lb">'.$enroll->skill_level_name.'</li>
                <li class="lb">'.$enroll->days->Sunday.'</li>
                <li class="lb">'.$enroll->days->Monday.'</li>
                <li class="lb">'.$enroll->days->Tuesday.'</li>
                <li class="lb">'.$enroll->days->Wednesday.'</li>
                <li class="lb">'.$enroll->days->Thursday.'</li>
                <li class="lb">'.$enroll->days->Friday.'</li>
                <li class="lb">'.$enroll->days->Saturday.'</li>
                <li class="lb">'.$enroll->all_selected_days.'</li>';
                if($enroll->cost_per_session == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->cost_per_session.'</li>';
                $email_content .= '<li class="lb">'.$enroll->session_per_week.'</li>
                <li class="lb">'.$enroll->schedule.'</li>
                <li class="lb">'.$enroll->week_selected.'</li>';
                if($enroll->cost == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->cost.'</li>';
                $email_content .= '<li class="lb">'.$enroll->package_display_name.'</li>
                <li class="lb">'.$enroll->num_of_sessions.'</li>';
                if($enroll->training_fee == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->training_fee.'</li>';
                if($enroll->annual_reg_fee == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->annual_reg_fee.'</li>';
                if($enroll->discount == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->discount.'</li>';
                if($enroll->savings == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->savings.'</li>';
                if($enroll->gross_total == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->gross_total.'</li>';
                if($enroll->vat_total == "-") $email_content .= '<li class="lb">-</li>';
                else $email_content .= '<li class="lb">'.$enroll->vat_total.'</li>';
                $email_content .= '
                </ul>
                </div>';
            }
        }
        $email_content .= '</div>
        <div class="row total-pay">
        <div class="col-md-6">
        <p><strong>Total Payable</strong></p>
        </div>
        <div class="col-md-6">
        <p>'.$symbol.$post->data->payments->grand_total.'</p>
        </div>
        </div>
        </div>
        </div>';
        $transaction_data = array(
            'parent_id'      => $parent_id,
            'payment_status' => 'pending',
            'total_amount'   => $post->data->payments->grand_total,
            'payfort_data'   => null,
            'access_token'   => $access_token,
            'email_content'  => $email_content,
            'insert_by'      => $parent_id,
        );
        $insert_transaction = $this->admin_manager->Insert('enrollments_transactions', $transaction_data);
        if(!$insert_transaction) responder(500, "Error in adding booking 1");
        $last_transaction_id = $this->db->insert_id();
        foreach($enrollments as $e){
            $enrollment_data = array(
                'type'                   => $e->type,
                'transaction_id'         => $last_transaction_id,
                'child_id'               => encrypt_decrypt('decrypt', $e->child_id),
                'parent_id'              => $parent_id,
                'club_id'                => $e->club_id,
                'program_id'             => $e->program_id,
                'term_id'                => $e->term_id,
                'session_id'             => $e->session_id,
                'level_id'               => $e->skill_level,
                'is_assessment'          => $e->club_is_assesment,
                'enroll_for_competition' => $e->enroll_for_competition,
                'num_of_sessions'        => $e->num_of_sessions,
                'package'                => $e->package,
                'competition_fee'        => $e->competition_fee,
                'annual_reg_fee'         => $e->annual_reg_fee,
                'session_card_cost'      => $e->session_card_cost,
                'full_week_cost'         => $e->full_week_cost,
                'daily_cost'             => $e->daily_cost,
                'exclusion_per_day_cost' => $e->exclusion_per_day_cost,
                'cost_per_session'       => $e->cost_per_session,
                'session_per_week'       => $e->session_per_week,
                'discount'               => $e->discount,
                'gross_total'            => $e->gross_total,
                'vat_total'              => $e->vat_total,
                'individual_total'       => $e->individual_total,
            );
            $insert_enrollment = $this->admin_manager->Insert('enrollments', $enrollment_data);
            if(!$insert_enrollment) responder(500, "Error in adding booking");
            $last_enrollment_id = $this->db->insert_id();
            if(!empty($e->venues)){
                $venue_data = array();
                foreach($e->venues as $v){
                    $venue_data[] = array(
                        'enroll_id' => $last_enrollment_id,
                        'venue_id'  => $v->venue_id
                    );
                }
                $insert_venue_meta = $this->db->insert_batch('enrollments_venue', $venue_data);
                if(!$insert_venue_meta) responder(500, "Error in adding booking venue");
            }
            if(!empty($e->session_details)){
                // _d($e->session_details);
                $session_meta = array();
                if(!empty($e->session_details->weeks)){
                    foreach($e->session_details->weeks as $week){
                        foreach($week as $w){
                            foreach($w->metas as $m){
                                $session_meta[] = array(
                                    'enroll_id'       => $last_enrollment_id,
                                    'week_id'         => $w->week_id,
                                    'session_meta_id' => $m->meta_id
                                );
                            }
                        }
                    }
                }
                if(!empty($e->session_details->days)){
                    foreach($e->session_details->days as $day){
                        foreach($day as $d){
                            $session_meta[] = array(
                                'enroll_id'       => $last_enrollment_id,
                                'session_meta_id' => $d->meta_id
                            );
                        }
                    }
                }
                $insert_session_meta = $this->db->insert_batch('enrollments_meta', $session_meta);
                if(!$insert_session_meta) responder(500, "Error in adding booking sesssions");
            }
        }
        responder(200, 'success', site_url('parent/payfort/'.$access_token));
    }
    public function returnPayfortForm($uniqid){
        $get_transaction_data = $this->db->query("SELECT parent_id, total_amount, payment_status FROM enrollments_transactions WHERE `access_token` = '{$uniqid}'")->row();
        if(empty($get_transaction_data)) responder(500, "invalid_request");
        if($get_transaction_data->payment_status == 'completed') responder(500, "already_paid");
        if($get_transaction_data->payment_status != 'pending') responder(500, "already_processed");
        $get_parent = $this->db->query("SELECT `email` FROM `parents` WHERE `id` = {$get_transaction_data->parent_id}")->row();
        $email        = $get_parent->email;
        $total_amount = $get_transaction_data->total_amount * 100;
        $return_url   = site_url('/parent/url/payfort/return.php');
        $Hash         = 'TESTSHAINaccess_code=KtSMK3y1eVbwtsMnUOREamount='.$total_amount.'command=AUTHORIZATIONcurrency=AEDcustomer_email='.$email.'language=enmerchant_identifier=XzCxIxqnmerchant_reference='.$uniqid.'order_description=Session_Bookingreturn_url='.$return_url.'TESTSHAIN';
        $signature    = hash('sha256', $Hash);
        $requestParams = array(
            'command'             => 'AUTHORIZATION',
            'access_code'         => 'KtSMK3y1eVbwtsMnUORE',
            'merchant_identifier' => 'XzCxIxqn',
            'merchant_reference'  => $uniqid,
            'amount'              => $total_amount,
            'currency'            => 'AED',
            'language'            => 'en',
            'customer_email'      => $email,
            'signature'           => $signature,
            'order_description'   => 'Session_Booking',
            'return_url'          => $return_url
        );
        $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
        // _d($requestParams);
        $html = '';
        $html .= "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        $html .= "<form action='$redirectUrl' method='post' name='frm'>\n";
        foreach ($requestParams as $a => $b){
            $html .= "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
        }
        $html .= "\t<script type='text/javascript'>\n";
        $html .= "\t\tdocument.frm.submit();\n";
        $html .= "\t</script>\n";
        $html .= "</form>\n</body>\n</html>";
        echo $html;
        // responder(200, 'success', $html);
    }
    public function payfort_return_url(){
        /*$_POST = array(
            'amount' => '9450',                                                          
            'response_code' => '00072',                                                       
            'signature' => 'a2521fa6d5b19bd9ebc7c490fc46af8a6e1627ebf37f1fa94b495a33e43b92f0',
            'merchant_identifier' => 'XzCxIxqn',                                              
            'access_code' => 'KtSMK3y1eVbwtsMnUORE',                                          
            'order_description' => 'Session_Booking',                                         
            'language' => 'en',                                                               
            'command' => 'AUTHORIZATION',                                                     
            'response_message' => 'Transaction has been cancelled by the Consumer.',          
            'merchant_reference' => 'b1JZRk5ueEswKzBqOENOQTFJOWRwQT09',                       
            'customer_email' => 'taimoorimran9@gmail.com',                                    
            'return_url' => 'http://localhost/msa_portal/parent/url/payfort/return.php',      
            'currency' => 'AED',                                                              
            'status' => '00',                                                                 
        );*/
        // _d($_POST);
        /*$_POST = array(
            'amount'              => '2',
            'response_code'       => '02000',
            'card_number'         => '400555******0001',
            'card_holder_name'    => 'Taimoor Imran',
            'signature'           => 'e39b41eb5aa45385b93ec17232502dce0c0d8d1e3a58b3970f4b0ce159f7abe7',
            'merchant_identifier' => 'XzCxIxqn',
            'access_code'         => 'KtSMK3y1eVbwtsMnUORE',
            'order_description'   => 'Session_Booking',
            'payment_option'      => 'VISA',
            'expiry_date'         => '2105',
            'customer_ip'         => '175.107.224.86',
            'language'            => 'en',
            'eci'                 => 'ECOMMERCE',
            'fort_id'             => '155115859800028750',
            'command'             => 'AUTHORIZATION',
            'response_message'    => 'Success',
            'merchant_reference'  => 'b1JZRk5ueEswKzBqOENOQTFJOWRwQT09',
            'authorization_code'  => '690710',
            'customer_email'      => 'taimoorimran9@gmail.com',
            'token_name'          => '82A6AF636399325BE053321E320AA8F5',
            'currency'            => 'AED',
            'status'              => '02',
        );*/
        if(empty($_POST)) responder(500, 'invalid_parameters');
        /*if($_POST['response_code'] != '02000'){
            header("Location: " . site_url('/parents/book-your-child/payment/success'));
        }*/
        $get_transaction_data = $this->db->query("SELECT transaction_id, parent_id, email_content FROM enrollments_transactions WHERE `access_token` = '".$_POST['merchant_reference']."'")->row();
        if(empty($get_transaction_data)) responder(500, "invalid_request");
        $payment_status    = $_POST['response_code'];
        if($payment_status == '02000') $payment_status = 'completed';
        $transaction = array(
            'payment_status' => $payment_status,
            'access_token'   => null,
            'payfort_data'   => serialize($_POST)
        );
        $update = $this->admin_manager->update('enrollments_transactions', $transaction, array('transaction_id' => $get_transaction_data->transaction_id));
        if($payment_status != 'completed') header("Location: " . site_url('/parents/book-your-child/payment/fail'));
        $get_parent = $this->db->query("SELECT `first_name`, `last_name` `email` FROM `parents` WHERE `id` = {$get_transaction_data->parent_id}")->row();
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Booking Confirmation</title>
        <link href="'.ASSETS.'css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        </head>
        <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
        <div class="page-wrapper">
        <img src="'.ASSETS.'images/logo-icon.png"/><img src="'.ASSETS.'images/logo.png"/>
        <h3>Booking Confirmation</h3>
        <p>Dear <strong>'.@$get_parent->first_name . ' ' . @$get_parent->last_name.'</strong>,</p>
        <p>Thank you for registering with My Sports Academy, your booking details are below. Please refer to My Sports Hub to meet our coaches, track attendance, view performance, T&C’s and the entire My Sports Academy timetable for our four clubs:</p>
        <p>🏊‍♂️    My Swim Club</p>
        <p>⚽️  My Football Club</p>
        <p>🚴‍♀️    My Tri Club</p>
        <p>🏐   My Netball Club</p>
        <p>'.$get_transaction_data->email_content.'</p>
        <p>Athlete centered and with a long-term approach to development, thank you for being part of My Sports Academy.</p>
        <p>The MSA Team</p>
        <p>#Aspire #Inspire</p>
        <p>@MySportsAcademyDubai Facebook link</p>
        <p>@MySportsAcademy Instagram link</p>
        </div>
        </body>
        </html>';
        send_notification('taimoorimran9@gmail.com', $get_parent->email, 'Booking Confirmation', $message, true);
        header("Location: " . site_url('/parents/book-your-child/payment/success'));
    }
}