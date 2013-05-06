<?php
	class Taobao_cart_mdl extends CI_Model
	{		
		function __construct()
		{
			parent::__construct();	
		}

		function get_product($id,$qty)
		{

			$info = $this->taobao_item_mdl->get_item_simple($id);
			if($info){
				$info->can_buy = false;
				$info->_cash = $info->price * $qty;

				$info->can_buy =  $info->num >=  $qty ? TRUE : FALSE ;
			}
			else
			{
				$info->can_buy = false;	
			}
			return $info;

		}

		

		function checkout()

		{

			$data['total'] = $this->ncart->total_items();

			$data['total_cash'] = 0;

			$data['can_buy'] = TRUE;

			$data['can_qty_buy'] = TRUE;

			$data['sellers'] = array();

			if($data['total'] > 0)

			{

				$data['cart'] = $this->ncart->contents();

				foreach($data['cart'] as $k => $v)

				{

					$data['cart'][$k]['info'] = $this->get_product($data['cart'][$k]['id'], $data['cart'][$k]['qty']);

					if( ! $data['cart'][$k]['info']->can_buy)

					{

						$data['can_buy'] = false;	

					}

					$data['total_cash'] += $data['cart'][$k]['info']->_cash;

					if (in_array($data['cart'][$k]['info']->nick,array_keys($data['sellers'])))

					{

						array_push($data['sellers'][$data['cart'][$k]['info']->nick]['rows'], $k);

						

						if ($data['sellers'][$data['cart'][$k]['info']->nick]['express_fee'] < $data['cart'][$k]['info']->express_fee)

						{

							$data['sellers'][$data['cart'][$k]['info']->nick]['express_fee'] = $data['cart'][$k]['info']->express_fee;

						}

					}

					else

					{

						$data['sellers'][$data['cart'][$k]['info']->nick] = array('name'=>$data['cart'][$k]['info']->nick, 'express_fee'=>$data['cart'][$k]['info']->express_fee, 'rows' => array($k));	

					}

					$data['cart'][$k]['options'] = implode('-', $data['cart'][$k]['options']);

				}

				foreach ($data['sellers'] as $seller)

				{

					$data['total_cash'] += $seller['express_fee'];	

				}

			}

			return $data;	

		}

		

	}