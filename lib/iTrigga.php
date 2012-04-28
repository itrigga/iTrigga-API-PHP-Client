<?php

define('IT_BASE_URL','http://api.itrigga.com/api/v1');

require_once 'iTrigga/Paginator.php';
require_once 'iTrigga/Item.php';

/**
 * iTrigga API client
 *
 * @author Nathan Whitworth <nathan@nathanwhitworth.co.uk>
 * @version 0.1
 */
class itrigga_iTrigga
{
	private $siteKey = null;
	private $apiKey = null;

	/**
	 *
	 *
	 * @param string $siteKey
	 * @param string $apiKey
	 */
	public function __construct($siteKey,$apiKey)
	{
		$this->siteKey = $siteKey;
		$this->apiKey = $apiKey;
	}

	private function createLoginArgs()
	{
		return '?site_key=' . $this->siteKey . '&api_key=' . $this->apiKey;
	}

	/**
	 * returns json decoded object
	 *
	 * @param API path $path
	 */
	private function fetchData($path, itrigga_Paginator $paginator = null)
	{
		$apiUrl = IT_BASE_URL . $path . '.xml' . $this->createLoginArgs();

		if ($paginator)
		{
			$apiUrl .= '&page=' . $paginator->getPage() . '&per_page=' . $paginator->getPerPage();
		}

		// echo $apiUrl;

		$ch = curl_init($apiUrl);
		$timeout = 5;
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);

		return simplexml_load_string($data);
	}

	/**
	 * Gets an array of items
	 *
	 * @param itrigga_Paginator $paginator
	 * @return itrigga_Item[]
	 */
	public function getItems(itrigga_Paginator $paginator = null)
	{
		$itemData = $this->fetchData('/items', $paginator);

		if ($paginator)
		{
			$paginator->setResults((int)$itemData->attributes()->size[0]);
		}

		$items = array();

		foreach ($itemData->item as $rawItem)
		{
			$items[] = new itrigga_Item($rawItem);
		}

		return $items;
	}


	/**
	 * gets an extended item with more data available
	 *
	 * @param int $itemId
	 * @return itrigga_Item
	 */
	public function getItem($itemId)
	{
		$result = $this->fetchData('/items/' . $itemId);

		$item = new itrigga_Item($result);

		return $item;
	}

}
