<?php
/*

 - DB STRUCTURE
coupons
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
	

coupons_products
	coupon_id (int)
	product_id (int) (zero applies to all products?)
	sequence (int) ( for coupon product listings )

*/

class Coupon_model extends CI_Model 
{

	function save($coupon)
	{
		if(!$coupon['id']) 
		{
			return $this->add_coupon($coupon);
		} 
		else 
		{
			$this->update_coupon($coupon['id'], $coupon);
			return $coupon['id'];
		}
	}

	// add coupon, returns id
	function add_coupon($data) 
	{
		$this->db->insert('coupons', $data);
		return $this->db->insert_id();
	}
	
	// update coupon
	function update_coupon($id, $data)
	{
		$this->db->where('id', $id)->update('coupons', $data);
	}
	
	// delete coupon
	function delete_coupon($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('coupons');
	
		// delete children
		$this->remove_product($id);
	}
	
	// checks coupon dates and usage numbers
	function is_valid($coupon)
	{
		//$coupon = $this->get_coupon($id);

		//die(var_dump($coupon));
				
		if($coupon['max_uses']!=0 && $coupon['num_uses'] >= $coupon['max_uses'] ) return false;
		
		if($coupon['start_date'] != "0000-00-00")
		{
			$start = strtotime($coupon['start_date']);
		
			$current = time();
		
			if($current < $start)
			{
				return false;
			}
		}
		
		if($coupon['end_date'] != "0000-00-00")
		{
			$end = strtotime($coupon['end_date']) + 86400; // add a day for the availability to be inclusive
		
			$current = time();
		
			if($current > $end)
			{
				return false;
			}
		}
		
		return true;
	}
	
	// increment coupon uses
	function touch_coupon($code)
	{
		$this->db->where('code', $code)->set('num_uses','num_uses+1', false)->update('coupons');
	}
	
	// get coupons list, sorted by start_date (default), end_date
	function get_coupons($sort=NULL, $current_admin=NULL, $is_form=FALSE) 
	{
		if($is_form){
			$this->db->where('coupons.active', 1);
		}
				
		$this->db->select(" branch.name as branch_name ,coupons.* ");
		$this->db->join("admin", "staff_id=admin.id");
		$this->db->join("branch", "coupons.branch_id=branch.id");
		// for merchant || branch can view only own data
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
			$this->db->where('coupons.branch_id', $current_admin['branch']);
		endif;
		endif;
		
		if($sort=='end_date')
		{
			$this->db->order_by('end_date');
		}
		else
		{
			$this->db->order_by('start_date');
		}
		return $this->db->get('coupons')->result();
	}
	
	// get coupon details, by id
	function get_coupon($id)
	{
		return $this->db->where('id', $id)->get('coupons')->row();
	}
	
	// get coupon details, by code
	function get_coupon_by_code($code)
	{
		$this->db->where('code', $code);
		$return = $this->db->get('coupons')->row_array();
		
		if(!$return)
		{
			return false;
		}
		$return['product_list'] = $this->get_product_ids($return['id']);
		return $return;
	}
	
	// get the next sequence number for a coupon products list 
	function get_next_sequence($coupon_id)
	{
		$this->db->select_max('sequence');
		$this->db->where('coupon_id',$coupon_id);
		$res = $this->db->get('coupons_products')->row();
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
		$count = $this->db->count_all_results('coupons');
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function check_coupon($code=false)
	{
		$this->db->where('code', $code);
		$count = $this->db->count_all_results('coupons');
	
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// add product to coupon
	function add_product($coupon_id, $prod_id, $seq=NULL)
	{
		// get the next seq
		if(is_null($seq))
		{
			$seq = $this->get_next_sequence($coupon_id);
		}
			
			
		$this->db->insert('coupons_products', array('coupon_id'=>$coupon_id, 'product_id'=>$prod_id, 'sequence'=>$seq));	
	}
	
	// remove product from coupon. Product id as null for removing all products
	function remove_product($coupon_id, $prod_id=NULL)
	{
		$where = array('coupon_id'=>$coupon_id);
		
		if(!is_null($prod_id))
		{
			$where['product_id'] = $prod_id;
		}
			
		$this->db->where($where);
		$this->db->delete('coupons_products');
	}
	
	// get list of products in coupon with full info
	function get_products($coupon_id) 
	{
		$this->db->join("products", "product_id=products.id");
		$this->db->where('coupon_id', $coupon_id);
		return $this->db->get('coupons_products')->result();
	}
	
	// Get list of product id's only - utility function
	function get_product_ids($coupon_id)
	{
		$this->db->select('product_id');
		$this->db->where('coupon_id', $coupon_id);
		$res = $this->db->get('coupons_products')->result_array();

		$list = array();
		foreach($res as $item)
		{
			array_push($list, $item["product_id"]);	
		}
		return $list;
	}
	
	// set sequence number of product in coupon, for re-sorting
	function set_product_sequence($coupon_id, $prod_id, $seq)
	{
		$this->db->where(array('coupon_id'=>$coupon_id, 'product_id'=>$prod_id));
		$this->db->update('coupons_products', array('sequence'=>$seq));
	}
	
	// Get list of product id's only - utility function
	function check_coupon_customer($coupon_id, $customer_id)
	{
		$this->db->select('coupon_id');
		$this->db->where('coupon_id', $coupon_id);
		$this->db->where('customer_id', $customer_id);
	
		$count = $this->db->count_all_results('customer_coupon');
	
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// add coupon, returns id
	function add_coupon_customer($data)
	{
		$this->db->insert('customer_coupon', $data);
		//return $this->db->insert_id(); // this is only for auto increment
		return $this->db->affected_rows();
	}
	
	// add coupon, returns id
	function add_customer_coupon_log($data)
	{
		$this->db->insert('customer_coupon_log', $data);
		//return $this->db->insert_id(); // this is only for auto increment
		return $this->db->affected_rows();
	}
	
	// update coupon
	function update_coupon_customer($data)
	{
		$this->db->where('coupon_id', $data['coupon_id']);
		$this->db->where('customer_id', $data['customer_id']);
		$this->db->update('customer_coupon', $data);
		return $this->db->affected_rows();
	}
	
	function my_coupon($customer_id)
	{
		$this->db->join("coupons", "coupons.id=customer_coupon.coupon_id");
		//$this->db->join("customers", "customers.id=customer_coupon.customer_id");
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('customer_coupon')->result();
	}
	
	function my_coupon_details($coupon_id, $customer_id)
	{
		$this->db->select('*, customer_coupon.active as use_status ');
		$this->db->join("coupons", "coupons.id=customer_coupon.coupon_id");
		//$this->db->join("customers", "customers.id=customer_coupon.customer_id");
		$this->db->where('customer_id', $customer_id);
		$this->db->where('coupon_id', $coupon_id);
		return $this->db->get('customer_coupon')->row_array();
	}
	
	function coupon_listing($coupon_id, $customer_id, $current_admin = false)
	{
		$this->db->select('*, customers.name as customer_name, coupons.name as coupon_name ');
		$this->db->join("coupons", "coupons.id=customer_coupon.coupon_id");
		$this->db->join("customers", "customers.id=customer_coupon.customer_id");
		if(!empty($customer_id)){
			$this->db->where('customer_id', $customer_id);
		}
		if(!empty($coupon_id)){
			$this->db->where('coupon_id', $coupon_id);
		}
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('coupons.branch_id', $current_admin['branch']);
			endif;
		endif;
		
		return $this->db->get('customer_coupon')->result();
	}
}	
