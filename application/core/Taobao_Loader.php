<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
class Taobao_Loader extends CI_Loader
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function switch_theme($theme = 'default')
	{
		$this->_ci_view_paths = array(FCPATH . 'templates/' . $theme . '/'	=> TRUE);
	}

}