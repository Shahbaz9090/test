<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
ob_start();
	ob_clean();
date_default_timezone_set('Asia/Kolkata');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|    http://example.com/
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
 */
/*if (!function_exists('core_url')) {
    function core_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else 
    	{
    		$base_url = 'http://localhost/';
    	}

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}*/

$config['base_url']	= 'https://'.$_SERVER['HTTP_HOST'].'/test/';
//print_r($config['base_url']);die;
/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
 */
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| Cron File
|--------------------------------------------------------------------------
|
| Typically this will be your database configuration for the cron job
|
 */

$config['cron_host'] = "localhost";
$config['cron_db'] = "rookie";
$config['cron_password'] = "patanahi";
$config['cron_user'] = "root";

/*
|--------------------------------------------------------------------------
| Other configuration Information
|--------------------------------------------------------------------------
|
| Typically this will be your default authorized action and limit setup for export,delete
|
 */

$config['export_limit'] = '100';
$config['delete_limit'] = '25';
$config['attachments'] = 'attachments/';
$config['temp_attachments'] = 'temp_attachments/';
$config['india_temp_attachments'] = '../inch-erp/temp_attachments/';


$config['bypass_permission']['install'] = true;
$config['bypass_permission']['opportunity'] = true;
$config['bypass_permission']['auth'] = true;
$config['bypass_permission']['sales_governing'] = array('get_company_suggestion','get_company_all_data');
$config['bypass_permission']['sales_spares'] = array('get_company_suggestion','get_company_all_data');
$config['bypass_permission']['sales_pcb'] = array('get_company_suggestion','get_company_all_data');
$config['bypass_permission']['service_automation'] = array('get_company_suggestion','get_company_all_data');
$config['bypass_permission']['service_dcs'] = array('get_company_suggestion','get_company_all_data');
$config['bypass_permission']['service_pcb'] = array('get_company_suggestion','get_company_all_data');
$config['bypass_permission']['cron'] = true;
//$config['bypass_permission']['dice_cron'] = true;
$config['bypass_permission']['suggestion_cron'] = true;
$config['bypass_permission']['error'] = array('permission_denied');
$config['bypass_permission']['country'] = true;
$config['bypass_permission']['user_group'] = true;

$config['bypass_permission']['dashboard'] = array('index', 'ajax_dashboard', 'ajax_user_dashboard', 'set_dashboard_report');
//$config['bypass_permission']['chat'] = true;
///$config['bypass_permission']['training'] = array('listing', 'ajax_training');
//$config['bypass_permission']['assign_job'] = array('ajax_users');
//$config['bypass_permission']['pipeline'] = array('ajax_is_email', 'edit_candidate');
//$config['bypass_permission']['contact'] = array('ajax_is_email', 'ajax_is_website', 'status', 'assign_group_user');
//$config['bypass_permission']['vendor'] = array('ajax_is_email', 'ajax_is_website', 'ajax_remove_msa');
//$config['bypass_permission']['candidate'] = array('temp_resume', 'ajax_upload', 'ajax_is_email', 'upload_resume', 'view_resume', 'download_resume', 'inactive', 'pipeline_list', 'change_status', 'add_comment', 'view_comment', 'delete_comment', 'discussion');

$config['bypass_permission']['user'] = array('profile_setting', 'password_setting', 'get_users', 'signature', 'get_parent_group', 'get_group_users', 'set_permission', 'status', 'hierarchy');
$config['bypass_permission']['setting'] = array('index', 'edit', 'ajax_list_items');
$config['bypass_permission']['activity'] = array('load');
$config['bypass_permission']['group'] = array('permission');

//$config['bypass_permission']['job_order'] = array('index', 'get_report', 'data_list', 'load', 'report_export', 'discussion', 'report_view', 'reactivate', 'check_status', 'ajax_contact', 'ajax_users', 'status', 'view_scr_candidate', 'candidate_pipeline_comment');

$config['bypass_permission']['company'] = array('report_view', 'get_report', 'data_list', 'load', 'report_export', 'users_company', 'upload_resume', 'users_contact', 'export','fetch_state_according_country','fetch_city_according_country','get_company_suggestion');

//$config['bypass_permission']['candidate_search'] = array('search', 'view', 'list_items', 'ajax_list_items', 'load', 'ajax_change_searched', 'send_mail', 'add_to_cart', 'total_mail_value', 'get_cart_total_by_id', 'get_sent_total_by_id', 'send_mail_cart', 'ajax_candidate', 'ajax_suggestion_search');

//$config['bypass_permission']['activity_sent_email'] = true;
//$config['bypass_permission']['activity_cart_email'] = true;
//$config['bypass_permission']['email_report'] = true;
//$config['bypass_permission']['home'] = true;
//$config['bypass_permission']['activity_email'] = array('ajax_list_items', 'load', 'delete');
//$config['bypass_permission']['scr'] = array('invoice_pdf', 'export', 'upload_doc', 'remove_scr_file_main_table', 'get_vendor_data_by_id');
//$config['bypass_permission']['dice_candidate_search'] = true;
//$config['bypass_permission']['dice_group'] = true;
/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'AUTO' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'AUTO'            Default - auto detects
| 'PATH_INFO'        Uses the PATH_INFO
| 'QUERY_STRING'    Uses the QUERY_STRING
| 'REQUEST_URI'        Uses the REQUEST_URI
| 'ORIG_PATH_INFO'    Uses the ORIG_PATH_INFO
|
 */
$config['uri_protocol'] = 'AUTO';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/urls.html
 */

$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
 */
$config['language'] = 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
 */
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
 */
$config['enable_hooks'] = false;

/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/core_classes.html
| http://codeigniter.com/user_guide/general/creating_libraries.html
|
 */
$config['subclass_prefix'] = 'MY_';

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify with a regular expression which characters are permitted
| within your URLs.  When someone tries to submit a URL with disallowed
| characters they will get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
 */
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-\=';

/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
 */
$config['allow_get_array'] = true;
$config['enable_query_strings'] = false;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd'; // experimental not currently in use

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|    0 = Disables logging, Error logging TURNED OFF
|    1 = Error Messages (including PHP errors)
|    2 = Debug Messages
|    3 = Informational Messages
|    4 = All Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
 */
$config['log_threshold'] = 0;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ folder. Use a full server path with trailing slash.
|
 */
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
 */
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| system/cache/ folder.  Use a full server path with trailing slash.
|
 */
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class or the Session class you
| MUST set an encryption key.  See the user guide for info.
|
 */
$config['encryption_key'] = 'Techbuddiesit!';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_cookie_name'        = the name you want for the cookie
| 'sess_expiration'            = the number of SECONDS you want the session to last.
|   by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
| 'sess_expire_on_close'    = Whether to cause the session to expire automatically
|   when the browser window is closed
| 'sess_encrypt_cookie'        = Whether to encrypt the cookie
| 'sess_use_database'        = Whether to save the session data to a database
| 'sess_table_name'            = The name of the session database table
| 'sess_match_ip'            = Whether to match the user's IP address when reading the session data
| 'sess_match_useragent'    = Whether to match the User Agent when reading the session data
| 'sess_time_to_update'        = how many seconds between CI refreshing Session Information
|
 */
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_expire_on_close'] = false;
$config['sess_encrypt_cookie'] = false;
$config['sess_use_database'] = false;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_match_ip'] = false;
$config['sess_match_useragent'] = true;
$config['sess_time_to_update'] = 300;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix' = Set a prefix if you need to avoid collisions
| 'cookie_domain' = Set to .your-domain.com for site-wide cookies
| 'cookie_path'   =  Typically will be a forward slash
| 'cookie_secure' =  Cookies will only be set if a secure HTTPS connection exists.
|
 */
$config['cookie_prefix'] = "";
$config['cookie_domain'] = "";
$config['cookie_path'] = "/";
$config['cookie_secure'] = false;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
 */
$config['global_xss_filtering'] = true;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
 */
$config['csrf_protection'] = true;
//$config['csrf_protection'] = FALSE;
/*if (isset($_SERVER["REQUEST_URI"])) {
    if (stripos($_SERVER["REQUEST_URI"], '/web_cont') == true) {
        $config['csrf_protection'] = false;
    }
}*/

$config['csrf_token_name'] = 'ui_8800_mob_827041_app';
$config['csrf_cookie_name'] = 'adATtechbuddiesit';
$config['csrf_expire'] = 7200;

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
 */
$config['compress_output'] = false;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or 'gmt'.  This pref tells the system whether to use
| your server's local time as the master 'now' reference, or convert it to
| GMT.  See the 'date helper' page of the user guide for information
| regarding date handling.
|
 */
$config['time_reference'] = 'local';

/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
 */
$config['rewrite_short_tags'] = true;

/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy IP
| addresses from which CodeIgniter should trust the HTTP_X_FORWARDED_FOR
| header in order to properly identify the visitor's IP address.
| Comma-delimited, e.g. '10.0.1.200,10.0.1.201'
|
 */
$config['proxy_ips'] = '';

$config['module'] = array(
    'company' => array('add', 'view', 'edit', 'clist'),
);
 
/* End of file config.php */
/* Location: ./application/config/config.php */
