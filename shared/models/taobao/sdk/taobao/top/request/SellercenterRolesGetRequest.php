<?php
/**
 * TOP API: taobao.sellercenter.roles.get request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class SellercenterRolesGetRequest
{
	/** 
	 * 卖家昵称
	 **/
	private $nick;
	
	private $apiParas = array();
	
	public function setNick($nick)
	{
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick()
	{
		return $this->nick;
	}

	public function getApiMethodName()
	{
		return "taobao.sellercenter.roles.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->nick,"nick");
		RequestCheckUtil::checkMaxLength($this->nick,500,"nick");
	}
}
