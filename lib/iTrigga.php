<?php

define('IT_BASE_URL','http://api.itrigga.com/api/v1');

// Autoload sub-classes
spl_autoload_register(array('iTrigga', 'autoload'));

/**
 * iTrigga API client
 *
 * @author Nathan Whitworth <nathan@nathanwhitworth.co.uk>
 * @version 0.1
 */
class iTrigga
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

  /**
   * Autoload sub-classes
   *
   * @param string $class Name of the class to load
   */
  public static function autoload($class) {
    if (strpos($class, 'iTrigga') === 0) {
      require str_replace('_', '/', $class) . '.php';
    }
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
	private function fetchData($path, iTrigga_Paginator $paginator = null)
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
	 * @param iTrigga_Paginator $paginator
	 * @return iTrigga_Item[]
	 */
	public function getItems(iTrigga_Paginator $paginator = null)
	{
		$itemData = $this->fetchData('/items', $paginator);

		if ($paginator)
		{
			$paginator->setResults((int)$itemData->attributes()->size[0]);
		}

		$items = array();

		foreach ($itemData->item as $rawItem)
		{
			$items[] = new iTrigga_Item($rawItem);
		}

		return $items;
	}


	/**
	 * gets an extended item with more data available
	 *
	 * @param int $itemId
	 * @return iTrigga_Item
	 */
	public function getItem($itemId)
	{
		$result = $this->fetchData('/items/' . $itemId);

		$item = new iTrigga_Item($result);

		return $item;
	}

}
