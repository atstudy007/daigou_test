<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/taobao/taobao_controller.php';

class Country extends Taobao_Controller
{

	public function __construct()
	{
		parent::__construct();	
	}
	
	public function express($country = '')
	{
		$this->load->model('taobao/taobao_country_mdl');
		$data['countries'] = $this->taobao_country_mdl->get_all_countries();
		$data['country'] = $this->taobao_country_mdl->get_country($country);
		$this->_template('taobao/country', $data);	
	}
	
	public function _express_post()
	{
		$this->load->model('taobao/taobao_country_mdl');
		$this->taobao_country_mdl->set_country();
		$this->_message('保存成功','',TRUE);
	}


}