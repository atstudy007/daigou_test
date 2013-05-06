<?php
require_once APPPATH . 'controllers/taobao/taobao_controller.php';

class Order extends Taobao_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('taobao/taobao_order_mdl');
		$this->load->model('taobao/taobao_member_mdl');
		$this->load->helper('date');
	}
	
	public function detail($orderid)
	{
		$this->load->model('taobao/taobao_member_mdl');
		$data['status'] = $this->taobao_order_mdl->get_status_code('cn');
		$data['order'] = $this->taobao_order_mdl->get_full_order_by_id($orderid);
		$this->_template('taobao/order_detail', $data);	
	}

	public function _purchased_post($orderid)
	{
		$this->taobao_order_mdl->ship_ready($orderid);
		redirect('taobao/order/detail/' . $orderid);
	}
	
	public function _memo_post($orderid)
	{
		if ($this->input->post('update_status_time') == 'yes')
		{
			$data['status_time'] = now();
		}
		$data['admin_memo'] = $this->input->post('admin_memo');
		$data['status'] = $this->input->post('status');
		$data['money'] = $this->input->post('money');
		$data['weight'] = $this->input->post('weight');
		if ($this->taobao_order_mdl->edit_order($orderid, $data))
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
		$this->taobao_order_mdl->cancel($orderid);
		redirect('taobao/order/detail/' . $orderid);
	}

	public function del($orderid = 0)
	{
		if ($this->taobao_order_mdl->delete_orders(array($orderid)))
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
		if ($this->taobao_order_mdl->delete_orders($orders))
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
		$data = $this->taobao_order_mdl->get_orders($where, 20, $offset, $suffix, 'taobao/order/view', TRUE);
		$data['current'] = $status;
		$data['status'] = $this->taobao_order_mdl->get_status_code('cn');
		$this->_stats($data);
		$this->_template('taobao/order_list', $data);
	}
	
	public function _stats(& $data)
	{
		$data['order_stats'] = 	$this->taobao_order_mdl->get_status_code('cn');
		foreach($data['order_stats'] as $k=>&$v)
		{
			$v = $this->db->where('status',$k)->count_all_results('taobao_orders');	
		}
	}
	
	
}