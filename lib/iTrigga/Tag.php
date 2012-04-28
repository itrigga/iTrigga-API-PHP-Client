<?php

class itrigga_Tag
{
	private $id;
	private $itemId;
	private $term;
	private $url;
	private $pos;
	private $count;

	public function __construct($rawData)
	{
		$this->id = (int)$rawData->id[0];
		$this->itemId = (int)$rawData->item_id[0];
		$this->term = (string)$rawData->term[0];
		$this->url = (string)$rawData->url[0];
		$this->pos = (string)$rawData->pos[0];
		$this->count = (int)$rawData->count[0];
	}

	public function getId()
	{
		return $this->id;
	}

	public function getItemId()
	{
		return $this->itemId;
	}
	public function getTerm()
	{
		return $this->term;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getPos()
	{
		return $this->pos;
	}

	public function getCount()
	{
		return $this->count;
	}

}
