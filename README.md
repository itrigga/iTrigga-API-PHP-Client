iTrigga API client - By Nathan Whitworth
----------------------------------------

This client makes use of PHP's simple XML library. It is currently very simple and should not be considered as a stable release.

So as to not restrict this to PHP 5.3 or above, I've used itrigga_ before every class as a pear style namespace.

Example usage
--------------

Contact iTrigga for API key details, if you don't have them.

	$iTrigga = new itrigga_iTrigga($siteKey,$apiKey);
	$items = $iTrigga->getItems();

You will get back an array of items (itrigga_Item[]), and each property is accessible via
a get method, for example, $item->getName().

Complex types, such as $item->getSource() will return an itrigga_Source object.

Due to the way the iTrigga API works (for efficiency), getItems() returns a simplified version of the itrigga_Item object.
To fetch the full set of information for a given item, use

	$item = $iTrigga->getItem($itemId);

This will give you access to Channel, Entity, and Tag data, although it should be noted that these are currently lightweight versions and miss some fields.
For most uses, they should be sufficient.


Pagination
----------

The client supports pagination via a pagination object.

	$perPage = 10;
	$currentPage = 1;
	$paginator = new itrigga_Paginator($perPage,$currentPage);

	$items = $iTrigga->getItems($paginator);

After the above call, paginator will now have been set with some extra information.
You can find out how many pages there are in your results, given the number per page, by calling

	$paginator->getPageCount();


In the spirit of Open Source, I will endeavour to fix any bugs promptly, so feel free to contact me with
any questions or problems. My email address can be found in the source.

Nathan
