<?php
Class Latest_News_Model extends CI_Model
{

	/********************************************************************
	News functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('news');
		return $res->result_array();
	}
	
	function get_latest_news($id)
	{
		$res = $this->db->where('id', $id)->get('news');
		return $res->row_array();
	}
	
	function save_latest_news($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('news', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('news', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_latest_news($id)
	{
		$this->db->where('id', $id)->delete('news');
		return $id;
	}
	
	function display_one_latest_news()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('news');				
		return $res->result_array();
	}
	
	
	
}