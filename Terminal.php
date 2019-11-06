<?php

include './ProductProvider.php';

class Terminal {
	/**
	 * The basket items
	 * @var array
	 */
	private $items = [];

	/**
	 * The total price
	 * @var int
	 */
	private $total = 0;

	/**
	 * Available products
	 * @var array
	 */
	private $products = [];

	public function __construct() {
		$this->loadProducts();
	}

	/**
	 * Get the total price
	 * @return int
	 */
	public function getTotal(): int {
		return $this->total;
	}

	/**
	 * Get the list of items
	 * @return array
	 */
	public function getItems(): array {
		return $this->items;
	}

	/**
	 * Scan an item
	 * @param string $code
	 * @param integer $quantity
	 */
	public function scan(string $code, int $quantity = 1): void {
		if (array_key_exists($code, $this->products) === false) {
			echo "Product " . $code . " does not exist\n";
			return;
		}

		if (array_key_exists($code, $this->items) === false) {
			$this->items[$code] = [
				'quantity' => 0
			];
		}

		$this->items[$code]['quantity'] += $quantity;
		$this->calculateTotal();
	}	
	
	/**
	 * Calculate the price of the given items and set the price property accordingly
	 * @return void
	 */
	private function calculateTotal(): void {
		$total = 0;
		foreach ($this->items as $code => $item) {
			$runningQuantity = $item['quantity'];
			$product = $this->products[$code];
			
			//Check for and apply offers
			foreach ($product['offers'] as $offer) {
				$offersCountMod = $item['quantity'] % $offer['required_quantity'];
				$offersCount = ($item['quantity'] - $offersCountMod) / $offer['required_quantity'];
				if ($offersCount > 0) {
					$total += $offer['price'] * $offersCount;
					$runningQuantity -= $offersCount * $offer['required_quantity'];
				}
			}

			if ($runningQuantity === 0) {
				continue;
			}
			
			$total += $product['price'] * $runningQuantity;
		}
		
		$this->total = $total;
	}
	
	/**
	 * Load the products into the class.
	 * @return void
	 */
	private function loadProducts(): void {
		$this->products = ProductProvider::getProducts();
	}
	
	/**
	 * Clear the basket and reset the total
	 * @var void
	 */
	public function clear(): void {
		$this->items = [];
		$this->total = 0;
	}
}

?>
