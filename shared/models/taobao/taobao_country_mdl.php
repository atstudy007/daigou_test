<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_country_mdl extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_countries()
	{
		return $this->db->select('id,name_en AS name')->order_by('name_en', 'ASC')->get('taobao_country')->result();	
	}

	public function get_country($id = '')
	{
		return  $this->db->where('id', $id)->get('taobao_country')->row();
	}

	public function set_country()
	{
		$id = $this->input->post('id', TRUE);
		$data['express'] = serialize($this->input->post('express'));
		$this->db->where('id', $id)->update('taobao_country', $data);
		$this->cache_country();
	}

	public function cache_country()
	{
		$countries = $this->db->select('id, name_en')->order_by('name_en', 'ASC')->get('taobao_country')->result_array();
		$geo_country = array();
		foreach($countries as $v)
		{
			$geo_country[$v['id']] = $v['name_en']; 	
		}
		if ($this->platform->get_type() == 'default')
    	{
    		if ( ! file_exists(DILICMS_SHARE_PATH . 'settings/taobao'))
	    	{
	    		mkdir(DILICMS_SHARE_PATH . 'settings/taobao');
	    	}
    	}
		$this->platform->cache_write(DILICMS_SHARE_PATH . 'settings/taobao/country.php',
										 array_to_cache("geo_country", $geo_country)
										 );
	}

}