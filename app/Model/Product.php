<?php
class Product extends AppModel {
	var $name = 'Product';
	var $order = 'Product.created';
	var $actsAs =  array('Containable');
	var $displayField = 'name';
	
	var $hasMany = array(
		'Order'
	);
	
	function findList() {
		$this->contain();
		$options = array(
			'order' => array(
				'name' => 'ASC',
			),
		);
		$products = $this->find('all', $options);
		
		$formattedProducts = array();
		foreach ($products as $product) {
			$formattedProducts[$product['Product']['id']] = $product['Product']['name'].' ('.$product['Product']['quantity'].' '.$product['Product']['measurement'].')';
		}
		return $formattedProducts;
	}
	
	function getProductPrice($id) {
		$this->id = $id;
		return $this->field('price');
	}
}