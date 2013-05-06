<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trade extends Taobao_Controller {

	function __construct()
	{
		parent::__construct();
		! $GLOBALS['member'] && redirect('member/login');	
	}
	
	function confirm($orderid = 0)
	{
		$this->load->model('taobao/taobao_delivery_mdl');
		$order = $this->taobao_delivery_mdl->get_order_by_id($orderid);
		if($order && $order->status == DELIVERY_SHIPMENT_DONE)
		{
			$this->taobao_delivery_mdl->finish($orderid);
		}
		redirect(site_url('my/delivery/'.$orderid).'#rate');
	}
	
	function _rate_post($orderid = 0)
	{
		$this->load->model('taobao/taobao_delivery_mdl');
		$order = $this->taobao_delivery_mdl->get_order_by_id($orderid);
		if($order && $order->status == DELIVERY_CONFIRMED)
		{
			$this->taobao_delivery_mdl->rate($orderid);
		}
		redirect('my/deliveries');
	}
			
	function  cancel($type = 'p', $orderid = 0)
	{
		if ($type == 'p')
		{
			$this->load->model('taobao/taobao_order_mdl');
			$order = $this->taobao_order_mdl->get_order_by_id($orderid);
			if($order && $order->status == ORDER_UNPAYED)
			{
				$this->taobao_order_mdl->canceling($orderid);
			}
			redirect('my/orders');
		}
		else if ($type == 'd')
		{
			$this->load->model('taobao/taobao_delivery_mdl');
			$order = $this->taobao_delivery_mdl->get_order_by_id($orderid);
			if($order && $order->status == DELIVERY_UNPAYED)
			{
				$this->taobao_delivery_mdl->canceling($orderid);
			}
			redirect('my/deliveries');
		}
	}
	
	function checkout()
	{
		$this->load->model('taobao/taobao_order_mdl');
		$this->load->model('taobao/taobao_cart_mdl');
		$this->load->model('taobao/taobao_item_mdl');
		$checkout = $this->taobao_cart_mdl->checkout();
		if($checkout['total'] > 0)
		{
			if(!$checkout['can_buy'])
			{
				redirect('my/cart');
			}
			else
			{
				$this->load->model('taobao/taobao_order_mdl');
				//生成新订单，并转到我的订单页面
				if($order_id = $this->taobao_order_mdl->create($checkout))
				{
					redirect('my/orders');
				}
				else
				{
					redirect('my/cart');
				}
			}
		}
		else
		{
			redirect('my/cart');
		}
		$this->_template('cart',$data);
	}
	
	function  _delivery_post($confirmed = '')
	{
		$this->load->model('taobao/taobao_order_mdl');
		//检查是否有订单号进来
		$orders = $this->input->post('order', TRUE);
		$country = $this->input->post('country', TRUE);
		$express = $this->input->post('express', TRUE);
		if (is_array($orders) AND $orders)
		{
		//检查订单号状态是否合法
			if ($this->taobao_order_mdl->check_status($orders))
			{
				//获取所选择国家和物流公司对应的快递信息
				$this->load->model('taobao/taobao_express_mdl');
				$express_data = $this->taobao_express_mdl->get_express($country, $express);
				if ( ! $express_data OR ($express_data['fee'] == 0 AND $express_data['extra'] == 0))
				{
					$this->nsession->set_flashdata('msg', 'This express vendor you selected is out of service or can’t reach, please try another!');		
				}
				else
				{
					$_orders = array();
					$_weight = 0;
					$_money = 0;
					//检查合并的订单是否超重，如果要合并的订单超重则不允许合并，单个订单超重则自动分解订单
					foreach ($orders as $order)
					{
						$_order = $this->taobao_order_mdl->get_full_order_by_id($order);
						$_weight += $_order->weight;
						$_money += $_order->money;
						array_push($_orders, $_order);
					}
					if (count($_orders) > 1 AND $_weight > $express_data['max'])
					{
						$this->nsession->set_flashdata('msg', 'Selected Orders can not delivery together due to weight');	
					}
					else
					{
						//开始准备呈现的数据
						$data['orders'] = $_orders;
						$data['express'] = $express;
						$data['country'] = $country;
						$data['express_data'] = $express_data;
						$data['weight'] = $_weight;
						$data['money'] = $_money;
						//1.获取用户收货信息
						$this->load->model('taobao/taobao_logistic_mdl');
						include (DILICMS_SHARE_PATH . 'settings/taobao/country.php');
						$data['countries'] = $geo_country;
						$data['logistics'] = $this->taobao_logistic_mdl->get_logistic_by_uid($GLOBALS['member']->uid);
						//2.如果超重则拆分重量
						$data['overweight'] = ($_weight > $express_data['max'] ? 1 : 0);
						$data['detail'] = array();
						$data['detail_money'] = 0;
						if ($data['overweight'])
						{
							$_cut_num = floor($_weight / $express_data['max']);
							for ($i = 1; $i <= $_cut_num; $i++)
							{
								$data['detail'][] = $express_data['max'];
								$data['detail_money'] += express_calculator($express_data['max'], $express_data);
							}
							if ($_weight > $express_data['max'] * $_cut_num)
							{
								$_w = ($_weight - $express_data['max'] * $_cut_num);
								$data['detail'][] = $_w;
								$data['detail_money'] += express_calculator($_w, $express_data);
							}
						}
						else
						{
							$data['detail_money'] = express_calculator($_weight, $express_data);	
						}
						//检查此人是否被邀请且首次消费
						$data['is_first_service_discount'] = FALSE;
						if ($GLOBALS['member']->inviter_uid)
						{
							$this->load->model('taobao/taobao_inviter_mdl');
							$relation = $this->taobao_inviter_mdl->get_relation('uid', $GLOBALS['member']->uid);
							if ($relation)
							{
								if ($relation->first_service_discount == 0)
								{
									$data['is_first_service_discount'] = TRUE;
								}
							}
						}
						
						if ($confirmed == '')
						{
							$this->_template('member/delivery_confirm', $data);
							return;
						}
						else
						{
							//判断提交的地址中的国家是否和所选国家一致
							$_logistic = $this->input->post('logistics', TRUE);
							if ($_logistic == 'new')
							{
								$data['logistic']->country = $country;
								$data['logistic']->name = $this->input->post('logistics_name', TRUE);
								$data['logistic']->state = $this->input->post('logistics_state', TRUE);
								$data['logistic']->city = $this->input->post('logistics_city', TRUE);
								$data['logistic']->phone = $this->input->post('logistics_phone', TRUE);
								$data['logistic']->address = $this->input->post('logistics_address', TRUE);
								$data['logistic']->postcode = $this->input->post('logistics_postcode', TRUE);
								//添加到收货列表
								$_POST['logistics_country'] = $country;
								$this->taobao_logistic_mdl->add_logistic();
							}
							else
							{
								if ( ! $_logistic OR ! $data['logistic'] = $this->taobao_logistic_mdl->get_logistic_by_id($_logistic))
								{
									$data['msg'] =  'Please select address!';
									$this->_template('member/delivery_confirm', $data);
									return;
								}
								else
								{
									if ($data['logistic']->country != $country)
									{
										$data['msg'] =  'the country you selected does not match the one in your address!';	
										$this->_template('member/delivery_confirm', $data);
										return;
									}
								}
							}
							//写入数据了
							$data['orders_string'] = $orders;
							$this->load->model('taobao/taobao_delivery_mdl');
							if ($_d_id = $this->taobao_delivery_mdl->create($data))
							{
								redirect('my/delivery/'.$_d_id);
							}
							else
							{
								$this->nsession->set_flashdata('msg', 'Unkown error!');	
							}
						}
					}
				}
			}
			else
			{
				$this->nsession->set_flashdata('msg', 'Please select orders with Arrived status to delivery!');	
			}
		
		}
		else
		{
			$this->nsession->set_flashdata('msg', 'Please select orders to delivery!');
		}
		redirect('my/orders');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */