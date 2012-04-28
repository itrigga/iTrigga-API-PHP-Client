<?php

class itrigga_Channel
{
	private $id;
	private $name;
	private $permalink;

	public function __construct($rawData)
	{
		$this->id = (int)$rawData->id[0];
		$this->name = (string)$rawData->name[0];
		$this->permalink = (string)$rawData->permalink[0];
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPermalink()
	{
		return $this->permalink;
	}
}
