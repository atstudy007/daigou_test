<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Error extends Taobao_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function not_found()
	{
		$this->_set_title('404');
		$this->_template('404');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */