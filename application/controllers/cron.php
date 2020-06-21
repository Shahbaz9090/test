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
 
class Cron extends CI_Controller 
{
    public $data = [];
    function __construct()
    {
        parent::__construct();
        $this->load->helper('comman');
        $this->data = ['country_type'=>1,'type'=>'sales_spares_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>1,'type'=>'sales_governing_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>1,'type'=>'sales_pcb_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>1,'type'=>'service_pcb_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>1,'type'=>'service_automation_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>1,'type'=>'service_dcs_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>1,'type'=>'all_erp_email','table'=>'email_data','table_doc'=>'email_data_doc'];
        $this->sync_inbox_cron();

        $this->data = ['country_type'=>2,'type'=>'all_email_china','table'=>'email_data_china','table_doc'=>'email_data_doc_china'];
        $this->sync_inbox_cron();

    }

    public function index()
    {
        echo "Test";
    }

    public function sync_inbox_cron($msg_type="inbox")
    {
        // pr($this->data);die;
        $userCred   = get_smtp_user($this->data['type'], $this->data['country_type']);
        // pr($userCred);die;

        if(!empty($userCred) && count((array) $userCred)>0 && !empty($userCred->email_id) && !empty($userCred->password))
        {
            $username   = $userCred->email_id;
            $password   = $userCred->password;
            $mailbox    = $userCred->mailbox;
            $label      = $userCred->label;
            $sentbox    = $userCred->sentbox;
            $encrypto   = $userCred->encrypto;
            $imap_port  = $userCred->imap_port;
        }
        else
        {
            echo "Email account details not exist for this module. Please add email account details";die;
        }

        if($msg_type=='inbox')
        {
            $config['encrypto'] = $encrypto;
            $config['validate'] = false;
            $config['host']     = $mailbox;
            $config['port']     = $imap_port;
            $config['username'] = $username;
            $config['password'] = $password;
            $config['folder']   = 'INBOX';
        }
        else
        {
            $config['encrypto'] = $encrypto;
            $config['validate'] = false;
            $config['host']     = $mailbox;
            $config['port']     = $imap_port;
            $config['username'] = $username;
            $config['password'] = $password;
            $config['folder']   = $sentbox;
        }
        // pr($config);die;
        $this->load->library('imap');
        $stream = $this->imap->connect($config);
        if (!$stream) {
            echo "Cannot connect to your mail server: ' . '<a href=\"https://www.google.com/search?q='.$mailbox.'\" target=\"_blank\">Allow access to your Email account</a>'";die;
        }
        else 
        {
            
            $data = [];
            mb_internal_encoding("UTF-8");
            $last_sync_date = false;
            $last_msg_id    = 0;
            $last_msg       = last_msg($msg_type, $username, $this->data['type'], $this->data['country_type']);
            if(isset($last_msg) && !empty($last_msg))
            {
                $last_msg_id    = $last_msg->mail_id;
                $last_sync_date = $last_msg->last_sync;
            }

            if(!$last_sync_date && $this->data['country_type']=='2')
            {
                $last_sync_date = '2020-03-15';
            }

            if ($last_sync_date) {
                $date   = date('d-M-Y', strtotime($last_sync_date));
                $emails = $this->imap->search('SINCE ' . $date. ' -1 day');
            }
            else {
                $emails = $this->imap->search('ALL');
            }
            // pr($emails);die;
            asort($emails);
            if (count($emails) && $emails) {
                $this->db->db_debug = false;
                
                foreach ($emails as $email_number) {
                    if ($email_number > $last_msg_id) {
                        $message    = $this->imap->get_message($email_number);

                        $data['user_id']        = 9999;
                        $data['type']           = $this->data['type'];
                        $data['added_by']       = $user_id;
                        $data['mail_id']        = $email_number;
                        $data['last_ip']        = current_ip();
                        $data['uid']            = $message['uid'];
                        $data['message_id']     = $message['message_id'];
                        $data['from_email']     = $message['from']['email'];
                        $data['from_name']      = $message['from']['name'];
                        $data['to_email']       = implode(',', array_column($message['to'], 'email'));
                        $data['to_name']        = implode(',', array_column($message['to'], 'name'));
                        $data['reply']          = implode(',', array_column($message['reply_to'], 'email'));
                        $data['reply_name']     = implode(',', array_column($message['reply_to'], 'name'));
                        $data['cc_email']       = implode(',', array_column($message['cc'], 'email'));
                        $data['bcc_email']      = implode(',', array_column($message['bcc'], 'email'));
                        $data['subject']        = $message['subject'];
                        $data['message']        = $message['body'];
                        $data['is_attachment']  = 0;
                        $data['mail_date']      = date('Y-m-d h:i:s', ($message['udate']));
                        $data['last_sync']      = date('Y-m-d', ($message['udate']));
                        $data['msg_type']       = $msg_type;
                        $attachments            = [];
                        
                        if(isset($message['attachments']) && !empty($message['attachments']) && count($message['attachments']))
                        {

                            foreach ($message['attachments'] as $att_key => $attach) {
                                $destination    = FCPATH.'/upload/email_attachment/';
                                $filename       = $attach['name'];
                                $extension      = pathinfo($filename)['extension'];
                                $filename_md5   = time().'.'.$extension;
                                $target_path    = $destination . $filename_md5;
                                $fpp            = file_put_contents($target_path, $attach['content'] );
                                $attachments[$att_key]['file_title']    = $filename;
                                $attachments[$att_key]['filename']      = $filename_md5;
                            }
                        }

                        if($query = $this->db->insert($this->data['table'], $data))
                        {
                            $last_id = $this->db->insert_id();
                            if(isset($attachments) && !empty($attachments))
                            {
                                foreach ($attachments as $key1 => $value1) {
                                    $attachments[$key1]['email_data_id'] = $last_id;
                                }
                                $this->db->insert_batch($this->data['table_doc'], $attachments);
                            }
                        }
                    }
                }
            }
        }
        echo "Email synchronization successfully";die;
    }
    
}