<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter My Url Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Url * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 

// ------------------------------------------------------------------------

/**
 * Last Access URL
 *
 * Returns the Last visited url
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('last_access_url'))
{
	function last_access_url()
	{
		$CI =& get_instance();
        
        return $CI->session->userdata('last_access_url');
	}
}