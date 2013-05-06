<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/taobao/taobao_controller.php';

class Setting extends Taobao_Controller
{

	public function __construct()
	{
		parent::__construct();	
	}

	public function api()
	{
		$this->load->model('taobao/taobao_api_mdl');
		$data['api'] = $this->taobao_api_mdl->get_api();
		$this->_template('taobao/setting_api', $data);
	}

	public function _api_post()
	{
		$this->load->model('taobao/taobao_api_mdl');
		$this->taobao_api_mdl->set_api();
		$this->_message("更新成功", 'taobao/setting/api', TRUE, ($this->input->get('tab') ? '?tab=' . $this->input->get('tab') : '' ));
	}
	
	public function email()
	{
		$this->load->model('taobao/taobao_email_tpl_mdl');
		$data['tpls'] = $this->taobao_email_tpl_mdl->get_tpls();
		$this->_template('taobao/setting_email', $data);
	}

	public function _email_post()
	{
		$this->load->model('taobao/taobao_email_tpl_mdl');
		$this->taobao_email_tpl_mdl->set_tpl();
		$this->_message("更新成功", 'taobao/setting/email', TRUE, ($this->input->get('tab') ? '?tab=' . $this->input->get('tab') : '' ));
	}
	
	public function category()
	{
		$this->load->model('taobao/taobao_category_mdl');
		$pid = $this->input->get('pid', TRUE, 0);
		$data['parent'] = $this->taobao_category_mdl->get_category($pid);
		$data['list'] = $this->taobao_category_mdl->get_categories($pid);
		$this->_template('taobao/category_list', $data);
	}

	public function _category_post()
	{
		$this->load->model('taobao/taobao_category_mdl');
		$this->taobao_category_mdl->set_category();
		$this->_message("保存成功", '', TRUE);
	}

	public function sync_category()
	{
		//$this->_template('taobao/category_sync');
		$this->_sync_category_post();
	}

	public function _sync_category_post()
	{
		$this->load->model('taobao/taobao_category_mdl');
		$this->taobao_category_mdl->sync_category($this->input->post('clear_first', TRUE));
		echo 'ok';
		return;
	}

	public function basic()
	{
		$this->load->model('taobao/taobao_setting_mdl');
		$data['setting'] = $this->taobao_setting_mdl->get_setting();
		$this->_template('taobao/setting_basic', $data);
	}

	public function _basic_post()
	{
		$this->load->model('taobao/taobao_setting_mdl');
		$this->taobao_setting_mdl->set_setting();
		$this->_message("更新成功", 'taobao/setting/basic', TRUE, ($this->input->get('tab') ? '?tab=' . $this->input->get('tab') : '' ));
	}
	
	public function view()
	{
		$this->load->model('taobao/taobao_view_setting_mdl');
		$data['setting'] = $this->taobao_view_setting_mdl->get_setting();
		$this->_template('taobao/setting_view', $data);
	}

	public function _view_post()
	{
		$this->load->model('taobao/taobao_view_setting_mdl');
		$this->taobao_view_setting_mdl->set_setting();
		$this->_message("更新成功", 'taobao/setting/view', TRUE, ($this->input->get('tab') ? '?tab=' . $this->input->get('tab') : '' ));
	}


}