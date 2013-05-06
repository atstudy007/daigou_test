<?php
/**
 * TOP API: taobao.media.file.delete request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class MediaFileDeleteRequest
{
	/** 
	 * 申请cdn资源的分配的userId
	 **/
	private $cdnUserId;
	
	/** 
	 * 文件ID字符串,可以一个也可以一组,用英文逗号间隔,如450,120,155
	 **/
	private $fileIds;
	
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

	public function setFileIds($fileIds)
	{
		$this->fileIds = $fileIds;
		$this->apiParas["file_ids"] = $fileIds;
	}

	public function getFileIds()
	{
		return $this->fileIds;
	}

	public function getApiMethodName()
	{
		return "taobao.media.file.delete";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->cdnUserId,"cdnUserId");
		RequestCheckUtil::checkMinValue($this->cdnUserId,0,"cdnUserId");
		RequestCheckUtil::checkNotNull($this->fileIds,"fileIds");
		RequestCheckUtil::checkMaxListSize($this->fileIds,50,"fileIds");
	}
}
