<?php 

	class Taobao_logistic_mdl extends CI_Model
	{	
		function __construct()
		{
				
		}
		
		function get_logistic_num_by_uid( $uid )
		{
			return $this->db->where('uid',$uid)->count_all_results('taobao_addresses');
		}
		
		function get_logistic_by_uid( $uid )
		{
			return $this->db->where('uid',$uid)->get('taobao_addresses')->result();
		}
		
		function get_logistic_by_id( $id )
		{
			return $this->db->where('id',$id)->get('taobao_addresses')->row();
		}
		
		function add_logistic()
		{
			if($this->get_logistic_num_by_uid($GLOBALS['member']->uid) < 10)
			{
				$data = array('name' => $this->input->post("logistics_name", TRUE),
							  'address' => $this->input->post("logistics_address", TRUE),
							  'phone' => $this->input->post("logistics_phone", TRUE),
							  'country' => $this->input->post("logistics_country", TRUE),
							  'state' => $this->input->post("logistics_state", TRUE),
							  'city' => $this->input->post("logistics_city", TRUE),
							  'postcode' => $this->input->post("logistics_postcode", TRUE),
							  'uid'  => $GLOBALS['member']->uid
							  );
				$this->db->insert('taobao_addresses', $data);
				return TRUE;
			}
			return FALSE;
		}
		
		function update_logistic()
		{
			$this->db->where('id',$this->input->post('id', TRUE));
			$data = array('name' => $this->input->post("logistics_name", TRUE),
						  'address' => $this->input->post("logistics_address", TRUE),
						  'phone' => $this->input->post("logistics_phone", TRUE),
						  'country' => $this->input->post("logistics_country", TRUE),
						  'state' => $this->input->post("logistics_state", TRUE),
						  'city' => $this->input->post("logistics_city", TRUE),
						  'postcode' => $this->input->post("logistics_postcode", TRUE));
			$this->db->update('taobao_addresses', $data);	
		}
		
		function delete_logistic($id)
		{
			$this->db->where('id',$id)->delete('taobao_addresses');	
		}
			
	}
