<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

abstract class Taobao_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->switch_theme($this->settings->item('site_theme'));
		$this->settings->load('taobao/settings');
		
		include DILICMS_SHARE_PATH . 'settings/taobao/category.php';
		$GLOBALS['category'] = $taobao['category'];
		unset($taobao['category']);
		$GLOBALS['taobao'] = $this->settings->item('taobao');
		if ($this->uri->rsegment(1) == 'home' AND $this->uri->rsegment(2) == 'index')
		{
			$this->settings->load('taobao/view_settings');
			$GLOBALS['view'] = $this->settings->item('view');  
		}
		//获取所有faq
		$GLOBALS['footer_faq'] = $this->db->select('title,alias,classid')->order_by('classid', 'ASC')->get('dili_u_m_guide')->result(); 
		$GLOBALS['member'] = NULL;
		$this->_check_auth();
	}
	
	function _check_auth()
	{
		if($uid = $this->nsession->userdata('uid'))
		{
			$GLOBALS['member'] = $this->taobao_member_mdl->get_member_by_uid($uid);
			if ($GLOBALS['member'])
			{
				$GLOBALS['member']->level = get_credit_group($GLOBALS['member']->credit);
			}
		}
		else
		{
			//查看cookies信息
			if ($_cookies = $this->input->cookie($this->config->item('cookie_prefix').'member'))
			{
				$_cookies = explode('|', $_cookies);
				if (count($_cookies) == 2)
				{
					//尝试自动登录
					$member = $this->taobao_member_mdl->get_member(array('uid'=>$_cookies[0]));
					if($member AND $_cookies[1] == $member->userpass)
					{
						if ($member->activated == 1)
						{
							$data['login_times'] = $member->login_times + 1;
							$data['last_login_ip'] = $this->input->ip_address();
							$data['last_login_time'] = now();
							$this->taobao_member_mdl->update_member('uid',$member->uid,$data);
							$this->nsession->set_userdata('uid',$member->uid);
							$this->input->set_cookie('member', $member->uid.'|'.$member->userpass, 7 * 24 * 3600);
							$GLOBALS['member'] = $member;
						}
					}	
				}
			}
		}
	}
	
	function _template($template, $data = array())
	{
		$data['tpl'] = $template;
		$this->load->view('default', $data);
		unset($data);
	}
	
	function _message($msg, $link = array(), $level = 'error')
	{
		$this->_template('message', array('message'=>$msg, 'link'=>$link, 'level' => $level));
		echo $this->output->get_output();
		exit();
	}
	
	function _set_title($title = '')
	{
		if ($title <> '')
		{
			$this->settings->set_item('site_name', $title);
		}
		else
		{
			$this->settings->set_item('site_name', $title . ' - ' . $this->settings->item('site_name'));
		}
	}

}