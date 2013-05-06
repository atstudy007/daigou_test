<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Captcha extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('captcha_code');
	}
	 	
	function show(){
		$this->captcha_code->show();
	}
	
	function showjs(){
		$this->captcha_code->show_javascript();
	}
	
}