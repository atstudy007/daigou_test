<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_member_mdl extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function get_member_by_uid($uid)
	{
		return $this->db->where('uid', $uid)->get('taobao_members')->row();
	}
	
	public function get_member_by_name($username)
	{
		return $this->db->where('username', $username)->get('taobao_members')->row();	
	}
	
	public function get_member_by_email($email)
	{
		return $this->db->where('email', $email)->get('taobao_members')->row();
	}
	
	public function get_members_num($where = array())
	{
		$where AND $this->db->where($where);
		return $this->db->count_all_results('taobao_members'); 
	}

	public function get_members($where = array(), $limit = 0, $offset = 0)
	{
		$where AND $this->db->where($where);
		$limit AND $this->db->limit($limit);	
		$offset AND $this->db->offset($offset);
		return $this->db->get('taobao_members')->result();
	}
	
	public function add_member($data = array())
	{
		$this->load->helper('date');
		if ( ! $data)
		{
			$data['email'] = $this->input->post('email', TRUE);
			$data['username'] = $this->input->post('username', TRUE);
			$data['userpass'] = trim($this->input->post('userpass', TRUE));
			$data['country'] = $this->input->post('country', TRUE);
			$data['inviter'] = $this->input->post('inviter', TRUE);
                        $data['mail_address'] = $this->input->post('address', TRUE);
                        $data['phone'] = $this->input->post('phone', TRUE);
		}
		$data['salt'] = substr(md5(rand()), 0, 5);
		$data['userpass'] = md5($data['userpass'] . $data['salt']);
		$data['login_times'] = 0;
		$data['reg_ip'] = $data['last_login_ip'] = $this->input->ip_address();
		$data['reg_time'] = $data['last_login_time'] = now();
		$this->db->insert('taobao_members', $data);
		$uid = $this->db->insert_id();
		return $uid;
	}
	
	public function update_member($type, $value, $data = array())
	{
		$this->db->where($type, $value)->update('taobao_members', $data);
	}
	
	public function get_member($type, $value =  NULL)
	{
		if ( ! is_array($type))
		{
			return $this->db->where($type, $value)->get('taobao_members')->row();
		}
		else
		{
			foreach ($type as $k => $v)
			{
				$this->db->where($k, $v);	
			}
			return $this->db->get('taobao_members')->row();
		}
	}

	public function activate_member()
	{
		$code = trim($this->input->get('user', TRUE));
		$member = $this->get_member(array('activation_code'=>$code, 'activated'=>0));
		if ($member)
		{
			$is_first_activate = TRUE;
			if ($member->activated_time)
			{
				$is_first_activate	= FALSE;
			}
			$this->db->set('activated', 1);
			$this->db->set('activated_time', now());
			$this->update_member('uid', $member->uid);
			if ( ! $is_first_activate)
			{
				return TRUE;	
			}
			//新建用户获得积分记录
			$this->load->model('taobao/taobao_inviter_mdl');
			$this->taobao_inviter_mdl->add_expense_record($member->uid, $member->username, 0, '', '', 'Register', 0, 0, $GLOBALS['taobao']['credit']['register']);
			if ($member->inviter)
			{
				//检查推广人是否是推广员
				$inviter = $this->taobao_inviter_mdl->get_inviter('username', $member->inviter);
				if ($inviter)
				{
					$_relation_id = $this->taobao_inviter_mdl->add_relation($member->uid, $member->username, $inviter->uid, $inviter->username);
					if ($_relation_id)
					{
						$this->db->set('inviter_uid', $inviter->uid);
						$this->update_member('uid', $member->uid);			
					}
					else
					{
						$this->db->set('inviter', '');
						$this->update_member('uid', $member->uid);	
					}
				}
				else
				{
					$this->db->set('inviter', '');
					$this->update_member('uid', $member->uid);
				}
			}
			return TRUE;
		}
		return FALSE;
	}

	public function send_activate_email($uid, $email = '')
	{
		$this->load->model('taobao/taobao_email_queue_mdl');
		$this->load->model('taobao/taobao_email_tpl_mdl');
		$data['activation_code'] = md5(rand() . $uid);
		$data['activation_send_time'] = now();
		$active_url = site_url('member/activate/') . '?user=' . $data['activation_code'];
		$message = $this->taobao_email_tpl_mdl->get_tpl('active');
                $member = $this->taobao_member_mdl->get_member_by_uid($uid);
		$message = str_replace('{active_url}', $active_url, $message);
                $message = str_replace('{username}', $member->username, $message);
		$this->taobao_email_queue_mdl->push($email, 'Member Activation', $message);
		$this->update_member('uid', $uid, $data);
		return TRUE;
	}
	
	public function send_password_email($email = '')
	{
		$data['password_code'] = md5(rand() . $email);
		$data['password_send_time'] = now();
		$data['password_code_used'] = 0;
		$username = '';
		$user = $this->get_member_by_email($email);
		if ($user)
		{
			$username = $user->username;
			$this->load->model('taobao/taobao_email_queue_mdl');
			$this->load->model('taobao/taobao_email_tpl_mdl');
			$password_url = site_url('member/change_password/') . '?user=' . $data['password_code'];
			$message = $this->taobao_email_tpl_mdl->get_tpl('password');
			$message = str_replace('{password_url}', $password_url, $message);
			$message = str_replace('{username}', $username, $message);
			$this->taobao_email_queue_mdl->push($email, 'Find Password', $message);
			$this->update_member('email', $email, $data);
		}
		return TRUE;
	}
		
}