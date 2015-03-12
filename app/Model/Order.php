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

	
	function getUnInvoicedOrders(){
		$this->contain(array(
			'User',
		));
		$options = array(
			'conditions' => array(
				'Order.invoice_id' => null,
			)
		);
		$orders = $this->find('all', $options);

		$returnArray = array();
		foreach($orders as $order) {
			$returnArray[$order['Order']['id']] = __('#%s for patient %s total of %d without VAT', $order['ref'], $order['User']['title'] . ' ' . $order['User']['firstname'] . ' ' . $order['User']['lastname'], $order['total']);
		}
		return $returnArray;
	}
}