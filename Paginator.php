<?php


class itrigga_Paginator
{
	private $perPage;
	private $page;
	private $results=0;
	
	public function __construct($perPage=20,$page=1)
	{
		$this->perPage = $perPage;
		$this->page = $page;
	}
	
	/**
	 * Get how many results we want per page
	 */
	public function getPerPage()
	{
		return $this->perPage;
	}
	
	/**
	 * return the current page
	 */
	public function getPage()
	{
		return $this->page;
	}
	
	public function getPageCount()
	{
		return ceil($this->results/$this->perPage);
	}
	
	public function setResults($resultCount)
	{
		$this->results = $resultCount;
	}

}
