<?php
App::uses('AppController', 'Controller');

class BlogArticlesController extends AppController {

	var $uses = array(
		'BlogArticle',
		'User',
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'blog_articles');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	function index() {
		$this->layout = 'default';

		$options = array(
			'conditions' => array(
				'BlogArticle.publish' => true,
			),
			'order' => array(
				'BlogArticle.created' => 'DESC',
			),
		);
		$blogArticles = $this->BlogArticle->find('all', $options);

		$title_for_layout = __('Blog');
		$this->set(compact(array('blogArticles', 'title_for_layout')));
	}
	
	function view() {
		$this->layout = 'default';
		if (empty($this->request->params['ref'])) {
			$this->Session->setFlash(__('Invalid Blog Article'), 'flash_failure');
			$this->redirect($this->referrer());
		}

		$blogArticle = $this->BlogArticle->findByRef($this->request->params['ref']);

		$title_for_layout = $blogArticle['BlogArticle']['title'];
		$this->set(compact(array('blogArticle', 'title_for_layout')));

	}

	function admin_index() {
		$options = array(
			'conditions' => array(
				'BlogArticle.publish' => true,
			),
			'order' => array(
				'BlogArticle.created' => 'DESC',
			),
		);
		$blogArticles = $this->BlogArticle->find('all', $options);

		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'blog_articles', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$title_for_layout = __('Blog Articles');
		$this->set(compact(array('headerButtons', 'blogArticles', 'title_for_layout')));
	}
	
	function admin_add() {
		if (!empty($this->request->data)) {
			if ($this->BlogArticle->save($this->request->data)) {
				$this->Session->setFlash(__('New Blog Article has been created'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('New Blog Article could not be created, please try again'), 'flash_failure');
			}
		}

		$users = $this->User->getAdminList();
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'blog_articles', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);


		$title_for_layout = __('Blog Articles :: New');
		$this->set(compact(array('headerButtons', 'blogArticles', 'title_for_layout', 'users')));
	}
	
	function admin_edit() {
		if (empty($this->request->params['blogArticle'])) {
			$this->Session->setFlash(__('Invalid Blog Article'), 'flash_failure');
			$this->redirect($this->referrer());
		}

		if (!empty($this->request->data)) {
			$this->request->data = $this->BlogArticle->getBlogArticleRef();
			if ($this->BlogArticle->save($this->request->data)) {
				$this->Session->setFlash(__('New Blog Article has been created'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('New Blog Article could not be created, please try again'), 'flash_failure');
			}
		}

		$this->BlogArticle->contain();
		$this->request->data = $blogArticle = $this->BlogArticle->findById($this->request->params['blogArticle']);
		
		$users = $this->User->getAdminList();

		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'blog_articles', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$title_for_layout = __('Blog Articles :: Edit');
		$this->set(compact(array('headerButtons', 'blogArticle', 'title_for_layout', 'users')));
	}
	
	function admin_delete() {
		if (empty($this->request->params['blogArticle'])) {
			$this->Session->setFlash(__('Invalid Blog Article'), 'flash_failure');
			$this->redirect($this->referrer());
		}

		if ($this->BlogArticle->delete($this->request->params['blogArticle'])) {
			$this->Session->setFlash(__('Blog Article has been deleted'), 'flash_success');
		} else {
			$this->Session->setFlash(__('Blog Article could not be deleted, please try again'), 'flash_failure');
		}
		$this->redirect($this->referrer());		
	}
}