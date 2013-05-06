<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_Controller extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->acl->filter_left_menus('taobao/setting/api', 3, 'taobao/');
		$this->settings->load('taobao/settings');
		$GLOBALS['taobao'] = setting('taobao'); 
		$this->load->helper('taobao_helper');
	}

	protected function _check_permit($action = '')
	{
		parent::_check_permit($action, 'taobao/');
	}
}