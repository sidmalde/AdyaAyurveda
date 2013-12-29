<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
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
			),
			'conditions' => array(
				'Page.parent_page_id' => null,
			)
		);
		$pages = $this->Page->find('all', $options);
		
		$title_for_layout = __('Content Pages');
		$this->set(compact(array('title_for_layout', 'pages')));
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
		
		$title_for_layout = __('Content Pages :: New Page');
		
		$this->set(compact(array('title_for_layout', 'parentPageId')));
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
		
		$this->Page->contain();
		$page = $this->request->data = $this->Page->findById($this->request->params['page']);
		$title_for_layout = __('Content Pages :: Edit Page');
		$this->set(compact(array('title_for_layout', 'page')));
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
