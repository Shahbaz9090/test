<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site URL and Public URL and UPLOAD
|--------------------------------------------------------------------------
*/
define('PUBLIC_URL','https://'.$_SERVER['HTTP_HOST'].'/test/assets/');
define('PUBLIC_HOME','https://'.$_SERVER['HTTP_HOST'].'/test/assets/public_home/');
define('SITE_PATH','https://'.$_SERVER['HTTP_HOST'].'/test/');
define('ATTACHMENT_PATH','/home/inchgroup/public_html/erp.inchgroup.in/');


/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/*
|--------------------------------------------------------------------------
| Cotroller Action Type
|--------------------------------------------------------------------------
|
*/
define('AT_OPEN',000);
define('AT_LOGOUT',111);
define('AT_VIEW',101);
define('AT_EDIT', 102);
define('AT_ADD', 103);
define('AT_DELTE', 104);
define('AT_EXPORT', 105);
define('AT_IMPORT', 106);
define('AT_DOWNLOAD', 107);
define('AT_PRINT', 108);
define('AT_LIST', 109);
define('AT_EMAIL',110);
define('AT_PERMISSION', 211);// setup permission and check for permission method 
define('AT_VIEW_RESUME', 222);// setup permission and check for view resume method 
define('AT_VIEW_DOWNLOAD_RESUME', 233);

define('PERM_MODULE', json_encode(['add'=>AT_ADD,'edit'=>AT_EDIT,'delete'=>AT_DELTE,'view'=>101,'list_items' =>AT_VIEW,'ajax_list_items'=>AT_VIEW,'export'=>AT_EXPORT,'import'=>AT_IMPORT,'download'=>AT_DOWNLOAD,'print'=>AT_PRINT]));


define('ADMIN_MAIL', 'keshavchauhan5445@gmail.com');
define('DEFAULT_DATABASE', 'rookie');
define('DEFAULT_SITE_ID', '2');
define('DEFAULT_ADDED_BY', '2');

/*
|--------------------------------------------------------------------------
| Set up Connection configuration for techbuddies.com
|--------------------------------------------------------------------------
|
*/
define('ANOTHER_HOST_NAME', 'e-rookie.com');
define('ANOTHER_USER_NAME', 'tek_web');
define('ANOTHER_PASSWORD', 'tek_web');
define('ANOTHER_DB', 'tekshapers_website');

//define('INDIA_EROOKIE', 'https://india.e-rookie.com/');
define('INDIA_EROOKIE_DB', 'indiaerookie');
define('CACHE_EXPIRE', 9999999999999999999);  // 43200 is 12 hrs.
defined('PERPAGE') 			   OR define('PERPAGE', 20);
defined('LIMIT')  			   OR define('LIMIT', 20);
defined('TBL_PREFIX')          OR define('TBL_PREFIX','inch_');
defined('DYNAMIC_FORM_TBL')    OR define('DYNAMIC_FORM_TBL','inch_form');
//define('INDIA_EROOKIE', 'http://192.168.1.32/indiaerookie/');

/* End of file constants.php */
/* Location: ./application/config/constants.php */
