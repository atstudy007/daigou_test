<?php
 
class cron_send_email
{
	
    function send($params = array())
    {
    	$ci = & get_instance();
		$i = 1;
		while($i < 11)
		{
			$ci->load->model('taobao/taobao_email_queue_mdl');
			$ci->taobao_email_queue_mdl->init();
			$ci->taobao_email_queue_mdl->auto_send();
			$i++;
			sleep(5);
		}
    }
    
}
 