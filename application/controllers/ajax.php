<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Taobao_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function _favorite_post($action = 'add')
	{
		if ($action == 'add')
		{
			if($GLOBALS['member']){
				$this->load->model('taobao/taobao_favorite_mdl');
				$iid = $this->input->post('iid', TRUE);
				if($this->taobao_favorite_mdl->exists($iid, $GLOBALS['member']->uid) > 0)
				{
					echo '2';//收藏过了	
				}
				else
				{
					$this->taobao_favorite_mdl->add();
					echo '1';
				}
			}
			else
			{
				echo '0';	
			}
		}
		else if ($action == 'delete')
		{
			$this->load->model('taobao/taobao_favorite_mdl');
			$iid = $this->input->post('iid', TRUE);
			$this->taobao_favorite_mdl->delete($iid, $GLOBALS['member']->uid);
		}
	}
	
	
	function _add_cart_post()
	{
		$data = array(
               'id'      => $this->input->post('pid', TRUE),
               'qty'     => $this->input->post('qty', TRUE) ? $this->input->post('qty', TRUE) : 0,
               'options' => array(
			   					'color' => $this->input->post('color', TRUE),
			   					'size' => $this->input->post('size', TRUE)
								)
            );
		$this->ncart->insert($data);
	}
	
	function cart()
	{
		$this->load->model('taobao/taobao_item_mdl');
		$this->load->model('taobao/taobao_cart_mdl');
		$checkout = $this->taobao_cart_mdl->checkout();
		if( ! isset($checkout['cart']))
		{
			echo 'No items!';
		}
		else
		{
			echo '<ul class="allofitems clearfix">';
			foreach ($checkout['cart'] as $item)
			{
				echo '<li id="cart_'.$item['rowid'].'">';
                echo '<a href="'.site_url('item/'.$item['info']->num_iid).'"><img src="'.$item['info']->pic_url.'" width="60" height="60" /></a>';
                echo '<p class="title break"><a href="'.site_url('item/'.$item['info']->num_iid).'">'.$item['info']->title.'</a></p>';
                echo '<p class="price">Price:<b>$'.dollar($item['info']->price).'</b>&nbsp;Qty:<b>'.$item['qty'].'</b></p>';
                echo '<p class="bought"><a href="javascript:void(0);" onclick="del_cart(\''.$item['rowid'].'\',true);">delete</a></p>';
                echo '</li>';
			}
            echo '</ul>';
			echo '<p align="right"><span style="color:red;font-weight:bold">Total:$'.dollar($checkout['total_cash']).'</span>&nbsp;<a href="'.site_url('cart').'">View Cart</a></p>';
		}
	}
	
	function quick_del_cart()
	{
		$data = array(
               'rowid' => $this->input->get('rowid', TRUE),
               'qty'   => 0
            );
		$this->ncart->update($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */