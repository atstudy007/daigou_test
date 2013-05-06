<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Company extends Taobao_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	private function _about()
	{
		$this->_set_title('About Us');
		$this->_init_page('about');
	}
	
	private function _term_of_service()
	{
		$this->_set_title('Terms of Service');
		$this->_init_page('term-of-service');
	}
	
	private function _contact()
	{
		$this->_set_title('Contact Us');
		$this->_init_page('contact');
	}
	
	private function _init_page($uri = '')
	{
		$data['alias'] = $uri;
		$data['left'] = array(
							'about' => 'About Us',
							'contact' => 'Contact Us',
							'term-of-service' => 'Term of Service'
						);
		$data['content'] = $this->db->where('title', $uri)->limit(1)->get('dili_u_m_company')->row();
		$data['seo_title'] = $data['left'][$uri];
		$this->_template('guide/company_view', $data);
	}
	
	public function _remap($method, $params = array())
	{
		$method = '_'.str_replace("-", "_", $method);
		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $params);
		}
		$this->_template('404');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */