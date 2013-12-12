<?php
App::uses('AppController', 'Controller');

class OrdersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'orders');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	function admin_index() {
		$this->Order->contain(array(
			'User',
			'Patient',
			'OrderItem',
		));
		$orders = $this->Order->find('all');
		
		$title_for_layout = __('Orders');
		$this->set(compact(array('title_for_layout', 'orders')));
	}
	
	function admin_add() {
		if (!empty($this->request->data)) {
			$runningTotal = 0;
			$orderItems = array();
			foreach ($this->request->data['OrderItem'] as $orderItem) {
				if (!empty($orderItem['product_id'])) {
					$productPrice = $this->Order->OrderItem->Product->getProductPrice($orderItem['product_id']);
					$runningTotal += $productPrice;
					$orderItems[] = array(
						'product_id' => $orderItem['product_id'],
						'notes' => $orderItem['notes'],
						'sub_total' => $productPrice,
					);
				}
			}
			
			if (!empty($orderItems)) {
				$order = array(
					'user_id' =>  $this->Auth->user('id'),
					'patient_id' =>  $this->request->data['Order']['patient_id'],
					'ref' => $this->Order->getOrderRef(),
					'total' => $runningTotal,
				);
				$this->Order->create();
				$this->Order->save($order);
				$orderId = $this->Order->id;
				
				$actualCount = count($orderItems);
				$saveCount = 0;
				foreach ($orderItems as $orderItem) {
					$orderItem['order_id'] = $orderId;
					$this->Order->OrderItem->create();
					if ($this->Order->OrderItem->save($orderItem)) {
						$saveCount++;
					}
				}
				
				if ($actualCount == $saveCount) {
					$this->Session->setFlash(__('All orders created successfully'), 'flash_success');
					$this->redirect('index');
				} else {
					$this->Session->setFlash(__('All orders could not be created successfully'), 'flash_failure');
				}
			} else {
				$this->Session->setFlash(__('No order items for order'), 'flash_failure');
			}
		}
		$products = $this->Order->OrderItem->Product->findList();
		$patients = $this->Order->User->getPatientList();
		$title_for_layout = __('Orders :: New Order');
		$this->set(compact(array('title_for_layout', 'products', 'patients')));
	}
	
	
	function admin_edit() {
		if (empty($this->request->params['order'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect('index');
		}
		
		if (!empty($this->request->data)) {
			$runningTotal = 0;
			$orderItems = array();
			foreach ($this->request->data['OrderItem'] as $orderItem) {
				if (!empty($orderItem['product_id'])) {
					$productPrice = $orderItem['sub_total'];
					$runningTotal += $productPrice;
					$orderItems[] = array(
						'id' => $orderItem['id'],
						'product_id' => $orderItem['product_id'],
						'order_id' => $this->request->data['Order']['id'],
						'notes' => $orderItem['notes'],
						'sub_total' => $productPrice,
					);
				}
			}
			
			if (!empty($orderItems)) {
				$order = array(
					'id' =>  $this->request->data['Order']['id'],
					'user_id' =>  $this->Auth->user('id'),
					'patient_id' =>  $this->request->data['Order']['patient_id'],
					'total' => $runningTotal,
				);
				$this->Order->save($order);
				
				$actualCount = count($orderItems);
				$saveCount = 0;
				foreach ($orderItems as $orderItem) {
					if ($this->Order->OrderItem->save($orderItem)) {
						$saveCount++;
					}
				}
				
				if ($actualCount == $saveCount) {
					$this->Session->setFlash(__('All orders created successfully'), 'flash_success');
					$this->redirect('index');
				} else {
					$this->Session->setFlash(__('All orders could not be created successfully'), 'flash_failure');
				}
			} else {
				$this->Session->setFlash(__('No order items for order'), 'flash_failure');
			}
		}
		
		$this->Order->contain(array(
			'OrderItem' => 'Product',
		));
		$order = $this->Order->findById($this->request->params['order']);
		
		$products = $this->Order->OrderItem->Product->findList();
		$patients = $this->Order->User->getPatientList();
		
		$title_for_layout = __('Orders :: Edit Order');
		$this->set(compact(array('title_for_layout', 'order', 'products', 'patients')));
	}
	
	function admin_delete() {
		if (empty($this->request->params['product'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		} else {
			if ($this->Product->delete($this->request->params['product'])) {
				$this->Session->setFlash(__('Product successfully deleted.'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Could not delete Product, please try again.'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
}