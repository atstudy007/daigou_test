<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

if ( ! function_exists('dollar'))
{
	function dollar($cny)
	{
		return 	round($cny / $GLOBALS['taobao']['system']['rate'], 2);
	}
}

if ( ! function_exists('express_calculator'))
{
	function express_calculator($weight, $express_data)
	{
		$_E = $express_data;
		$_weight = ($weight - $_E['kg']) / $_E['kg'];
		if ($_weight < 0)
		{
			$_weight = 0;	
		}
		else
		{
			$_weight = ceil($_weight);	
		}
		return 	$_E['fee'] + $_E['extra'] * $_weight;
	}
}

if ( ! function_exists('get_credit_group'))
{
	function get_credit_group($credit)
	{
		$_E = array('name' => 'Member', 'discount' => 0);
		foreach ($GLOBALS['taobao']['credit']['level'] as $_level)
		{
			if ($credit >= $_level['min'] AND $credit <= $_level['max'])
			{
				$_E = $_level;
				break;	
			}
		}
		return $_E;
	}
}

if ( ! function_exists('get_page_offset'))
{
	function get_page_offset($limit = 10)
	{
		$_CI = & get_instance();
		$page = $_CI->input->get('page') ? $_CI->input->get('page') : 1;
		if ($page == 1)
		{
			$offset = 0;	
		}
		else
		{
			$offset = $limit * ($page - 1) + 1;	
		}
		return $offset;	
	}
}

if ( ! function_exists('get_service_fee'))
{
	function get_service_fee($calculate, $purchase_fee, $discount = 0)
	{
		if ($calculate)
		{
			$_fee = $purchase_fee * $GLOBALS['taobao']['system']['service'];
		}
		else
		{
			$_fee = $purchase_fee;	
		}
		if ($discount > 0)
		{
			$_fee *= $discount;
		}
		if ($_fee < $GLOBALS['taobao']['system']['service_min'])
		{
			return 	$GLOBALS['taobao']['system']['service_min'];
		}
		else
		{
			return $_fee;	
		}
	}
}

if ( ! function_exists('get_express_fee'))
{
	function get_express_fee($fee)
	{
		if ($fee < 12)
		{
			$fee = 12;	
		}
		return $fee;
		
	}
}