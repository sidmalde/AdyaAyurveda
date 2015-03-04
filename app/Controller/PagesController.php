<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'pages');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function display() {
		$path = func_get_args();
		$this->layout = 'default';

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	
	function home() {
		$this->layout = 'default';
		$title_for_layout = __('Welcome to Adya-Ayurveda');
		$this->set(compact(array('title_for_layout')));
	}
	
	function venues() {
		$this->layout = 'default';
		$title_for_layout = __('Venues');
		$this->set(compact(array('title_for_layout')));
	}
	
	function view() {
		$this->layout = 'default';
		$url = '/'.$this->request->url;
		
		$this->Page->contain();
		$options = array(
			'conditions' => array(
				'Page.url' => $url
			),
		);
		$page = $this->Page->find('first', $options);
		if (empty($page)) {
			$this->Session->setFlash(__('Page could not be found.'), 'flash_failure');
			$this->redirect('/');
		}
		// die;
		$title_for_layout = $page['Page']['title'];
		$content = $page['Page']['content'];
		
		$this->set(compact(array('title_for_layout', 'content')));
	}
	
	function admin_index() {
		$this->Page->contain(array(
			'ChildPage' => array(
				'ChildPage',
			),
		));
		$options = array(
			'fields' => array(
				'id',
				'label',
				'title',
				'url',
				'publish',
				'modified',
			),
			'conditions' => array(
				'Page.parent_page_id' => null,
			)
		);
		$pages = $this->Page->find('all', $options);
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'pages', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$title_for_layout = __('Content Pages');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'pages')));
	}
	
	function admin_add() {
		if (!empty($this->request->data)) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('New content page has been saved successfully'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('New content page could not be saved, please try again'), 'flash_failure');
			}
		}
		
		if (!empty($this->request->params['page'])) {
			$parentPageId = $this->request->params['page'];
		} elseif (!empty($this->request->data['Page']['parent_page_id'])) {
			$parentPageId = $this->request->data['Page']['parent_page_id'];
		}

		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'pages', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);


		$title_for_layout = __('Content Pages :: New Page');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'parentPageId')));
	}
	
	function admin_edit() {
		if (empty($this->request->params['page'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		if (!empty($this->request->data)) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('New content page has been saved successfully'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('New content page could not be saved, please try again'), 'flash_failure');
			}
		}
		
		$headerButtons[] = array(
			'title' => '<i class="fa fa-reply"></i> ' . __('Back'),
			'url' => array('controller' => 'pages', 'action' => 'index'),
			'options' => array(
				'class' => 'btn btn-danger',
				'escape' => false,
			),
		);

		$this->Page->contain();
		$page = $this->request->data = $this->Page->findById($this->request->params['page']);
		$title_for_layout = __('Content Pages :: Edit Page');
		$this->set(compact(array('headerButtons', 'title_for_layout', 'page')));
	}
	
	function admin_delete() {
		if (empty($this->request->params['page'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		} else {
			if ($this->Page->delete($this->request->params['page'])) {
				$this->Session->setFlash(__('Page has been deleted successfully'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Page could not be deleted, please try again'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
}
