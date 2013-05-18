<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_email_queue_mdl extends CI_Model
{

	protected $config = array();
	protected $sender = '';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function init()
	{
		include DILICMS_SHARE_PATH . 'settings/taobao/api.php';
		$this->config['protocol'] = 'smtp';
		$this->config['smtp_host'] = $taobao['api']['email_smtp'];
		$this->config['smtp_user'] = $taobao['api']['email_account'];
		$this->config['smtp_pass'] = $taobao['api']['email_password'];
                $this->config['smtp_port'] = '25';
		$this->config['charset'] = 'utf-8';
		$this->config['wordwrap'] = TRUE;
		$this->config['mailtype'] = 'html';
        $this->config['validate'] = TRUE;
     	$this->config['priority'] = 1;
     	$this->config['crlf']  = "\r\n";
		$this->config['newline']  = "\r\n";
     	$this->config['smtp_port'] = 25;
		$this->sender = $taobao['api']['email_account'];
		$this->load->library('email');
		$this->email->initialize($this->config);
	}
	
	public function push($email, $title, $content)
	{
		$data['email'] = $email;
		$data['title'] = $title;
		$data['content'] = $content;
		$this->db->insert('taobao_email_queue', $data);
	}
	
	public function auto_send($limit = 20)
	{
		$items = $this->db->where('status', 1)->or_where('status', 3)->limit($limit)->order_by('qid', 'ASC')->get('taobao_email_queue')->result();
		foreach ($items as $item)
		{
			$this->send($item->qid, $item->email, $item->title, $item->content, $item->times);
		}
	}
	
	public function send($qid, $email, $title, $content, $times = 0)
	{
		if ($times > 10)
		{
			$this->db->where('qid', $qid)->set('status', 4)->set('status_time', now())->update('taobao_email_queue');
		}
		else
		{
			$this->email->from($this->sender);
			$this->email->to($email); 
			$this->email->subject($title);
			$this->email->message($content);
			if ($this->email->send())
			{
				//发送成功就更新status
				$this->db->where('qid', $qid)->set('status', 2)->set('status_time', now())->update('taobao_email_queue');
			}
			else
			{
				//发送失败将状态更新为3，并增加重拾次数
				$this->db->where('qid', $qid)->set('status', 3)->set('times', 'times+1', false)->set('status_time', now())->update('taobao_email_queue');
			}
		}
	}

}