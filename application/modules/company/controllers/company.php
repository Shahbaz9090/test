<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * CodeIgniter Company Controller

 *

 * @package		CodeIgniter

 * @subpackage	Controllers

 * @category	Company

 * @author		Kumar Gaurav

 * @website		http://www.tekshapers.com

 * @company     Tekshapers Inc

 * @since		Version 1.0

 */

 

class Company extends MY_Controller {

   

    public $table     = "companies";

    private $data = array();

    private $export_limit = NULL;

    private $delete_limit = NULL;

    /**

	 * Constructor

	 */ 

    function __construct()

    {

        parent::__construct();

		//echo "yess";die;

        isProtected();

        $this->load->model('company_mod');

        $this->load->model('user_group_mod');

        $this->lang->load('company', get_site_language());

               

        $this->data['head']['title'] = "Client";

        $this->data['readonly'] = NULL;

        $this->data['base_url'] = base_url("company");

        $this->export_limit = $this->config->item('export_limit');

        $this->delete_limit = $this->config->item('delete_limit');

        $this->table_name   = "companies";



		$this->data['module'] = 'Client';

        $this->data['module_link'] = base_url("company")."/list_items";

        

    }

    

    

    // ------------------------------------------------------------------------

    /**

     * Add

     *

     * This function add new Company

     * 

     * @access	public

     * @return	html data

     */

	public function add()

	{

		if(isPostBack())

       {

           // pr($_POST);

            //pr($_POST['data']['common']['plc_dcs_make'][0]);die;



            $id = $this->company_mod->add();

            $this->data['state'] = get_state_from_master_acord_country($_POST['country']);

            $this->data['city'] = get_city_from_master_acord_state($_POST['state_comp']);

            //spr($this->data);die;

            if($id){

                redirect($this->data['base_url']."/list_items/");

            }

            else{

                //redirect($this->data['base_url']."/add");

            }

       }

	   $table_data = $this->company_mod->get_table_name();

	   //pr($table_data);die;

	   foreach($table_data as $key=>$val){

            if($val->form_name=='plc_dcs_make'){

            $table_name = 'inch_plc_dcs_make';

            $form_data ='';

            $this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);

           }

           if($val->form_name=='actuator_make'){

            $table_name = 'inch_actuator_make';

            $form_data ='';

            $this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);

           }

           if($val->form_name=='vfd_make'){

            $table_name = 'inch_vfd_make';

            $form_data ='';

            $this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);

           }

			if($val->form_name=='client_type_establishment'){

			$table_name = 'inch_client_type_establishment';

			$form_data ='';

			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);

		   }

           if($val->form_name=='type_of_client'){

			$table_name = 'inch_type_of_client';

			$form_data ='';

			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);

		   }

		}

       $this->data['action'] = "add";

	   $views[] = "company_form";

	   $this->data['industry'] = get_industry_from_master();

	   $this->data['country'] = get_country_from_master();

	   

	   $this->data['submodule'] = 'Add Client';

	   

	   view_load($views,$this->data);

	}

    

    // ------------------------------------------------------------------------



    /**

     * View

     *

     * This function View Company Details

     * 

     * @access	public

     * @param   int - Company Id

     * @return	html data

     */

	public function view($id = NULL)

	{        

       $result = $this->company_mod->get($id);

	   $this->data['result'] = $result;

	   $notes = $this->company_mod->get_notes($id);

	   $this->data['notes'] = $notes;

	   $document = $this->company_mod->get_doc($id);
   

	   $this->data['document'] = $document;

	   /*$industry = $result->industry;

	   //pr($industry);die;

	    

		$this->db->where('id',$industry);

        $this->db->select("id,name as industry_name");

		$this->db->order_by("name","asc");

        $res = $this->db->get("industry");

        if ($res->num_rows > 0) {

            $var =  $res->row();

        } else {

            return false;

        }*/

		//pr("yess");die;

	   $this->data['industry'] = $var;

	   $table_data = $this->company_mod->get_table_name();

	   //pr($table_data);die;

	   foreach($table_data as $key=>$val){

            if($val->form_name=='plc_dcs_make'){

            $table_name = 'inch_plc_dcs_make';

            $form_data ='';

            $this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);

           }

           if($val->form_name=='actuator_make'){

            $table_name = 'inch_actuator_make';

            $form_data ='';

            $this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);

           }

           if($val->form_name=='vfd_make'){

            $table_name = 'inch_vfd_make';

            $form_data ='';

            $this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);

           }

			if($val->form_name=='client_type_establishment'){

			$table_name = 'inch_client_type_establishment';

			$form_data ='';

			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);

		   }if($val->form_name=='type_of_client'){

			$table_name = 'inch_type_of_client';

			$form_data ='';

			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);

		   }

		}

       $this->data['readonly'] = 'readonly="true"';

       $this->data['action'] = "view";

       $views[] = "company_form_view"; 

		$this->data['helper'] = check_file_extension();

	   $this->data['submodule'] = 'View Client';

	   view_report($id);

	   view_load($views,$this->data);

	}

    

    

    // ------------------------------------------------------------------------



    /**

     * Edit

     *

     * This function Edit Company Details

     * 

     * @access	public

     * @param   int - Company Id

     * @return	html data

     */

	public function edit($id = NULL)

	{   	   

        if(check_own_all_permission( ['id'=>$id], $this->table)==false)

        {

            set_flashdata("error", "You do not have permission.");

            return redirect(base_url('company/list_items'));exit;

        }



       if(isPostBack())

       {

			 $r = $this->company_mod->update($id);

           if($r === 'error'){ 

                //redirect($this->data['base_url']."/edit/".$id);

				$this->data['error_msg']="Oops !! This Company Name is Already Exists.";

				

			}else{

				$this->data['error_msg']='';

                redirect($this->data['base_url']."/list_items/");

			}

			//pr($this->data);die;

       }

       $table_data = $this->company_mod->get_table_name();

	   //pr($table_data);die;

	   foreach($table_data as $key=>$val){

        if($val->form_name=='plc_dcs_make'){

            $table_name = 'inch_plc_dcs_make';

            $form_data ='';

            $this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);

           }

           if($val->form_name=='actuator_make'){

            $table_name = 'inch_actuator_make';

            $form_data ='';

            $this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);

           }

           if($val->form_name=='vfd_make'){

            $table_name = 'inch_vfd_make';

            $form_data ='';

            $this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);

           }

			if($val->form_name=='client_type_establishment'){

			$table_name = 'inch_client_type_establishment';

			$form_data ='';

			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);

		   }if($val->form_name=='type_of_client'){

			$table_name = 'inch_type_of_client';

			$form_data ='';

			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);

		   }

		}

       $result = $this->company_mod->get($id);

       $notes = $this->company_mod->get_notes($id);

	   $this->data['result'] = $result;

	   $this->data['notes'] = $notes;

       //pr($result);die;

       $this->data['action'] = "edit";

       $views[] = "company_form";

	   $this->data['industry'] = get_industry_from_master();

	   $this->data['country'] = get_country_from_master();

	   $this->data['state'] = get_state_from_master_acord_country($result->country);

	   $this->data['city'] = get_city_from_master_acord_state($result->state_comp);

	   $this->data['submodule'] = 'Edit Client';

	   //pr($this->data);die;

	   view_load($views,$this->data);

	}

    

    // ------------------------------------------------------------------------



    /**

     * list items

     *

     * This function display all Company list

     * 

     * @access	public

     * @return	html data

     */

	public function list_items()

	{  

		

	    $views[] = "company_list";

        $this->data['title'] = lang('list_title');

        $this->data['place_holder'] = "Enter filter terms here";        

        $this->data['action'] = "list";



        $this->data['grid']['cols'] = $this->company_mod->get_flexigrid_cols();



        $this->data['grid']['base_url'] = $this->data['base_url'];

        $this->data['grid']['export_limit'] = $this->export_limit;

        $this->data['grid']['delete_limit'] = $this->delete_limit;

        

        //check session offset

        if($this->session->flashdata('offset')) {

            $this->data["offset"] = $this->session->flashdata('offset');

        } else {

            $this->data["offset"] = 1;

        }

        $text = $this->input->post('text');

        $limit=@$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';

        $offset=1;

        $order_by='id';

        $order='desc';

        $result =  $this->company_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);

		foreach ($result['result'] as $row) { 

            

				

                $row->name = ucwords($row->name); //@$companyContact->contact_person;

                $row->name = '<a href="'.base_url().'company/view/'.$row->id.'">#'.$row->name.'</a>';

				$row->industry_name = ucwords($row->industry_name);

				$row->country_name = ucwords($row->country_name);

				$row->state_name = ucwords(strtolower($row->state_name));

				$row->city_name = ucwords(strtolower($row->city_name));

				$row->created_time = date("d/m/Y", strtotime($row->created_time));

				//pr($row->created_time);die;

				if($row->type_of_establishment!=0){

					$row->type_of_establishment = ucwords(strtolower($row->type_of_establishment_name));

				}else{

						$row->type_of_establishment = '-/-';

				}

				

				if($row->type_of_client!=0){

					$row->type_of_client = ucwords(strtolower($row->type_client_name));

				}else{

						$row->type_of_client = '-/-';

				}

				

				//pr($row->name);die;

				

			if ($row->status == '0')

            {

                $row->status = "Inactive";

            } else

            {

                $row->status = "Active";

            }  

                

            if($row->added_by == $user->id && ($permission != '1' && $permission !='' ))

            {

                $row->status =  $row->status;

				//$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';

            }else

            {

                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';

            }

		}

		//\\pr($result);die;

		

        $this->data['grid']['result'] = $result;

        $this->data['grid']["page_offset"] = 1;

        $this->data['grid']["limit"] = $limit;

        $this->data['grid']["order_by"] = 'id';

        $this->data['user_groups'] = $this->user_group_mod->get_groups();

        //pr($this->data);die;

        $this->data['submodule'] = 'Client List';
      

        view_load($views, $this->data);

	}

    

     public function ajax_list_items($limit = 10)

	{ 

	    $user=currentuserinfo();

		$perPage = $this->company_mod->perPage($user->id);

        if($perPage) {

        } else {

            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);

            $pageArr = array(

                'action' => $controllerInfo,

                'records' => $this->input->get_post('rp', true),

                'user_id' => $user->id);

            $this->company_mod->insert_perPage($pageArr);

        }



       

        if($this->input->post("order_by")) {

            $order_by = $this->input->post("order_by");

        }else{

            $order_by = 'id';

        }

        if($this->input->post("order")) {

            $order = $this->input->post("order");

        }else{

            $order = 'desc';

        }

        $offset = $this->input->post("offset");

        if(!$offset){

            $offset =1;

        }

        if(!$limit) {

            $limit = 10;

        }

        if($this->input->post("limit")) {

            $limit = $this->input->post("limit");

            $this->data["hiddenLimit"] = $limit;

        }

        if($this->input->post('text')) {

            $text = $this->input->post('text');

        } else {

            $text = null;

        }

        

        $data = $this->company_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);

        $permission=_check_perm();

       // pr($data);die;

        foreach ($data['result'] as $row)

        {



                $row->name = ucwords($row->name); //@$companyContact->contact_person;

                $row->name = '<a href="'.base_url().'company/view/'.$row->id.'">#'.$row->name.'</a>';

                $row->industry_name = ucwords($row->industry_name);

				$row->country_name = ucwords($row->country_name);

				$row->state_name = ucwords(strtolower($row->state_name));

				$row->city_name = ucwords(strtolower($row->city_name));

                $row->created_time = date("d/m/Y", strtotime($row->created_time));

				if($row->type_of_establishment!=0){

					$row->type_of_establishment = ucwords(strtolower($row->type_of_establishment_name));

				}else{

						$row->type_of_establishment = '-/-';

				}

				

				if($row->type_of_client!=0){

					$row->type_of_client = ucwords(strtolower($row->type_client_name));

				}else{

						$row->type_of_client = '-/-';

				}

				

				//pr($row->name);die;

				

			if ($row->status == '0')

            {

                $row->status = "Inactive";

            } else

            {

                $row->status = "Active";

            }  

                

            if($row->added_by == $user->id && ($permission != '1' && $permission !='' ))

            {

                $row->status =  $row->status;

				//$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';

            }else

            {

                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';

            }

            //$cityResult = viewCity($row->city);

			//pr($cityResult);die;

            //$row->city = @$cityResult->cityName;

        }

       

        $data['grid']['total'] = $data['total'];

        $data['grid']['cols'] = $this->company_mod->get_flexigrid_cols();

        $data['grid']['result'] = $data['result'];

        $data['grid']["page_offset"] = $offset;

        $data['grid']["limit"] = $limit;

      	$data['grid']["base_url"] = $this->data['base_url'];

        //pr($data);die;

        $this->load->view('kg_grid/ajax_grid', $data);

       

  

	}

    

    

     // ------------------------------------------------------------------------



    /**

     * Export items

     *

     * This function display Export by id

     * 

     * @access	public

     * @return	html data

     */

    

    public function export($id='')

    {

        $this->load->library('export_lib');

        $text          =$this->input->get_post('text',TRUE);

        $is_export =true;

        $items          =$this->input->get_post('items',TRUE);

        $items_data     = str_replace("row","",$items);       

        $items_data      = explode(",",$items_data);

        if($items==''){

            $items_data='';

        }



        $result =  $this->company_mod->ajax_list_items($text, null, null, null, null, $is_export, $items_data);

        $result = $result['result'];

        $table_columns = ["name"=>"Client Name","industry_name"=>"Industry Type","country_name"=>"Country","state_name"=>"State/Province","city_name"=>"City ","created_time"=>"Created Date","plant_established_year"=>"Plnt stablished Year","type_of_establishment_name"=>"Type of Establishment","type_client_name"=>"Type of Client","tax_gst"=>"GST No.","company_address"=>"Client Address"];

        $filename = "Company" . date('d-m-Y'). ".xls";

        $this->export_lib->export($table_columns, $result, $filename); 

    } 

    

    

  // ------------------------------------------------------------------------



    /**

     * delete items

     *

     * This function display delete by id

     * 

     * @access	public

     * @return	html data

     */

    

    public function delete()

    {

       $items           = $this->input->get_post('items',TRUE);

       $items_data      = str_replace("row","",$items);       

       $items_data      = explode(",",$items_data);      

       

       $this->db->where_in("id",$items_data);

       filter_data();

       $this->db->delete($this->table_name);

       delete_report($items_data);

    }

	

	// ------------------------------------------------------------------------



    /**

     * Fetch State 

     *

     * This function Fetch All State by Country id

     * 

     * @access	public

     * @return	html data

     */

    

    public function fetch_state_according_country()

    {

		

       $id          = $this->input->get_post('id',TRUE);

		//pr($id);die;

		if(!empty($id)){

			echo $data['value'] = $this->company_mod->fetch_state($id);

		}else{

			return false;

		}

    }

	

	/**

     * Fetch City 

     *

     * This function Fetch All City by State id

     * 

     * @access	public

     * @return	html data

     */

    

    public function fetch_city_according_country()

    {

       $id          = $this->input->get_post('id',TRUE);

		

		if(!empty($id)){

			echo $data['value'] = $this->company_mod->fetch_city($id);

		}else{

			return false;

		}

    }

	

	

	

	

	

	public function checkClientIdExistence() {

        is_ajax_request();

        $client_id = $this->input->post('client_id', true);

        $result = $this->company_mod->check_client_id_existance($client_id);

       // pr($result);die;

        if ($result == true)

            echo true;

    }

        

	/**

     * Contact Status

     *

     * This function action on Contact Status

     * 

     * @access	public

     * @return	html data

     */

    public function status($id = null) {

        $result = $this->company_mod->get($id);

        $r = $this->company_mod->status_update($id, $result->status);

        if($r) {

            redirect($this->data['base_url'] . "/list_items");

        }



    }

  public function checkNameExistence() {

		is_ajax_request();

		

        $company_name = $this->input->get_post('company_name', true);

        $id = $this->input->get_post('id', true);

		$company_name = strtolower($company_name);

		$result = $this->company_mod->check_name_existance($company_name,$id);

        //pr($result);die;

        if ($result == true)

            echo true;

    }

	

	/**

     * get company name suggestion

     *

     * This function display 

     * 

     * @access	public

     * @return	html data

     */

    

    public function get_company_suggestion()

    {

	   $this->session->unset_userdata("key");

       $comp_text           = $this->input->get_post('query',TRUE);

	   

	   if(!empty($comp_text)){

		   $this->db->select("com.*");

		   $this->db->where("(com.name like '%".$comp_text."%')");

		   $query = $this->db->get('companies as com');

		   //echo $this->db->last_query();die;

		   if($query->num_rows()>0){

			   $result = $query->result();

			    $output = ''; 

				$output = '<ul class="list-unstyled">';

				foreach($result as $val){

					$output .= '<li class="suggestion disabled"><a>'.ucwords($val->name).'</a></li>'; 

				}

				$output .= '</ul>';  

				echo $output;  

		   }

	   }

    }

	

	

	/**

     * get All company Data

     *

     * This function display 

     * 

     * @access	public

     * @return	html data

     */

    

    public function get_company_all_data()

    {

       $comp_text           = $this->input->get_post('company_name',TRUE);

	  

	   if(!empty($comp_text)){

		   $this->db->select("com.*");

		  $this->db->where("com.name",$comp_text);

		   $query = $this->db->get('companies as com');

		   //echo $this->db->last_query();die;

		   if($query->num_rows()>0){

			   $result = $query->row();

			   

			    $output = ''; 

				

				$output = $result; 

				///$this->session->set_userdata("key",$output->id);

				//pr($this->session->userdata("key"));

				echo json_encode($output);  

		   }

	   }

    }



    public function transfer_client(){

        $assign_group = $this->input->post('assign_group');

        $assign_user = $this->input->post('assign_user');

        $company = $this->input->post('company');

        $company = trim($company,',');

        $company = explode(',',$company);

        //pr($assign_user);die;

        if(isset($company) && is_array($company))

        {

            foreach($company as $cc_key => $cc_val)

            {

                $upd['added_by']    =   $assign_user;

                $this->db->where('id',$cc_val);

                $this->db->update('companies',$upd);

            }

        }

        set_flashdata("success", lang('client_transfer'));

        echo "true";

    }

    	

}



    

 