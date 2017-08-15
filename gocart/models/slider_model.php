<?php
Class Slider_Model extends CI_Model
{

	/********************************************************************
	gallery Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('slider');
		return $res->result_array();
	}
	
	function get_slider($id)
	{
		$res = $this->db->where('id', $id)->get('slider');
		return $res->row_array();
	}
	
	function save_slider($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('slider', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('slider', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_slider($id)
	{
		$this->db->where('id', $id)->delete('slider');
		return $id;
	}
	
	function display_one_slider()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('slider');				
		return $res->result_array();
	}
	
	
	
}