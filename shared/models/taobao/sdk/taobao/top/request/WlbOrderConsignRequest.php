<?php
/**
 * TOP API: taobao.wlb.order.consign request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class WlbOrderConsignRequest
{
	/** 
	 * 物流宝订单编号
	 **/
	private $wlbOrderCode;
	
	private $apiParas = array();
	
	public function setWlbOrderCode($wlbOrderCode)
	{
		$this->wlbOrderCode = $wlbOrderCode;
		$this->apiParas["wlb_order_code"] = $wlbOrderCode;
	}

	public function getWlbOrderCode()
	{
		return $this->wlbOrderCode;
	}

	public function getApiMethodName()
	{
		return "taobao.wlb.order.consign";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->wlbOrderCode,"wlbOrderCode");
		RequestCheckUtil::checkMaxLength($this->wlbOrderCode,64,"wlbOrderCode");
	}
}
