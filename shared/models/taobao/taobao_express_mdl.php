<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_express_mdl extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_express($country = '', $express = '')
	{
		$express_row = $this->db->where('id', $country)->limit(1)->get('taobao_country')->row();
		if ( ! $express_row)
		{
			return FALSE;	
		}
		else
		{
			$return = @unserialize($express_row->express);
			if ($express == '')
			{
				return $return;
			}
			else
			{
				if ( ! isset($return[$express]))
				{
					return FALSE;	
				}
				return $return[$express];
			}
		}
	}

}