<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_api extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
    public function returnTermsDropdown(){
        write(returnTerms(array('keys' => 'id, term_name', 'format' => '')));
    }
    public function returnSelectedTermNumofWeeks($term_id = null){
        if(empty($term_id)) return;
        $where[] = "id = {$term_id}";
        write(returnTerms(array('keys' => 'num_of_weeks', 'format' => '', 'where' => $where)));
    }
    public function returnVenuesDropdown(){
        write(returnVenues(array('keys' => 'id, venue_name', 'format' => '')));
    }
    public function returnClubsDropdown(){
        write(returnClubs(array('keys' => 'id, club_name', 'format' => '')));
    }
    public function returnDaysDropdown(){
        write(returnDays(array('keys' => 'id, day_name', 'format' => '')));
    }
    public function returnProgramsDropdown($club_id){
        $where = array();
        if(!empty($club_id)) $where[] = "club_id = {$club_id}";
        write(returnPrograms(array('keys' => 'id, program_name', 'format' => '', 'where' => $where)));
    }
    public function returnLevelsDropdown($program_id = null){
        $where = array();
        if(!empty($program_id)) $where[] = "program_id = {$program_id}";
        write(returnLevels(array('keys' => 'id, level_name, duration', 'format' => '', 'where' => $where)));
    }
}