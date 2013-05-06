<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

if ( ! class_exists('Taobao_Model'))
{
	require_once DILICMS_SHARE_PATH . 'models/taobao/taobao_api_model.php';
}

class Taobao_item_mdl extends Taobao_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_item_simple($id = 0)
	{
		$request = new ItemGetRequest();
		$request->setFields("num_iid,num,title,pic_url,price,express_fee,detail_url,nick");
		$request->setNumIid($id);
		$response = $this->client->execute($request);
		if (isset($response->item))
		{
			$response->item->express_fee = get_express_fee($response->item->express_fee);
			$response->item->taobaoke = $this->convert_taobaoke_item($id);
			if ( ! isset($response->item->taobaoke->click_url))
			{
				$response->item->taobaoke->click_url = 	$response->item->detail_url;
			}
			return $response->item;
		}
		return FALSE;
	}
	
	public function get_category_sequence($cid = 0)
	{
		$bread = array();
		$cate = $this->db->where('cid', $cid)->limit(1)->get('taobao_category')->row_array();
		while ($cate AND $cate['level'] > 0)
		{
			array_unshift($bread, $cate);
			$cate = $this->db->where('cid', $cate['parent_cid'])->limit(1)->get('taobao_category')->row_array();		
		}
		return $bread;
	}
	
	public function get_item($id = 0, $with_shop = TRUE)
	{
		$request = new ItemGetRequest();
		$request->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual,props_name");
		$request->setNumIid($id);
		$response = $this->client->execute($request);
		if (isset($response->item) AND $response->item)
		{
			$response->item->express_fee = get_express_fee($response->item->express_fee);
			if ($with_shop)
			{
				$response->item->shop = $this->get_shop($response->item->nick);
				$response->item->shop_items = $this->get_shop_items(array('Nicks'=>$response->item->nick), 10, 1);
			}
			$response->item->taobaoke = $this->convert_taobaoke_item($id);
			$response->item->category_sequence = $this->get_category_sequence($response->item->cid);
			$response->item->dealt_property = FALSE;
			if ( ! isset($response->item->skus->sku))
			{
				$skus = array();	
			}
			else
			{
				$skus = $response->item->skus->sku;
			}
			$response->item->skus = $skus;
			$response->item->dealt_property = $this->get_sku($response->item->props, $response->item->props_name, $response->item->property_alias, $skus);
			return $response->item;
		}
		return FALSE;
	}
	
	public function convert_taobaoke_item($id = 0)
	{
		$request = new TaobaokeItemsDetailGetRequest();
		$request->setFields("click_url,shop_click_url");
		$request->setNumIids("$id");
		//$request->setPid($this->_api['taobao_pid']);
		$request->setNick($this->_api['taobao_nick']);
		$response = $this->client->execute($request);
		if (isset($response->total_results) AND $response->total_results == 1)
		{
			if (isset($response->taobaoke_item_details->taobaoke_item_detail[0]))
			{
				return 	$response->taobaoke_item_details->taobaoke_item_detail[0];
			}
		}
		return false;
	}
	
	public function get_shop($nick = '')
	{
		$request = new UserGetRequest();
		$request->setFields("user_id,uid,nick,sex,buyer_credit,seller_credit,location,created,last_visit,birthday,type,status,alipay_no,alipay_account,alipay_account,email,consumer_protection,alipay_bind");
		$request->setNick($nick);
		$response_user = $this->client->execute($request);
		$response->shop　= FALSE;
		if (isset($response_user->user) AND $response_user->user)
		{
			$response->shop = $response_user->user;
		}
		return $response->shop;
	}
	
	public function get_list_items($ids = '')
	{
		if (is_array($ids))
		{
			$ids = implode(',', $ids);	
		}
		if (substr_count($ids, ',') > 19)
		{
			return array();	
		}
		$request = new TaobaokeItemsConvertRequest();
		//$request->setPid($this->_api['taobao_pid']);
		$request->setNick($this->_api['taobao_nick']);
		$request->setFields("num_iid,title,nick,pic_url,price,click_url,commission,ommission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume");
		$request->setNumIids($ids);
		$response = $this->client->execute($request);
		if (isset($response->taobaoke_items) AND $response->taobaoke_items->taobaoke_item)
		{
			return $response->taobaoke_items->taobaoke_item;
		}
		return array();
	}
	
	public function get_shop_items($condition =  array(), $limit = 0, $page = 0)
	{
		$request = new ItemsGetRequest();
		$request->setFields("num_iid,title,nick,pic_url,cid,price,type,delist_time,post_fee,score,volume,num");
		foreach ($condition as $k => $v)
		{
			if ($k == 'StartPrice' || $k == 'EndPrice')
			{
				$v = round($v * $GLOBALS['taobao']['system']['rate'], 0);
			}
			$k = 'set' . $k;
			$request->{$k}($v);	
		}
		$request->setPageNo($page);
		$request->setPageSize($limit);
		//$request->setStartScore($GLOBALS['taobao']['taobao']['startscore']);
		//$request->setEndScore($GLOBALS['taobao']['taobao']['endscore']);
		$response = $this->client->execute($request);
		return $response;
	}
	
	public function get_items($condition =  array(), $limit = 0, $page = 0)
	{
		$request = new TaobaokeItemsGetRequest();
		$request->setFields("num_iid,title,nick,pic_url,cid,price,type,delist_time,post_fee,score,volume,num");
		foreach ($condition as $k => $v)
		{
			if ($k == 'StartPrice' || $k == 'EndPrice')
			{
				$v = round($v * $GLOBALS['taobao']['system']['rate'], 0);
			}
			$k = 'set' . $k;
			$request->{$k}($v);	
		}
		if ( ! isset($condition['Sort']))
		{
			//$request->setSort('commissionRate_desc');	
			$request->setSort('commissionNum_desc');	
		}
		//$request->setPid($this->_api['taobao_pid']);
		$request->setNick($this->_api['taobao_nick']);
		$request->setPageNo($page);
		$request->setPageSize($limit);
		if ( ! isset($condition['StartCredit']) OR  ! isset($condition['EndCredit']))
		{
			$request->setStartCredit($GLOBALS['taobao']['taobao']['startscore']);
			$request->setEndCredit($GLOBALS['taobao']['taobao']['endscore']);
		}
		$request->setStartCommissionRate($GLOBALS['taobao']['taobao']['startcommission']);
		$request->setEndCommissionRate($GLOBALS['taobao']['taobao']['endcommission']);
		$response = $this->client->execute($request);
		return $response;
	}
	
	public function hot_items($condition =  array(), $limit = 0, $page = 0)
	{
		$request = new TaobaokeItemsGetRequest();
		$request->setFields("num_iid,title,nick,pic_url,cid,price,type,delist_time,post_fee,score,volume,num");
		foreach ($condition as $k => $v)
		{
			if ($k == 'StartPrice' || $k == 'EndPrice')
			{
				$v = round($v * $GLOBALS['taobao']['system']['rate'], 0);
			}
			$k = 'set' . $k;
			$request->{$k}($v);	
		}
		//$request->setPid($this->_api['taobao_pid']);
		$request->setNick($this->_api['taobao_nick']);
		$request->setPageNo($page);
		$request->setPageSize($limit);
		$request->setSort('commissionNum_desc');
		if ( ! isset($condition['StartCredit']) OR  ! isset($condition['EndCredit']))
		{
			$request->setStartCredit($GLOBALS['taobao']['taobao']['startscore']);
			$request->setEndCredit($GLOBALS['taobao']['taobao']['endscore']);
		}
		$request->setStartCommissionRate($GLOBALS['taobao']['taobao']['startcommission']);
		$request->setEndCommissionRate($GLOBALS['taobao']['taobao']['endcommission']);
		$response = $this->client->execute($request);
		return $response;
	}
	
	public function search_items($condition =  array(), $limit = 0, $page = 0)
	{
		/*$request = new TaobaokeItemsGetRequest();
		$request->setFields("num_iid,title,nick,pic_url,cid,price,type,delist_time,post_fee,score,volume,num");
		foreach ($condition as $k => $v)
		{
			if ($k == 'StartPrice' || $k == 'EndPrice')
			{
				$v = round($v * $GLOBALS['taobao']['system']['rate'], 0);
			}
			$k = 'set' . $k;
			$request->{$k}($v);	
		}
		$request->setPid($this->_api['taobao_pid']);
		$request->setNick($this->_api['taobao_nick']);
		$request->setPageNo($page);
		$request->setPageSize($limit);
		if ( ! isset($condition['StartCredit']) OR  ! isset($condition['EndCredit']))
		{
			$request->setStartCredit($GLOBALS['taobao']['taobao']['startscore']);
			$request->setEndCredit($GLOBALS['taobao']['taobao']['endscore']);
		}
		$request->setStartCommissionRate($GLOBALS['taobao']['taobao']['startcommission']);
		$request->setEndCommissionRate($GLOBALS['taobao']['taobao']['endcommission']);
		$response = $this->client->execute($request);
		return $response;*/
		$request = new TaobaokeListurlGetRequest();
		$request->setQ($condition['Q']);
		$request->setNick($this->_api['taobao_nick']);
		$response = $this->client->execute($request);
		if (isset($response->taobaoke_item->keyword_click_url))
		{
			return 	$response->taobaoke_item->keyword_click_url;
		}
		else
		{
			return 'false';	
		}
	}
	
	private function  get_sku($props = '', $props_name = '', $property_alias = '', $skus)
	{
		 $props_a = $props ? explode(";", $props) : array();   
		 $props_name_a = $props_name ? explode(";", $props_name) : array();
		 $property_alias_a = $property_alias ? explode(";", $property_alias) : array();        
		 foreach($props_a as  $p=>$prop)
		 {   
			foreach($property_alias_a as  $a=>$alia)
			{ 
					if(strpos($alia, $prop)!==false)
					{   
						$tmp=str_replace($prop.':','',$alia);   
						$props_name_a[$p]=preg_replace('/(.*):(.*):(.*):(.*)/','$1:$2:$3:'.$tmp, $props_name_a[$p]);        
				   }   
			}   
		  }
		  
		  $props_view = array();  
		  foreach ($props_name_a as $v)
		  {
			 $v = explode(':', $v);
			 if (array_key_exists($v[0], $props_view))
			 {
				$props_view[$v[0]]['values'][] = $v[3]; 
			 }
			 else
			 {
				$props_view[$v[0]] = array('name'=>$v[2], 'values'=>array($v[3])); 
			 }
		  }
			
		 //提取sku销售属性里面的颜色和尺码   
		 $color=array();   
		 $chima=array();    
		 foreach($skus as $t){   
		  if($t->quantity > 0){   
		   $split_sku=explode(';', $t->properties);      
		   foreach($split_sku as $sku0){    
			foreach($props_name_a as $prop_a){   
			 if(strpos($prop_a,$sku0)!==false){   
			  $tmp=str_replace($sku0.':','',$prop_a);         
			  $tmp = explode(':', $tmp);
			  if(strpos($sku0,'1627207:')!==false){   
			   $color[$sku0]=$tmp[1];   
			  }else{   
			   $chima[$sku0]=$tmp[1];   
			  }   
			 }   
			}   
				
		   }    
		  }   
		 }    
		 $color = array_flip(array_flip($color)); //去除重复项   
		 $chima = array_flip(array_flip($chima)); //去除重复项    
		 return  array('color'=>$color,'size'=>$chima,'view'=>$props_view);    
	}

}