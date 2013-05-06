<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Taobao_Model extends CI_Model
{

	protected $client;
	protected $_api;

	public function __construct()
	{
		parent::__construct();
		include DILICMS_SHARE_PATH . 'settings/taobao/api.php';
		
		! defined("TOP_SDK_WORK_DIR") AND define("TOP_SDK_WORK_DIR", DILICMS_SHARE_PATH . 'models/taobao/sdk/taobao/cache');
		! defined("TOP_SDK_DEV_MODE") AND define("TOP_SDK_DEV_MODE", $taobao['api']['taobao_dev_mode']);
		
		! defined("TOP_SDK_SANDBOX_MODE") AND define("TOP_SDK_SANDBOX_MODE", $taobao['api']['taobao_sandbox_mode']);

		include_once DILICMS_SHARE_PATH . 'models/taobao/sdk/taobao/TopSdk.php';

		$this->client = new TopClient();
		$this->client->format = 'json';
		$this->client->appkey = $taobao['api']['taobao_key'];
		if (TOP_SDK_SANDBOX_MODE)
		{
			$this->client->gatewayUrl = 'http://gw.api.tbsandbox.com/router/rest';
			$this->client->secretKey = $taobao['api']['taobao_sandbox_key'];
		}
		else
		{
			$this->client->secretKey = $taobao['api']['taobao_secret_key'];
		}
		$this->_api = $taobao['api'];
		unset($taobao);
	}
}