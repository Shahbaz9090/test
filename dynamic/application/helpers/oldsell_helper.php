<?php defined('BASEPATH') OR exit('No direct script access allowed');

function isLogin()
{
    if($this->session->userdata('isLogin'))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function check_get_image($name,$path)
{
    $name = substr($name, strripos($name, "/"));
    if($name!='' && file_exists(FCPATH.$path.$name))
    {
        return $url = base_url($path.$name);
    }
    else
    {
        return $url = base_url("assets/images/oldsell.jpg");
    }
}

function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function location()
{
    $location = '';
    if(get_cookie('location') && get_cookie('location')!='')
    {
        $location = explode(",",get_cookie('location'));
    }
    return $location;
}


function user_location_name($type='full_name')
{
    $location = '';
    $CI=& get_instance();
    $location1 = $CI->session->userdata('user_location');
    if($location1!=null && $location1!='')
    {
        if($type=='full_name')
        {
            $location =  $CI->session->userdata('user_location')['location_full_name'];
        }
        elseif($type=='id')
        {
            $location =  $CI->session->userdata('user_location')['location_id'];
        }
        elseif($type=='name')
        {
            $location =  $CI->session->userdata('user_location')['location_name'];
        }
        else
        {
            $location = array();
        }
    }
    else
    {
        if($type=='full_name')
        {
            $location =  'All India';
        }
    }
    return $location;
}
function ID_encode($id) {
    $encode_id = '';
    if ($id) {
        $encode_id = rand(1111, 9999) . (($id + 19)) . rand(1111, 9999);
    } else {
        $encode_id = '';
    }
    return $encode_id;
}

function ID_decode($encoded_id) {
    $id = '';
    if ($encoded_id) {
        $id = substr($encoded_id, 4, strlen($encoded_id) - 8);
        $id = $id - 19;
    } else {
        $id = '';
    }
    return $id;
}

 function get_flashdata() {
    $CI = &get_instance();
    $success    = $CI->session->flashdata('success') ? $CI->session->flashdata('success') : '';
    $error      = $CI->session->flashdata('error') ? $CI->session->flashdata('error') : '';
    $warning    = $CI->session->flashdata('warning') ? $CI->session->flashdata('warning') : '';
    $msg        = '';
    if ($success) {
        $msg = '<div class="alert alert-success flash-row">
                        <button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
                        ' . $success . ' </div>';
    } 
    elseif ($error) {
        $msg = '<div class="alert alert-danger flash-row">
        <button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
        <strong>Error!</strong> ' . $error . ' </div>';
    } 
    elseif ($warning) {
        $msg = '<div class="alert alert-warning flash-row">
        <button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        ' . $warning . '</div>';
    }
    return $msg;
}
