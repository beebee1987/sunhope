<?php

class Branch extends Admin_Controller {

	//this is used when editing or adding a customer
	var $branch_id	= false;
	var $current_admin	= false;
	protected $activemenu 	= 'branch';
	

	function __construct()
	{		
		parent::__construct();

		$this->load->model(array('Branch_model', 'Location_model'));
		$this->load->helper('formatting_helper');
		$this->lang->load('branch');
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{				
		$data['branches'] = $this->Branch_model->get_branch_list($this->current_admin);
		$data['activemenu'] 		= $this->activemenu;
		$data['page_title']	= lang('branch');
		
		$this->view($this->config->item('admin_folder').'/branch_listing', $data);
	}
	

			
	function branch_form($id = false)
	{		
		$data['activemenu'] 		= $this->activemenu;
		$data['id']				= $id;		
		$data['name']			= '';
		$data['active']		= '';		
				
		$data['page_title']		= lang('branch_form');
		if($id)
		{
			$branch			= $this->Branch_model->get_branch_by_id($id);			
			//fully escape the address
			form_decode($branch);			
			//merge the array
			$data				= array_merge($data, $branch);	
			
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('address', 'lang:address', 'trim');
		$this->form_validation->set_rules('phone', 'lang:phone', 'trim');
		$this->form_validation->set_rules('active', 'lang:active', 'trim');
						
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/branch_form', $data);
		}
		else
		{
			
			$a['id']				= (empty($id))?'':$id;
			$a['name']				= $this->input->post('name');
			$a['address']			= $this->input->post('address');
			$a['phone']				= $this->input->post('phone');
			$a['active']			= 1;
										
			$this->Branch_model->save_branch($a);
			$this->session->set_flashdata('message', lang('message_saved_branch'));
			
			redirect($this->config->item('admin_folder').'/branch/');
		}
	}
	
	
	function delete_branch($branch_id = false)
	{
		if ($branch_id)
		{	
				//if the customer is legit, delete them
				$delete	= $this->Branch_model->delete_branch($branch_id);
				$this->session->set_flashdata('message', lang('message_branch_deleted'));								
				redirect($this->config->item('admin_folder').'/branch');				
			
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_branch_not_found'));
			redirect($this->config->item('admin_folder').'/branch');
		}
	}
	
}