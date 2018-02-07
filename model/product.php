<?php
	
	class Product {
		public $product_id;
		public $product_name;
		public $quantity;
		public $unit;
		public $price;

		function getQuanity() {
			return "" . $this->quantity." ".$this->unit;
		}
	}