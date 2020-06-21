<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter USER GROUP Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Country * @author		Pradeep Kumar
 * @website		http://www.techbuddiesit.com
 * @company     Techbuddiesit
 * @since		Version 1.0
 */
 
class Access extends CI_Controller 
{
   
    function __construct()
    {
        parent::__construct();
        isProtected();
    }

    public function permission_denied()
    {
        $this->load->view('access/access-denied');
    }
    
}