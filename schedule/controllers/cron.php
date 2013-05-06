<?php
 
class Cron extends CI_Controller
{
    public function index()
    {
        //$this->load->library('cron_schedule');
        //$this->cron_schedule->dispatch();
		$this->load->model('taobao/taobao_email_queue_mdl');
		$i = 1;
		while($i < 11)
		{
			$this->taobao_email_queue_mdl->init();
			$this->taobao_email_queue_mdl->auto_send();
			$i++;
			sleep(5);
		}
    }
}
 