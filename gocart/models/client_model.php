<?php
/*

 - DB STRUCTURE
clients
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
	

clients_products
	client_id (int)
	product_id (int) (zero applies to all products?)
	sequence (int) ( for client product listings )

*/

class Client_model extends CI_Model 
{

	function save($client)
	{
		if(!$client['id']) 
		{
			return $this->add_client($client);
		} 
		else 
		{
			$this->update_client($client['id'], $client);
			return $client['id'];
		}
	}

	// add client, returns id
	function add_client($data) 
	{
		$this->db->insert('clients', $data);
		return $this->db->insert_id();
	}
	
	// update client
	function update_client($id, $data)
	{
		$this->db->where('id', $id)->update('clients', $data);
	}
	
	// delete client
	function delete_client($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('clients');
	
		// delete children
		$this->remove_product($id);
	}
	
	// checks client dates and usage numbers
	function is_valid($client)
	{
		//$client = $this->get_client($id);

		//die(var_dump($client));
				
		if($client['max_uses']!=0 && $client['num_uses'] >= $client['max_uses'] ) return false;
		
		if($client['start_date'] != "0000-00-00")
		{
			$start = strtotime($client['start_date']);
		
			$current = time();
		
			if($current < $start)
			{
				return false;
			}
		}
		
		if($client['end_date'] != "0000-00-00")
		{
			$end = strtotime($client['end_date']) + 86400; // add a day for the availability to be inclusive
		
			$current = time();
		
			if($current > $end)
			{
				return false;
			}
		}
		
		return true;
	}
	
	// increment client uses
	function touch_client($code)
	{
		$this->db->where('code', $code)->set('num_uses','num_uses+1', false)->update('clients');
	}
	
	// get clients list, sorted by start_date (default), end_date
	function get_clients() 
	{		
		$this->db->where('clients.active', 1);
		return $this->db->get('clients')->result();
	}
	
	// get client details, by id
	function get_client($id)
	{
		return $this->db->where('id', $id)->get('clients')->row();
	}
	
	// get client details, by code
	function get_client_by_code($code)
	{
		$this->db->where('code', $code);
		$return = $this->db->get('clients')->row_array();
		
		if(!$return)
		{
			return false;
		}
		$return['product_list'] = $this->get_product_ids($return['id']);
		return $return;
	}
	
	// get the next sequence number for a client products list 
	function get_next_sequence($client_id)
	{
		$this->db->select_max('sequence');
		$this->db->where('client_id',$client_id);
		$res = $this->db->get('clients_products')->row();
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
		$count = $this->db->count_all_results('clients');
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function check_client($code=false)
	{
		$this->db->where('code', $code);
		$count = $this->db->count_all_results('clients');
	
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}	
