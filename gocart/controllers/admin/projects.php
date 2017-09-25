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
//            }
            $data['selectcategory']					= '';
            $count  = 0 ; 
		$data['page_title']	= lang('project_form');
                $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
                 $categorys = $this->Project_model->get_projectcategorys_list(NULL, $this->current_admin);
                 foreach($categorys as $category)
		{
			$category_list[$category['name']] = $category['name'];
		}
		$data['categorys'] = $category_list;	
                
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
                $data['url']					= '';
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
			$data['url']					= $project->url;
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
			
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
//		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
		$this->form_validation->set_rules('description', 'lang:description', 'trim');
		$this->form_validation->set_rules('category', 'lang:category', 'trim');
                $this->form_validation->set_rules('seq_no', 'lang:seq_no', 'trim|numeric');
                $this->form_validation->set_rules('status', 'lang:status', 'trim');
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/project_form', $data);
		}
		else
		{
                    $this->load->helper('text');
                    
                    $save['id']					= $id;
                    $save['name']				= $this->input->post('name');
                    $save['description']			= $this->input->post('description');
                    $save['url']				= $this->input->post('url');
                    $save['category']				= $this->input->post('category');
                    $save['seq_no']				= $this->input->post('seq_no');
                    $save['status']				= $this->input->post('status');
                        
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
//	
//	//this is a callback to make sure that 2 projects don't have the same code
//	function check_project($str)
//	{
//		$project = $this->Project_model->get_project_by_code($str);
//		if ($project)
//		{
//			
//			$is_valid = $this->Project_model->is_valid($project);
//			
//			if($is_valid){
//				return TRUE;
//			}else{
//				$this->form_validation->set_message('check_project', lang('error_project'));
//				return FALSE;
//			}									
//		}
//		else
//		{
//			$this->form_validation->set_message('check_project', lang('error_not_found'));
//			return FALSE;
//		}
//	}
//	
//	function check_card($str)
//	{
//		$card = $this->Customer_model->check_card($str);
//		if ($card)
//		{			
//			return TRUE;			
//		}
//		else
//		{
//			$this->form_validation->set_message('check_card', lang('error_card_not_found'));
//			return FALSE;
//		}
//	}
//	
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
//	
//	function process_project()
//	{
//		$data['page_title']		= lang('process_project');
//		$today_date 	= date("Ymd");
//		//die(print_r($_POST));
//	
//		$this->load->helper(array('form', 'date'));
//		$this->load->library('form_validation');
//		$this->load->helper('url');
//		$this->load->helper('form');
//		
//		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
//			
//		//default values are empty if the product is new
//		$data['id']						= '';
//		$data['project_id']				= '';
//		$data['card']					= '';	
//
//		
//		$projects	= $this->Project_model->get_projects(NULL, $this->current_admin, TRUE);
//		$project_list = array();
//		foreach($projects as $project)
//		{
//			$project_list[$project->id] = $project->name;
//		}
//		$data['projects'] = $project_list;
//		
//	
//		$added = array();
//	
//		$this->form_validation->set_rules('project_id', 'lang:products');
//		$this->form_validation->set_rules('card', 'lang:card', 'trim|required|callback_check_card');
//						
//		if ($this->form_validation->run() == FALSE)
//		{
//			$this->view($this->config->item('admin_folder').'/project_proceed', $data);
//		}
//		else
//		{					
//			$project_id					= $this->input->post('project_id');
//			$card					= $this->input->post('card');
//			
//			// We're done
//			//$this->session->set_flashdata('message', lang('message_customer_project'));				
//			//go back to the product list
//			redirect($this->config->item('admin_folder').'/projects/process_project_details/'.$project_id.'/'.$card);
//		}
//	}
//	
//	function process_project_details($project_id = '', $member_card = '')
//	{
//		$data['page_title']		= lang('process_project');
//		$this->load->helper(array('form', 'date', 'url'));
//		$this->load->library('form_validation');
//		
//		
//		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//									
//			$this->form_validation->set_rules( 'used', lang('use_qty'), 'trim|required|numeric|callback_check_qty_used' );
//								
//			if ($this->form_validation->run() == FALSE)
//			{				
//				$project_id = $this->input->post('project_id');
//				$member_card = $this->input->post('customer_card');				
//			}
//			else 
//			{
//				$save['active']  = $this->input->post('active');
//				$used  			= $this->input->post('used');
//				$save['project_id'] = $this->input->post('project_id');
//				$save['customer_id'] = $this->input->post('customer_id');
//					
//				$is_exist = $this->Project_model->check_project_customer($save['project_id'], $save['customer_id']);
//				
//				if($is_exist){
//					$details = $this->Project_model->my_project_details($save['project_id'], $save['customer_id']);									
//					$save['used'] = $details['used'] + $used;				
//					$id = $this->Project_model->update_project_customer($save);				
//				}else{
//					// impossible happen here
//					$save['used'] = $used;
//					$this->Project_model->add_project_customer($save);
//				}
//				
//				//customer project log , can know all the using project log
//				$log['project_id'] = $save['project_id'];
//				$log['customer_id'] = $save['customer_id'];
//				$log['used'] = $used;
//				$log['trx_date'] = date('Y-m-d H:i:s');
//				$log['staff_id'] = $this->current_admin['id'];
//					
//				$this->Project_model->add_customer_project_log($log);
//
//				if($id > 0){
//					// We're done
//					$this->session->set_flashdata('message', lang('message_saved_project'));
//					//go back to the process project form
//					redirect($this->config->item('admin_folder').'/projects/process_project/');
//				}else{
//					$this->session->set_flashdata('error', lang('error_saved_project'));
//					//go back to the process project form with error message
//					redirect($this->config->item('admin_folder').'/projects/process_project/');
//				}
//			}
//			
//		}
//		
//		if($project_id == '' || $member_card == ''){
//			$this->session->set_flashdata('message', lang('error_not_found'));
//			redirect($this->config->item('admin_folder').'/projects/process_project');
//		}else{			
//			
//			$project = $this->Project_model->get_project($project_id);
//			$customer = $this->Customer_model->get_customer_by_card($member_card);
//			
//			$data['project_id'] = $project->id;
//			$data['customer_id'] = $customer['id'];
//			$data['customer'] = $customer;
//			
//						
//			$data['details'] = $this->Project_model->my_project_details($project->id, $customer['id']);
//						
//			$this->view(config_item('admin_folder').'/project_proceed_details', $data);						
//		}
//	}
        
        public function do_upload() { 
//            redirect('admin_folder').'/projects';
//            redirect($this->config->item('admin_folder').'/projects/form_success');
//            echo '<script>console.log("Your stuff here")</script>';
         $config['upload_path']   = 'uploads/project/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;  
         $this->load->library('upload', $config);
			
//         if ( ! $this->upload->do_upload('userfile')) {
//             echo 'lalalalala1';
//            $data =  array('error' => $this->upload->display_errors()); 
////            redirect($this->config->item('admin_folder').'/projects/form/success');
//            $this->view(config_item('admin_folder').'/project_form', $data);
////            redirect('admin_folder').'/projects/form';
//         }
//			
//         else { 
//             echo 'lalalalala2';
//            $data = array('upload_data' => $this->upload->data()); 
////            redirect($this->config->item('admin_folder').'/projects/form/success');
//            $this->view(config_item('admin_folder').'/project_form_success', $data);
////            redirect('admin_folder').'/projects/form_success'; 
//         } 
         
         if(!empty($_FILES)){
             $this->upload->do_upload($_FILES['file']['name']);
         }
         
         foreach ($_FILES as $userfile => $fileObject)  //fieldname is the form field name
        {
             echo "{$userfile} =>  ";
             print_r( $fileObject);
//             echo $userfile;
//             print_r( $fileObject);
            if (!empty($fileObject['name']))
            {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($userfile['userfile']['name']))
                {
                    $errors = $this->upload->display_errors();
                    flashMsg($errors);
                }
                else
                {
                    echo 'lalalalala2';
                     // Code After Files Upload Success GOES HERE
                }
            }
        }
      } 
	
	public function uploadImage($value = null)
        {
//            $projects	= $this->input->post('voucher');
//		
//		if(!$projects)
//		{
//			$this->session->set_flashdata('error',  lang('error_bulk_no_products'));
//			redirect($this->config->item('admin_folder').'/projects');
//		}
//		
//            $selectcategory = $this->input->post('selectcategory');
//            if(!$selectcategory)
//            {
//                    $this->session->set_flashdata('message',  lang('message_project_uploaded'));
//                    redirect($this->config->item('admin_folder').'/projects');
//            }
            
//            $sscategory  = $_FILES['file']['sscategory'];
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
        
        public function getData()
        {
            $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
//            redirect($this->config->item('admin_folder').'projects/form');
//            $this->form(false);
//            return $this->Project_model->get_projects(NULL, $this->current_admin);
//            header('Content-type: application/json');
//            echo json_encode($data);
        }
        
        public function changeCategory()
        {
//            $data['category']	= ;
    $data['category']=$this->input->post('id'); //

    // and send it to model

//    $data['product'] = $this->order_model->get_all_product_info($select_design);
        }
        
        public function do_resize($source_path,$target_path)
        {
//            $filename = $this->input->post('new_val');
//            $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/avatar/tmp/' . $filename;
//            $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/avatar/';
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 373,
                'height' => 280
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            // clear //
            $this->image_lib->clear();
        }
	
        function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
    }
	
}

?>