<?php

class Company extends Admin_Controller {

	//this is used when editing or adding a customer
	var $company_id	= false;	
	protected $activemenu 	= 'company';

	function __construct()
	{		
		parent::__construct();

		$this->load->model(array('Company_model', 'Location_model'));
		$this->load->helper('formatting_helper');
		$this->lang->load('company');
	}
	
	function index()
	{				
		$data['companies'] = $this->Company_model->get_company_list();
		$data['activemenu'] 		= $this->activemenu;
		$data['page_title']	= lang('company');
		
		$this->view($this->config->item('admin_folder').'/company_listing', $data);
	}
	

	function delete($id = false)
	{
		if ($id)
		{	
			$company	= $this->Company_model->get_customer($id);
			//if the customer does not exist, redirect them to the customer list with an error
			if (!$company)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/company');
			}
			else
			{
				//if the customer is legit, delete them
				$delete	= $this->Company_model->delete($id);
				
				$this->session->set_flashdata('message', lang('message_customer_deleted'));
				redirect($this->config->item('admin_folder').'/company');
			}
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/company');
		}
	}
			
	function company_form($id = false)
	{		
		$data['activemenu'] 		= $this->activemenu;
		$data['id']				= $id;
		$data['user_id']		= '';
		$data['email']			= '';
		$data['company_name']	= '';
		$data['fax']			= '';
		$data['phone']			= '';
		$data['address']		= '';
		$data['gps']		= '';
		$data['company_details']= '';
		$data['website']	= '';
		$data['logo']		= '';
		$data['gst']		= '';
		$data['ssm']		= '';
		$data['active']		= '';		
				
		$data['page_title']		= lang('company_form');
		if($id)
		{
			$company			= $this->Company_model->get_company_by_id($id);			
			//fully escape the address
			form_decode($company);			
			//merge the array
			$data				= array_merge($data, $company);			
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('company_name', 'lang:firstname', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('address', 'lang:address', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('gps', 'lang:gps', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|valid_email|max_length[255]');				
		$this->form_validation->set_rules('fax', 'lang:fax', 'trim');
		$this->form_validation->set_rules('company_details', 'lang:company_details', 'trim');
		$this->form_validation->set_rules('website', 'lang:website', 'trim');
		$this->form_validation->set_rules('logo', 'lang:logo', 'trim');
		$this->form_validation->set_rules('gst', 'lang:gst', 'trim');
		$this->form_validation->set_rules('ssm', 'lang:ssm', 'trim');
		$this->form_validation->set_rules('active', 'lang:active', 'trim');
						
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/company_form', $data);
		}
		else
		{
			
			$a['user_id']			= 0; 
			$a['id']				= (empty($id))?'':$id;
			$a['email']				= $this->input->post('email');
			$a['company_name']		= $this->input->post('company_name');
			$a['fax']				= $this->input->post('fax');
			$a['phone']				= $this->input->post('phone');
			$a['address']			= $this->input->post('address');
			$a['gps']				= $this->input->post('gps');
			$a['company_details']	= $this->input->post('company_details');
			$a['website']			= $this->input->post('website');
			$a['logo']				= $this->input->post('logo');
			$a['gst']				= $this->input->post('gst');
			$a['ssm']				= $this->input->post('ssm');
			$a['active']			= 1;
			
							
			$this->Company_model->save_company($a);
			$this->session->set_flashdata('message', lang('message_saved_company'));
			
			redirect($this->config->item('admin_folder').'/company/');
		}
	}
	
	
	function delete_company($company_id = false)
	{
		if ($company_id)
		{	
				//if the customer is legit, delete them
				$delete	= $this->Company_model->delete_company($company_id);
				$this->session->set_flashdata('message', lang('message_company_deleted'));								
				redirect($this->config->item('admin_folder').'/company');				
			
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_company_not_found'));
			redirect($this->config->item('admin_folder').'/company');
		}
	}
	
}