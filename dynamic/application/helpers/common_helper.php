<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    //the database functions can not be called from within the helper
    //so we have to explicitly load the functions we need in to an object
    //that I will call ci. then we use that to access the regular stuff.
function is_field_exist($table,$field_name,$field_val)
{
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->is_field_exist($table,$field_name,$field_val);
    
}

function checkRow($table,$cond)
{
    $ci=& get_instance();
    $ci->load->model('login_model');
    return $ci->login_model->checkRow($table,$cond);
}

function getAllRecords($table)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getAllRecords($table);
}

function getRecords($table,$condKey,$condValue)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getRecords($table,$condKey,$condValue);
}

function getFieldValue($table,$condField,$condValue,$field)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getFieldValue($table,$condField,$condValue,$field);
}
function getFieldValueByQuery($table,$condField,$condValue,$field)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getFieldValueByQuery($table,$condField,$condValue,$field);
}
function getNumRowsByQuery($table,$q_data='')
{
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getNumRowsByQuery($table,$q_data);
}
function getNumRows($table,$condKey,$condValue)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getNumRows($table,$condKey,$condValue);
}

function getAllNumRows($table)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getNumRows($table);
}
function getSum($table,$sumFieldName,$condKey,$condValue)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->getSum($table,$sumFieldName,$condKey,$condValue);
}

function GetLimitRecords($table,$offset,$limit)
{   
    $ci=& get_instance();
    $ci->load->model('common_model');
    return $ci->common_model->GetLimitRecords($table,$offset,$limit);
}

function current_full_url()
{
    $CI =& get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'/?'.$_SERVER['QUERY_STRING'] :"";
}
function current_full_url_for_pagination()
{
    $CI =& get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    $query = $_SERVER['QUERY_STRING'];
    $query_string = "";
    if($query!="")
    {
        $data = explode("&", $query);
        for ($i=0; $i < count($data); $i++) { 
            
            $data1 = explode("=", $data[$i]);
            // print_r($data1);die;
            if($data1[0]!="page")
            {
                $query_string .=  "&".$data[$i];     
            }
        }
    }
    return $query_string !="" ? $url."/?".ltrim($query_string,"&"):$url."/";
    //return $_SERVER['QUERY_STRING'] ? $url.'/?'.$_SERVER['QUERY_STRING'] :"";
}

function current_full_url_without_base()
{
    $extra = "";
    if(query_string()!="")
    {
        $extra = "/?";
    }
    return uri_string().$extra.query_string()."/";
}

function current_full_url_without_query()
{
    $CI =& get_instance();

    return $CI->config->site_url($CI->uri->uri_string())."/";
}

function query_string()
{
    return $_SERVER['QUERY_STRING'];
}

function time_ago( $time )
{
    $out    = ''; // what we will print out
    $now    = time(); // current time
    $diff   = $now - $time; // difference between the current and the provided dates

    if( $diff < 60 ) // it happened now
        return TIMEBEFORE_NOW;

    elseif( $diff < 3600 ) // it happened X minutes ago
        return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

    elseif( $diff < 3600 * 24 ) // it happened X hours ago
        return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

    elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
        return TIMEBEFORE_YESTERDAY;

    else // falling back on a usual date format as it happened later than yesterday
        return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
}
function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
   
    //Hours
    if($hours <=24){
       return "Today at ".date('g:i A',$time_ago);
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "Yesterday at ".date('g:i A',$time_ago);
        }else{
            return date('d M Y g:i A',$time_ago);
        }
    }

    else{
        return date('d M Y g:i A',$time_ago);
    }
}

function seoUrl($string) {
    //Lower case everything
    $string = str_replace("&amp;", "", $string);
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}
function beautyTitle($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = ucwords($string);
    //Convert whitespaces and underscore to dash
    // $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}
function beautyFileTitle($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    // $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    // $string = ucwords($string);
    $string = preg_replace("/[\s-]+/", "_", $string);
    //Convert whitespaces and underscore to dash
    // $string = preg_replace("/[\s-]/", "_", $string);
    // $string = str_replace(" ", "_", $string);
    return $string;
}

function pagination($rowcount,$url,$perpage)
{
    if($rowcount>$perpage)
    { 
        $perpage = ceil($rowcount/$perpage);
        if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
        {
            $j = $_REQUEST['page'];
        }
        else{$j = 1;}

        if(isset($_REQUEST['page']) && $_REQUEST['page']==$perpage)
        {
            $pdisabled = "";
            $ndisabled = "disabled";
            $purl = $url."?page=".($_REQUEST['page']-1);
            $nurl = "javascript:void(0)";
        }
        else if(isset($_REQUEST['page']) && $_REQUEST['page']==2)
        { 
            $pdisabled = "";
            $ndisabled = "";
            $purl = $url;
            $nurl = $url."?page=".($_REQUEST['page']+1);
        }
        else if(isset($_REQUEST['page']) && $_REQUEST['page']<$perpage)
        {
            $pdisabled = "";
            $ndisabled = "";
            $purl = $url."?page=".($_REQUEST['page']-1);
            $nurl = $url."?page=".($_REQUEST['page']+1);
        }
        else
        {
            $pdisabled = "disabled";
            $ndisabled = "";
            $purl = "javascript:void(0)";
            $nurl = $url."?page=2";
        }
        // echo "$purl";
        // echo "$nurl";
        echo "<nav>";
            echo "<ul class='pagination pagination-sm'>";
                echo "<li class='".$pdisabled."'><a href='".$purl."' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>";

                for ($i=1; $i <= $perpage; $i++) { 
                    
                    if($i==$j)
                    {
                        $active = "active";
                        $active_url = "javascript:void(0)";
                    }
                    elseif($i==1)
                    {
                        $active="";
                        $active_url = $url;
                    }
                    else
                    {
                        $active="";
                        $active_url = $url."?page=$i";
                    }
                    
                    echo "<li class='".$active."'><a href='".$active_url."'>$i <span class='sr-only'>(current)</span></a></li>";
                }
                echo "<li class='".$ndisabled."' ><a href='".$nurl."' aria-label='Next'><span aria-hidden='true'>»</span></a></li>";
            echo "</ul>";
        echo "</nav>";
    } 
}

function pagination1($rowcount,$url,$perpage)
{
    if($rowcount>$perpage)
    { 
        $perpage = ceil($rowcount/$perpage);
        if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
        {
            $j = $_REQUEST['page'];
        }
        else{$j = 1;}

        if(isset($_REQUEST['page']) && $_REQUEST['page']==$perpage)
        {
            $pdisabled = "";
            $ndisabled = "disabled";
            $purl = $url."page=".($_REQUEST['page']-1);
            $nurl = "javascript:void(0)";
        }
        else if(isset($_REQUEST['page']) && $_REQUEST['page']==2)
        { 
            $pdisabled = "";
            $ndisabled = "";
            $purl = $url;
            $nurl = $url."page=".($_REQUEST['page']+1);
        }
        else if(isset($_REQUEST['page']) && $_REQUEST['page']<$perpage)
        {
            $pdisabled = "";
            $ndisabled = "";
            $purl = $url."page=".($_REQUEST['page']-1);
            $nurl = $url."page=".($_REQUEST['page']+1);
        }
        else
        {
            $pdisabled = "disabled";
            $ndisabled = "";
            $purl = "javascript:void(0)";
            $nurl = $url."page=2";
        }
        // echo "$purl";
        // echo "$nurl";
        echo "<nav>";
            echo "<ul class='pagination pagination-sm'>";
                echo "<li class='".$pdisabled."'><a href='".$purl."' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>";

                for ($i=1; $i <= $perpage; $i++) { 
                    
                    if($i==$j)
                    {
                        $active = "active";
                        $active_url = "javascript:void(0)";
                    }
                    elseif($i==1)
                    {
                        $active="";
                        $active_url = $url;
                    }
                    else
                    {
                        $active="";
                        $active_url = $url."page=$i";
                    }
                    
                    echo "<li class='".$active."'><a href='".$active_url."'>$i <span class='sr-only'>(current)</span></a></li>";
                }
                echo "<li class='".$ndisabled."' ><a href='".$nurl."' aria-label='Next'><span aria-hidden='true'>»</span></a></li>";
            echo "</ul>";
        echo "</nav>";
    } 
}

