<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Guide extends Taobao_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->channel();
	}
	
	public function channel($alias = 'new-user')
	{
		$this->settings->load('category/data_guide');
		$data['guide'] = $this->settings->item('category');
		$permitted_alias = array('new-user'=>1, 'transportation'=>2, 'payment-and-charge'=>3 , 'shopping-guide'=>4, 'order-instruction'=>5,'customer-service'=>6, 'tools'=>7);
		if (! in_array($alias, array_keys($permitted_alias)))
		{
			 $this->_template('404');	
			 return;
		}
		$data['alias'] = $alias;
		$this->_set_title($data['guide']['guide'][$permitted_alias[$alias]]['name']);
		$data['list'] = $this->db->select('dili_u_m_guide.title,dili_u_m_guide.alias,dili_u_m_guide.type,dili_u_m_guide.url')
								  ->from('dili_u_m_guide')
								  ->join('dili_u_c_guide', 'dili_u_c_guide.classid = dili_u_m_guide.classid')
								  ->where('dili_u_c_guide.alias', $alias)
								  ->get()
								  ->result_array();
		$this->_template('guide/guide', $data);
	}
	
	public function view($alias = '')
	{
		$this->settings->load('category/data_guide');
		$data['guide'] = $this->settings->item('category');
		$data['article'] = $this->db->select('dili_u_m_guide.content,dili_u_m_guide.title,dili_u_c_guide.alias,dili_u_m_guide.type,,dili_u_m_guide.url')
								  ->from('dili_u_m_guide')
								  ->join('dili_u_c_guide', 'dili_u_c_guide.classid = dili_u_m_guide.classid')
								  ->where('dili_u_m_guide.alias', $alias)
								  ->get()
								  ->row_array();
		! $data['article'] && $this->_template('404');
		if ($data['article']['type'] != 1)
		{
			redirect($data['article']['url']);
		}
		else
		{
			$this->_set_title($data['article']['title']);
			$data['alias'] = $data['article']['alias'];
			$this->_template('guide/guide_view', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */