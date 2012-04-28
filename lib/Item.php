<?php

require_once 'Source.php';
require_once 'Entity.php';
require_once 'Channel.php';
require_once 'Tag.php';

class itrigga_Item
{
	private $id;
	private $name;
	private $permalink;
	private $created;
	private $updated;
	private $clickthroughUrl;
	private $url;
	private $type;
	private $summary;
	private $source;
	private $editorial;

	private $channels = array();
	private $entities = array();
	private $tags = array();

	public function __construct($rawData)
	{
		$this->id = (int)$rawData->id[0];
		$this->name = (string)$rawData->name[0];
		$this->permalink = (string)$rawData->permalink[0];
		$this->created = (string)$rawData->created_at[0];
		$this->updated = (string)$rawData->updated_at[0];
		$this->clickthroughUrl = (string)$rawData->clickthrough_url[0];
		$this->url = (string)$rawData->url[0];
		$this->type = (string)$rawData->type[0];
		$this->summary = (string)$rawData->summary[0];
		$this->editorial = ((string)$rawData->editorial[0]) == 'false' ? false : true;
		$this->source = new itrigga_Source($rawData->source);

		// channels
		if (isset($rawData->channels))
		{
			foreach ($rawData->channels->channel as $rawChannel)
			{
				$this->channels[] = new itrigga_Channel($rawChannel);
			}
		}

		// entities
		if (isset($rawData->entities))
		{
			foreach ($rawData->entities->entity as $rawEntity)
			{
				$this->entities[] = new itrigga_Entity($rawEntity);
			}
		}

		// tags
		if (isset($rawData->item_tags))
		{
			foreach ($rawData->item_tags->item_tag as $rawTag)
			{
				$this->tags[] = new itrigga_Tag($rawTag);
			}
		}
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

	public function getCreated()
	{
		return $this->created;
	}

	public function getUpdated()
	{
		return $this->updated;
	}

	public function getClicThroughUrl()
	{
		return $this->clickthroughUrl;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getSummary()
	{
		return $this->summary;
	}

	public function isEditorial()
	{
		return $this->isEditorial();
	}

	/**
	 * @return itrigga_Source
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 *
	 * @return itrigga_Channel[]
	 */
	public function getChannels()
	{
		return $this->channels;
	}

	/**
	 *
	 * @return itrigga_Entity[]
	 */
	public function getEntities()
	{
		return $this->entities;
	}

	/**
	 *
	 * @return itrigga_Tag[]
	 */
	public function getTags()
	{
		return $this->tags;
	}

}
