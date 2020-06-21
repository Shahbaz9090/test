<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once APPPATH."/third_party/class.phpmailer.php"; 
 
class Sendmail extends PHPMailer { 
    public function __construct() { 
        parent::__construct(); 
    } 
}
?>
