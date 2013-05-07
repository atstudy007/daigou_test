<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Member extends Taobao_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function activate()
	{
		$this->_set_title('Member Activate');
		if ($this->taobao_member_mdl->activate_member())
		{
			$link = array('label'=>'login', 'url'=>site_url('member/login'));
			$this->_message('Activate Successfully!', array($link), 'success');	
		}
		else
		{
			redirect();
			//$this->_message('Invalid Code OR has been activated!');		
		}
	}
	
	function send_activate_email()
	{
		$this->_set_title('Send Email');
		$uid = $this->input->get('uid', TRUE);
		$email = $this->input->get('email', TRUE);
		if ($uid AND $email AND $member = $this->taobao_member_mdl->get_member(array('uid'=>$uid, 'email'=>$email)) AND isset($member->activated) AND $member->activated == 0)
		{
			$this->taobao_member_mdl->send_activate_email($uid, $email);
			$this->_message('An activate Email has been send to your email box.', array(), 'info');
		}
		else
		{
			$this->_message('Invalid Entry.');
		}
	}
        
	function password()
	{
		$this->_password_post();
	}
	
	function _password_post()
	{
		$this->_set_title('Find Password');
		if($GLOBALS['member'])
		{
			redirect('home');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="colorA10">', '</span>');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__check_password_email');
		if ($this->form_validation->run() == FALSE)
		{

			$this->_template('password');	
		}
		else
		{
			$this->taobao_member_mdl->send_password_email($this->input->post('email', TRUE));
			$this->_message('A confirmation Email has been send to your email box.',array(), 'info');
		}
	}
        
    function _check_password_email($email)
	{
		if( ! $this->taobao_member_mdl->get_member_by_email($email))
		{
			$this->form_validation->set_message('_check_password_email', 'the Email does not register yet!');
			return FALSE;
		}
		else
		{
			return TRUE;	
		}
	}
	
	function change_password()
	{
		$this->_set_title('Change Password');
		$this->_change_password_post();
	}
	
	function _change_password_post()
	{
		$code = trim($this->input->get('user', TRUE));
		! $code && redirect();
		$member = $this->taobao_member_mdl->get_member(array('password_code'=>$code, 'password_code_used'=>0));
		$form_data['post_url'] = site_url('member/change_password').'?user='.$code;
		if ( ! $member)
		{
			$html = 'Invalid Code!';
			$this->_message($html);			
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="colorA10">', '</span>');
			$this->form_validation->set_rules('userpass', 'Password', 'trim|required|min_length[6]|max_length[16]|matches[userpass_confirm]');
			$this->form_validation->set_rules('userpass_confirm', 'Confirm Password', 'trim|required|min_length[6]|max_length[16]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->_template('reset_password', $form_data);	
			}
			else
			{
				$data['userpass'] = md5($this->input->post('userpass').$member->salt);
				$this->taobao_member_mdl->update_member('uid', $member->uid, $data);
				$link = array('label'=>'Login','url'=>site_url('member/login'));
				$html = 'Password Reset Success.';
				$this->_message($html, array($link), 'success');
			}
		}
	}

	function login()
	{
		$this->_login_post();
	}
	
	function _login_post()
	{
		$this->_set_title('Login');
		$back_url = isset($_GET['back']) ? $_GET['back'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url()); 
		if($back_url == ''){$back_url = site_url();}
		if($GLOBALS['member'])
		{
			header('Location:'.$back_url);
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="colorA10">', '</span>');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('userpass', 'Password', 'trim|required');
		if(isset($_POST['captcha']))
		{
			$this->form_validation->set_rules('captcha', 'captcha', 'trim|required|callback__check_captcha');	
		}
		if ($this->form_validation->run() == FALSE)
		{
			$this->_template('login',array('back'=>$back_url));
		}
		else
		{
			$member = $this->taobao_member_mdl->get_member(array('email'=>$this->input->post('email')));
			if($member AND md5($this->input->post('userpass') . $member->salt) == $member->userpass)
			{
				if ($member->activated == 1)
				{
					$data['login_times'] = $member->login_times + 1;
					$data['last_login_ip'] = $this->input->ip_address();
					$data['last_login_time'] = now();
					$this->taobao_member_mdl->update_member('uid',$member->uid,$data);
					$this->nsession->set_userdata('uid',$member->uid);
					$this->nsession->set_userdata('last_activity',$data['last_time']);
					if ($this->input->post('stay_login', TRUE) == 'yes')
					{
						$this->input->set_cookie('member', $member->uid.'|'.$member->userpass, 7 * 24 * 3600);
					}
					if ($back_url != site_url('member/login'))
					{
						header('Location:' . $back_url);
					}
					else
					{
						redirect();	
					}
				}
				else
				{

					$data['login_times'] = $member->login_times + 1;
					$data['last_login_ip'] = $this->input->ip_address();
					$data['last_login_time'] = now();
					$this->taobao_member_mdl->update_member('uid',$member->uid,$data);
					$this->nsession->set_userdata('uid',$member->uid);
					$this->nsession->set_userdata('last_activity',$data['last_time']);
                    header('Location:' . '/');
					$link = array('label'=>'click here will redirect to the home page', 'url' =>site_url("home/index/") );
					$html = 'Login successfully!!';
					$this->_message($html, array($link), 'info');


				}
			}
			else
			{
				$data['error'] = 'Login Failed!';
				$this->_template('login', $data);	
			}
		}
	}
	
	function logout()
	{
		$this->nsession->sess_destroy();
		$this->input->set_cookie('member', '', -1);
		$goto = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url();
		header('Location:'.$goto.'');
	}
	
	function register()
	{
		$this->_register_post();
	}
	
	function _register_post()
	{
		$this->_set_title('Register');
		if($GLOBALS['member'])
		{
			redirect('home');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="colorA10">', '</span>');
		include (DILICMS_SHARE_PATH . 'settings/taobao/country.php');
		$data['country'] = $geo_country;
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__check_email');
		$this->form_validation->set_rules('userpass', 'Password', 'trim|required|min_length[6]|max_length[16]|matches[userpass_confirm]');
		$this->form_validation->set_rules('userpass_confirm', 'Confirm Password', 'trim|required|min_length[6]|max_length[16]');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[10]|callback__check_username');
		$this->form_validation->set_rules('inviter', 'Inviter', 'trim');
		$this->form_validation->set_rules('country', 'Country' ,'trim');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback__check_captcha');
		if ($this->form_validation->run() == FALSE)
		{
			
		    $this->_template('register',$data);	
		}
		else
		{
			$uid = $this->taobao_member_mdl->add_member();

					$link = array('label'=>'click here to login', 'url' =>site_url("member/login"));
					$html = 'Register successfully!!';
					$this->_message($html, array($link), 'info');	
                    
                    
                    
		}
		
	}
	
	function _check_email($email)
	{
		if($this->taobao_member_mdl->get_member_by_email($email))
		{
			 $this->form_validation->set_message('_check_email', 'the Email has been used!');
			 return FALSE;
		}
		else
		{
			return TRUE;	
		}
	}
	
	function _check_username($username)
	{
		if($this->taobao_member_mdl->get_member_by_name($username))
		{
			 $this->form_validation->set_message('_check_username', 'the Username has been used!');
			 return FALSE;
		}
		else
		{
			return TRUE;	
		}	
	}
	
	function _check_captcha($captcha)
	{
		if(strtolower($this->nsession->userdata('captcha')) != strtolower($captcha))
		{
			 $this->form_validation->set_message('_check_captcha', 'captcha code error!');
			 return FALSE;
		}
		else
		{
			return TRUE;	
		}	
	}
	
	function _check_password($password)
	{
		if ( md5($password . $GLOBALS['member']->salt) != $GLOBALS['member']->userpass)
		{
			 $this->form_validation->set_message('_check_password', "Current Password does't match");
			 return FALSE;
		}
		else
		{
			return TRUE;	
		}
		
	}
	
	function info()
	{
		$this->_info_post();
	}
	
	function _info_post()
	{
		$this->_set_title('Account Information');
		if(!$GLOBALS['member']) {redirect('member/login');}
		/*查询所在地*/
		include (DILICMS_SHARE_PATH . 'settings/taobao/country.php');
		$data['country'] = $geo_country;
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="colorA10">', '</span>');
		$flag = FALSE;
		if($_SERVER['REQUEST_METHOD'] == 'POST' && ($this->input->post('old_pass') || $this->input->post('new_pass')) )
		{
			$flag = TRUE;
			$this->form_validation->set_rules('old_pass', 'Current Password', 'trim|required|min_length[6]|max_length[16]|callback__check_password');
			$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[6]|max_length[16]|matches[new_pass_confirm]|md5');
			$this->form_validation->set_rules('new_pass_confirm', 'Confirm New Password', 'trim|required|min_length[6]|max_length[16]');	
		}
		$this->form_validation->set_rules('country', 'Country' ,'trim');
		if ($this->form_validation->run() == FALSE)
		{
		    $this->_template('member/info',$data);
		}
		else
		{
			unset($data['country']);
			$data['country'] = $this->input->post('country', TRUE);
			if($flag)
			{
				$data['userpass'] = md5($this->input->post('new_pass').$GLOBALS['member']->salt);	
			}
			$this->taobao_member_mdl->update_member('uid',$GLOBALS['member']->uid,$data);
			$this->nsession->set_flashdata('msg', 'Account Information updated!');
			redirect('member/info');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
