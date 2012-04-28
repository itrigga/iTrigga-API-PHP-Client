<?php

class itrigga_Entity
{
	private $id;
	private $name;
	private $permalink;
	private $entityType;

	public function __construct($rawData)
	{
		$this->id = (int)$rawData->id[0];
		$this->name = (string)$rawData->name[0];
		$this->permalink = (string)$rawData->permalink[0];
		$this->entityType = (string)$rawData->entityType[0];
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

	public function getEntityType()
	{
		return $this->entityType;
	}

}
