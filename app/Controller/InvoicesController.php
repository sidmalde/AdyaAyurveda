<?php
App::uses('AppController', 'Controller');

class InvoicesController extends AppController {

	var $components = array('Pdf');


	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'invoices');
		$this->Auth->allow();
		$this->layout = 'admin';
	}

	function admin_index() {
		$this->Invoice->contain(array(
			'User'
		));
		$invoices = $this->Invoice->find('all');

		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'invoices', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$orders = $this->Invoice->Order->getUnInvoicedOrders();
		$title_for_layout = __('Invoices');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'invoices', 'orders')));
	}

	function admin_add() {
		$this->layout = false;
		$this->autoRender = false;

		// debug($this->request->data); die;

		if (!empty($this->request->data)) {
			if (!empty($this->request->data['Invoice']['order_id'])) {
				$orderId = $this->request->data['Invoice']['order_id'];
				$this->Invoice->Order->contain(array(
					'User',
				));
				$order = $this->Invoice->Order->findById($orderId);
				$vat = $order['Order']['total']*$this->vatRate;
				$this->request->data['Invoice'] = array(
					'user_id' => $order['User']['id'],
					'order_id' => $orderId,
					'ref' => $this->Invoice->getInvoiceRef(),
					'address_1' => $order['User']['address_1'],
					'address_2' => $order['User']['address_2'],
					'address_3' => $order['User']['address_3'],
					'city' => $order['User']['city'],
					'region' => $order['User']['region'],
					'postcode' => $order['User']['postcode'],
					'country' => $order['User']['country'],
					'vat' => $vat,
					'vat_rate' => $this->vatRate*100,
					'subtotal' => $order['Order']['total'],
					'discount' => '',
					'total_paid' => '',
					'total' => $order['Order']['total']+$vat,
				);		

				if ($this->Invoice->save($this->request->data)) {
					$invoiceId = $this->Invoice->id;
					$this->Invoice->Order->id = $orderId;
					$this->Invoice->Order->saveField('invoice_id', $invoiceId);
					$this->Invoice->contain(array(
						'Order' => array(
							'OrderItem' => 'Product',
						),
						'User',
					));
					$invoice = $this->Invoice->findById($invoiceId);
					$this->Pdf->generateInvoice($invoice);
				} else {
					$this->Session->setFlash(__('Unable to save'), 'flash_failure');
				}
			} else {
				$this->Session->setFlash(__('No Order selected'), 'flash_failure');
			}
		} else {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		}

		$this->redirect($this->referer());
	}

	function admin_view() {
		$this->layout = false;
		$this->autoRender = false;
		$this->Invoice->contain(array(
			'Order' => array(
				'OrderItem' => 'Product',
			),
			'User',
		));
		$invoice = $this->Invoice->findById($this->request->params['invoice']);
		$this->Pdf->generateInvoice($invoice);

	}

	function admin_edit() {
		
	}

	function admin_delete() {

	}

}