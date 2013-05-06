<?php

class Paypal extends Taobao_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('paypal_lib');
	}

	public function checkout($type = 'p', $order_id = 0)
	{
		! $GLOBALS['member'] && redirect('member/login');
		include DILICMS_SHARE_PATH . 'settings/taobao/api.php';
		if ($type == 'p')
		{
			$this->load->model('taobao/taobao_order_mdl');
			$order = $this->taobao_order_mdl->get_full_order_by_id($order_id);
			if ($order AND $order->uid == $GLOBALS['member']->uid AND ($order->status == ORDER_UNPAYED))
			{
				$this->paypal_lib->add_field('business', $taobao['api']['paypal_business']);
			    $this->paypal_lib->add_field('return', site_url('my/order/'.$order->id));
			    $this->paypal_lib->add_field('cancel_return', site_url('my/order/'.$order->id));
			    $this->paypal_lib->add_field('notify_url', site_url('pay/paypal/ipn'));
			    $this->paypal_lib->add_field('custom', 'p');
			    $this->paypal_lib->add_field('invoice', $order->id);
			    $this->paypal_lib->add_field('item_number', $order->id);
				$_money = dollar($order->money);
				$_money += (round($_money*0.039,2)+0.3);
			    $this->paypal_lib->add_field('amount', $_money);
			    $this->paypal_lib->add_field('item_name', 'purchase fee');
			    $this->paypal_lib->paypal_auto_form();
			    return;
			}
		}
		else if ($type == 'd')
		{
			$this->load->model('taobao/taobao_order_mdl');
			$this->load->model('taobao/taobao_delivery_mdl');
			$order = $this->taobao_delivery_mdl->get_full_order_by_id($order_id);
			if ($order AND $order->uid == $GLOBALS['member']->uid AND ($order->status == DELIVERY_UNPAYED))
			{
				$this->paypal_lib->add_field('business', $taobao['api']['paypal_business']);
			    $this->paypal_lib->add_field('return', site_url('my/delivery/'.$order->id));
			    $this->paypal_lib->add_field('cancel_return', site_url('my/delivery/'.$order->id));
			    $this->paypal_lib->add_field('notify_url', site_url('pay/paypal/ipn'));
			    $this->paypal_lib->add_field('custom', 'd');
			    $this->paypal_lib->add_field('invoice', $order->id);
			    $this->paypal_lib->add_field('item_number', $order->id);
			    $_money = $order->service_fee + $order->tax_fee + $order->ship_fee;
			    $_money = dollar($_money);
				$_money += (round($_money*0.039,2)+0.3);
			    $this->paypal_lib->add_field('amount', $_money);
			    $this->paypal_lib->add_field('item_name', 'express,service,tax fee');
			    $this->paypal_lib->paypal_auto_form();
			    return;
			}	
		}
		$this->_message('Invalid Entry!');
	}
	
	public function _ipn_post()
	{
		if ($this->paypal_lib->validate_ipn()) 
		{
			$type = $this->paypal_lib->ipn_data['custom'];
			$order_id = isset($this->paypal_lib->ipn_data['invoice']) ? $this->paypal_lib->ipn_data['invoice'] : 0 ;
			if ($type == 'p')
			{
				$this->load->model('taobao/taobao_order_mdl');
				$order = $this->taobao_order_mdl->get_full_order_by_id($order_id);
				if ($order AND ($order->status == ORDER_UNPAYED))
				{
					if ($order->status == ORDER_UNPAYED)
					{
						$data['pay_from'] = 'paypal';
						$data['pay_from_bill'] = $this->paypal_lib->ipn_data['txn_id'];
						$data['status_time'] = $data['pay_status_time'] = now();
						$this->taobao_order_mdl->pay($order->id, $data);
					}
				}
			}
			else if ($type == 'd')
			{
				$this->load->model('taobao/taobao_delivery_mdl');
				$order = $this->taobao_delivery_mdl->get_full_order_by_id($order_id);
				if ($order AND ($order->status == DELIVERY_UNPAYED))
				{
					if ($order->status == DELIVERY_UNPAYED)
					{
						$data['pay_from'] = 'paypal';
						$data['pay_from_bill'] = $this->paypal_lib->ipn_data['txn_id'];
						$data['status_time'] = $data['pay_status_time'] = now();
						$this->taobao_delivery_mdl->pay($order->id, $data);
					}
				}
			}
			
		}
	}
}