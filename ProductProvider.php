<?php

/**
 * This class is only meant to imitate some kind of API 
 * client responsible for fetching products.
 */
class ProductProvider {
	/**
	 * Get the list of available products.
	 * @return array
	 */
	public static function getProducts(): array {
		$productsRaw = file_get_contents('./products.json');
		return json_decode($productsRaw, true);
	}
}

?>
