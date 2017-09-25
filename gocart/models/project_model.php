<?php
/*

 - DB STRUCTURE
projects
	id  (int)
	name (varchar)
	code (varchar)
	description (text)
	start_date (date)
	end_date (date)
	max_uses (int)
	num_uses (int)
	reduction_type (varchar) (percent or fixed)
	reduction_amount (float)
	

projects_products
	project_id (int)
	product_id (int) (zero applies to all products?)
	sequence (int) ( for project product listings )

*/

class Project_model extends CI_Model 
{
    
        function save($project)
	{
		if(!$project['id']) 
		{
			return $this->add_project($project);
		} 
		else 
		{
			$this->update_project($project['id'], $project);
			return $project['id'];
		}
	}

	// add project, returns id
	function add_project($data) 
	{
		$this->db->insert('projects_products', $data);
		return $this->db->insert_id();
	}
	
	// update project
	function update_project($id, $data)
	{
		$this->db->where('id', $id)->update('projects_products', $data);
	}

	function savecategory($project)
	{
		if(!$project['id']) 
		{
			return $this->add_projectcategory($project);
		} 
		else 
		{
			$this->update_projectcategory($project['id'], $project);
			return $project['id'];
		}
	}

	// add project, returns id
	function add_projectcategory($data) 
	{
		$this->db->insert('project_category', $data);
		return $this->db->insert_id();
	}
	
	// update project
	function update_projectcategory($id, $data)
	{
		$this->db->where('id', $id)->update('project_category', $data);
	}
	
	// delete project
	function delete_project($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('projects_products');
	
		// delete children
		$this->remove_product($id);
	}
	
	// checks project dates and usage numbers
	function is_valid($project)
	{
		//$project = $this->get_project($id);

		//die(var_dump($project));
				
		if($project['max_uses']!=0 && $project['num_uses'] >= $project['max_uses'] ) return false;
		
		if($project['start_date'] != "0000-00-00")
		{
			$start = strtotime($project['start_date']);
		
			$current = time();
		
			if($current < $start)
			{
				return false;
			}
		}
		
		if($project['end_date'] != "0000-00-00")
		{
			$end = strtotime($project['end_date']) + 86400; // add a day for the availability to be inclusive
		
			$current = time();
		
			if($current > $end)
			{
				return false;
			}
		}
		
		return true;
	}
	
	// increment project uses
	function touch_project($code)
	{
		$this->db->where('code', $code)->set('num_uses','num_uses+1', false)->update('projects');
	}
	
	// get projects list, sorted by start_date (default), end_date
	function get_projects($sort=NULL, $current_admin=NULL, $is_form = false) 
	{
		return $this->db->get('projects_products')->result();
	}
	
	// get project details, by id
	function get_project($id)
	{
		return $this->db->where('id', $id)->get('projects_products')->row();
	}
        
        // get projects list, sorted by start_date (default), end_date
	function get_projectcategorys($sort=NULL, $current_admin=NULL, $is_form = false) 
	{
		return $this->db->get('project_category')->result();
	}
        
        function get_projectcategorys_list($sort=NULL, $current_admin=NULL, $is_form = false)
        {    	

            $branch = $this->db->get('project_category')->result_array();
            // unserialize the field data       

            return $branch;
        }   
	
	// get project details, by id
	function get_projectcategory($id)
	{
		return $this->db->where('id', $id)->get('project_category')->row();
	}
        
        function delete_category($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('project_category');
	
		// delete children
		$this->remove_product($id);
	}
        
        function get_project_by_url($url)
	{
		return $this->db->where('url', $url)->get('projects_products')->row();
	}
	
	// get project details, by code
	function get_project_by_code($code)
	{
		$this->db->where('code', $code);
		$return = $this->db->get('projects')->row_array();
		
		if(!$return)
		{
			return false;
		}
		$return['product_list'] = $this->get_product_ids($return['id']);
		return $return;
	}
	
	// get the next sequence number for a project products list 
	function get_next_sequence($project_id)
	{
		$this->db->select_max('sequence');
		$this->db->where('project_id',$project_id);
		$res = $this->db->get('projects_products')->row();
		return $res->sequence + 1;
	}
	
	function check_code($str, $id=false)
	{
		$this->db->select('code');
		$this->db->where('code', $str);
		if ($id)
		{
			$this->db->where('id !=', $id);
		}
		$count = $this->db->count_all_results('projects');
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function check_project($code=false)
	{
		$this->db->where('code', $code);
		$count = $this->db->count_all_results('projects');
	
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// add product to project
	function add_product($project_id, $prod_id, $seq=NULL)
	{
		// get the next seq
		if(is_null($seq))
		{
			$seq = $this->get_next_sequence($project_id);
		}
			
			
		$this->db->insert('projects_products', array('project_id'=>$project_id, 'product_id'=>$prod_id, 'sequence'=>$seq));	
	}
	
	// remove product from project. Product id as null for removing all products
	function remove_product($project_id, $prod_id=NULL)
	{
		$where = array('id'=>$project_id);
		
		if(!is_null($prod_id))
		{
			$where['id'] = $prod_id;
		}
			
		$this->db->where($where);
		$this->db->delete('projects_products');
	}
	
	// get list of products in project with full info
	function get_products($project_id) 
	{
		$this->db->join("products", "product_id=products.id");
		$this->db->where('project_id', $project_id);
		return $this->db->get('projects_products')->result();
	}
	
	// Get list of product id's only - utility function
	function get_product_ids($project_id)
	{
		$this->db->select('product_id');
		$this->db->where('project_id', $project_id);
		$res = $this->db->get('projects_products')->result_array();

		$list = array();
		foreach($res as $item)
		{
			array_push($list, $item["product_id"]);	
		}
		return $list;
	}
	
	// set sequence number of product in project, for re-sorting
	function set_product_sequence($project_id, $prod_id, $seq)
	{
		$this->db->where(array('project_id'=>$project_id, 'product_id'=>$prod_id));
		$this->db->update('projects_products', array('sequence'=>$seq));
	}
	
	// Get list of product id's only - utility function
	function check_project_customer($project_id, $customer_id)
	{		
		$this->db->select('project_id');
		$this->db->where('project_id', $project_id);
		$this->db->where('customer_id', $customer_id);
		
		$count = $this->db->count_all_results('customer_project');
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	// add project, returns id
	function add_project_customer($data)
	{
		$this->db->insert('customer_project', $data);
		//return $this->db->insert_id(); // this is only for auto increment
		return $this->db->affected_rows();		
	}
	
	// add coupon, returns id
	function add_customer_project_log($data)
	{
		$this->db->insert('customer_project_log', $data);
		//return $this->db->insert_id(); // this is only for auto increment
		return $this->db->affected_rows();
	}
	
	// update project
	function update_project_customer($data)
	{
		$this->db->where('project_id', $data['project_id']);
		$this->db->where('customer_id', $data['customer_id']);		
		$this->db->update('customer_project', $data);
		return $this->db->affected_rows();
	}
	
	function my_project($customer_id)
	{
		$this->db->join("projects", "projects.id=customer_project.project_id");
		//$this->db->join("customers", "customers.id=customer_project.customer_id");
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('customer_project')->result();
	}
	
	function my_project_details($project_id, $customer_id)
	{
		$this->db->select('*, customer_project.active as use_status ');
		$this->db->join("projects", "projects.id=customer_project.project_id");
		//$this->db->join("customers", "customers.id=customer_project.customer_id");		
		$this->db->where('customer_id', $customer_id);		
		$this->db->where('project_id', $project_id);		
		return $this->db->get('customer_project')->row_array();
	}
	
	function project_listing($project_id, $customer_id, $current_admin = false)
	{
		$this->db->select('*, customers.name as customer_name, projects.name as project_name ');
		$this->db->join("projects", "projects.id=customer_project.project_id");
		$this->db->join("customers", "customers.id=customer_project.customer_id");
		if(!empty($customer_id)){
			$this->db->where('customer_id', $customer_id);
		}
		if(!empty($project_id)){
			$this->db->where('project_id', $project_id);
		}
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):				
				$this->db->where('projects.branch_id', $current_admin['branch']);
			endif;
		endif;
		
		return $this->db->get('customer_project')->result();
	}
	
}	
