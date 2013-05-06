<?php

	class Taobao_inviter_mdl extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();	
		}
		
		public function get_inviter_by_uid($uid = 0)
		{
			return  $this->db->where('uid', $uid)->limit(1)->get('taobao_inviters')->row();
		}
		
		public function get_inviter_by_username($username = '')
		{
			return  $this->db->where('username', $username)->limit(1)->get('taobao_inviters')->row();
		}
		
		public function add_inviter($data = array())
		{
			if ( ! $data)
			{
				$data['uid'] = $GLOBALS['member']->uid;
				$data['username'] = $GLOBALS['member']->username;
				$data['paypal'] = $this->input->post('paypal', TRUE);
				$data['type'] = $this->input->post('type', TRUE);
			}
			$data['cash'] = 0;
			$data['total_cash'] = 0;
			$this->db->insert('taobao_inviters', $data);
		}
		
		public function update_inviter($type, $value, $data = array())
		{
			$this->db->where($type, $value)->update('taobao_inviters', $data);
		}
		
		public function get_inviter($type, $value =  NULL)
		{
			if ( ! is_array($type))
			{
				return $this->db->where($type, $value)->get('taobao_inviters')->row();
			}
			else
			{
				foreach ($type as $k => $v)
				{
					$this->db->where($k, $v);	
				}
				return $this->db->get('taobao_inviters')->row();
			}
		}
		
		//获取提现记录
		public function get_cash_records($where = array(), $limit = 0, $offset = 0 , $suffix = '', $uri = 'my/inviter')
		{
			$total = $this->db->where($where)->count_all_results('taobao_invite_cash');
			$data['list'] = $this->db->where($where)->limit($limit)->offset($offset)->order_by('timeline', 'DESC')->get('taobao_invite_cash')->result();
			$this->load->library('pagination');
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = $limit;
			$config['query_string_segment'] = 'page'; 
			$config['base_url'] = site_url($uri).'?'.($suffix == '' ?  '{fix}' : $suffix);
			$config['total_rows'] = $total;
			$this->pagination->initialize($config); 
			$data['pagination'] = '<div class="pagination">'.str_replace('{fix}&','',$this->pagination->create_links()).'</div>';
			return $data;	
		}
		
		public function add_cash_record($data = array())
		{
			$this->load->helper('date');
			if ( ! $data)
			{
				$data['uid'] = $this->input->post('uid', TRUE);
				$data['cash'] = $this->input->post('cash', TRUE);
				$data['paypal'] = $this->input->post('paypal', TRUE);
				$data['description'] = $this->input->post('description', TRUE);
			}
			$data['timeline'] = now();
			$this->db->insert('taobao_invite_cash', $data);
			//减去账户当前金额
			if ($this->db->insert_id())
			{
				$this->db->set('cash', 'cash-'.$data['cash'], FALSE)->where('uid', $data['uid'])->update('taobao_inviters');
			}	
		}
		
		//获取推广员记录
		public function get_inviters($where = array(), $limit = 0, $offset = 0 , $suffix = '', $uri = 'taobao/inviter/view')
		{
			$total = $this->db->where($where)->count_all_results('taobao_inviters');
			$data['list'] = $this->db->where($where)->limit($limit)->offset($offset)->order_by('cash', 'DESC')->get('taobao_inviters')->result();
			$this->load->library('pagination');
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = $limit;
			$config['query_string_segment'] = 'page'; 
			$config['base_url'] = backend_url($uri).'?'.($suffix == '' ?  '{fix}' : $suffix);
			$config['total_rows'] = $total;
			$this->pagination->initialize($config);
			$data['pagination'] = str_replace('{fix}&','',$this->pagination->create_links());
			return $data;	
		}
		
		public function add_expense_record($uid, $username, $iuid, $iusername, $orderid, $description, $money, $cash, $credit)
		{
			$data['uid'] = $uid;
			$data['username'] = $username;
			$data['iuid'] = $iuid;
			$data['iusername'] = $iusername;
			$data['orderid'] = $orderid;
			$data['description'] = $description;
			$data['money'] = $money;
			$data['cash'] = $cash;
			$data['credit'] = $credit;
			$data['timeline'] = now();
			$this->db->insert('taobao_invite_expense', $data);
			if ($this->db->insert_id())
			{
				
				//如果有下线会员，则属于推广范围
				if ($data['iuid'])
				{
					$_shenfen = $this->get_inviter_by_uid($data['uid']);
					//是推广员
					if ($_shenfen)
					{
						if ($_shenfen->type == 1)
						{
							//是积分推广员,增加推广积分
							$this->db->set('invite_credit', 'invite_credit+' . $data['credit'] , FALSE);
							$this->db->where('uid', $data['uid'])->update('taobao_members');
						}
						else if($_shenfen->type == 2)
						{
							//增加推广金额
							$this->db->set('cash', 'cash+' . $data['cash'] , FALSE);
							$this->db->set('total_cash', 'total_cash+' . $data['cash'] , FALSE);
							$this->db->where('uid', $data['uid'])->update('taobao_inviters');
						}
					}
				}
				else
				{
					//增加消费积分
					$this->db->set('credit', 'credit+' . $data['credit'] , FALSE);
					$this->db->where('uid', $data['uid'])->update('taobao_members');
				}
			}
		}
		
		public function add_relation($uid, $username, $iuid, $iusername)
		{
			$data['uid'] = $uid;
			$data['username'] = $username;
			$data['iuid'] = $iuid;
			$data['iusername'] = $iusername;
			$data['first_service_discount'] = 0;
			$data['first_service_order'] = '';
			$this->db->insert('taobao_invite_relations', $data);
			return $this->db->insert_id();
		}
		
		public function get_relation($type, $value)
		{
			return $this->db->limit(1)->where($type, $value)->get('taobao_invite_relations')->row();
		}
		
		public function update_relation($uid, $iuid, $data = array())
		{
			$this->db->limit(1)->where('uid', $uid)->where('iuid', $iuid)->update('taobao_invite_relations', $data);
		}
		
		//获取历史记录
		public function get_history($where = array(), $limit = 0, $offset = 0 , $suffix = '', $uri = 'my/history')
		{
			$total = $this->db->where($where)->count_all_results('taobao_invite_expense');
			$data['list'] = $this->db->where($where)->limit($limit)->offset($offset)->order_by('timeline', 'DESC')->get('taobao_invite_expense')->result();
			$this->load->library('pagination');
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = $limit;
			$config['query_string_segment'] = 'page'; 
			$config['base_url'] = site_url($uri).'?'.($suffix == '' ?  '{fix}' : $suffix);
			$config['total_rows'] = $total;
			$this->pagination->initialize($config);
			$data['pagination'] = str_replace('{fix}&','',$this->pagination->create_links());
			return $data;	
		}
		
	}