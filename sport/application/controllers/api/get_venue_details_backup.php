public function get_venues_details($club_id, $program_id, $venue_id){
        $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} GROUP BY v.`id`;";
        if($club_id == 4){
            $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} AND s.`club_id` = {$club_id} GROUP BY v.`id`;";
        }
        else if($club_id == 5){
            $venue_query = "SELECT v.`id` AS `venue_id`, s.`id` AS `session_id`, `venue_name`, `google_map_url`, `c_code`, `contact_number`, `additional_description`, t.`start_month`, t.`end_month`, t.`num_of_weeks`, `photo_path` FROM `venues` v INNER JOIN `sessions` s ON s.`venue_id` = v.`id` INNER JOIN `terms` t ON t.`id` = s.`term_id` WHERE v.`id` = {$venue_id} GROUP BY v.`id`;";
        }
        $venue = $this->db->query($venue_query)->row();
        if(empty($venue)) responder(507, null);
        if(!empty($venue->photo_path)) $venue->photo_path = ASSETS.'uploads/'.$venue->photo_path;
        if(!empty($venue->google_map_url)){
            $google = $venue->google_map_url;
            $venue->google_map_url = null;
            $matches = [];
            preg_match("/@(.*?),(.*?),/",$google,$matches);
            if(!empty($matches)){
                $place = $matches[1];
                preg_match("/@(.*?),(.*?),/",$google,$matches);
                $lat  = $matches[1];
                $long = $matches[2];
                $venue->google_map_url = "https://www.google.com/maps/embed/v1/place?q='.$place.'&center='.$lat.','.$long.'&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU&zoom=8";
            }
        }
        $days            = $this->db->query("SELECT * FROM days")->result();
        $venue->sessions = null;
        if($club_id == 4){
            $refined  = array();
            $sessions = $this->db->query("SELECT `meta_id`, `session_id`, `week_id`, `start_date`, `end_date`, `start_time`, `end_time`, `exclusion_day_id`, CONCAT('< ', DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%M'), ' ', DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%d'), ' - ', DATE_FORMAT(STR_TO_DATE(end_date, '%d-%m-%Y'), '%d'), '>') AS `formatted_date` FROM `sessions_meta_holiday` WHERE `session_id` = {$venue->session_id};")->result_array();
            $weeks = array_column($sessions, 'week_id');
            $weeks = array_unique($weeks);
            $weeks = max($weeks);
            for($i = 1; $i <= $weeks; $i++ ){
                $refined[$i]['week_id']   = $i;
                $refined[$i]['week_name'] = "Week ".$i;
                foreach($sessions as $session){
                    if($session['week_id'] == $i){
                        $refined[$i]['formatted_date'] = $session['formatted_date'];
                        $refined[$i]['meta_id'] = $session['meta_id'];
                        $refined[$i]['start_date'] = $session['meta_id'];
                        $refined[$i]['end_date'] = $session['end_date'];
                        $refined[$i]['start_time'] = $session['start_time'];
                        $refined[$i]['end_time'] = $session['end_time'];
                        $refined[$i]['exclusion_day_id'] = $session['exclusion_day_id'];
                        $refined[$i]['days'] = $this->returnDays($session['start_date'], $session['end_date']);
                        foreach($refined[$i]['days'] as &$d) $d = DateTime::createFromFormat('Y-m-d', $d)->format('d-m-Y');
                    }
                }
            }
            $venue->sessions = $refined;
            responder(200, 'success', $venue);
        }
        $sessions = $this->db->query("SELECT sm.`meta_id`, sm.`day_id`, sm.`start_time`, sm.`end_time`, d.`day_name`, l.`color` FROM `sessions_meta` sm INNER JOIN `days` d ON d.`id` = sm.`day_id` INNER JOIN `sessions` s ON s.`id` = sm.`session_id` INNER JOIN `levels` l ON l.`id` = s.`level_id` WHERE sm.`session_id` = {$venue->session_id};")->result();
        if(!empty($sessions)){
            $refined = array();
            foreach($days as $day){
                $refined[strtolower($day->day_name)]['day_id']   = $day->id;
                $refined[strtolower($day->day_name)]['day_name'] = $day->day_name;
                $refined[strtolower($day->day_name)]['metas']    = array();
                foreach($sessions as $session){
                    if($session->day_id == $day->id){
                        $refined[strtolower($day->day_name)]['metas'][]  = array(
                            'meta_id'    => $session->meta_id,
                            'start_time' => $session->start_time,
                            'end_time'   => $session->end_time,
                            'color'      => $session->color
                        );
                    }
                }
            }
            $venue->sessions = $refined;
        }
        if(@$_GET['pre'] == true) _d($venue);
        responder(200, 'success', $venue);
    }