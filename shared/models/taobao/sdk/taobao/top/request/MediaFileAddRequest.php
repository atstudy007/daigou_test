<?php
/**
 * TOP API: taobao.media.file.add request
 * 
 * @author auto create
 * @since 1.0, 2012-03-07 12:30:34
 */
class MediaFileAddRequest
{
	/** 
	 * cdn申请的isv编号
	 **/
	private $cdnUserId;
	
	/** 
	 * 文件属于的那个目录的目录编号
	 **/
	private $dirId;
	
	/** 
	 * 额外信息
	 **/
	private $ext;
	
	/** 
	 * 文件上传的内容
	 **/
	private $img;
	
	/** 
	 * 上传文件的名称
	 **/
	private $name;
	
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

	public function setExt($ext)
	{
		$this->ext = $ext;
		$this->apiParas["ext"] = $ext;
	}

	public function getExt()
	{
		return $this->ext;
	}

	public function setImg($img)
	{
		$this->img = $img;
		$this->apiParas["img"] = $img;
	}

	public function getImg()
	{
		return $this->img;
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

	public function getApiMethodName()
	{
		return "taobao.media.file.add";
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
		RequestCheckUtil::checkMinValue($this->dirId,0,"dirId");
		RequestCheckUtil::checkNotNull($this->img,"img");
		RequestCheckUtil::checkNotNull($this->name,"name");
		RequestCheckUtil::checkMaxLength($this->name,50,"name");
	}
}
