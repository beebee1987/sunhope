<?php
class Slider extends Admin_Controller
{

	protected $activemenu 	= 'slider';
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('slider_model');
		
		$lang = $this->session->userdata('lang');
		$this->lang->load('slider', $lang);
		
	}
		
	function index()
	{
		$data['page_title']	=  lang('slider');
		$data['sliders']		= $this->slider_model->get_list();		
		$data['activemenu'] 		= $this->activemenu;
		
		$this->view($this->config->item('admin_folder').'/slider', $data);
	}
	
	/********************************************************************
	edit slider
	********************************************************************/
	function form($id = false)
	{
		$data['activemenu'] 		= $this->activemenu;
		$this->load->helper('url');
		$this->load->helper('form');
		$today_date 	= date("Ymd");
						
		$folderName = 'uploads/slider/'.$today_date.'/';
		$config['upload_path']		= $folderName;
		if (!is_dir($folderName)) {
			mkdir($folderName, 0777, TRUE);
			//mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
		}
		
		//$config['upload_path']		= 'uploads';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['caption']	= '';
		$data['content']	= '';
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['enable_date']		= '';
		$data['disable_date']		= '';
		$data['image']		= '';
		$data['status']		= '';
		
		$data['page_title']	=  lang('slider_form');
		$data['sliders']		= $this->slider_model->get_list();
		
		if($id)
		{
			
			$slider			= $this->slider_model->get_slider($id);
			
			if(!$slider)
			{
				//slider does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/slider');
			}
						
			//set values to db values
			$data['id']				= $slider['id'];			
			$data['title']			= $slider['title'];
			$data['caption']		= $slider['caption'];
			$data['content']		= $slider['content'];
			$data['sequence']		= $slider['sequence'];
			$data['seo_title']		= $slider['seo_title'];
			$data['meta']			= $slider['meta'];
			$data['enable_date']	= $slider['enable_date'];
			$data['disable_date']	= $slider['disable_date'];
			$data['image']			= $slider['image'];
			$data['status']			= $slider['status'];
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('caption', 'lang:caption', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('enable_date', 'lang:enable_date', 'trim');
		$this->form_validation->set_rules('disable_date', 'lang:disable_date', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/slider_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
			
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');						
			
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['status']		= $this->input->post('status');
				
								
			if ($id)
			{
				$save['id']			= $id;
			
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						$file = $folderName.$data['image'];
			
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
					$this->view(config_item('admin_folder').'/slider_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $folderName.$image['file_name'];
			}
			
			
			
			//save the slider
			$slider_id	= $this->slider_model->save_slider($save);
									
			$this->session->set_flashdata('message', lang('message_saved_slider'));
			
			//go back to the slider list
			redirect($this->config->item('admin_folder').'/slider');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['url']		= '';
		$data['new_window']	= false;
		$data['sequence']	= 0;
		$data['parent_id']	= 0;

		
		$data['page_title']	= lang('link_form');
		$data['sliders']		= $this->slider_model->get_list();
		if($id)
		{
			$slider			= $this->slider_model->get_slider($id);

			if(!$slider)
			{
				//slider does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/slider');
			}
			
			
			//set values to db values
			$data['id']			= $slider->id;
			$data['parent_id']	= $slider->parent_id;
			$data['title']		= $slider->title;
			$data['url']		= $slider->url;
			$data['new_window']	= (bool)$slider->new_window;
			$data['sequence']	= $slider->sequence;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['parent_id']	= $this->input->post('parent_id');
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['sequence']	= $this->input->post('sequence');
			$save['new_window']	= $this->input->post('new_window');
			
			//save the slider
			$this->slider_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the slider list
			redirect($this->config->item('admin_folder').'/slider');
		}
	}
	
	/********************************************************************
	delete slider
	********************************************************************/
	function delete($id)
	{
		
		$slider	= $this->slider_model->get_slider($id);
		
		if($slider)
		{
			$this->slider_model->delete_slider($id);
			$this->session->set_flashdata('message', lang('message_deleted_slider'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/slider');
	}
}	