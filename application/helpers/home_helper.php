<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



/**
 * to count new requirements
 * 
 * **/
if (!function_exists('job_type')) {
    function job_type($id = null) {
        $arr = array(
            '1' => 'Contract',
            '2' => 'Contract',
            '3' => 'Full Time');
        if (!empty($id)) {
            return $arr[$id];
        }
    }
}



/**
 * to count new requirements
 * 
 * **/
if (!function_exists('check_candidate_login')) {
    function check_candidate_login() {
        $CI = &get_instance();
        $session = $CI->session->userdata('candidate_login', 'yes');
        if ($session != 'yes') {
            redirect(base_url());
        }

    }
}


/**
 * to count new requirements
 * 
 * **/
if (!function_exists('candidate_session_data')) {
    function candidate_session_data() {
        $CI = &get_instance();
        return $CI->session->userdata('candidate_data');
    }
}


