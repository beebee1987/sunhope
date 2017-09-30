<?php

class Projects extends Admin_Controller {	
	var $project_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		$this->load->model('Project_model');		
		$this->load->model('Voucher_model');
		$this->lang->load('project');
		$this->load->helper('form');
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index($upload_true = true)
	{
//            if($upload_true){
//                $this->session->set_flashdata('message', lang('message_project_deleted'));
//            }$
            $data['category'] = "";
            $category_list = [];
            $data['selectcategory']					= '';
            $count  = 0 ; 
		$data['page_title']	= lang('project_form');
                $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
                 $categorys = $this->Project_model->get_projectcategorys_list(NULL, $this->current_admin);
                 foreach($categorys as $category)
		{
			$category_list[$category['id']] = $category['name'];
		}
		$data['categorys'] = $category_list;	
                
                $categoryss = $this->Project_model->get_projectcategorys(NULL, $this->current_admin);
		$data['categoryss'] = $categoryss;
                
		//filter access and branch out automatically
//		$data['projects']	= $this->Project_model->get_projects(NULL, $this->current_admin);		
		//$data['projects']	= $this->Project_model->get_projects();	
		$this->view($this->config->item('admin_folder').'/projects', $data);
                
	}
        
        function listing($upload_category = '')
	{
//            if($upload_true){
//                $this->session->set_flashdata('message', lang('message_project_deleted'));
//            }
            $data['selectcategory']					= '';
            $count  = 0 ; 
		$data['page_title']	= lang('project_form');
                $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
                 $categorys = $this->Project_model->get_projectcategorys_list(NULL, $this->current_admin);
                 foreach($categorys as $category)
		{
			$category_list[$category['id']] = $category['name'];
		}
		$data['categorys'] = $category_list;	
                $data['category'] = '';	
                if($upload_category){
                    $data['category'] = $upload_category;
                }
                
                $categoryss = $this->Project_model->get_projectcategorys(NULL, $this->current_admin);
		$data['categoryss'] = $categoryss;
                
		//filter access and branch out automatically
//		$data['projects']	= $this->Project_model->get_projects(NULL, $this->current_admin);		
		//$data['projects']	= $this->Project_model->get_projects();	
		$this->view($this->config->item('admin_folder').'/projects', $data);
                
	}
        
        function deletesuccess($delete_true = true){
            if($delete_true){
                $this->session->set_flashdata('message', lang('message_project_deleted'));
            }
            redirect($this->config->item('admin_folder').'/projects');
        }
        
        function bulk_save()
	{
		$projects	= $this->input->post('voucher');
		
		if(!$projects)
		{
			$this->session->set_flashdata('error',  lang('error_bulk_no_products'));
			redirect($this->config->item('admin_folder').'/projects');
		}
				
		foreach($projects as $id=>$project)
		{
			$project['id']	= $id;
			$this->Project_model->save($project);
		}
		
		$this->session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->config->item('admin_folder').'/projects');
	}
	
        
	
	function form($id)
	{
            $today_date 	= date("Ymd");
		//die(print_r($_POST));

		$this->load->helper(array('form', 'date', 'url'));
		
                $folderName = 'uploads/project/';
                $folderNameOri = 'uploads/project/original/';
                $folderNameSmaller = 'uploads/project/smaller/';
		$config['upload_path']		= $folderNameOri;	
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
                
		$this->load->library('form_validation');
		
		$categorys = $this->Project_model->get_projectcategorys_list(NULL, $this->current_admin);
//		$category_list = array();
//                $categoryss = json_decode($categorys, true);
		foreach($categorys as $category)
		{
			$category_list[$category['name']] = $category['name'];
		}
		$data['categorys'] = $category_list;		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->voucher_id	= $id;
		
		$data['page_title']		= lang('project_form_edit');
		
		//default values are empty if the product is new
		$data['id']					= '';
		$data['name']					= '';
                $data['description']				= '';
//                $data['url']					= '';
                $data['smaller_url']				= '';
                $data['category']				= '';
                $data['seq_no']					= '';
                $data['status']					= '';
                $data['upload_date']                            = '';
		
		$added = array();
		
		if ($id)
                {
		
			$project		= $this->Project_model->get_project($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$project)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/projects');
			}
			
			//set values to db values
			$data['id']					= $project->id;
			$data['name']					= $project->name;
			$data['description']				= $project->description;
//			$data['url']					= $project->url;
			$data['smaller_url']                            = $project->smaller_url;
			$data['category']				= $project->category;
			$data['seq_no']					= $project->seq_no;
			$data['status']                                 = $project->status;
			$data['upload_date']				= $project->upload_date;
			
//			$added = $this->Voucher_model->get_product_ids($id);
		}
		
		//Checking for super admin
//		if($this->current_admin['branch'] == 0):
//			$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
//		endif;		
			
//		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
//		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
//		$this->form_validation->set_rules('description', 'lang:description', 'trim');
		$this->form_validation->set_rules('category', 'lang:category', 'trim');
                $this->form_validation->set_rules('seq_no', 'lang:seq_no', 'trim|numeric');
                $this->form_validation->set_rules('status', 'lang:status', 'trim');
		$this->form_validation->set_rules('smaller_url', 'lang:image', 'trim');
//		$this->form_validation->set_rules('url', 'lang:image', 'trim');
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/project_form', $data);
		}
		else
		{
                    $this->load->helper('text');
                    $uploaded	= $this->upload->do_upload('smaller_url');
                    $save['id']					= $id;
//                    $save['name']				= $this->input->post('name');
//                    $save['description']			= $this->input->post('description');
//                    $save['url']				= $this->input->post('url');
//                    $save['smaller_url']			= $this->input->post('smaller_url');
                    $save['category']				= $this->input->post('category');
                    $save['seq_no']				= $this->input->post('seq_no');
                    $save['status']				= $this->input->post('status');
                    
                    if ($id)
                    {	
                            //delete the original file if another is uploaded
                            if($uploaded)
                            {
                                    if($data['image'] != '')
                                    {
                                            //$file = 'uploads/'.$data['image'];
                                            //$config['upload_path'] = FCPATH . 'uploads/';						 						

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
                                    $this->view(config_item('admin_folder').'/voucher_form', $data);
                                    return; //end script here if there is an error
                            }
                    }
                    
                    if($uploaded)
                    {
                        $image			= $this->upload->data();
                        $save['url']  = $folderNameOri.$image['file_name'];
                        
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $folderNameOri.$image['file_name'];       
    //                    $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 373;
                        $config['height'] = 280;
                        $config['new_image'] = $folderNameSmaller;               
                        $this->image_lib->initialize($config);
                        if(!$this->image_lib->resize())
                        { 
                            echo $this->image_lib->display_errors();
                        } 
                        $save['smaller_url']  = $folderNameSmaller.$image['file_name'];
                    }
                    
                    
                    
                    $this->Project_model->save($save);

                    // We're done
                    $this->session->set_flashdata('message', lang('message_saved_project'));

                    //go back to the product list
                    redirect($this->config->item('admin_folder').'/projects');
		}
	}

	//this is a callback to make sure that 2 projects don't have the same code
	function check_code($str)
	{
		$code = $this->Project_model->check_code($str, $this->project_id);
        if ($code)
       	{
			$this->form_validation->set_message('check_code', lang('error_already_used'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
        
	function delete($id = false)
	{
		if ($id)
		{	
			$project	= $this->Project_model->get_projects($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$project)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/projects');
			}
			else
			{
				$this->Project_model->delete_project($id);
				
				$this->session->set_flashdata('message', lang('message_project_deleted'));
				redirect($this->config->item('admin_folder').'/projects');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/projects/form');
		}
	}
        
	public function uploadImage($value = null)
        {
            $sscategory  =$this->input->post('sscategory');
            $today_date 	= date("Ymd");
$this->load->helper('text');
            $this->load->helper(array('form', 'date', 'url'));

            $folderName = 'uploads/project/';
            $config['upload_path']		= $folderName;		
            if (!is_dir($folderName)) {
                    mkdir($folderName, 0777, TRUE);
                    //mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
            }
            $orifolderName = 'uploads/project/original';
            if (!is_dir($orifolderName)) {
                    mkdir($orifolderName, 0777, TRUE);
                    //mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
            }
            $smallfolderName = 'uploads/project/smaller';
            if (!is_dir($smallfolderName)) {
                    mkdir($smallfolderName, 0777, TRUE);
                    //mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
            }
             $dbHost = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'codexworld';
             $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
            if($mysqli->connect_errno){
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }
            
            $targetDir = $folderName;
            $fileName = $_FILES['file']['name'];
            $filenamewithoutextension = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $targetFile = $targetDir.'/original/'.$fileName;
            
            if(!file_exists($targetFile)){
                if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
                    $count++;
                    $this->load->model('Project_model');
                    
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $targetFile;       
//                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 373;
                    $config['height'] = 280;
                    $config['new_image'] = $targetDir.'/smaller';               
                    $this->image_lib->initialize($config);
                    if(!$this->image_lib->resize())
                    { 
                        echo $this->image_lib->display_errors();
                    }  
                    $data = array( 
                        'url'           => $targetFile, 
                        'smaller_url'   => $targetDir.'/smaller/'.$fileName, 
                        'name'          => $filenamewithoutextension,
                        'seq_no'        => 0,
                        'category'        => $sscategory,//$this->input->post('category'),
                        'upload_date'   => date("Y-m-d H:i:s"),
                        'status'        => 'ACTIVE'
                     ); 
                     var_dump($data);
                    $img_id = $this->Project_model->save($data); 
                    //$data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
                    //insert file information into db table
    //                $conn->query("INSERT INTO projects_products (url,name, upload_date) VALUES('".$targetFile."','".$fileName."','".date("Y-m-d H:i:s")."')");
                }
            }else{
                if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
                    $project_url_exist = $this->Project_model->get_project_by_url($targetFile);
                    if(!$project_url_exist){
                        $this->load->model('Project_model');
                        
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $targetFile;       
    //                    $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 373;
                        $config['height'] = 280;
                        $config['new_image'] = $targetDir.'/smaller';               
                        $this->image_lib->initialize($config);
                        if(!$this->image_lib->resize())
                        { 
                            echo $this->image_lib->display_errors();
                        }  
                        
                        $data = array( 
                            'url'           => $targetFile, 
                            'smaller_url'   => $targetDir.'/smaller/'.$fileName, 
                            'name'          => $fileName,
                            'seq_no'        => 0,
                            'category'        => $sscategory,//$this->input->post('category'),
                            'upload_date'   => date("Y-m-d H:i:s"),
                            'status'        => 'ACTIVE'
                         ); 
                         var_dump($data);
                        $img_id = $this->Project_model->save($data); 
                    }
                }
            }
            $this->session->set_flashdata('message', lang('message_project_uploaded'));
        }
        
//        public function getData()
//        {
//            $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
////            redirect($this->config->item('admin_folder').'projects/form');
////            $this->form(false);
////            return $this->Project_model->get_projects(NULL, $this->current_admin);
////            header('Content-type: application/json');
////            echo json_encode($data);
//        }
}
?>