<?php
/**
 * TOP API: taobao.media.dir.update request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class MediaDirUpdateRequest
{
	/** 
	 * 申请cdn资源的分配的userId
	 **/
	private $cdnUserId;
	
	/** 
	 * 目录id
	 **/
	private $dirId;
	
	/** 
	 * 目录名称
	 **/
	private $name;
	
	/** 
	 * 目录的所属目录
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

	public function setDirId($dirId)
	{
		$this->dirId = $dirId;
		$this->apiParas["dir_id"] = $dirId;
	}

	public function getDirId()
	{
		return $this->dirId;
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
		return "taobao.media.dir.update";
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
		RequestCheckUtil::checkMinValue($this->parentId,0,"parentId");
	}
}
