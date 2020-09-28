<?php 
namespace App;
class Cart{
	public $product = null;
	public $totalPrice = 0;
	public $totalQty = 0;
	// hàm dựng
	public function __constant($cart){
		if($cart){
			$this->product = $cart->product;
			$this->totalPrice = $cart->totalPrice;
			$this->totalQty = $cart->totalQty;
		}
	}

	public function AddCart($product, $id){
		$newProduct = [
			'qty'=> 0,
			'price'=> $product->product_price,
			'productInfor'=> $product
		];
		if ($this->product) {
			if (array_key_exists($id, $newProduct)) {
				$newProduct = $product[$id];
			}
		}
		$newProduct['qty']++;
		$newProduct['price'] = $newProduct['qty'] * $product->product_price;
		$this->product[$id] = $newProduct;
		$this->totalPrice += $product->product_price;
		$this->totalQty ++;  
	}
}


 ?>