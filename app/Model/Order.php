<?php
class Order extends AppModel {
	var $name = 'Order';
	var $order = 'Order.created';
	var $actsAs =  array('Containable');
	var $displayField = 'ref';
	
	var $hasMany  = array(
		'OrderItem'
	);
	
	var $belongsTo  = array(
		'User',
		'Patient' => array(
			'className' => 'User',
			'conditions' => array(
				'Patient.deleted' => 0,
				'Patient.active' => 1,
				'Patient.group_id' => '5234723b-bdbc-4e50-930c-1368d96041f1',
			)
		),
		'Status',
	);
	
	function getOrderRef(){
		$this->contain();
		$orderRef = $this->find('first', array('fields' => array('MAX(Order.ref) as max')));
		$orderRef = $orderRef[0]['max'];
		if ($orderRef == 0) {
			$orderRef = 1000;
		}
		return $orderRef+1;
	}
}