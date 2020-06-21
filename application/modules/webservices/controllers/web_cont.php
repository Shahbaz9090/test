<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * @subpackage	Rest API
 * @category	Controller
 */

require APPPATH.'/libraries/webservices/REST_Controller.php';
require APPPATH.'/libraries/webservices/Message.php';

class Web_cont extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('web_mod');
        $this->load->model('auth/auth_mod');
        
		define("API_KEY", "2992c9debd79d6e9");
	}
	
	/***************************function for login***************************/
	public  function login_post() {			
		//	echo "vfsdhgf";
          //  die;
		//	$_POST = json_decode(file_get_contents('php://input'),true);
            
			//$this->form_validation->set_rules('email','email','required|xss_clean'); 
			//$this->form_validation->set_rules('password', 'password','required|xss_clean');
			$this->form_validation->set_rules('apikey', 'Api Key','required| xss_clean');
			
            if(!empty($_POST)) {
				if($this->form_validation->run() == TRUE) {
					$apiKey   = $this->input->post('apikey');
				
					if($apiKey==API_KEY) {
						$result = $this->auth_mod->login_authorize();
                        
						if(!empty($result['valid'])) {
						    $data['id']=$result['other']->id;
                            $data['site_id']=$result['other']->site_id;
                            $data['name']=$result['other']->name;
                            $data['email']=$result['other']->email;
                            $data['designation']=$result['other']->designation;
                           $data['password']=$_POST['password'];
							$success = array('responseCode' =>'1', 'responseMessage' =>Message::__('LOGIN SUCCESSFULLY'), 'data'=>$data);
							set_status_header(200);
							echo json_encode($success);
						} else {
							$error = array('responseCode' =>'0', 'responseMessage' =>Message::__('USER_PASSWORD_NOT_MATCH'));
							$this->response($error, 200);
						}
					} else {
						$error = array('responseCode' =>'0', 'responseMessage' =>'Api Key does not exist');
						$this->response($error, 200);
					}
				} else {
					$error = array('responseCode' =>'0', 'responseMessage' =>strip_tags(validation_errors()));
					$this->response($error, 200);
				}
			} else {
				$error = array('responseCode' =>'0', 'responseMessage' =>'Invalid Request');
				$this->response($error);
			}
		}

	/***************************function for login***************************/
    
    /***************************function for uploadResume***************************/
    
     public  function uploadResume_post() {	
            $this->load->module('candidate/candidate');
            $this->load->model('candidate/candidate_mod');
            $this->load->model('candidate/attachment_mod');
            $this->load->model('country_mod');
			$this->form_validation->set_rules('site_id','Site Id','required|xss_clean');
            $this->form_validation->set_rules('fileToUpload[]','fileToUpload','xss_clean'); 
            $this->form_validation->set_rules('user_id','user_id','required|xss_clean');
           	$this->form_validation->set_rules('apikey', 'Api Key','required| xss_clean');
             
			
            if(!empty($_POST)) {
				if($this->form_validation->run() == TRUE) {
					$apiKey   = $this->input->post('apikey');
					
					if($apiKey==API_KEY) {
					  // echo "hjfjs";
                       //die;
					//$result = $this->upload_resume();
                   // print_r($result);
                    //die;
                       // $result = $this->candidate->ect();
                        //echo $result;
                        //print_r($result);
                       // die;
                        $result = $this->candidate->upload_resume();
						print_r($result);
                        die;
						if($result) {
							$success = array('responseCode' =>'1', 'responseMessage' =>'You Have Successfully Upload Resume!');
							//$this->response($success, 200);
							set_status_header(200);
							echo json_encode($success);
						} else {
							$error = array('responseCode' =>'0', 'responseMessage' =>'Resume Not Upload Successfully');
							$this->response($error, 200);
						}
                        
					} else {
    					$error = array('responseCode' =>'0', 'responseMessage' =>'Api Key Does Not Exist');
						$this->response($error, 200);
					}
				} else {
					$error = array('responseCode' =>'0', 'responseMessage' =>strip_tags(validation_errors()));
					$this->response($error, 200);
				}
			} else {
				$error = array('responseCode' =>'0', 'responseMessage' =>'Invalid Request');
				$this->response($error , 200);
			}
		}
    public  function test_post() {
            
							$success = array('responseCode' =>'1', 'responseMessage' =>'You Have Successfully Hit This Api!');
							//$this->response($success, 200);
							set_status_header(200);
							echo json_encode($success);
						
		}
        
    
    /***************************function for uploadResume***************************/
    /* public function upload_resume() {
        if (isPostBack()) {
            $count_image = count($_FILES['fileToUpload']['name']);
           // print_r($_FILES);
            //die;
            $this->load->library('upload');
            $err = array();
            $error = "";
            $sys_err = array();
            $is_customer = 0;
            $email_exists = 1;
            for ($i = 0; $i < $count_image; $i++) {
                $limit_over = 0;
                ///////////////check customer's user creation limit /////////////////
                if (@currentuserinfo()->is_customer == "1") {
                    if (is_resume_limit() == false) {
                        $limit_over = 1;
                        $sys_err[] = "<strong>Error : You have exceeds the resume limit.</strong>";
                    }
                    $is_customer = 1;

                }
                //////////////////////////////////////////////////////////////////////////////////////////

                if ($limit_over != 1) {

                    $_FILES['userfile']['name'] = $_FILES['fileToUpload']['name'][$i];
                    //echo $_FILES['userfile']['types']    = $_FILES['fileToUpload']['type'][$i];exit;
                    $_FILES['userfile']['type'] = $_FILES['fileToUpload']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['fileToUpload']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['fileToUpload']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['fileToUpload']['size'][$i];

                    $config['file_name'] = $_FILES['fileToUpload']['name'][$i];
                    $config['upload_path'] = $this->config->item('temp_attachments');
                    $config['allowed_types'] = 'doc|docx|pdf|csv|DOCX|DOC|PDF|txt|rtf';

                    $config['max_size'] = '';
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;
                    $config['overwrite'] = false;

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload()) {
                        $error = $this->upload->display_errors();
                        $error = strip_tags($error);
                        $sys_err[] = "<strong>Error : " . $config['file_name'] . ':</strong> ' . $error;

                    } else {
                        $data = $this->upload->data();
                        $filename = $data['file_name'];
                        $filesize = $data['file_size'];
                        $filetype = $data['file_type'];

                        //Read doc file if server string fine Win means windows server
                        $server = $_SERVER['SERVER_SIGNATURE'];
                        $this->load->model('candidate/attachment_mod');
                        //$this->load->model("attachment_mod");

                        if (strpos($server, 'Win') !== false) {
                            $text = $this->attachment_mod->doc_to_text_win($this->config->item('temp_attachments') . $filename);

                        } else {
                            $text = $this->attachment_mod->doc_to_text_unix($this->config->item('temp_attachments') . $filename,
                                $filetype);
                        }

                        $text = trim($text);
                        $for_name = explode(" ", $text);
                        $first_name = $for_name[0];

                        $email = $this->extract_email_address($text);
                        if ($email != '') {
                            $check_email = $this->attachment_mod->check_email($email);

                            if ($check_email == false) {
                                $data = array(
                                    'is_refine' => '1',
                                    'email' => $email,
                                    'first_name' => $first_name);

                                $this->attachment_mod->insert_upload_resume($data, $text, $filesize, $filename);

                                /////////////////////check candiate exits on central database or not...if not then upload on central///////////////////
                                if ($is_customer == 1) {
                                    $result = $this->attachment_mod->check_email_central($email);
                                    ($result == false) ? $this->attachment_mod->insert_upload_resume_central($data, $text, $filesize, $filename) : '' ;
                                }
                                ///////////////////////////////////////////////////////////////////////////////////////

                               

                                $success = 'true';
                                $suc[] = "<strong>Success : " . $config['file_name'] . ':</strong> ' .
                                    ' is successfully uploaded to database ';
                            } else {
                                if (file_exists($this->config->item('temp_attachments') . $filename)) {
                                    unlink($this->config->item('temp_attachments') . $filename);
                                }
                                $err[] = '<strong>Error: ' . $config['file_name'] . '</strong> is already in database';

                            }
                        } else {
                            if (file_exists($this->config->item('temp_attachments') . $filename)) {
                                unlink($this->config->item('temp_attachments') . $filename);
                            }
                            $err[] = '<strong>Error: ' . $config['file_name'] . '</strong> does not contain email address.';
                        }
                    }
                }
            }
            if(isset($_POST['apikey']) && ($_POST['apikey']=='2992c9debd79d6e9')){
                $data['error']=$error;
                $data['err']= $err;
                $data['success']=$success;
                return $data;
            }

            if (($error != '') || $err) {
                if ($err) {
                    $err_string = implode('<br>', $err) . '<br>';
                }
                $this->session->set_flashdata('flash_msg_type', '#');
                if ($sys_err) {
                    $error = implode('<br>', $sys_err);
                }
                $this->session->set_flashdata('flash_msg_text', $err_string . $error);
            } elseif($success) {
                $this->session->set_flashdata('flash_msg_type', 'Success: ');
                $this->session->set_flashdata('flash_msg_text', 'Resume Uploded Successfully');
            }
            redirect(base_url('candidate/upload_resume'));
        }
        $this->data['action'] = "add";
        $views[] = "candidate_upload_resume";

        $this->data['submodule'] = 'Upload Resume';
        view_load($views, $this->data);
    }*/

    
}


