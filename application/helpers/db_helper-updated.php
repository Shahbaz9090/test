<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * Database helper

 *

 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

 // ------------------------------------------------------------------------



/**
* Set Common insert value
*
* @access	public
*/ 

if(!function_exists('set_common_insert_value'))

{

    function set_common_insert_value()

    {

        $CI =& get_instance();

        $CI->db->set('site_id',currentuserinfo()->site_id);          
        $CI->db->set('added_by',currentuserinfo()->id);          
        $CI->db->set('last_ip',current_ip());          
        $CI->db->set('created_time',current_date());

		

        

    }

}





// ------------------------------------------------------------------------



/**

 * Set Common update value

 *

 * @access	public

 */ 

if(!function_exists('set_common_update_value'))

{

    function set_common_update_value()

    {

        $CI =& get_instance();

        

        $CI->db->set('last_ip',current_ip());          

        $CI->db->set('modified_time',current_date());          

        

    }

}





// ------------------------------------------------------------------------



/**

 * Filter Content By Site Id 

 * 

 * Filter Content BY Current Site ID

 *

 * @access	public

 */ 

if(!function_exists('filter_by_site_id'))

{

    function filter_by_site_id($key = 'site_id')

    {

        $CI =& get_instance();

        $site_id = current_site_id();

        

        if($site_id != 1)

            $CI->db->where($key,$site_id);

    }

}











// ------------------------------------------------------------------------



/**

 * Filter Data According to permission 

 * 

 * @access	public

 */ 

if(!function_exists('filter_data'))

{

    function filter_data($table = NULL)

    {

        $CI =& get_instance();        

        $userinfo = currentuserinfo();

        

        $site_colum = "site_id";

        $user_colum = "added_by";

        

        if($table != NULL)

        {

            $site_colum = "$table.site_id";

            $user_colum = "$table.added_by";

        }

        

        $permission = $CI->session->userdata("permission");

        

        if(!$userinfo->is_super_site && AT_VIEW == $permission['code'] && $permission['type'] == 'own_view')

        {

             

             //$CI->db->where($user_colum,$userinfo->id,FALSE);

             $user_list  =  $CI->session->userdata("child_list");

             $CI->db->where_in($user_colum,$user_list,FALSE);

        }

        

        if(!$userinfo->is_super_site && AT_EDIT == $permission['code'] && $permission['type'] == 'own_edit')

        {

            // $CI->db->where($user_colum,$userinfo->id,FALSE);

            

             $user_list  =  $CI->session->userdata("child_list");

             $CI->db->where_in($user_colum,$user_list,FALSE);

        }

     

        //Filter by site id         

        if(!$userinfo->is_super_site)

            $CI->db->where($site_colum,$userinfo->site_id,FALSE);

            

          

        

    }

}





















// ------------------------------------------------------------------------



/**

 * Filter Data According to permission 

 * 

 * @access	public

 */ 

if(!function_exists('filter_job_order_data'))

{

    function filter_job_order_data($table = NULL)

    {

        $CI =& get_instance();        

        $userinfo = currentuserinfo();

        

        $site_colum = "site_id";

        $user_colum = "added_by";

        

        if($table != NULL)

        {

            $site_colum = "$table.site_id";

            $user_colum = "$table.assign_user_id";

        }

        

        $permission = $CI->session->userdata("permission");

        

        if(!$userinfo->is_super_site && AT_VIEW == $permission['code'] && $permission['type'] == 'own_view')

        {			 
             //$CI->db->where($user_colum,$userinfo->id,FALSE);

             $user_list  =  $CI->session->userdata("child_list");

             

             $CI->db->where_in("$table.added_by",$user_list,FALSE);
			 //$CI->db->or_where_in($user_colum,$user_list,FALSE);

        }

        

        if(!$userinfo->is_super_site && AT_EDIT == $permission['code'] && $permission['type'] == 'own_edit')
        {
            // $CI->db->where($user_colum,$userinfo->id,FALSE);

             $user_list  =  $CI->session->userdata("child_list");
		
			 $CI->db->where_in("$table.added_by",$user_list,FALSE);
             //$CI->db->or_where_in($user_colum,$user_list,FALSE);
		}

        //Filter by site id         

        if(!$userinfo->is_super_site)
            $CI->db->where($site_colum,$userinfo->site_id,FALSE);
		}
}

// ------------------------------------------------------------------------



/**

* Filter Data According to permission

*

* @access	public

*/
if(!function_exists('add_report'))

{

	function add_report($id = NULL)

	{
		$CI 		= & get_instance();
 		$uri		= $CI->uri->uri_string();
 		
 		$CI->db->set('site_id',currentuserinfo()->site_id);
		$CI->db->set('added_by',currentuserinfo()->id);
		$CI->db->set('last_ip',current_ip());
		$CI->db->set('created_time',current_date());
		$CI->db->set('uri',$uri);
		$CI->db->set('action',AT_ADD);
		$CI->db->set('action_id',"$id");
		$CI->db->insert("report");



	}

}

if(!function_exists('update_report'))

{

	function update_report($id = NULL)

	{
		$CI 		= & get_instance();
		$uri		= $CI->uri->uri_string();

		$CI->db->set('site_id',currentuserinfo()->site_id);
		$CI->db->set('added_by',currentuserinfo()->id);
		$CI->db->set('last_ip',current_ip());
		$CI->db->set('created_time',current_date());
		$CI->db->set('uri',$uri);
		$CI->db->set('action',AT_EDIT);
		$CI->db->set('action_id',"$id");
		$CI->db->insert("report");



	}

}



if(!function_exists('delete_report'))

{

	function delete_report($id = array())

	{
		$CI 		= & get_instance();
		$uri		= $CI->uri->uri_string();

		$id   		= implode(",",$id);
		
		$CI->db->set('site_id',currentuserinfo()->site_id);
		$CI->db->set('added_by',currentuserinfo()->id);
		$CI->db->set('last_ip',current_ip());
		$CI->db->set('created_time',current_date());
		$CI->db->set('uri',$uri);
		$CI->db->set('action',AT_DELTE);
		$CI->db->set('action_id',"$id");
		$CI->db->insert("report");



	}

}




if(!function_exists('export_report'))

{

	function export_report($id = array())

	{
		$CI 		= & get_instance();
		$uri		= $CI->uri->uri_string();
		
		$id   		= implode(",",$id);

		$CI->db->set('site_id',currentuserinfo()->site_id);
		$CI->db->set('added_by',currentuserinfo()->id);
		$CI->db->set('last_ip',current_ip());
		$CI->db->set('created_time',current_date());
		$CI->db->set('uri',$uri);
		$CI->db->set('action',AT_EXPORT);
		$CI->db->set('action_id',"$id");
		$CI->db->insert("report");



	}

}






