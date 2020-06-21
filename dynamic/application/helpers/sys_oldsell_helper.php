<?php defined('BASEPATH') OR exit('No direct script access allowed');

function getNumRow($table)
{   
    $CI = & get_instance();
    return $CI->db->get($table)->num_rows();
}
