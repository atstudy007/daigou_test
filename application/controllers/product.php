<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Product extends Taobao_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function shop($nick = '')
	{
		! $nick AND redirect();
		$nick = urldecode($nick);
		$this->load->model('taobao/taobao_item_mdl');
		$page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 1;
		$data['provider'] = $this->taobao_item_mdl->get_shop_items(array('Nicks'=>$nick), 16, $page);
		$data['provider']->shop = $this->taobao_item_mdl->get_shop($nick);
		if ( ! isset($data['provider']->total_results))
		{
			$data['provider']->total_results = 0;
		}
		$data['pagination'] = $this->_multi_pages(16, $data['provider']->total_results, site_url('shop/'.urlencode($nick)));
		$this->_set_title($nick . '\'s Shop');
		$this->_template('shop_items', $data);	
	}
	
	public function _quick_post()
	{
		$url = $this->input->post('url', TRUE);
		if (preg_match("/id=(\d{10,})/", $url, $result))
		{
			$iid = $result[1];
			redirect('item/'.$iid);
		}
		else
		{
			$this->_set_title('Error');
			$this->_message('Sorry, Can not find the product!');	
		}
	}
	
	public function item($iid)
	{
		$this->load->model('taobao/taobao_item_mdl');
		$data['item'] = $this->taobao_item_mdl->get_item($iid);
		! $data['item']  AND $this->_message('Sorry, Can not find the product!');
		$this->_set_title($data['item']->title);
		$this->_template('item', $data);
	}
	
	public function category($cid = '')
	{
		$search['Cid'] = $cid;
		$search['Cid'] == '' AND $this->_message('Invalid Request!');
		//$this->_filter_args($search);
		$search['Props'] = $this->input->get('Props', TRUE);
		if ($search['Props'] == '')
		{
			unset($search['Props']);	
		}
		$page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 1;
 		$this->load->model('taobao/taobao_item_mdl');
		$this->load->model('taobao/taobao_category_mdl');
		$data['search'] = $search;
		$data['property'] = $this->taobao_category_mdl->get_category_property($cid);
		$data['provider'] = $this->taobao_item_mdl->get_items($search, 32, $page);
		$data['top10'] = $this->taobao_item_mdl->hot_items(array('Sort'=>'commissionRate_desc', 'Keyword'=>'热卖'), 10);
		if ( ! isset($data['provider']->total_results))
		{
			$data['provider']->total_results = 0;
		}
		$data['pagination'] = $this->_multi_pages(32, $data['provider']->total_results, site_url('category/'.$cid), $search);
		if (isset($data['search']['Props']))
		{
			$data['search']['Props'] = explode(';', $data['search']['Props']);
		}
		$this->_set_title($GLOBALS['category']['all'][$cid]);
		$this->_template('category_items', $data);
	}
	
	public function hot()
	{
		$permitted_limits = array(1=>16, 2=>32, 3=>48);
		$limit = $this->input->get('page_limits', TRUE);
		if ( ! in_array($limit, $permitted_limits))
		{
			$limit = 32;	
		}
		$page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 1;
 		$this->load->model('taobao/taobao_item_mdl');
		$search = array('Sort'=>'commissionNum_desc', 'Keyword'=>'热卖');
		$data['provider'] = $this->taobao_item_mdl->hot_items($search, $limit, $page);
		$data['top10'] = $this->taobao_item_mdl->hot_items(array('Sort'=>'commissionRate_desc', 'Keyword'=>'热卖'), 10);
		if ( ! isset($data['provider']->total_results))
		{
			$data['provider']->total_results = 0;
		}
		$data['pagination'] = $this->_multi_pages(12, $data['provider']->total_results, site_url('hot'), array('page_limits'=>$limit));
		$this->_set_title('Hot Products');
		$this->_template('hot', $data);
	}
	
	public function search()
	{
		/*$search['Keyword'] = $this->input->get('Keyword', TRUE);
		$search['Keyword'] == '' AND $this->_message('Please set a keyword to search!');
		$search['Cid'] = $this->input->get('Cid', TRUE);
		if ($search['Cid'] == '' OR $search['Cid'] == 'all')
		{
			unset($search['Cid']);	
		}
		$this->_filter_args($search);
		$page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 1;
 		$this->load->model('taobao/taobao_item_mdl');
		$data['search'] = $search;
		$data['provider'] = $this->taobao_item_mdl->search_items($search, 12, $page);
		if ( ! isset($data['provider']->total_results))
		{
			$data['provider']->total_results = 0;
		}
		$data['pagination'] = $this->_multi_pages(12, $data['provider']->total_results, site_url('search'), $search);
		$this->_template('search', $data);*/
		$search['Q'] = $this->input->get('Keyword', TRUE);
		if ( ! $search['Q'])
		{
			$this->_set_title('error');
			$this->_message('Please set a keyword to search!');
		}
		$this->load->model('taobao/taobao_item_mdl');
		$url = $this->taobao_item_mdl->search_items($search);
		if ($url != 'false')
		{
			$cid = $this->input->get('Cid', TRUE);
			if ($cid AND $cid != 'all')
			{
				$url .= '&cat='.$cid;	
			}
		}
		else
		{
			$this->_set_title('error');
			$this->_message('No data found!');	
		}
		redirect($url);
	}
	
	private function _filter_args(& $data)
	{
		$data['StartPrice'] = $this->input->get('StartPrice', TRUE);
		if ($data['StartPrice'] == '')
		{
			unset($data['StartPrice']);	
		}
		$data['EndPrice'] = $this->input->get('EndPrice', TRUE);
		if ($data['EndPrice'] == '')
		{
			unset($data['EndPrice']);	
		}
		$data['StartCredit'] = $this->input->get('StartCredit', TRUE);
		if ($data['StartCredit'] == '')
		{
			unset($data['StartCredit']);	
		}
		$data['EndCredit'] = $this->input->get('EndCredit', TRUE);
		if ($data['EndCredit'] == '')
		{
			unset($data['EndCredit']);	
		}
		$data['Sort'] = $this->input->get('Sort', TRUE);
		if ($data['Sort'] == '')
		{
			$data['Sort'] = 'credit_desc';
		}
		return $data;	
	}
	
	private function _multi_pages($per_page , $total , $base_url , $where = array())
	{
		$ci = & get_instance();
		$ci->load->library('pagination');
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = $per_page;
		$config['query_string_segment'] = 'page'; 
		$config['base_url'] = $base_url.'?{fix}';
		foreach($where as $key => $v)
		{
			$config['base_url'] .= '&' . $key . '=' . $v;	
		}
		$config['total_rows'] = $total;
		$ci->pagination->initialize($config); 
		$this->pagination->base_url = str_replace('{fix}&','',$this->pagination->base_url);
		return '<div class="pagination">'.str_replace('{fix}&','',$ci->pagination->create_links()).'</div>';	
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */