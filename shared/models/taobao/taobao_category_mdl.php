<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

if ( ! class_exists('Taobao_Model'))
{
	require_once DILICMS_SHARE_PATH . 'models/taobao/taobao_api_model.php';
}

class Taobao_category_mdl extends Taobao_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_category($pid = 0)
	{
		return $this->db->where('cid', $pid)->get('taobao_category')->row_array();
	}

	public function get_categories($pid = 0)
	{
		return $this->db->where('parent_cid', $pid)
						->order_by('is_show', 'DESC')
						->order_by('order', 'ASC')
						->get('taobao_category')
						->result_array();
	}

	public function set_category($data = array())
	{
		if ( ! $data)
		{
			$data = $this->input->post();
		}
		$cid = $data['cid'];
		unset($data['cid']);
		$this->db->where('cid', $cid)->update('taobao_category', $data);
		$this->cache_category();
	}
	
	public function get_category_property($cid)
	{
		$request = new ItempropsGetRequest();
		$request->setFields("pid,name,must,multi,prop_values");
		$request->setCid($cid);
		$request->setIsEnumProp("true");
		$request->setIsItemProp("false");
		$response = $this->client->execute($request);
		return $response;
	}
	
	public function cache_category()
	{
		$category['relations'] = $this->db
						 ->select('cid')
						 ->where('parent_cid', 0)
						 ->where('is_show', 1)
						 ->order_by('order', 'ASC')
						 ->get('taobao_category')
						 ->result_array();
		foreach ($category['relations'] as $_k => & $_v)
		{
			$_v['children'] = array();
			$children = $this->db
							 ->select('cid')
							 ->where('parent_cid', $_v['cid'])
							 ->where('is_show', 1)
							 ->order_by('order', 'ASC')
							 ->get('taobao_category')
							 ->result_array();
			foreach($children as $child)
			{
				$_v['children'][] = $child['cid'];
			}
		}
		$category_temp = $this->db
						 ->select('cid, name_en')
						 ->get('taobao_category')
						 ->result_array();
		$category['all'] = array();
		foreach ($category_temp as $temp )
		{
			$category['all'][$temp['cid']] = $temp['name_en'];
		}
		unset($category_temp);
		if ($this->platform->get_type() == 'default')
    	{
    		if ( ! file_exists(DILICMS_SHARE_PATH . 'settings/taobao'))
	    	{
	    		mkdir(DILICMS_SHARE_PATH . 'settings/taobao');
	    	}
    	}
		$this->platform->cache_write(DILICMS_SHARE_PATH . 'settings/taobao/category.php',
										 array_to_cache("taobao['category']", $category)
										 );
	}

	//同步栏目
	public function sync_category($clear_first = FALSE)
	{
		error_reporting(E_ALL);
		set_time_limit(0);
		if ($clear_first)
		{
			$this->db->where('cid >', 0)->delete('taobao_category');
		}
		$request = new ItemcatsGetRequest();
		$request->setFields("cid, parent_cid, name");
		$request->setParentCid(0);
		$response = $this->client->execute($request);
		if (isset($response->item_cats->item_cat))
		{	
			foreach ($response->item_cats->item_cat as $cat)
			{
				$cat->level = 1;
				$this->db->replace('taobao_category', $cat);
				$request->setFields("cid, parent_cid, name");
				$request->setParentCid($cat->cid);
				$response2 = $this->client->execute($request);
				if (isset($response2->item_cats) AND isset($response2->item_cats->item_cat))
				{
					foreach ($response2->item_cats->item_cat as $cat2)
					{
						$cat2->level = 2;
						$this->db->replace('taobao_category', $cat2);
						$request->setFields("cid, parent_cid, name");
						$request->setParentCid($cat2->cid);
						$response3 = $this->client->execute($request);
						if (isset($response3->item_cats) AND isset($response3->item_cats->item_cat))
						{
							foreach ($response3->item_cats->item_cat as $cat3)
							{
								$cat3->level = 3;
								$this->db->replace('taobao_category', $cat3);
								$request->setFields("cid, parent_cid, name");
								$request->setParentCid($cat3->cid);
								$response4 = $this->client->execute($request);
								if (isset($response4->item_cats) AND isset($response4->item_cats->item_cat))
								{
									foreach ($response4->item_cats->item_cat as $cat4)
									{
										$cat4->level = 4;
										$this->db->replace('taobao_category', $cat4);
									}
								}
							}
						}
					}
				}
			}
		}
	}

}