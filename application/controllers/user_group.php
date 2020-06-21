<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter USER GROUP Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Country * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class user_group extends CI_Controller 
{
   
   
    /**
	 * Constructor
	 */ 
     function __construct()
    {
        parent::__construct();
        isProtected();
        $this->load->model('user_group_mod');
        
    }
    
    
    
    function ajax_user($group_id = NULL)
    {
        if($group_id==NULL || $group_id=='')
        {
            if(isset($_GET['group_id'][0]) && !empty($_GET['group_id'][0]))
            {
                $group_id = $_GET['group_id'][0];
            }
        }
        // pr($_GET['users_id']);die;
        $users_id = [];
        if(isset($_GET['users_id']) && !empty($_GET['users_id']))
        {
            $users_id = $_GET['users_id'];
        }
        $user = $this->user_group_mod->get_users($group_id);
        if(count($user) > 0)
            echo '';
        else
            echo '<option value=""><--No Employee--></option>';
        
        foreach($user as $row)
        {
            echo '<option '.(in_array($row->id, $users_id)?'selected':'').' value="'.$row->id.'">'.ucfirst($row->first_name.' '.$row->last_name).'</option>';
        }
        
    }
}