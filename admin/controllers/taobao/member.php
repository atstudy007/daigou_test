<?php

require_once APPPATH . 'controllers/taobao/taobao_controller.php';

class Member extends Taobao_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('taobao/taobao_member_mdl');
	}
	
	function add()
	{
		$this->_add_post();
	}
	
	function _check_email($email)
	{
		if($this->taobao_member_mdl->get_member_by_email($email))
		{
			 $this->form_validation->set_message('_check_email', "已经存在的email");
			 return FALSE;
		}
		else
		{
			return TRUE;	
		}
	}
	
	function _check_username($username)
	{
		if ( ! preg_match("/^[a-z0-9_]+$/i", $username))
		{
			 $this->form_validation->set_message('_check_username', "用户名含有不被允许的字符");
			 return FALSE;
		}
		if($this->taobao_member_mdl->get_member_by_name($username))
		{
			 $this->form_validation->set_message('_check_username', "用户名已经存在了");
			 return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
	function _add_post()
	{
		$this->load->model('taobao/taobao_member_mdl');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', '用户邮箱', 'required|valid_email|callback__check_email');
		$this->form_validation->set_rules('userpass', '用户密码', 'trim|required|min_length[6]|max_length[16]|md5');
		$this->form_validation->set_rules('username', '用户名称', 'required|min_length[6]|max_length[16]|callback__check_username');
		$this->form_validation->set_rules('country', '所在国家', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			include_once(DILICMS_SHARE_PATH . 'settings/taobao/country.php');
			$data['country'] = $geo_country;
			$this->_template('taobao/member_add', $data);
		}
		else
		{
			if($this->taobao_member_mdl->get_member_by_name($this->input->post('username')) || $this->taobao_member_mdl->get_member_by_email($this->input->post('email')))
			{
				$this->_message('用户名或者EMAIL已经存在了，请换个重试!', '', FALSE);	
			}
			$this->taobao_member_mdl->add_member();
			$this->_message('用户添加成功', 'taobao/member/view', TRUE);
		}	
	}
	
	function edit($uid = 0)
	{
		$this->load->model('taobao/taobao_member_mdl');
		$data['member'] = $this->taobao_member_mdl->get_member_by_uid($uid);
		include_once(DILICMS_SHARE_PATH . 'settings/taobao/country.php');
		$data['country'] = $geo_country;
		$this->_template('taobao/member_edit', $data);
	}
	
	function _edit_post($uid = 0)
	{
		$this->load->model('taobao/taobao_member_mdl');
		$data['credit'] = $this->input->post('credit', TRUE);
		if($this->input->post('userpass', TRUE))
		{
			$data['userpass'] = md5(trim($this->input->post('userpass', TRUE)));	
		}
		$this->taobao_member_mdl->update_member('uid', $uid, $data);
		$this->_message('用户修改成功', 'taobao/member/edit/' . $uid, TRUE);	
	}
	
	function del($uid = 0)
	{
		$this->db->where('uid', $uid)->limit(1)->delete('taobao_members');
		$this->_message('删除用户成功!', '', TRUE);		
	}
	
	function activate($uid = 0)
	{
		$this->load->model('taobao/taobao_member_mdl');
		$this->taobao_member_mdl->update_member('uid', $uid, array('activated'=>1));
		$this->_message('用户激活成功!', '', TRUE);
	}
	
	function view()
	{
		include_once(DILICMS_SHARE_PATH . 'settings/taobao/country.php');
		$data['country'] = $geo_country;
		$this->load->library('pagination');
		$config['base_url'] = backend_url('taobao/member/view');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['suffix'] = '?model=member';
		
		$condition = array('uid >'=> '0');
		/*
		// 处理搜索条件
		*/
		if($this->input->get('uid'))
		{
			$condition['uid'] = $this->input->get('uid');
			$config['suffix'] .= '&uid='.$this->input->get('uid');
		}
		if($this->input->get('username'))
		{
			$condition['username LIKE '] = '%'.$this->input->get('username').'%';
			$config['suffix'] .= '&username='.$this->input->get('username');
		}
		if($this->input->get('email'))
		{
			$condition['email LIKE '] = '%'.$this->input->get('email').'%';
			$config['suffix'] .= '&email='.$this->input->get('email');
		}
		
		$config['total_rows'] = $this->db->where($condition)->count_all_results('taobao_members');
		
		$this->db->from('taobao_members');
		$this->db->select('*');
		$this->db->where($condition);
		$this->db->order_by('reg_time','DESC');
		$this->db->offset($this->uri->segment($config['uri_segment'],0));
		$this->db->limit($config['per_page']);
		$data['list'] = $this->db->get()->result();
		$config['first_url'] = $config['base_url'] . $config['suffix'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->_template('taobao/member_list',$data);
	}
	
	
}