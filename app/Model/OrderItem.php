<?php
class OrderItem extends AppModel {
	var $name = 'OrderItem';
	var $order = 'created';
	var $actsAs =  array('Containable');
	var $displayField = 'ref';
	
	var $belongsTo  = array(
		'Order',
		'Product',
	);
}