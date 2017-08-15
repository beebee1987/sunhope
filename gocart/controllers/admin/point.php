<?php

class Point extends Admin_Controller {	

	protected $activemenu 	= 'point';
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();		
		
		$this->load->model(array('Search_model', 'Point_model', 'Branch_model', 'Credit_model'));
		//$this->load->model('location_model');
		$this->load->helper(array('formatting'));
		$this->lang->load('point');
		
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	public function check_branch_point($point)
	{
		//Checking for super admin
		if($this->current_admin['branch'] == 0):
			$branch_id					= $this->input->post('branch_id');
		else:
			$branch_id					= $this->current_admin['branch'];
		endif;
		
		$credit_balance = $this->Point_model->get_branch_point_balance($branch_id);
		if($point > $credit_balance['point_amt']){
			$this->form_validation->set_message('check_branch_point', 'Insufficient of Branch Point');
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	
	public function check_point($value)
	{
		//$customer_id			= $this->input->post('customer_id');
		$card 					= $this->input->post('card');
		$payment				= $this->input->post('payment');
	
		$customer		= $this->Customer_model->get_customer_by_card($card);
	
		if(!empty($customer) && isset($customer)){
			$balance = 0;
			if($payment == 'Credit'){
				$credit_balance = $this->Credit_model->get_credit_amt($customer['id']);
				$balance = $credit_balance['credit_amt'];
			}else{
				$point_balance = $this->Point_model->get_point_amt($customer['id']);
				$balance = $point_balance['point_amt'];
			}
	
			if($value > $balance)
			{
				if($payment == 'Credit'){
					$this->form_validation->set_message('check_point', lang('invalid_credit_balance'));
				}else{
					$this->form_validation->set_message('check_point', lang('invalid_point_balance'));
				}
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}else{
			if($payment == 'Credit'){
				$this->form_validation->set_message('check_point', lang('invalid_credit_balance'));
			}else{
				$this->form_validation->set_message('check_point', lang('invalid_point_balance'));
			}
			return FALSE;
		}		
	}
	
	//this is a callback to make sure that customers are not sharing an email address
	function check_card($str)
	{
		$customer	= $this->Customer_model->get_customer_by_card($str);
		if ($customer)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_card', lang('error_card_in_use'));
			return FALSE;			
		}
	}
	
	function index($sort_by='created',$sort_order='desc', $code=0, $page=0, $rows=15)
	{		
		$data['activemenu'] 		= $this->activemenu;
		//if they submitted an export form do the export
		if($this->input->post('submit') == 'export')
		{
			$this->load->model('Point_model');
			$this->load->helper('download_helper');
			$post	= $this->input->post(null, false);
			$term	= (object)$post;

			$data['points']	= $this->Point_model->get_point($term);		
			
			force_download_content('points.xml', $this->load->view($this->config->item('admin_folder').'/points_xml', $data, true));
			
			//kill the script from here
			die;
		}
		
		$this->load->helper('form');
		$this->load->helper('date');
		$data['message']	= $this->session->flashdata('message');
		$data['page_title']	= lang('points');
		$data['code']		= $code;
		$term				= false;
		
		$post	= $this->input->post(null, false);
		if($post)
		{
			//if the term is in post, save it to the db and give me a reference
			$term			= json_encode($post);			
			$code			= $this->Search_model->record_term($term);
			$data['code']	= $code;
			//reset the term to an object for use
			$term	= (object)$post;
		}
		elseif ($code)
		{
			$term	= $this->Search_model->get_term($code);
			$term	= json_decode($term);
		} 
 		
		
		
 		$data['term']	= $term;
 		$data['points']	= $this->Point_model->get_points($term, $sort_by, $sort_order, $rows, $page);
		$data['total']	= $this->Point_model->get_points_count($term);
		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/point/index/'.$sort_by.'/'.$sort_order.'/'.$code.'/');
		$config['total_rows']		= $data['total'];
		$config['per_page']			= $rows;
		$config['uri_segment']		= 7;
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '';
		$config['first_tag_close']	= '';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '';
		$config['last_tag_close']	= '';

		$config['full_tag_open']	= '<div class="btn-group">';
		$config['full_tag_close']	= '</div>';
		$config['cur_tag_open']		= '<a class="btn btn-white active" href="#">';
		$config['cur_tag_close']	= '</a>';
		
		$config['num_tag_open']		= '';
		$config['num_tag_close']	= '';
		
		$config['prev_link']		= '&laquo;';
		$config['prev_tag_open']	= '';
		$config['prev_tag_close']	= '';

		$config['next_link']		= '&raquo;';
		$config['next_tag_open']	= '';
		$config['next_tag_close']	= '';
		
		$this->pagination->initialize($config);
	
		$data['sort_by']	= $sort_by;
		$data['sort_order']	= $sort_order;
				
		$this->view($this->config->item('admin_folder').'/points', $data);
	}
	
	function export()
	{
		$this->load->model('customer_model');
		$this->load->helper('download_helper');
		$post	= $this->input->post(null, false);
		$term	= (object)$post;
		
		$data['points']	= $this->Point_model->get_point($term);		

		foreach($data['points'] as &$o)
		{
			$o->items	= $this->Point_model->get_items($o->id);
		}

		force_download_content('points.xml', $this->load->view($this->config->item('admin_folder').'/points_xml', $data, true));
		
	}
	
	function edit_status()
    {
    	$this->auth->is_logged_in();
    	$order['id']		= $this->input->post('id');
    	$order['status']	= $this->input->post('status');
    	
    	$this->Point_model->save_order($order);
    	
    	echo url_title($order['status']);
    }    
	
	function bulk_delete()
    {
    	$points	= $this->input->post('order');
    	
		if($points)
		{
			foreach($points as $order)
	   		{
	   			$this->Point_model->delete($order);
	   		}
			$this->session->set_flashdata('message', lang('message_points_deleted'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_no_points_selected'));
		}
   		//redirect as to change the url
		redirect($this->config->item('admin_folder').'/points');	
    }
    
    function add_point_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('add_point_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';   
    	$data['remark']				= '';    	
    	$data['active']				= false;
    	$data['branch_id']			= false;
    	$data['trx_no']				= '';
    	
    	$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
    	$branch_list = array();
    	foreach($branches as $branch)
    	{
    		$branch_list[$branch['id']] = $branch['name'];
    	}
    	$data['branches'] = $branch_list;
    	
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/point');
    		}
    			
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['email_subscribe']	= $customer->email_subscribe;
    			
    	}
    	
    	//Checking for super admin
    	if($this->current_admin['branch'] == 0):
    		$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
    	endif;
    	
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	
    	//$this->form_validation->set_rules('topup_date', 'lang:topup_date', 'trim|required');    	
    	$this->form_validation->set_rules('point_amount', 'lang:point_amount', 'trim|required|numeric|callback_check_branch_point');
    	$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'trim|required');
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');    	
    	$this->form_validation->set_rules('active', 'lang:active');
    	    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/add_point_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer		= $this->Customer_model->get_customer_by_card($card);
    		
    		$save['id']					= $id;
    		$save['customer_id']		= $customer['id'];
    		$save['trx_no']				= $this->input->post('trx_no');
    		$save['point']				= $this->input->post('point_amount');
    		$save['remark']				= $this->input->post('remark');
    		$save['created']			= date('Y-m-d H:i:s');
    		$save['staff_id']			= $this->current_admin['id'];
    		
    		//Checking for super admin
    		if($this->current_admin['branch'] == 0):
    			$save['branch_id']					= $this->input->post('branch_id');
    		else:
    			$save['branch_id']					= $this->current_admin['branch'];
    		endif;
    		
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');
    			
    		$last_id = $this->Point_model->save_point($save);
    		
    		//deduct branch point for particular branch point
    		$branch_save['id'] = '';
    		$branch_save['customer_id'] = $customer['id'];
    		$branch_save['depoint']   = $this->input->post('point_amount');
    		$branch_save['created'] = date("Y-m-d H:i:s");
    		$branch_save['staff_id'] = $this->current_admin['id'];
    		$branch_save['branch_id'] = $save['branch_id'];
    		$branch_save['remark'] = $this->input->post('remark');
    		$branch_save['trx_no'] = $this->input->post('trx_no');
    		
    		$this->Point_model->save_branch_point($branch_save);
    		
    			
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    			
    		//go back to the point
    		redirect($this->config->item('admin_folder').'/point/point_info/'.$last_id);
    	}
    }
    
    function point_info($id = false)
    {    	
    	$data['page_title']		= lang('point_info');
    	 
    	if($id){
    		$data['point'] = $this->Point_model->get_point($id);    		
    		$this->view($this->config->item('admin_folder').'/point_info', $data);
    	}else{
    		//go back to the credit
    		redirect($this->config->item('admin_folder').'/point/');
    	}
    }
    
    function consume_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('consume_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';
    	$data['remark']				= '';
    	$data['options']			= '';
    	$data['active']				= false;
    	 
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/point');
    		}
    		 
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['options']			= '';
    		$data['email_subscribe']	= $customer->email_subscribe;
    		 
    	}
    	 
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('consume_date', 'lang:consume_date', 'trim|required');
    	$this->form_validation->set_rules('consume_amount', 'lang:consume_amount', 'trim|required|numeric');
    	
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');
    	$this->form_validation->set_rules('payment', 'lang:payment', 'required');
    
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/consume_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer		= $this->Customer_model->get_customer_by_card($card);
    		$payment				= $this->input->post('payment');
    		
    		
    		if($payment == 'point')
    		{    			    			
    			$save['id']					= $id;
    			$save['customer_id']		= $customer['id'];
    			$save['out']				= $this->input->post('consume_amount');
    			$save['remark']				= $this->input->post('remark');
    			
    			// unlogic sales man logic:everything put today
    			$save['created']			= date('Y-m-d H:i:s');    			    			
    			//$save['created']			= format_ymd_malaysia($this->input->post('consume_date'));
    			$save['staff_id']			= $this->current_admin['id'];
    			//$save['branch'] = $staff_branch;    			
    			$id = $this->Point_model->save_point($save);
    		}
    		else{
    			$save['id'] = '';
    			$save['customer_id'] =  $customer['id'];
    			$save['depoint'] 	= $this->input->post('consume_amount');
    			$save['created']			= date('Y-m-d H:i:s');
    			$save['staff_id'] = $this->current_admin['id'];
    			//$save['branch'] = $staff_branch;
    			//$save['status'] = 1; //enable
    			$save['remark'] =  $this->input->post('remark');
    		
    			$id = $this->Point_model->save_point($save);
    		}
    		
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');    		 
    		 
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    		 
    		//go back to the point
    		redirect($this->config->item('admin_folder').'/point');
    	}
    }
    
    function deduct_point_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('deduct_point_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['trx_no']				= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['point']				= '';
    	$data['depoint']			= '';
    	$data['remark']				= '';
    	$data['options']			= '';
    	$data['active']				= false;
    	$data['branch_id']			= false;
    	 
    	$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
    	$branch_list = array();
    	foreach($branches as $branch)
    	{
    		$branch_list[$branch['id']] = $branch['name'];
    	}
    	$data['branches'] = $branch_list;
    		
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/point');
    		}
    		 
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['trx_no']				= $customer->trx_no;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['options']			= '';
    		$data['email_subscribe']	= $customer->email_subscribe;
    		 
    	}
    
    	//Checking for super admin
    	if($this->current_admin['branch'] == 0):
    	$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
    	endif;
    	 
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'trim|required');
    	//$this->form_validation->set_rules('consume_date', 'lang:consume_date', 'trim|required');
    	$this->form_validation->set_rules('point_amount', 'lang:point_amount', 'trim|required|numeric|callback_check_point');
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');
    	 
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/deduct_point_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer				= $this->Customer_model->get_customer_by_card($card);
    		$trx_no					= $this->input->post('trx_no');
    		$point_amount			= $this->input->post('point_amount');
    		$remark					= $this->input->post('remark');
    		$last_id = '';
    
    		$save['id']					= $id;
    		$save['customer_id']		= $customer['id'];
    		$save['trx_no']				= $trx_no;
    		$save['depoint']			= $point_amount;
    		$save['remark']				= $remark;
    		$save['created']			= date('Y-m-d H:i:s');
    		$save['staff_id']			= $this->current_admin['id'];
    		//Checking for super admin
    		if($this->current_admin['branch'] == 0):
    			$save['branch_id']					= $this->input->post('branch_id');
    		else:
    			$save['branch_id']					= $this->current_admin['branch'];
    		endif;
    
    		//$save['branch'] = $staff_branch;
    		$last_id = $this->Point_model->save_point($save);
        		
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    		 
    		//go back to the point
    		//redirect($this->config->item('admin_folder').'/credit');
    		redirect($this->config->item('admin_folder').'/credit/consume_info/'.$last_id.'/Point');
    	}
    }
    
    function branch_point($sort_by='created',$sort_order='desc', $code=0, $page=0, $rows=15)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//if they submitted an export form do the export
    	if($this->input->post('submit') == 'export')
    	{
    		$this->load->model('Point_model');
    		$this->load->helper('download_helper');
    		$post	= $this->input->post(null, false);
    		$term	= (object)$post;
    
    		$data['points']	= $this->Point_model->get_branch_point($term);
    			
    		force_download_content('points.xml', $this->load->view($this->config->item('admin_folder').'/points_xml', $data, true));
    			
    		//kill the script from here
    		die;
    	}
    
    	$this->load->helper('form');
    	$this->load->helper('date');
    	$data['message']	= $this->session->flashdata('message');
    	$data['page_title']	= lang('points');
    	$data['code']		= $code;
    	$term				= false;
    
    	$post	= $this->input->post(null, false);
    	if($post)
    	{
    		//if the term is in post, save it to the db and give me a reference
    		$term			= json_encode($post);
    		$code			= $this->Search_model->record_term($term);
    		$data['code']	= $code;
    		//reset the term to an object for use
    		$term	= (object)$post;
    	}
    	elseif ($code)
    	{
    		$term	= $this->Search_model->get_term($code);
    		$term	= json_decode($term);
    	}
    		
    
    
    	$data['term']	= $term;
    	$data['points']	= $this->Point_model->get_branch_points($term, $sort_by, $sort_order, $rows, $page);
    	$data['total']	= $this->Point_model->get_branch_points_count($term);
    
    	$this->load->library('pagination');
    
    	$config['base_url']			= site_url($this->config->item('admin_folder').'/point/branch_point/'.$sort_by.'/'.$sort_order.'/'.$code.'/');
    	$config['total_rows']		= $data['total'];
    	$config['per_page']			= $rows;
    	$config['uri_segment']		= 7;
    	$config['first_link']		= 'First';
    	$config['first_tag_open']	= '';
    	$config['first_tag_close']	= '';
    	$config['last_link']		= 'Last';
    	$config['last_tag_open']	= '';
    	$config['last_tag_close']	= '';
    
    	$config['full_tag_open']	= '<div class="btn-group">';
    	$config['full_tag_close']	= '</div>';
    	$config['cur_tag_open']		= '<a class="btn btn-white active" href="#">';
    	$config['cur_tag_close']	= '</a>';
    
    	$config['num_tag_open']		= '';
    	$config['num_tag_close']	= '';
    
    	$config['prev_link']		= '&laquo;';
    	$config['prev_tag_open']	= '';
    	$config['prev_tag_close']	= '';
    
    	$config['next_link']		= '&raquo;';
    	$config['next_tag_open']	= '';
    	$config['next_tag_close']	= '';
    
    	$this->pagination->initialize($config);
    
    	$data['sort_by']	= $sort_by;
    	$data['sort_order']	= $sort_order;
    
    	$this->view($this->config->item('admin_folder').'/branch_points', $data);
    }
    
    function branch_point_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('branch_point_form');
    	    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['branch_id']			= false;    	
    	$data['trx_no']				= '';
    	$data['cost']				= '';    	
    	$data['created']			= '';
    	
    	$data['point_amount']		= '';
    	$data['remark']				= '';
    	$data['created']				= '';
    	
    	$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
    	$branch_list = array();
    	foreach($branches as $branch)
    	{
    		$branch_list[$branch['id']] = $branch['name'];
    	}
    	$data['branches'] = $branch_list;
    	 
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/point');
    		}
    		 
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['email_subscribe']	= $customer->email_subscribe;
    		 
    	}
    	 
    	//Checking for super admin
    	if($this->current_admin['branch'] == 0):
    	$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
    	endif;
    	     	 
    	//$this->form_validation->set_rules('topup_date', 'lang:topup_date', 'trim|required');
    	$this->form_validation->set_rules('cost', 'lang:cost', 'trim|required|numeric');
    	$this->form_validation->set_rules('point_amount', 'lang:point_amount', 'trim|required|numeric');
    	$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'trim|required');
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');
    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/branch_point_form', $data);
    	}
    	else
    	{    		
    		$save['id']					= $id;    		
    		$save['trx_no']				= $this->input->post('trx_no');
    		$save['cost']				= $this->input->post('cost');
    		$save['point']				= $this->input->post('point_amount');
    		$save['remark']				= $this->input->post('remark');
    		$save['created']			= date('Y-m-d H:i:s');
    		$save['staff_id']			= $this->current_admin['id'];
    
    		//Checking for super admin
    		if($this->current_admin['branch'] == 0):
    		$save['branch_id']					= $this->input->post('branch_id');
    		else:
    		$save['branch_id']					= $this->current_admin['branch'];
    		endif;
    
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');    		 
    		$last_id = $this->Point_model->save_branch_point($save);    		 
    		$this->session->set_flashdata('message', lang('message_saved_point'));
    		 
    		//go back to the point
    		redirect($this->config->item('admin_folder').'/point/branch_point_info/'.$last_id);
    	}
    }
    
    function branch_point_info($id = false)
    {
    	$data['page_title']		= lang('point_info');
    
    	if($id){
    		$data['point'] = $this->Point_model->get_branch_point($id);
    		$this->view($this->config->item('admin_folder').'/branch_point_info', $data);
    	}else{
    		//go back to the credit
    		redirect($this->config->item('admin_folder').'/branch_point/');
    	}
    }
    
    
    
}