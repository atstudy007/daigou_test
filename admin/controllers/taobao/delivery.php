<?php
require_once APPPATH . 'controllers/taobao/taobao_controller.php';

class Delivery extends Taobao_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('taobao/taobao_order_mdl');
		$this->load->model('taobao/taobao_delivery_mdl');
		$this->load->model('taobao/taobao_member_mdl');
		$this->load->helper('date');
		$this->load->helper('taobao');
	}
	
	public function detail($orderid)
	{
		$this->load->model('taobao/taobao_member_mdl');
		$data['status'] = $this->taobao_delivery_mdl->get_status_code('cn');
		$data['order'] = $this->taobao_delivery_mdl->get_full_order_by_id($orderid);
		$this->_template('taobao/delivery_detail', $data);	
	}
	
	public function _memo_post($orderid)
	{
		if ($this->input->post('update_status_time') == 'yes')
		{
			$data['status_time'] = now();
		}
		$data['admin_memo'] = $this->input->post('admin_memo');
		$data['status'] = $this->input->post('status');
		if ($this->taobao_delivery_mdl->edit_order($orderid, $data))
		{
			$this->_message('更新成功', '', TRUE);
		}
		else
		{
			$this->_message('更新失败', '', TRUE);
		}
	}

	public function _cancel_post($orderid)
	{
		$this->taobao_delivery_mdl->cancel($orderid);
		redirect('taobao/delivery/detail/' . $orderid);
	}
	
	public function _ship_post($orderid)
	{
		$order = $this->taobao_delivery_mdl->get_order_by_id($orderid);
		if ($order)
		{
			if ($order->status == DELIVERY_PAYED)
			{
				$this->taobao_delivery_mdl->ship($orderid);	
			}
			else if ($order->status >= DELIVERY_SHIPMENT_DONE)
			{
				$this->taobao_delivery_mdl->update_ship($orderid);		
			}
		}
		redirect('taobao/delivery/detail/' . $orderid);
	}

	public function del($orderid = 0)
	{
		if ($this->taobao_delivery_mdl->delete_orders(array($orderid)))
		{
			$this->_message('删除成功', '', TRUE);
		}
		else
		{
			$this->_message('删除失败', '', TRUE);
		}
	}

	public function _del_post()
	{
		$orders = $this->input->post('id');
		if (! $orders)
		{
			$orders = array();
		} 
		if ($this->taobao_delivery_mdl->delete_orders($orders))
		{
			$this->_message('删除成功', '', TRUE);
		}
		else
		{
			$this->_message('删除失败', '', TRUE);
		}
	}
	
	public function view()
	{
		$this->load->model('taobao/taobao_member_mdl');
		$suffix = '_from=insite';
		$where['id >'] = '0';
		if($orderid = $this->input->get('orderid'))
		{
			$where['id LIKE'] = '%'.$orderid.'%';
			$suffix .= '&orderid='.$orderid;	
		}
		$status = $this->input->get('status');
		if($status <> '')
		{
			$where['status'] = $status;
			$suffix .= '&status='.$status;	
		}
		if($uid = $this->input->get('uid'))
		{
			$where['uid'] = $uid;
			$suffix .= '&uid='.$uid;		
		}
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		if ($page == 1)
		{
			$offset = 0;	
		}
		else
		{
			$offset = 20 * ($page - 1);	
		}
		$data = $this->taobao_delivery_mdl->get_orders($where, 20, $offset, $suffix, 'taobao/delivery/view', TRUE);
		$data['current'] = $status;
		$data['status'] = $this->taobao_delivery_mdl->get_status_code('cn');
		$this->_stats($data);
		$this->_template('taobao/delivery_list', $data);
	}
	
	public function _stats(& $data)
	{
		$data['order_stats'] = 	$this->taobao_delivery_mdl->get_status_code('cn');
		foreach($data['order_stats'] as $k=>&$v)
		{
			$v = $this->db->where('status',$k)->count_all_results('taobao_delivery_orders');	
		}
	}
	
	
}