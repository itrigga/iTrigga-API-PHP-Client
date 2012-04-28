<?php

class itrigga_Source
{
	private $id;
	private $name;
	private $siteUrl;
	private $url;
	private $permalink;
	private $lastChecked;
	private $nextCheckDue;
	private $checkInterval;
	private $description;
	
	public function __construct($rawData)
	{
		$this->id = (int)$rawData->id[0];
		$this->name = (string)$rawData->name[0];
		$this->siteUrl = (string)$rawData->site_url[0];
		$this->url =(string)$rawData->url[0];
		$this->permalink = (string)$rawData->permalink[0];
		$this->lastChecked = (string)$rawData->last_checked_at[0];
		$this->nextCheckDue = (string)$rawData->next_check_due[0];
		$this->checkInterval = (int)$rawData->check_interval_minutes[0];
		$this->description = (string)$rawData->description[0];
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getSiteUrl()
	{
		return $this->siteUrl;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
	
	public function getPermalink()
	{
		return $this->permalink;
	}
	
	public function getLastChecked()
	{
		return $this->lastChecked;
	}
	
	public function getNextCheckDue()
	{
		return $this->nextCheckDue;
	}
	
	public function checkInterval()
	{
		return $this->checkInterval();
	}
	
	public function getDescription()
	{
		return $this->description;
	}

}
