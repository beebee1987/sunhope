<?php

class Messages extends Admin_Controller {	
	
	protected $activemenu 	= 'messages';
	var $message_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		$this->load->model('Messages_model');
		$this->lang->load('message');
		
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
		$data['activemenu'] 		= $this->activemenu;
		$data['page_title']	= lang('messages');
		$data['messages']	= $this->Messages_model->get_contact_messages();
		$this->view($this->config->item('admin_folder').'/messages', $data);
	}
	
	
	function form($id = false)
	{
		
		//die(print_r($_POST));
		$today_date 	= date("Ymd");
				
		$this->load->helper(array('form', 'date', 'url'));
		$folderName = 'uploads/message/'.$today_date.'/';
		$config['upload_path']		= $folderName;
				
		if (!is_dir($folderName)) {
			mkdir($folderName, 0777, TRUE);
			//mkdir('./uploads/message/' . $today_date.'/thumbs', 0777, TRUE);
		}
		
		
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);
		
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->message_id	= $id;
		
		$data['page_title']		= lang('message_form');
		
		//default values are empty if the product is new
		$data['id']						= '';
		$data['code']					= '';
		$data['name']					= '';
		$data['start_date']				= '';
		$data['whole_order_message']		= 1;
		$data['max_product_instances'] 	= '';
		$data['end_date']				= '';
		$data['max_uses']				= '';
		$data['reduction_target'] 		= 'price';
		$data['reduction_type']			= '';
		$data['reduction_amount']		= '';
		$data['point_consume']			= '';
		$data['image']					= '';
		$data['desc']					= '';
		$data['branch_id']				= '';
		
		$added = array();
		
		if ($id)
		{	
			$message		= $this->Messages_model->get_contact_message($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$message)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/messages');
			}
			
			//set values to db values
			$data['id']						= $message['id'];
			$data['name']					= $message['name'];
			$data['email']					= $message['email'];
			$data['message']				= $message['message'];
			$data['created_date']			= $message['created_date'];
			
			$added = $this->Messages_model->get_contact_message($id);
		}
		
		 
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/message_form', $data);
		}
		
	}

	
	
	function delete($id = false)
	{
		if ($id)
		{	
			$message	= $this->Messages_model->get_contact_message($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$message)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/messages');
			}
			else
			{
				$this->Messages_model->delete_contact_message($id);
				
				$this->session->set_flashdata('message', lang('message_message_deleted'));
				redirect($this->config->item('admin_folder').'/messages');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/messages');
		}
	}
	
	
	
	
}