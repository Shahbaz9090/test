<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

//$active_group = 'default';
//$active_record = TRUE;


$CI=&get_instance();
$CI->load->library('session');
if (@$CI->session->userdata('db_name')) {
    $active_group = "custom";
    $database=$CI->session->userdata('db_name');
} else {
    $active_group = "default";
    //$database="new_erookie";
    $database="rookie";
}
$active_record = TRUE;



$db[$active_group]['hostname'] = 'localhost';
$db[$active_group]['username'] = 'root';
// $db[$active_group]['username'] = 'inchgrou_erp';
$db[$active_group]['password'] = '';
// $db[$active_group]['password'] = 'z7nW-X)bfyF3';
$db[$active_group]['database'] = "inchgrou_erp_test";
$db[$active_group]['dbdriver'] = 'mysqli';
$db[$active_group]['dbprefix'] = '';
$db[$active_group]['pconnect'] = true;
$db[$active_group]['db_debug'] = true;
$db[$active_group]['cache_on'] = false;
$db[$active_group]['cachedir'] = '';
$db[$active_group]['char_set'] = 'utf8';
$db[$active_group]['dbcollat'] = 'utf8_general_ci';
$db[$active_group]['swap_pre'] = '';
$db[$active_group]['autoinit'] = true;
$db[$active_group]['stricton'] = false;

/* End of file database.php */
/* Location: ./application/config/database.php */

/*$db['otherdb']['hostname'] = "203.122.17.116";
$db['otherdb']['username'] = "erookie_bulkmail";
$db['otherdb']['password'] = "Automatic_Bulkmail";
$db['otherdb']['database'] = "erookie_mail";
$db['otherdb']['dbdriver'] = "mysql";
$db['otherdb']['dbprefix'] = "";
$db['otherdb']['pconnect'] = true;
$db['otherdb']['db_debug'] = false;
$db['otherdb']['cache_on'] = false;
$db['otherdb']['cachedir'] = "";
$db['otherdb']['char_set'] = "utf8";
$db['otherdb']['dbcollat'] = "utf8_general_ci";
$db['otherdb']['swap_pre'] = "";
$db['otherdb']['autoinit'] = true;
$db['otherdb']['stricton'] = false;*/


