<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * Database helper

 *

 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Security
 * @company     GohrmInc
 * @since		Version 1.0
 */

 // ------------------------------------------------------------------------

/**
 * getRealIpAddr* 
 * Display IP adsress if proxy or shared client
 *
 * Example
 * getRealIpAddr()
 * author :: sunnyv75
 * @access	public
 */ 
if(!function_exists('getRealIpAddr')) {
	 function getRealIpAddr() {
		  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			  //check ip from share internet
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
		  }
		  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			  //to check if ip is passed from proxy
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		  else {
			  $ip=$_SERVER['REMOTE_ADDR'];
		  }
		  return $ip;
		}
 }

 /**
 * generate_salt* 
 * returns the final salt base64-encoded for a little more entropy.
 * generates a salt string of controllable length
 * Example
 * generate_salt(15,SHASHANK)
 * author :: TEKSHAPERS
 * @access	public
 */ 
if(!function_exists('generate_salt')) {
	function generate_salt($length = 12,$salts = 'TEK@sunnyv75') {
		$str = '';
		$lim = 0;
		$CI =& get_instance();
		while ($lim<$length) {
			$lim = strlen($str);
			$str .= hash('sha512', $CI->config->item('encryption_key') . time() . uniqid(true) . $salts);
		}
		$str = base64_encode($str);
		$str = strlen($str) > $length ? substr($str, 0, $length) : $str;
		return trim(strtr($str, '/+=', '   '));
	}
}

/**
 * encrypt_decrypt* 
 * returns the final
 * uses mcypt library php5 
 * Super secured
 * generates a code string of controllable length
 * Example
 * encrypt_decrypt('encrypt','SHASHANK')
 * author :: Gohrm@ shashank
 * @access	public
 */ 
if ( ! function_exists('encrypt_decrypt')) {
	function encrypt_decrypt($action, $string) { 
		$output = false;
		$key = '$#@!$H@$H@NK!@#$';
		$iv = md5(md5($key)); if( $action == 'encrypt' ) {
		   $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
		   $output = base64_encode($output); 
		} else if ( $action == 'decrypt' ) {
		   $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
		   $output = rtrim($output, ""); 
		} 
		return $output;
	}
}
/**
 * encrypt_decrypt_php* 
 * returns the final 
 * generates a code string of controllable length
 * Example
 * zipped_res_code('encrypt','SHASHANK')
 * author :: Gohrm@ shashank
 * @access	public
 */ 
if ( ! function_exists('zipped_res_code')) {
	function zipped_res_code($action, $string) { 
		$output = false;
		if( $action == 'encrypt' ) {
		   $output =  base64_encode(gzdeflate(ENCRP_KEY.$string.ENCRP_KEY));
           $output=str_replace('/', '~', $output);
		} else if ( $action == 'decrypt' ) {
		   $string=str_replace('~', '/', $string);
		   $output = gzinflate(base64_decode($string));
		   $output = str_replace(ENCRP_KEY, '', $output);
		} 
		return $output;
	}
}

/* 
 * If the cookie exists we will use it's value.  We don't
 * need to regenerate it.
 * Set the CSRF hash
 * @access	public
 * @param	string
 * author 	 */

if ( ! function_exists('csrf_mk_hash')) {
	function csrf_mk_hash() { 
		$CI =& get_instance();
		$XRF_hash = $CI->security->_csrf_set_hash();		
		return $XRF_hash;
	}
}
/* If no POST data exists we will set the CSRF cookie
 * kill POST Data
 * CSRF Protection check
 * Set the CSRF hash
 * @access	public
 * @param	string
 * author shashank	 */

if ( ! function_exists('csrf_prot_check')) {
	function csrf_prot_check() { 
		$CI =& get_instance();
		if ($CI->_enable_csrf == TRUE) {
			$XRF_verify = $CI->security->csrf_verify();
			return $XRF_verify;
		}
	}
}

/**
 * XSS Filtering
 * author shashank
 * @access	public
 * @param	string
 * usage	is_xss_safe($str, TRUE) === FALSE
 * @param	bool second parameter returns TRUE if the image is safe
 * @return	string
 */
if ( ! function_exists('is_xss_safe')) {
	function is_xss_safe($str, $is_image = FALSE) {
		$CI =& get_instance();
		return $CI->security->xss_clean($str, $is_image);
	}
}

// ------------------------------------------------------------------------

/**
 * author shashank
 * Sanitize Filename
 * usage	is_filename_sanitize($filename, TRUE) === FALSE
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('is_filename_sanitize')) {
	function is_filename_sanitize($filename , $is_abs_path = FALSE) {
		$CI =& get_instance();
		return $CI->security->sanitize_filename($filename , $is_abs_path);
	}
}



