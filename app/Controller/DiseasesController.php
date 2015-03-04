<?php
App::uses('AppController', 'Controller');

class DiseasesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'diseases');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	function admin_index() {
		$options = array(
			'order' => array(
				'disease' => 'asc'
			),
		);
		$diseases = $this->Disease->find('all', $options);
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'diseases', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$title_for_layout = __('Diseases');
		$this->set(compact(array('headerButtons', 'diseases', 'title_for_layout')));
	}
	
	function admin_view() {
		if (empty($this->request->params['disease'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		$this->Disease->contain(array(
			'KnowledgeBaseArticle' => 'Modality',
		));
		$disease = $this->Disease->findById($this->request->params['disease']);
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'diseases', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$title_for_layout = __('Disease :: Edit %s', $disease['Disease']['disease']);
		$this->set(compact(array('headerButtons', 'title_for_layout', 'disease')));
	}
	
	function admin_add() {
		if (!empty($this->request->data)) {
			$this->Disease->create();
			if ($this->Disease->save($this->request->data)) {
				$this->Session->setFlash(__('Disease %s has been saved.', $this->request->data['Disease']['disease']), 'flash_success');
				$this->redirect('index');
			} else {
				$this->Session->setFlash(__('Disease could not be saved, please try again.'), 'flash_failure');
			}
		}
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'diseases', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$title_for_layout = __('Disease :: New Disease');
		$this->set(compact(array('headerButtons', 'title_for_layout')));
	}
	
	function admin_edit() {
		if (empty($this->request->params['disease'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		if (!empty($this->request->data)) {
			if ($this->Disease->save($this->request->data)) {
				$this->Session->setFlash(__('Disease %s has been saved.', $this->request->data['Disease']['disease']), 'flash_success');
				$this->redirect('index');
			} else {
				$this->Session->setFlash(__('Disease could not be saved, please try again.'), 'flash_failure');
			}
		}
		
		$this->Disease->contain();
		$disease = $this->Disease->findById($this->request->params['disease']);
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'diseases', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);


		$title_for_layout = __('Disease :: Edit %s', $disease['Disease']['disease']);
		$this->set(compact(array('headerButtons', 'title_for_layout', 'disease')));
	}
	
	function admin_delete() {
		if (empty($this->request->params['disease'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		} else {
			$this->Disease->contain();
			$disease = $this->Disease->findById($this->request->params['disease']);
			
			if ($this->Disease->delete($this->request->params['disease'])) {
				$this->Session->setFlash(__('Disease %s has been deleted.', $disease['Disease']['disease']), 'flash_success');
			} else {
				$this->Session->setFlash(__('Disease %s could not be deleted, please try again.', $disease['Disease']['disease']), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
}
