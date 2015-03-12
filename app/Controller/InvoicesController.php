<?php
App::uses('AppController', 'Controller');

class InvoicesController extends AppController {


	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'invoices');
		$this->Auth->allow();
		$this->layout = 'admin';
	}

	function admin_index() {
		$this->Invoice->contain();
		$invoices = $this->Invoice->find('all');

		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'invoices', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$title_for_layout = __('Invoices');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'invoices')));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			// s
		}

		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'invoices', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$patients = $this->Invoice->Order->User->getPatientList();
		$this->Invoice->Order->contain(array(
			'User',
		));
		$options = array(
			'conditions' => array(
				'Order.invoice_id' => null,
			)
		);
		$orders = $this->Invoice->Order->find('all', $options);
		$orders = $this->Invoice->Order->getUnInvoicedOrders('all', $options);
		$title_for_layout = __('Invoices :: New');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'patients', 'orders')));
	}

	function admin_view() {
		
	}

	function admin_edit() {
		
	}

	function admin_delete() {

	}

}