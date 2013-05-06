<?php
	
	define("ORDER_CANCELED" , -2);
	define("ORDER_CANCEL_PROGRESSING" , -1);
	define("ORDER_INVALID" , 0);
	define("ORDER_UNPAYED" , 1);
	define("ORDER_PAYED" , 2);
	define("ORDER_PURCHASED" , 3);
	define("ORDER_REFUNDED" , 4);
	define("ORDER_ARRIVED" , 5);
	define("ORDER_EXPRESSED" , 6);
	
	
	class Taobao_order_mdl extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function get_order_lists_by_id($id)
		{
			$lists = $this->db->where('orderid',$id)->get('taobao_order_lists')->result();
			return $lists;
		}
		
		public function get_orders($where = array(), $limit = 0, $offset = 0 , $suffix = '', $uri = 'my/orders', $show_detail = FALSE)
		{
			$total = $this->db->where($where)->count_all_results('taobao_orders');
			$orders['orders'] = $this->db->where($where)->limit($limit)->offset($offset)->order_by('id', 'DESC')->get('taobao_orders')->result();
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
		
		function check_status($orders = array(), $status = ORDER_ARRIVED)
		{
			if ( ! $orders)
			{
				return FALSE;	
			}
			else
			{
				$assume_num = $this->db->where('status', $status)->where_in('id', $orders)->count_all_results('taobao_orders');
				if ($assume_num == count($orders))
				{
					return TRUE;	
				}
				return FALSE;
			}
		}
		
		public function get_status_code($lang = 'en')
		{
			  if ($lang == 'en')
			  {
				  	return array(
					 	ORDER_CANCELED => 'Canceled',
						ORDER_CANCEL_PROGRESSING => 'Cancelling',
						ORDER_INVALID => 'Invalid',
						ORDER_UNPAYED => 'Unpayed',
						ORDER_PAYED => 'Payed',
						ORDER_PURCHASED => 'Purchased',
						ORDER_REFUNDED => 'Refunded',
						ORDER_ARRIVED => 'Arrived',
						ORDER_EXPRESSED => 'Finished'
				    );
			  }
			  else if ($lang == 'cn')
			  {
			  		return array(
					    ORDER_CANCELED => '已取消',
						ORDER_CANCEL_PROGRESSING => '取消中',
						ORDER_INVALID => '非法',
						ORDER_UNPAYED => '未支付',
						ORDER_PAYED => '已支付',
						ORDER_PURCHASED => '已采购',
						ORDER_REFUNDED => '退换货',
						ORDER_ARRIVED => '已入库',
						ORDER_EXPRESSED => '已转运'
				    );
			  }
			  
		}
		//简单
		public function get_order_by_id($orderid)
		{
			return $this->db->where('id',$orderid)->get('taobao_orders')->row();
		}
		
		//高阶
		public function get_full_order_by_id($id)
		{
			$order = $this->db->where('id',$id)->get('taobao_orders')->row();
			if ($order)
			{
				$order->buyer = $this->taobao_member_mdl->get_member_by_uid($order->uid);
				$order->lists = $this->get_order_lists_by_id($order->id);
			}
			return $order;
		}
		
		//付款处理,由支付通知接口调用!
		public function pay($orderid, $data = array())
		{
			$data['status'] = ORDER_PAYED;
			$data['status_time'] = $data['pay_time'] = now();
			$this->db->where('id',$orderid)->update('taobao_orders', $data);
			$this->_send_email($orderid);
		}
		
		//标记采购完成
		public function purchased($orderid)
		{
			$data['status'] = ORDER_PURCHASED;
			$data['status_time'] = $data['purchased_time'] = now();
			$this->db->where('id', $orderid)->update('taobao_orders', $data);
			$this->_send_email($orderid);
		}
		
		//标记到货
		public function arrived($orderid)
		{
			$data['status'] = ORDER_ARRIVED;
			$data['status_time']  = now();
			$this->db->where('id', $orderid)->update('taobao_orders', $data);
			$this->_send_email($orderid);
		}
		
		//标记转运
		public function expressed($orderid)
		{
			$data['status'] = ORDER_EXPRESSED;
			$data['status_time'] = now();
			$this->db->where('id', $orderid)->update('taobao_orders', $data);
			$this->_send_email($orderid);
		}
						
		//取消处理
		public function canceling($orderid)
		{
			$data['status'] = ORDER_CANCEL_PROGRESSING;
			$data['status_time'] = $data['cancel_start_time'] = now();
			$this->db->where('id', $orderid)->update('taobao_orders', $data);
			$this->_send_email($orderid);
		}
		
		//已取消处理
		public function cancel($orderid)
		{
			$data['status'] = ORDER_CANCELED;
			$data['status_time'] = $data['cancel_time'] = now();
			$this->db->where('id', $orderid)->update('taobao_orders', $data);
			$this->_send_email($orderid);
		}

		//更新admin_memo
		public function update_admin_memo($orderid)
		{
			$data['admin_memo'] = $this->input->post('admin_memo', TRUE);
			$this->db->where('id', $orderid)->update('taobao_orders', $data);	
		}
		
		//修改订单
		public function edit_order($orderid = 0, $data = array())
		{
			$this->db->trans_begin();//事物开始
			$this->db->where('id', $orderid)->update('taobao_orders', $data);
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
			$this->db->where_in('id', $orders)->delete('taobao_orders');
			$this->db->where_in('orderid', $orders)->delete('taobao_order_lists');
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

		//从购物车生成订单
		public function create($checkout)
		{
			if ( ! $checkout['can_buy'])
			{
				return FALSE;	
			}
			$data = array();
			$data['status_time'] = $data['id'] = $data['create_time'] = now();
			$data['uid'] = $GLOBALS['member']->uid;
			$data['money'] = $checkout['total_cash'];
			$data['status'] = ORDER_UNPAYED;
			//生成订单数据!!!transaction must be used,wraning : innodb,更新前都要判断，防止数据的不一致性！！！
			$this->db->trans_begin();//事物开始
			$this->db->insert('taobao_orders', $data);
			//生成订单中商品数据,并更新商品库存，个人积分数据将在用户确认订单后增加
			foreach($checkout['cart'] as $v)
			{
				$pdata = array();
				$pdata['productid'] = $v['info']->num_iid;
				$pdata['orderid'] = $data['id'];
				$pdata['qty'] = $v['qty'];
				$pdata['price'] = $v['info']->price;
				$pdata['express_fee'] = $v['info']->express_fee;
				$pdata['pic_url'] = $v['info']->pic_url;
				$pdata['click_url'] = $v['info']->taobaoke->click_url;
				$pdata['options'] = $v['options'];
				$pdata['name'] = $v['info']->title;
				$this->db->insert('taobao_order_lists', $pdata);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				//删除购物车数据
				$this->ncart->destroy();
				
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
				$member = $this->taobao_member_mdl->get_member_by_uid($order->uid);
				if ($member)
				{
					$this->load->model('taobao/taobao_email_queue_mdl');
					$this->load->model('taobao/taobao_email_tpl_mdl');
					$content = $this->taobao_email_tpl_mdl->get_tpl('order');
					$search = array('{username}', '{order_no}', '{order_status}', '{order_url}');
					$replace = array($member->username, $order->id, $status[$order->status], site_url('my/order/'.$order->id));
					$content = str_replace($search, $replace, $content);
					$this->taobao_email_queue_mdl->push($member->email, 'Puchase Order Status Change Notice', $content);
				}
			}
		}
		
	}