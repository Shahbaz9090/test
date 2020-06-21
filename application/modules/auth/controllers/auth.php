<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Auth Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Authentication * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Auth extends MY_Controller {
   
    private $data = array();
    
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
			
		// to change the status of user if user not logged in last 7 days...
		//lastLogin();

        $this->load->model('auth_mod');
		
        $this->lang->load('auth', get_site_language());
		
		
      
    }
    
    public function index()
	{
      
        
	   $r = $this->auth_mod->get_user_by_id(1);
       $user= currentuserinfo();
       //pr($user);die;
       if(!empty($user) && count($user) > 0){
         redirect(base_url('dashboard'));
       }else {
            $this->load->view('login');
        } 

	}

	
	 
	public function forget(){
		
		if(isPostBack()){			
			$result=$this->auth_mod->forget();
			if($result['valid'])
            {  
			   $this->session->set_flashdata("forgot_success","Your password has been send to your Email.");
			   redirect(base_url());
            }else{		
				$data['error_msg']=$result['error_msg'];
				$this->session->set_flashdata("forgot_error",$data['error_msg']);
				redirect(base_url());
			}
		}
	}

    
    
    // ------------------------------------------------------------------------

    /**
     * Login
     *
     * This function display login page
     * 
     * @access	public
     * @return	html data
     */     
    public function login()
    {
        if($this->session->userdata('isLogin') == 'yes')
            redirect(base_url('dashboard'));
        $data['error_msg'] = NULL;
        
        
        if(isPostBack())
        {
           //$result = $this->auth_mod->check_login();
		    $result = $this->auth_mod->login_authorize();            
            if($result['valid'])
            {
                redirect(base_url('dashboard'));
            }
            $data['error_msg'] = "<b>Error: </b>".$result['error_msg'];  
            $this->session->set_flashdata("Error", $data['error_msg']);
        }
        redirect(site_url());		
    }
    
    // ------------------------------------------------------------------------

    /**
     * Logout
     *
     * This function destroy all saved session
     * 
     * @access	public
     * @return	html data
     */     
    public function logout()
    {
        //isProtected();
        $this->session->sess_destroy();	
        redirect(base_url());
       
    }
    
    
    
    
    // ------------------------------------------------------------------------

    /**    
     *
     * This function generate encyrpted password
     * 
     * @access	public
     * @param   String 
     * @return	String
     */     
    public function enc($str = '')
    {
        $pwd = $this->auth_mod->encode_pwd($str);
        echo $pwd;
    }

	public function notifications(){
		$userData=currentuserinfo();
		$userId=$userData->id;
		$from_date=date("Y-m-d");
		$to_date=date("Y-m-d");
		$user_list=set_child_users($userId);
		$limit=100;
		$data=notifications($from_date,$to_date,$user_list,6,$limit);//To get interviews data
		$result=$data["result"];
		$total_notification=$data["total"];
		?>
		<div class='modal-header' style='10%'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button><h3 class='modal-title'>Interviews</h3></div><div class='modal-body'><div class='row-fluid'>
		<?php
		if($total_notification < 1){
			$response = "<li class='view-all' >You don't have notifications.</li>";
		}
        ?>
       <table class="table">
            <tr>
                <td>Company</td>
                <td>Candidate</td>
                <td>Time</td>
                <td>User</td>
            </tr>
        <?php
        //pr($result);
		foreach($result as $key=>$value){
		?>
           <tr>
                <td><a onClick="return intDetail(<?=$value->id?>);" style="color: #333333;" data-toggle="modal" href="#commonModel"><?php echo $value->company_name ?></a></td>
                <td><?php echo $value->first_name ?></td>
                <td><?=@$value->Hours?> :<?=@$value->Mint?> <?=viewTimeZone($value->time_zone)?></td>
                <td><?php echo $value->user_fname?></td>
           </tr>
        <!--<div class="popup-discripton-main">
        	<div class="popup-icon"></div>
            <div class="popup-contentmain">
				<div class="popup-name"><strong><?=$value->user_fname." ".$value->user_lname?></strong></div>
				<div class="popup-msg"><span class="popuptxt-color">Interview schedule with <?=$value->first_name." ".$value->last_name?> at <?=@$value->Hours?> :<?=@$value->Mint?> <?=viewTimeZone($value->time_zone)?></span></div>
			</div>
        </div>-->
     
       
		<?php } ?>
        </table>
		</div></div><div class='modal-footer' style='text-align: left;'><button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button></div>
	<?php }
	
	function interviewDetail($id=null){
		$job_activity_id      = $this->input->post("id",true);		
		
		$perm=_check_perm();
		if($perm==1){
			$show_client=true;
		}elseif(isset($perm["company"]["add"]) || isset($perm["company"]["all_view"])){
			$show_client=true;
		}else{
			$show_client=false;
		}
		$this->data['result'] = interviewDetail($job_activity_id);
		$this->data['show_client'] = $show_client;
		

		$this->load->view("ajax_interview_detail",$this->data);
	}
    
    
    
}