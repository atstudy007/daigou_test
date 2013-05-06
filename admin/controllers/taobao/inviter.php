<?php

require_once APPPATH . 'controllers/taobao/taobao_controller.php';

class Inviter extends Taobao_Controller
{
	function __construct()
	{
		parent::__construct();
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
	
	function _add_post()
	{
		$this->load->model('taobao/taobao_member_mdl');
		$this->load->model('taobao/taobao_inviter_mdl');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uid', '用户名称', 'required');
		$this->form_validation->set_rules('username', '用户名称', 'required');
		$this->form_validation->set_rules('paypal', 'Paypal', 'required|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_template('taobao/inviter_add');
		}
		else
		{
			$where = array('uid'=>$this->input->post('uid'), 'username'=>$this->input->post('username'));
			if( ! $this->taobao_member_mdl->get_member($where) OR $this->taobao_inviter_mdl->get_inviter($where))
			{
				$this->_message('用户不存在，或者用户已经是推广员了', '', FALSE);
			}
			$data['uid'] = $this->input->post('uid');
			$data['username'] = $this->input->post('username');
			$data['paypal'] = $this->input->post('paypal');
			$this->taobao_inviter_mdl->add_inviter($data);
			$this->_message('推广员添加成功', 'taobao/inviter/view', TRUE);
		}	
	}
	
	function edit($uid = 0)
	{
		$this->load->model('taobao/taobao_inviter_mdl');
		$data['inviter'] = $this->taobao_inviter_mdl->get_inviter('uid', $uid);
		$this->_template('taobao/inviter_edit', $data);
	}
	
	function _edit_post($uid = 0)
	{
		$this->load->model('taobao/taobao_inviter_mdl');
		$data['paypal'] = $this->input->post('paypal', TRUE);
		$this->taobao_inviter_mdl->update_inviter('uid', $uid, $data);
		$this->_message('推广员修改成功', 'taobao/inviter/edit/' . $uid, TRUE);	
	}
	
	function del($uid = 0)
	{
		$this->db->where('uid', $uid)->limit(1)->delete('taobao_inviters');
		$this->_message('删除推广员成功!', '', TRUE);		
	}
	
	function view()
	{
		$limit = 15;
		$offset = get_page_offset($limit);
		$where = array();
		$suffix = array();
		if ($this->input->get('uid') != '')
		{
			$where['uid'] = $this->input->get('uid');
			$suffix[] = 'uid='.$this->input->get('uid');	
		}
		if ($this->input->get('username') != '')
		{
			$where['username LIKE'] = '%'.$this->input->get('username').'%';
			$suffix[] = 'username='.$this->input->get('username');	
		}
		$this->load->model('taobao/taobao_inviter_mdl');
		$where['type'] = 2;
		$data = $this->taobao_inviter_mdl->get_inviters($where, $limit, $offset, implode('&', $suffix));
		$this->_template('taobao/inviter_list',$data);
	}
	
	function cash()
	{
		$limit = 15;
		$offset = get_page_offset($limit);
		$where = array();
		$suffix = array();
		if ($this->input->get('uid') != '')
		{
			$where['uid'] = $this->input->get('uid');
			$suffix[] = 'uid='.$this->input->get('uid');	
		}
		$this->load->model('taobao/taobao_inviter_mdl');
		$data = $this->taobao_inviter_mdl->get_cash_records($where, $limit, $offset, implode('&', $suffix), 'taobao/inviter/cash');
		$this->_template('taobao/inviter_cash_list', $data);	
	}
	
	function _cash_post()
	{
		$data = array();
		$data['uid'] = $this->input->post('uid', TRUE);
		$data['cash'] = $this->input->post('cash', TRUE);
		$data['paypal'] = $this->input->post('paypal', TRUE);
		$data['description'] = $this->input->post('description', TRUE);
		foreach ($data as $v)
		{
			if ($v == '')
			{
				$this->_message('所有项目都必须填写', '', TRUE);	
			}
		}
		$this->load->model('taobao/taobao_inviter_mdl');
		$inviter = $this->taobao_inviter_mdl->get_inviter('uid', $data['uid']);
		if ( ! $inviter ||  $inviter->cash - $data['cash'] < 0)
		{
			$this->_message('用户不存在，或者用户余额没有这么多！', '', TRUE);		
		}
		else
		{
			$data['admin'] = $this->_admin->username;
			$this->taobao_inviter_mdl->add_cash_record($data);
			$this->_message('操作成功', '', TRUE);
		}
	}
	
	
	function history($type,$uid)
	{
		$where = array();
		$where['uid'] = $uid;
		if ($type == 'cash')
		{
			$where['iuid >'] = 0;	
		}
		$limit = 20;
		$offset = get_page_offset($limit);
		$this->load->model('taobao/taobao_inviter_mdl');
		$data = $this->taobao_inviter_mdl->get_history($where, $limit, $offset, '', backend_url('taobao/inviter/history/'.$type.'/'.$uid));
		$this->_template('taobao/inviter_history', $data);		
	}
}