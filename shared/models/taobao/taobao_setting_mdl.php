<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_setting_mdl extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_setting()
	{
		return  $this->db->get('taobao_settings')->row();
	}

	public function set_setting()
	{
		$data = $this->input->post();
		foreach ($data as $k => $v)
		{
			if (is_array($v))
			{
				$data[$k] = serialize($v);
			}
		}
		$this->db->update('taobao_settings', $data);
		$this->cache_setting();	
	}

	public function cache_setting()
	{
		$settings = $this->db->get('taobao_settings')->row_array();
		foreach ($settings as & $v)
		{
			$v = @unserialize($v);
		}
		if ($this->platform->get_type() == 'default')
    	{
    		if ( ! file_exists(DILICMS_SHARE_PATH . 'settings/taobao'))
	    	{
	    		mkdir(DILICMS_SHARE_PATH . 'settings/taobao');
	    	}
    	}
		$this->platform->cache_write(DILICMS_SHARE_PATH . 'settings/taobao/settings.php',
										 array_to_cache("setting['taobao']", $settings)
										 );
	}

}