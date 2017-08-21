<?php

class Clients extends Admin_Controller {

	protected $activemenu 	= 'clients';
	var $client_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		$this->load->model('Client_model');
		$this->lang->load('client');
		
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
		$data['activemenu'] 		= $this->activemenu;
		$data['page_title']	= lang('clients');
		$data['clients']	= $this->Client_model->get_clients();
		
		$this->view($this->config->item('admin_folder').'/clients', $data);
	}
	
	
	
	function form($id = false)
	{
		
		//die(print_r($_POST));
		$today_date 	= date("Ymd");
				
		$this->load->helper(array('form', 'date', 'url'));
		$folderName = 'uploads/client/'.$today_date.'/';
		$config['upload_path']		= $folderName;
				
		if (!is_dir($folderName)) {
			mkdir($folderName, 0777, TRUE);
			//mkdir('./uploads/client/' . $today_date.'/thumbs', 0777, TRUE);
		}
		
		
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);
		
		$this->load->library('form_validation');
				
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->client_id	= $id;
		
		$data['page_title']		= lang('client_form');
		
		//default values are empty if the product is new
		$data['id']						= '';
		$data['name']					= '';
		$data['email']					= '';
		$data['phone']					= '';
		$data['company']				= '';
		$data['default_billing_address']= '';
		$data['logo']					= '';
		
		$added = array();
		
		if ($id)
		{	
			$client		= $this->Client_model->get_client($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$client)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/clients');
			}
			
			//set values to db values
			$data['id']						= $client->id;
			$data['name']					= $client->name;
			$data['email']					= $client->email;
			$data['phone']					= $client->phone;
			//$data['whole_order_client']		= $client->whole_order_client;
			$data['company']				= $client->company;
			$data['default_billing_address']= $client->default_billing_address;
			$data['logo']     				= $client->logo;		
			
		}
		
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('company', 'lang:company', 'trim|required');
		$this->form_validation->set_rules('logo', 'lang:logo', 'trim');
				
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/client_form', $data);
		}
		else
		{
			$this->load->helper('text');
			$uploaded	= $this->upload->do_upload('logo');						
			
			$save['id']						= $id;			
			$save['name']					= $this->input->post('name');
			$save['email']					= $this->input->post('email');
			$save['phone']				= $this->input->post('phone');
			$save['company']				= $this->input->post('company');
			$save['default_billing_address']				= $this->input->post('default_billing_address');

			var_dump($save['default_billing_address']);

			$save['active'] 				= 1;
			
			if ($id)
			{
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['logo'] != '')
					{
						//$file = 'uploads/'.$data['image'];
						//$config['upload_path'] = FCPATH . 'uploads/';
			
						$file = $folderName.$data['logo'];
							
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
					
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/client_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				if (!is_dir($folderName)) {
					mkdir($folderName, 0777, TRUE);
					//mkdir('./uploads/client/' . $today_date.'/thumbs', 0777, TRUE);
				}
			
				$logo			= $this->upload->data();
					
				$save['logo']  = $folderName.$logo['file_name'];
			}
			
			// save client
			var_dump($save);
			$promo_id = $this->Client_model->save($save);
			
			// We're done
			$this->session->set_flashdata('message', lang('message_saved_client'));
			
			//go back to the product list
			redirect($this->config->item('admin_folder').'/clients');
		}
	}

	
	
	function delete($id = false)
	{
		if ($id)
		{	
			$client	= $this->Client_model->get_client($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$client)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/clients');
			}
			else
			{
				$this->Client_model->delete_client($id);
				
				$this->session->set_flashdata('message', lang('message_client_deleted'));
				redirect($this->config->item('admin_folder').'/clients');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/clients');
		}
	}
	
	
	
	
}