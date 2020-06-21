<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model{
    public function __construct(){
	   parent::__construct();	   
       $this->_last_access_url();
       $this->lang->load('common', get_site_language());
       $this->session->set_userdata("current_uri",$this->_current_uri());
	}

    private function _last_access_url(){
        if(current_url() != $this->session->userdata('current_url'))
             $this->session->set_userdata('last_access_url',$this->session->userdata('current_url'));
        $this->session->set_userdata('current_url',current_url());
    }    
   
   /**
     * Get current_uri
     * Also remove index or index.php from uri
     *
     * @return	string
     */
    private function _current_uri($uri = ''){
        $segments = $this->uri->segment_array();
        // Remove index and index.php from array
        $segments = array_diff($segments, array('index', 'index.php'));
        // Reindex array
        $segments = array_values($segments);
        foreach ($segments as $segment){
            $uri .= $segment.'/';
        }
        return $uri;
    }

}