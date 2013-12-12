<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'products');
		$this->Auth->allow();
		$this->layout = 'admin';
		
		$measurements = array(
			'Capsules' => 'Capsules',
			'Caplets' => 'Caplets',
			'Tablets' => 'Tablets',
			'Millilitres' => 'Millilitres',
			'Litres' => 'Litres',
			'Grams' => 'Grams',
			'Kilos' => 'Kilos',
		);
		
		$this->set(compact(array('measurements')));
	}
	
	function admin_index() {
		$this->Product->contain();
		$products = $this->Product->find('all');
		
		$title_for_layout = __('Products');
		$this->set(compact(array('title_for_layout', 'products')));
	}
	
	function admin_add() {
		if (!empty($this->request->data)) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('Product has been saved.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Product could not be saved.'), 'flash_failure');
			}
		}
		
		$title_for_layout = __('Products :: New Product');
		$this->set(compact(array('title_for_layout')));
	}
	
	
	function admin_edit() {
		if (empty($this->request->params['product'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect('index');
		}
		
		if (!empty($this->request->data)) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('Product has been saved.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Product could not be has been saved.'), 'flash_failure');
			}
		}
		$product = $this->Product->findById($this->request->params['product']);
		$title_for_layout = __('Products :: Edit Product');
		$this->set(compact(array('title_for_layout', 'product')));
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
