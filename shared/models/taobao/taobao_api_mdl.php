<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_api_mdl extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_api()
	{
		return $this->db->get('taobao_apis')->row();
	}

	public function set_api()
	{
		$data = $this->input->post();
		$this->db->update('taobao_apis', $data);
		$this->cache_api();		
	}

	public function cache_api()
	{
		$apis = $this->db->get('taobao_apis')->row_array();
		if ($this->platform->get_type() == 'default')
    	{
    		if ( ! file_exists(DILICMS_SHARE_PATH . 'settings/taobao'))
	    	{
	    		mkdir(DILICMS_SHARE_PATH . 'settings/taobao');
	    	}
    	}
		$this->platform->cache_write(DILICMS_SHARE_PATH . 'settings/taobao/api.php',
										 array_to_cache("taobao['api']", $apis)
										 );
	}

}