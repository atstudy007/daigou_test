<?php

	class Taobao_favorite_mdl extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();	
		}
		
		function exists($iid, $uid)
		{
			$num = $this->db->where('iid',$iid)->where('uid',$uid)->count_all_results('taobao_favorites');	
			return $num;
		}
		
		function add($data = array())
		{
			if ( ! $data)
			{
				$data['iid'] = $this->input->post('iid', TRUE);
				$data['uid'] = $GLOBALS['member']->uid;
				$data['title'] = $this->input->post('title', TRUE);
				$data['pic_url'] = $this->input->post('pic_url', TRUE);
				$data['url'] = $this->input->post('url', TRUE);
				$data['price'] = $this->input->post('price', TRUE);
			}
			return $this->db->insert('taobao_favorites', $data);
		}
		
		function delete($iid, $uid)
		{
			$data['iid'] = $iid;
			$data['uid'] = $uid;
			$this->db->where($data)->delete('taobao_favorites');	
		}
		
		function get_favorites($uid, $limit, $offset)
		{
			$total = $this->db->where('uid', $uid)->count_all_results('taobao_favorites');
			$data['list'] = $this->db->limit($limit)->offset($offset)->where('uid', $uid)->get('taobao_favorites')->result();
			$this->load->library('pagination');
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = $limit;
			$config['query_string_segment'] = 'page'; 
			$config['base_url'] = site_url('my/favorites/').'?{fix}';
			$config['total_rows'] = $total;
			$this->pagination->initialize($config); 
			$data['pagination'] = '<div class="pagination">'.str_replace('{fix}&','',$this->pagination->create_links()).'</div>';
			return $data;
		}
		
	}