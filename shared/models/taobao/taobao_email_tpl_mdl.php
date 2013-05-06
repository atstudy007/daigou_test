<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_email_tpl_mdl extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_tpls()
	{
		return $this->db->get('taobao_email_tpls')->result_array();
	}
	
	public function get_tpl($k)
	{
		if ($this->platform->get_type() == 'default')
    	{
    		if ( ! file_exists(DILICMS_SHARE_PATH . 'settings/taobao/email_tpls/'.$k.'.html'))
	    	{
	    		$this->cache_tpl();		
	    	}
    	}
		return $this->platform->file_read(DILICMS_SHARE_PATH . 'settings/taobao/email_tpls/'.$k.'.html');
	}

	public function set_tpl()
	{
		$data = $this->input->post();
		foreach ($data as $k=>$v)
		{
			$this->db->where('k', $k)->set('v', $v)->update('taobao_email_tpls');
		}
		$this->cache_tpl();	
	}
	
	
	
	public function cache_tpl()
	{
		$tpls = $this->db->get('taobao_email_tpls')->result_array();
		if ($this->platform->get_type() == 'default')
    	{
    		if ( ! file_exists(DILICMS_SHARE_PATH . 'settings/taobao/email_tpls'))
	    	{
	    		mkdir(DILICMS_SHARE_PATH . 'settings/taobao/email_tpls');
	    	}
    	}
		foreach ($tpls as $tpl)
		{
			$this->platform->file_write(DILICMS_SHARE_PATH . 'settings/taobao/email_tpls/'.$tpl['k'].'.html', $tpl['v']);	
		}
	}

}