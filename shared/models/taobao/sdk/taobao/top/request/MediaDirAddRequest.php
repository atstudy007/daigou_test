<?php
/**
 * TOP API: taobao.media.dir.add request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class MediaDirAddRequest
{
	/** 
	 * 申请cdn资源的分配的userId
	 **/
	private $cdnUserId;
	
	/** 
	 * 额外参数
	 **/
	private $ext;
	
	/** 
	 * 目录的名称
	 **/
	private $name;
	
	/** 
	 * 目录的所属目录的id，根目录id为0
	 **/
	private $parentId;
	
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

	public function setExt($ext)
	{
		$this->ext = $ext;
		$this->apiParas["ext"] = $ext;
	}

	public function getExt()
	{
		return $this->ext;
	}

	public function setName($name)
	{
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setParentId($parentId)
	{
		$this->parentId = $parentId;
		$this->apiParas["parent_id"] = $parentId;
	}

	public function getParentId()
	{
		return $this->parentId;
	}

	public function getApiMethodName()
	{
		return "taobao.media.dir.add";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->cdnUserId,"cdnUserId");
		RequestCheckUtil::checkMinValue($this->cdnUserId,1,"cdnUserId");
		RequestCheckUtil::checkNotNull($this->name,"name");
		RequestCheckUtil::checkMaxLength($this->name,50,"name");
		RequestCheckUtil::checkNotNull($this->parentId,"parentId");
		RequestCheckUtil::checkMinValue($this->parentId,0,"parentId");
	}
}
