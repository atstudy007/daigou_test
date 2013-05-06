<?php
/**
 * TOP API: taobao.media.dir.delete request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class MediaDirDeleteRequest
{
	/** 
	 * 申请cdn资源的分配的userId
	 **/
	private $cdnUserId;
	
	/** 
	 * 目录id
	 **/
	private $dirId;
	
	private $apiParas = array();
	
	public function setCdnUserId($cdnUserId)
	{
		$this->cdnUserId = $cdnUserId;
		$this->apiParas["cdn_user_id"] = $cdnUserId;
	}

	public function getCdnUserId()
	{
		return $this->cdnUserId;
	}

	public function setDirId($dirId)
	{
		$this->dirId = $dirId;
		$this->apiParas["dir_id"] = $dirId;
	}

	public function getDirId()
	{
		return $this->dirId;
	}

	public function getApiMethodName()
	{
		return "taobao.media.dir.delete";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->cdnUserId,"cdnUserId");
		RequestCheckUtil::checkMinValue($this->cdnUserId,1,"cdnUserId");
		RequestCheckUtil::checkNotNull($this->dirId,"dirId");
		RequestCheckUtil::checkMinValue($this->dirId,1,"dirId");
	}
}
