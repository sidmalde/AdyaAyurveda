<?php
App::uses('AppController', 'Controller');

class KnowledgeBaseArticlesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'knowledge_base_articles');
		$this->Auth->allow();
		$this->layout = 'admin';
		
		$modalities = $this->KnowledgeBaseArticle->Modality->find('list');
		$diseases = $this->KnowledgeBaseArticle->Disease->find('list');
		
		$this->set(compact(array('modalities', 'diseases')));
	}
	
	function admin_index() {
		$this->KnowledgeBaseArticle->Modality->contain(array(
			'KnowledgeBaseArticle' => 'Disease'
		));
		$kbArticles = $this->KnowledgeBaseArticle->Modality->find('all');
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'knowledge_base_articles', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$title_for_layout = __('Knowledge Base Articles');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'kbArticles')));
	}
	
	function admin_add() {
		if (!empty($this->request->data)) {
			$this->KnowledgeBaseArticle->create();
			if ($this->KnowledgeBaseArticle->save($this->request->data)) {
				$this->Session->setFlash(__('KB Article has been saved.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('KB Article could not be saved.'), 'flash_failure');
			}
		}
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'knowledge_base_articles', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$title_for_layout = __('Knowledge Base Articles :: New Article');
		$this->set(compact(array('headerButtons', 'title_for_layout')));
	}
	
	function admin_view() {
		if (empty($this->request->params['kbArticle'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect('index');
		}
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'knowledge_base_articles', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);
		
		$kbArticle = $this->KnowledgeBaseArticle->findById($this->request->params['kbArticle']);
		$title_for_layout = __('Knowledge Base Articles :: %s', $kbArticle['KnowledgeBaseArticle']['title']);
		$this->set(compact(array('headerButtons', 'title_for_layout', 'kbArticle')));
	}
	
	function admin_edit() {
		if (empty($this->request->params['kbArticle'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect('index');
		}
		
		if (!empty($this->request->data)) {
			if ($this->KnowledgeBaseArticle->save($this->request->data)) {
				$this->Session->setFlash(__('KB Article has been saved.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('KB Article could not be saved.'), 'flash_failure');
			}
		}
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'knowledge_base_articles', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$kbArticle = $this->KnowledgeBaseArticle->findById($this->request->params['kbArticle']);
		$title_for_layout = __('Knowledge Base Articles :: Edit Article');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'kbArticle')));
	}
	
	function admin_delete() {
		if (empty($this->request->params['kbArticle'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		} else {
			if ($this->KnowledgeBaseArticle->delete($this->request->params['kbArticle'])) {
				$this->Session->setFlash(__('KB Article successfully deleted.'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Could not delete KB Article, please try again.'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
}
