<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Dashboard Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Dashboard 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Dashboard extends MY_Controller {
    
    /**
	 * Constructor
	 */
     
    function __construct()
    {
        parent::__construct();
        isProtected();
		//pr($this->session); die;
         $this->load->model('dashboard_mod');
		 //$this->load->model('job_order/pipeline_mod');
    }
    
    // ------------------------------------------------------------------------

    /**
     * Index
     *
     * This function display user dashboard
     * 
     * @access	public
     * @return	html data
     */
	

	public function index()
	{
	   $views[]         = "dashboard";
       $data['title']   = "Dashboard";	
	  
	  $data['result'] = $this->dashboard_mod->appointment_data();
		//$this->output->cache();
	   //pr($data);die;		
	   view_load($views,$data);
	   
	}
    
    function ajax_dashboard($searchType,$getUserId1)
    {  
        $userlist = explode('_',$this->input->post('user'));
        
        if(end($userlist) != $getUserId1)
        {
            $parent_id = getUser($getUserId1)->parent_user_id;
            $split_by = array_search($parent_id, $userlist);
        
            if ($split_by > -1)
                {
                   if($split_by == 0)
                   {
                    $userlist = array($parent_id);
                   }
                   else
                   {
                     $userlist = array_slice($userlist, 0, $split_by + 1 );
                   }
                  
                   $userlist[] = $getUserId1;
                }
                $userlist = implode('_',$userlist); 
               
                if($_POST){
                    $data['total_user_id']=($split_by > -1) ? $userlist : $this->input->post('user').'_'.$getUserId1;
                }else{
                    $data['total_user_id']=currentuserinfo()->id;
                }
        }
        else
        {
            $userlist = $this->input->post('user');
            $data['total_user_id']=$userlist;
        }
                
        $userlist=explode("_",$data['total_user_id']);   
           
        $data['getcount']=$userlist;
        
        $data['searchType']=$searchType;
        $data['getUserId1']=$getUserId1;
        
        //set year of yearly report type
        $data['year'] = $this->input->post('year');
        
        //set month for monthly report type
        $data['month'] = $this->input->post('month');
        
        //set date for daily report type
        $post_max = $this->input->post('max_day');
        $post_min = $this->input->post('min_day');
        $max_day = date('Y-m-d',strtotime($this->input->post('max_day'))); 
        $min_day = date('Y-m-d',strtotime($this->input->post('min_day'))); 
        $data['min_day'] = $min_day;
        $data['max_day'] = $max_day;
       
        if($post_min != '' && $post_max=='')
        {
           $data['max_day'] = $min_day;  
        }
        else if($post_max != '' && $post_min=='')
        {
            $data['min_day'] = $max_day;
        }
        else if($post_max == '' && $post_min== '')
        {
            $data['min_day'] = date("Y-m-d");
            $data['max_day'] = date("Y-m-d");
        }
        
        //set week for weekly report type
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if($start_date && $end_date)
        {
           $data['start_date'] = $this->input->post('start_date');
           $data['end_date'] = $this->input->post('end_date');
        }
        else
        {
           $data['start_date'] = date("Y-m-d",strtotime('monday this week')); 
           $data['end_date'] = date("Y-m-d",strtotime('today')); 
        }
        
               
        $this->load->view("ajax_dashboard",$data);
        
    }
    
    function ajax_user_dashboard($searchType,$getUserId1)
    {        
        if($_POST){
            $data['total_user_id']=$getUserId1;
        }else{
            $data['total_user_id']=currentuserinfo()->id;
        }
        
        $userlist=explode("_",$data['total_user_id']);
        
        //set year of yearly report type
        $data['year'] = $this->input->post('year');
        
        //set month for monthly report type
        $data['month'] = $this->input->post('month');
        
        //set date for daily report type
        $post_max = $this->input->post('max_day');
        $post_min = $this->input->post('min_day');
        $max_day = date('Y-m-d',strtotime($this->input->post('max_day'))); 
        $min_day = date('Y-m-d',strtotime($this->input->post('min_day'))); 
        $data['min_day'] = $min_day;
        $data['max_day'] = $max_day;
        if($post_min != '' && $post_max=='')
        {
           $data['max_day'] = $min_day;  
        }
        else if($post_max != '' && $post_min=='')
        {
            $data['min_day'] = $max_day;
        }
        else if($post_max == '' && $post_min== '')
        {
            $data['min_day'] = date("Y-m-d");
            $data['max_day'] = date("Y-m-d");
        }
        
        //set week for weekly report type
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if($start_date && $end_date)
        {
           $data['start_date'] = $this->input->post('start_date');
           $data['end_date'] = $this->input->post('end_date');
        }
        else
        {
           $data['start_date'] = date("Y-m-d",strtotime('monday this week')); 
           $data['end_date'] = date("Y-m-d",strtotime('today')); 
        }
         $data['searchType']=$searchType;
         $data['getUserId1']=$getUserId1;
         $data['getcount']= $userlist;        
         $this->load->view("ajax_user_dashboard",$data);
        
    }
    
    function set_dashboard_report($drag = null)
    {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
       
        $id = currentuserinfo()->id;
        $arr = $this->input->post('arr');
        if($drag) {
            $data = array('chart_list' => $arr);
            $update = $this->dashboard_mod->update_report_type($data, $id);
            return;
        }
        if($month == '')
        {
            $month = date("m");
        }
        $day = $this->input->post('day');
        $search_type = $this->input->post('search_type');
        
        
        $data = array(
            'year' => $year,
            'month' => $month,
            'search_type' => $search_type,
            'day' => $day);
            
        $update = $this->dashboard_mod->update_report_type($data, $id);   
        
    }

	function performance(){
		$this->output->enable_profiler(TRUE);
		$this->data['submodule'] = 'Performance';
		$this->data['description'] = 'Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>Alongside his inspiring longevity for a striker, Klose has been the beneficiary of outstanding crops of attacking midfielders who have set up many of his 71 goals for Germany.<br>Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany. Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany<br/>.Alongside his record-breaking goal tally, Klose will long be remembered for his sportsmanship with his acts of fair play making headline news in Germany';
		$this->load->view('performance',$this->data);
	}


}