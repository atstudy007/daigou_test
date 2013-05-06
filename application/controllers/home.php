<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Home extends Taobao_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		include (DILICMS_SHARE_PATH . 'settings/taobao/country.php');
		$data['country'] = $geo_country;
		$this->load->model('taobao/taobao_item_mdl');
		$this->load->model('taobao/taobao_delivery_mdl');
		$data['sliders'] = $this->db->where('status', 1)->limit(5)->get('dili_u_m_slider')->result();
		$data['news'] = $this->db->select('title,create_time,id')->limit(5)->order_by('create_time', 'DESC')->get('dili_u_m_news')->result();
		$data['articles'] = $this->db->select('title,create_time,id')->limit(5)->order_by('create_time', 'DESC')->get('dili_u_m_articles')->result();
		$data['rates'] = $this->taobao_delivery_mdl->get_lastest_rates();
		$data['items_en'] = array();
		foreach ($GLOBALS['view']['index_hot'] as $_v)
		{
			$_v = explode('|', $_v);
			$data['items_en'][$_v[0]] = isset($_v[1]) ? $_v[1] :'';
		}
		$data['items'] = $this->taobao_item_mdl->get_list_items(implode(',', array_keys($data['items_en'])));
		$this->_template('home', $data);
	}
	
	function partners()
	{
		$this->_set_title('Partners');
		$this->_template('partners');	
	}
	
	function sitemap()
	{
		$this->_set_title('Sitemap');
		$this->_template('sitemap');		
	}
	
	function news($news_id = '')
	{
		if (preg_match("/^\d+$/", $news_id))
		{
			$data['news'] = $this->db->where('id', $news_id)->limit(1)->get('dili_u_m_news')->row_array();
			if ( ! $data['news']) {$this->_template('404');	return;}
			$this->_set_title($data['news']['title']);
			$this->_template('news/news_view', $data);	
		}
		else
		{
			$this->_set_title('News');
			$page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 1;
			if ($page == 1)
			{
				$offset = 0;	
			}
			else
			{
				$offset = 10 * ($page - 1) + 1;	
			}
			$total = $this->db->count_all_results('dili_u_m_news');
			$data['news'] = $this->db->select('title,create_time,id')->limit(10)->offset($offset)->order_by('create_time', 'DESC')->get('dili_u_m_news')->result();
			$data['pagination'] = $this->_multi_pages(10, $total,  site_url('news'));
			$this->_template('news/news_list', $data);
		}
	}
	
	function article($article_id = '')
	{
		if (preg_match("/^\d+$/", $article_id))
		{
			$data['article'] = $this->db->where('id', $article_id)->limit(1)->get('dili_u_m_articles')->row_array();
			if ( ! $data['article']) {$this->_template('404');	return;}
			$this->_set_title($data['article']['title']);
			$this->_template('article/article_view', $data);	
		}
		else
		{
			$this->_set_title('Articles');
			$page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 1;
			if ($page == 1)
			{
				$offset = 0;	
			}
			else
			{
				$offset = 10 * ($page - 1) + 1;	
			}
			$total = $this->db->count_all_results('dili_u_m_articles');
			$data['articles'] = $this->db->select('title,create_time,id')->limit(10)->offset($offset)->order_by('create_time', 'DESC')->get('dili_u_m_articles')->result();
			$data['pagination'] = $this->_multi_pages(10, $total,  site_url('article'));
			$this->_template('article/article_list', $data);
		}
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