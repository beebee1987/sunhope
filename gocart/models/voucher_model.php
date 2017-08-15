<?php
/*

 - DB STRUCTURE
vouchers
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
	

vouchers_products
	voucher_id (int)
	product_id (int) (zero applies to all products?)
	sequence (int) ( for voucher product listings )

*/

class Voucher_model extends CI_Model 
{

	function save($voucher)
	{
		if(!$voucher['id']) 
		{
			return $this->add_voucher($voucher);
		} 
		else 
		{
			$this->update_voucher($voucher['id'], $voucher);
			return $voucher['id'];
		}
	}

	// add voucher, returns id
	function add_voucher($data) 
	{
		$this->db->insert('vouchers', $data);
		return $this->db->insert_id();
	}
	
	// update voucher
	function update_voucher($id, $data)
	{
		$this->db->where('id', $id)->update('vouchers', $data);
	}
	
	// delete voucher
	function delete_voucher($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('vouchers');
	
		// delete children
		$this->remove_product($id);
	}
	
	// checks voucher dates and usage numbers
	function is_valid($voucher)
	{
		//$voucher = $this->get_voucher($id);

		//die(var_dump($voucher));
				
		if($voucher['max_uses']!=0 && $voucher['num_uses'] >= $voucher['max_uses'] ) return false;
		
		if($voucher['start_date'] != "0000-00-00")
		{
			$start = strtotime($voucher['start_date']);
		
			$current = time();
		
			if($current < $start)
			{
				return false;
			}
		}
		
		if($voucher['end_date'] != "0000-00-00")
		{
			$end = strtotime($voucher['end_date']) + 86400; // add a day for the availability to be inclusive
		
			$current = time();
		
			if($current > $end)
			{
				return false;
			}
		}
		
		return true;
	}
	
	// increment voucher uses
	function touch_voucher($code)
	{
		$this->db->where('code', $code)->set('num_uses','num_uses+1', false)->update('vouchers');
	}
	
	// get vouchers list, sorted by start_date (default), end_date
	function get_vouchers($sort=NULL, $current_admin=NULL, $is_form = false) 
	{
		if($is_form){
			$this->db->where('vouchers.active', 1);		
		}
		
		$this->db->select(" branch.name as branch_name ,vouchers.* ");
		$this->db->join("admin", "staff_id=admin.id");
		$this->db->join("branch", "vouchers.branch_id=branch.id");
		// for merchant || branch can view only own data
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):				
				$this->db->where('vouchers.branch_id', $current_admin['branch']);
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
		
		return $this->db->get('vouchers')->result();
	}
	
	// get voucher details, by id
	function get_voucher($id)
	{
		return $this->db->where('id', $id)->get('vouchers')->row();
	}
	
	// get voucher details, by code
	function get_voucher_by_code($code)
	{
		$this->db->where('code', $code);
		$return = $this->db->get('vouchers')->row_array();
		
		if(!$return)
		{
			return false;
		}
		$return['product_list'] = $this->get_product_ids($return['id']);
		return $return;
	}
	
	// get the next sequence number for a voucher products list 
	function get_next_sequence($voucher_id)
	{
		$this->db->select_max('sequence');
		$this->db->where('voucher_id',$voucher_id);
		$res = $this->db->get('vouchers_products')->row();
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
		$count = $this->db->count_all_results('vouchers');
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function check_voucher($code=false)
	{
		$this->db->where('code', $code);
		$count = $this->db->count_all_results('vouchers');
	
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// add product to voucher
	function add_product($voucher_id, $prod_id, $seq=NULL)
	{
		// get the next seq
		if(is_null($seq))
		{
			$seq = $this->get_next_sequence($voucher_id);
		}
			
			
		$this->db->insert('vouchers_products', array('voucher_id'=>$voucher_id, 'product_id'=>$prod_id, 'sequence'=>$seq));	
	}
	
	// remove product from voucher. Product id as null for removing all products
	function remove_product($voucher_id, $prod_id=NULL)
	{
		$where = array('voucher_id'=>$voucher_id);
		
		if(!is_null($prod_id))
		{
			$where['product_id'] = $prod_id;
		}
			
		$this->db->where($where);
		$this->db->delete('vouchers_products');
	}
	
	// get list of products in voucher with full info
	function get_products($voucher_id) 
	{
		$this->db->join("products", "product_id=products.id");
		$this->db->where('voucher_id', $voucher_id);
		return $this->db->get('vouchers_products')->result();
	}
	
	// Get list of product id's only - utility function
	function get_product_ids($voucher_id)
	{
		$this->db->select('product_id');
		$this->db->where('voucher_id', $voucher_id);
		$res = $this->db->get('vouchers_products')->result_array();

		$list = array();
		foreach($res as $item)
		{
			array_push($list, $item["product_id"]);	
		}
		return $list;
	}
	
	// set sequence number of product in voucher, for re-sorting
	function set_product_sequence($voucher_id, $prod_id, $seq)
	{
		$this->db->where(array('voucher_id'=>$voucher_id, 'product_id'=>$prod_id));
		$this->db->update('vouchers_products', array('sequence'=>$seq));
	}
	
	// Get list of product id's only - utility function
	function check_voucher_customer($voucher_id, $customer_id)
	{		
		$this->db->select('voucher_id');
		$this->db->where('voucher_id', $voucher_id);
		$this->db->where('customer_id', $customer_id);
		
		$count = $this->db->count_all_results('customer_voucher');
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	// add voucher, returns id
	function add_voucher_customer($data)
	{
		$this->db->insert('customer_voucher', $data);
		//return $this->db->insert_id(); // this is only for auto increment
		return $this->db->affected_rows();		
	}
	
	// add coupon, returns id
	function add_customer_voucher_log($data)
	{
		$this->db->insert('customer_voucher_log', $data);
		//return $this->db->insert_id(); // this is only for auto increment
		return $this->db->affected_rows();
	}
	
	// update voucher
	function update_voucher_customer($data)
	{
		$this->db->where('voucher_id', $data['voucher_id']);
		$this->db->where('customer_id', $data['customer_id']);		
		$this->db->update('customer_voucher', $data);
		return $this->db->affected_rows();
	}
	
	function my_voucher($customer_id)
	{
		$this->db->join("vouchers", "vouchers.id=customer_voucher.voucher_id");
		//$this->db->join("customers", "customers.id=customer_voucher.customer_id");
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('customer_voucher')->result();
	}
	
	function my_voucher_details($voucher_id, $customer_id)
	{
		$this->db->select('*, customer_voucher.active as use_status ');
		$this->db->join("vouchers", "vouchers.id=customer_voucher.voucher_id");
		//$this->db->join("customers", "customers.id=customer_voucher.customer_id");		
		$this->db->where('customer_id', $customer_id);		
		$this->db->where('voucher_id', $voucher_id);		
		return $this->db->get('customer_voucher')->row_array();
	}
	
	function voucher_listing($voucher_id, $customer_id, $current_admin = false)
	{
		$this->db->select('*, customers.name as customer_name, vouchers.name as voucher_name ');
		$this->db->join("vouchers", "vouchers.id=customer_voucher.voucher_id");
		$this->db->join("customers", "customers.id=customer_voucher.customer_id");
		if(!empty($customer_id)){
			$this->db->where('customer_id', $customer_id);
		}
		if(!empty($voucher_id)){
			$this->db->where('voucher_id', $voucher_id);
		}
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):				
				$this->db->where('vouchers.branch_id', $current_admin['branch']);
			endif;
		endif;
		
		return $this->db->get('customer_voucher')->result();
	}
	
}	
