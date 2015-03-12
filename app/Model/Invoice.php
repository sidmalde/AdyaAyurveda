<?php
class Invoice extends AppModel {
	var $name = 'Invoice';
	var $order = 'Invoice.created';
	var $actsAs =  array('Containable');
	var $displayField = 'ref';
	
	
	
	var $belongsTo  = array(
		'Order',
		'User',
		'Patient' => array(
			'className' => 'User',
			'conditions' => array(
				'Patient.group_id' => '5234723b-bdbc-4e50-930c-1368d96041f1',
			)
		),
		'Status',
	);
	
	function getInvoiceRef(){
		$this->contain();
		$invoiceRef = $this->find('first', array('fields' => array('MAX(Invoice.ref) as max')));
		$invoiceRef = $invoiceRef[0]['max'];
		if ($invoiceRef == 0) {
			$invoiceRef = 1000;
		}
		return $invoiceRef+1;
	}
}