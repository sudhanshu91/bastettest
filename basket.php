<?php

class Basket {
		private $catalogue;
		private $deliveryCharges;
		private $offers;
		private $items = [];

		public function __construct($catalogue, $deliveryCharges, $offers) {
			$this->catalogue = $catalogue;
			$this->deliveryCharges = $deliveryCharges;
			$this->offers = $offers;
		}

		public function add($productCode) {
			if (isset($this->catalogue[$productCode])) {
				$this->items[] = $productCode;
			}
		}

		public function total() {
			$total = 0;
			$productCounts = array_count_values($this->items);

			foreach ($productCounts as $productCode => $count) {
				$price = $this->catalogue[$productCode];
				if (isset($this->offers[$productCode])) {
					$total += $this->applyOffer($productCode, $count, $price);
				} else {
					$total += $count * $price;
				}
			}

			$total += $this->calculateDelivery($total);
			return number_format($total, 2);
		}

		private function applyOffer($productCode, $count, $price) {
			$offer = $this->offers[$productCode];
			$total = 0;

			if ($offer['type'] === 'buy_one_get_one_half_price') {
				$fullPriceCount = ceil($count / 2);
				$halfPriceCount = floor($count / 2);
				$total = $fullPriceCount * $price + $halfPriceCount * $price / 2;
			}

			return $total;
		}

		private function calculateDelivery($subtotal) {
			foreach ($this->deliveryCharges as $limit => $charge) {
				if ($subtotal < $limit) {
					return $charge;
				}
			}
			return 0;
		}
	}

	$catalogue = [
		'R01' => 32.95,
		'G01' => 24.95,
		'B01' => 7.95
	];

	$deliveryCharges = [
		50 => 4.95,
		90 => 2.95,
		PHP_INT_MAX => 0
	];

	$offers = [
		'R01' => [
			'type' => 'buy_one_get_one_half_price'
		]
	];

	$basket = new Basket($catalogue, $deliveryCharges, $offers);

	$basket->add('B01');
	$basket->add('G01');
	echo "Total: $" . $basket->total() . "\n";  

	$basket = new Basket($catalogue, $deliveryCharges, $offers);
	$basket->add('R01');
	$basket->add('R01');
	echo "Total: $" . $basket->total() . "\n"; 

	$basket = new Basket($catalogue, $deliveryCharges, $offers);
	$basket->add('R01');
	$basket->add('G01');
	echo "Total: $" . $basket->total() . "\n"; 

	$basket = new Basket($catalogue, $deliveryCharges, $offers);
	$basket->add('B01');
	$basket->add('B01');
	$basket->add('R01');
	$basket->add('R01');
	$basket->add('R01');
	echo "Total: $" . $basket->total() . "\n"; 

?>
