<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
// echo APPPATH;die;
require_once APPPATH.'third_party/dompdf_new/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
	public function __construct()
	{
		parent::__construct();
	} 
}

?>