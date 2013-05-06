<?php
	
	define("DELIVERY_CANCELED" , -2);
	define("DELIVERY_CANCEL_PROGRESSING" , -1);
	define("DELIVERY_INVALID" , 0);
	define("DELIVERY_UNPAYED" , 1);
	define("DELIVERY_PAYED" , 2);
	define("DELIVERY_SHIPMENT_DONE" , 3);
	define("DELIVERY_CONFIRMED" , 4);
	define("DELIVERY_EVALUATED" , 5);
	
	
	class Taobao_delivery_mdl extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		
		
		function get_order_lists_by_id($id)
		{
			$this->load->model('taobao/taobao_order_mdl');
			$lists = array();
			$orders = explode(',', $id);
			foreach ($orders as $order)
			{
				if ($order)
				{
					$lists[] = $this->taobao_order_mdl->get_full_order_by_id($order);
				}
			}
			return $lists;
		}
		
		function get_orders($where = array(), $limit = 0, $offset = 0 , $suffix = '', $uri = 'my/deliveries', $show_detail = FALSE)
		{
			$total = $this->db->where($where)->count_all_results('taobao_delivery_orders');
			$orders['orders'] = $this->db->where($where)->limit($limit)->offset($offset)->order_by('id', 'DESC')->get('taobao_delivery_orders')->result();
			if ($show_detail)
			{
				foreach ($orders['orders'] as & $_order)
				{
					$_order->buyer = $this->taobao_member_mdl->get_member_by_uid($_order->uid);
				}
			}
			$this->load->library('pagination');
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = $limit;
			$config['query_string_segment'] = 'page'; 
			$config['base_url'] = site_url($uri).'?'.($suffix == '' ?  '{fix}' : $suffix);
			$config['total_rows'] = $total;
			$this->pagination->initialize($config); 
			$orders['pagination'] = '<div class="pagination">'.str_replace('{fix}&','',$this->pagination->create_links()).'</div>';
			return $orders;
			
		}
		
		function get_status_code($lang = 'en')
		{
			  if ($lang == 'en')
			  {
				  	return array(
					  DELIVERY_CANCELED => 'Canceled',
					  DELIVERY_CANCEL_PROGRESSING => 'Canceling',
					  DELIVERY_INVALID => 'Invalid',
					  DELIVERY_UNPAYED => 'Unpayed',
					  DELIVERY_PAYED => 'Payed',
					  DELIVERY_SHIPMENT_DONE => 'Shipped',
					  DELIVERY_CONFIRMED => 'Confirmed',
					  DELIVERY_EVALUATED => 'Finished'
				    );
			  }
			  else if ($lang == 'cn')
			  {
			  		return array(
					  DELIVERY_CANCELED => '已取消',
					  DELIVERY_CANCEL_PROGRESSING => '取消中',
					  DELIVERY_INVALID => '不合法',
					  DELIVERY_UNPAYED => '未支付',
					  DELIVERY_PAYED => '已支付',
					  DELIVERY_SHIPMENT_DONE => '已发货',
					  DELIVERY_CONFIRMED => '已确认收获',
					  DELIVERY_EVALUATED => '已评价'
					);
			  }
			  
		}
		
		//获取最近10条好评
		
		function get_lastest_rates()
		{
			$sql = "SELECT d.rate_description,d.rate_time,m.username,m.country FROM taobao_delivery_orders d INNER JOIN taobao_members m ON m.uid=d.uid WHERE d.status=".DELIVERY_EVALUATED.' AND d.rate_score = 5 ORDER BY d.rate_time DESC LIMIT 0,10';
			return $this->db->query($sql)->result();
		}
		
		
		//简单
		function get_order_by_id($orderid)
		{
			return $this->db->where('id',$orderid)->get('taobao_delivery_orders')->row();
		}
		
		//高阶
		function get_full_order_by_id($id)
		{
			$order = $this->db->where('id',$id)->get('taobao_delivery_orders')->row();
			if ($order)
			{
				$order->buyer = $this->taobao_member_mdl->get_member_by_uid($order->uid);
				$order->lists = $this->get_order_lists_by_id($order->orders);
				//计算分拆数据
				$order->packages = array();
				$express_data = array('kg' => $order->weight_kg, 'fee' => $order->weight_fee, 'extra' => $order->weight_extra, 'max' => $order->max_weight);
				if ($order->overweight)
				{
					$_cut_num = floor($order->weight / $order->max_weight);
					for ($i = 1; $i <= $_cut_num; $i++)
					{
						$_t = array('weight' => $order->max_weight, 'money' => express_calculator($order->max_weight, $express_data));
						$order->packages[] = $_t;
					}
					if ($order->weight > $order->max_weight * $_cut_num)
					{
						$_w = ($order->weight - $order->max_weight * $_cut_num);
						$_t = array('weight' => $_w, 'money' => express_calculator($_w, $express_data));
						$order->packages[] = $_t;
					}	
				}
				else
				{
					$_t = array('weight' => $order->weight, 'money' => express_calculator($order->weight, $express_data));
					$order->packages[] = $_t;
				}
			}
			return $order;
		}
		
		//付款处理
		function pay($orderid, $data = array())
		{
			$data['status'] = DELIVERY_PAYED;
			$data['status_time'] = $data['pay_time'] = now();
			$this->db->where('id',$orderid)->update('taobao_delivery_orders', $data);	
			$this->_send_email($orderid);
		}
		
		
		//标记发货
		function ship($orderid)
		{
			$data['status'] = DELIVERY_SHIPMENT_DONE;
			$data['status_time'] = $data['ship_time'] = now();
			$tracks = $this->input->post('track_no');
			$data['logistics_no'] = serialize($tracks);
			//物流信息
			$this->db->where('id', $orderid)->update('taobao_delivery_orders',$data);	
			$this->_send_email($orderid);
		}
		
		//修改物流信息
		function update_ship($orderid)
		{
			$tracks = $this->input->post('track_no');
			$data['logistics_no'] = serialize($tracks);
			//物流信息
			$this->db->where('id', $orderid)->update('taobao_delivery_orders', $data);	
		}
		
		//取消处理
		function canceling($orderid)
		{
			$data['status'] = DELIVERY_CANCEL_PROGRESSING;
			$data['status_time'] = $data['cancel_start_time'] = now();
			$this->db->where('id',$orderid)->update('taobao_delivery_orders',$data);
			$this->_send_email($orderid);
		}
		
		//已取消处理
		function cancel($orderid)
		{
			$this->load->model('taobao/taobao_order_mdl');
			$data['status'] = DELIVERY_CANCELED;
			$data['status_time'] = $data['cancel_time'] = now();
			$_order = $this->get_order_by_id($orderid);
			if ( ! $_order) {return FALSE;}
			$this->db->trans_begin();//事物开始
			$this->db->where('id',$orderid)->update('taobao_delivery_orders',$data);
			$_related_orders = $this->db->select('id')->where_in('id', $_order->orders)->get('taobao_orders')->result();
			foreach ($_related_orders as $_purchase_order)
			{
				$this->taobao_order_mdl->arrived($_purchase_order->id);
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				$this->_send_email($orderid);
				return TRUE;
			}
		}
		
		//确认收货
		function finish($orderid)
		{
			$data['status'] = DELIVERY_CONFIRMED;
			$data['status_time'] = $data['confirm_time'] = now();
			$this->db->where('id',$orderid)->update('taobao_delivery_orders',$data);
			$this->_send_email($orderid);
		}

		//更新admin_memo

		function update_admin_memo($orderid)
		{
			$data['admin_memo'] = $this->input->post('admin_memo', TRUE);
			$this->db->where('id',$orderid)->update('taobao_delivery_orders',$data);	
		}
		
		//修改订单
		public function edit_order($orderid = 0, $data = array())
		{
			$this->db->trans_begin();//事物开始
			$this->db->where('id', $orderid)->update('taobao_delivery_orders', $data);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				return TRUE;
			}
		}

		//删除订单
		public function delete_orders($orders = array())
		{
			$this->db->trans_begin();//事物开始
			$this->db->where_in('id', $orders)->delete('taobao_delivery_orders');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				return TRUE;
			}
		}

		//评价
		function rate($orderid)
		{
			$data['status'] = DELIVERY_EVALUATED;
			$data['status_time'] = $data['rate_time'] = now();
			$data['rate_score'] = $this->input->post('score', TRUE);
			$data['rate_description'] = $this->input->post('description', TRUE);
			$this->db->trans_begin();//事物开始
			if ($this->db->where('id',$orderid)->update('taobao_delivery_orders', $data))
			{
				//整个交易完成，根据比例更新个人积分
				$order = $this->get_order_by_id($orderid);
				$this->load->model('taobao/taobao_inviter_mdl');
				//增加消费积分记录
				$_money = dollar($order->money);
				$_credit = round($_money * $GLOBALS['taobao']['credit']['trade']);
				$_cash = round($_money * $GLOBALS['taobao']['credit']['cash'], 2);
				$_invite_credit = round($_money * $GLOBALS['taobao']['credit']['invite']);
				$this->taobao_inviter_mdl->add_expense_record($GLOBALS['member']->uid, $GLOBALS['member']->username, 0, '', $order->orders, '', $_money, 0, $_credit);
				//增加上限会员推广记录
				if ($GLOBALS['member']->inviter_uid)
				{
					//检查此人是返积分还是返现金
					$_inviter = $this->taobao_inviter_mdl->get_inviter_by_uid($GLOBALS['member']->inviter_uid);
					if ($_inviter)
					{
						if ($_inviter->type == 1)
						{
							$_cash = 0;	
						}
						else if($_inviter->type == 2)
						{
							$_invite_credit = 0;	
						}
						$this->taobao_inviter_mdl->add_expense_record($GLOBALS['member']->inviter_uid, $GLOBALS['member']->inviter, $GLOBALS['member']->uid, $GLOBALS['member']->username, $order->orders, '', $_money, $_cash, $_invite_credit);
						
					}
				}
				
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				$this->_send_email($orderid);
				return TRUE;
			}
			
		}
		
		function create($checkout)
		{
			$data = array();
			$data['id'] = $data['create_time'] = $data['status_time'] = now();
			$data['uid'] = $GLOBALS['member']->uid;
			$data['orders'] = implode(',', $checkout['orders_string']);
			$data['money'] = $checkout['money'];
			$data['status'] = DELIVERY_UNPAYED;
			//$data['logistics_info'] = $checkout['logistic']->name.','.$checkout['countries'][$checkout['logistic']->country].'&nbsp;'.$checkout['logistic']->state.'&nbsp;'.$checkout['logistic']->city.$checkout['logistic']->address.','.$checkout['logistic']->phone;
			$_address = array();
			$_address[] = $checkout['logistic']->name;
			$_address[] = $checkout['logistic']->address;
			$_address[] = $checkout['logistic']->city;
			$_address[] = $checkout['logistic']->state;
			$_address[] = $checkout['countries'][$checkout['logistic']->country];
			$_address[] = $checkout['logistic']->postcode;
			$_address[] = $checkout['logistic']->phone;
			$data['logistics_info'] = implode(',', $_address);
			
			$data['weight'] = $checkout['weight'];
			$data['weight_kg'] = $checkout['express_data']['kg'];
			$data['max_weight'] = $checkout['express_data']['max'];
			$data['weight_fee'] = $checkout['express_data']['fee'];
			$data['weight_extra'] = $checkout['express_data']['extra'];
			$data['service_fee'] = $checkout['money'] * $GLOBALS['taobao']['system']['service'];
			//检查此人是否被邀请且首次消费
			$relation = NULL;
			if ($GLOBALS['member']->inviter_uid)
			{
				$this->load->model('taobao/taobao_inviter_mdl');
				$relation = $this->taobao_inviter_mdl->get_relation('uid', $GLOBALS['member']->uid);
				if ($relation)
				{
					if ($relation->first_service_discount == 0)
					{
						$data['service_fee'] *= $GLOBALS['taobao']['system']['invite'];
					}
				}
			}
			//检查积分折扣
			if (isset($GLOBALS['member']->level['discount']) AND $GLOBALS['member']->level['discount'] > 0)
			{
				$data['service_fee'] *= $GLOBALS['member']->level['discount'];	
			}
			$data['service_fee'] = round($data['service_fee'], 4);
			//计算真正的服务费
			$data['service_fee'] = get_service_fee(FALSE, $data['service_fee']);
			
			$data['tax_fee'] = round($checkout['money'] * $GLOBALS['taobao']['system']['tax'], 4);
			$data['ship_fee'] = round($checkout['detail_money'], 4);
			$data['overweight'] = $checkout['overweight'];
			$data['logistics'] = $checkout['express'];
			//生成订单数据!!!transaction must be used,wraning : innodb,更新前都要判断，防止数据的不一致性！！！
			$this->db->trans_begin();//事物开始
			$this->db->insert('taobao_delivery_orders', $data);
			//标记已转运
			$_purchase_orders = $this->db->select('id')->where_in('id', $checkout['orders_string'])->get('taobao_orders')->result();
			foreach ($_purchase_orders as $_purchase_order)
			{
				$this->taobao_order_mdl->expressed($_purchase_order->id);	
			}
			//移除首次服务费折扣
			if ($relation)
			{
				$this->taobao_inviter_mdl->update_relation($relation->uid, $relation->iuid, array('first_service_discount'=>1, 'first_service_order'=>$data['id']));	
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				$this->_send_email($data['id']);
				return $data['id'];
			}
		}
		
		//生成订单处理通知
		private function _send_email($id = 0)
		{
			$order = $this->get_order_by_id($id);
			$status = $this->get_status_code();
			if ($order)
			{
				$this->load->model('taobao/taobao_member_mdl');
				$member = $this->taobao_member_mdl->get_member_by_uid($order->uid);
				if ($member)
				{
					$this->load->model('taobao/taobao_email_queue_mdl');
					$this->load->model('taobao/taobao_email_tpl_mdl');
					$content = $this->taobao_email_tpl_mdl->get_tpl('delivery');
					$search = array('{username}', '{delivery_no}', '{delivery_status}', '{delivery_url}');
					$replace = array($member->username, $order->id, $status[$order->status], site_url('my/delivery/'.$order->id));
					$content = str_replace($search, $replace, $content);
					$this->taobao_email_queue_mdl->push($member->email, 'Delivery Order Status Change Notice', $content);
				}
			}
		}
		
		
		
		
	}