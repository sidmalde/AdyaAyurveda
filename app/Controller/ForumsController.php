<?php
App::uses('AppController', 'Controller');

class ForumsController extends AppController {
	
	var $uses = array('ForumCategory', 'ForumTopic', 'ForumPost');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'view_post', 'add_post');
		$this->layout = 'admin';
		$this->set('bodyClass', 'forums');
	}
	
	function index() {
		$this->layout = 'default';
		$this->ForumCategory->contain(array(
			/* 'ChildForumCategory' => array(
				'ForumTopic.id'
			), */
			'ForumTopic' => array(
				'order' => array(
					'ref' => 'ASC',
				),
				'ForumPost' => array(
					'fields' => array(
						'id'
					),
					'conditions' => array(
						'ForumPost.parent_forum_post_id' => null,
					),
				),
			),
		));
		$options = array(
			'conditions' => array(
				'ForumCategory.parent_forum_category_id' => null,
			),
		);
		$forumCategories = $this->ForumCategory->find('all', $options);
		$title_for_layout = __('Discusssion Forum');
		$this->set(compact(array('title_for_layout', 'forumCategories')));
	}
	
	function view() {
		$this->layout = 'default';
		$forumCategory = $this->request->params['forumCategory'];
		$forumTopicRef = $this->request->params['forumTopic'];
		
		$this->ForumCategory->ForumTopic->contain(array(
			'ForumCategory.ref',
			'ForumPost' => array(
				'conditions' => array(
					'ForumPost.parent_forum_post_id' => null,
				),
				'order' => array(
					'created' => 'ASC'
				),
				'User',
				'ChildForumPost' => array(
					'fields' => array(
						'id'
					),
					'order' => array(
						'created' => 'ASC'
					),
				),
			),
		));
		$forumTopic = $this->ForumCategory->ForumTopic->findByRef($forumTopicRef);
		if (empty($forumTopic)) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		$title_for_layout = __('Forum :: %s', $forumTopic['ForumTopic']['topic']);
		
		$this->set(compact(array('title_for_layout', 'forumCategory', 'forumTopicRef', 'forumTopic')));
	}
	
	function view_post() {
		$this->layout = 'default';
		$forumCategory = $this->request->params['forumCategory'];
		$forumTopic = $this->request->params['forumTopic'];
		$forumPostRef = $this->request->params['forumPost'];
		
		$this->ForumCategory->ForumTopic->ForumPost->contain(array(
			'ForumTopic' => array(
				'fields' => array(
					'ref',
					'topic',
				),
				'ForumCategory.ref',
			),
			'ChildForumPost' => array(
				'order' => array(
					'created' => 'ASC'
				),
				'User',
			),
			'User',
		));
		$forumPost = $this->ForumCategory->ForumTopic->ForumPost->findByRef($forumPostRef);
		if (empty($forumPost)) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		$title_for_layout = $forumPost['ForumPost']['post'];
		
		$this->set(compact(array('title_for_layout', 'forumCategory', 'forumTopic', 'forumPostRef', 'forumPost')));
	}
	
	function add_post() {
		$forumCategory = (empty($this->request->params['forumCategory'])) ? null : $this->request->params['forumCategory'];
		$forumTopic = (empty($this->request->params['forumTopic'])) ? null : $this->request->params['forumTopic'];
		$forumPost = (empty($this->request->params['forumPost'])) ? null : $this->request->params['forumPost'];
		
		if (!empty($this->request->data)) {
			if (!empty($forumPost)) { $this->request->data['ForumPost']['parent_forum_post_id'] = $this->ForumCategory->ForumTopic->ForumPost->field('id', array('ref' => $forumPost)); }
			$this->request->data['ForumPost']['ref'] = $this->ForumCategory->ForumTopic->ForumPost->getRef();
			$this->request->data['ForumPost']['forum_topic_id'] = $this->ForumCategory->ForumTopic->field('id', array('ref' => $forumTopic));
			$this->request->data['ForumPost']['user_id'] = $this->Auth->user('id');
			$this->request->data['ForumPost']['ip'] = $_SERVER['REMOTE_ADDR'];
			$this->ForumCategory->ForumTopic->ForumPost->create();
			if ($this->ForumCategory->ForumTopic->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('Your reply has been posted'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Your reply could not be saved'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
	
	function admin_index() {
		$this->ForumCategory->contain(array(
			/* 'ChildForumCategory' => array(
				'ForumTopic.id'
			), */
			'ForumTopic.id'
		));
		$options = array(
			'conditions' => array(
				'ForumCategory.parent_forum_category_id' => null,
			),
		);
		$forumCategories = $this->ForumCategory->find('all', $options);
		$title_for_layout = __('Forum Manager');
		$this->set(compact(array('title_for_layout', 'forumCategories')));
	}
	
	function admin_category_view() {
		if (empty($this->request->params['forumCategory'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		$this->ForumCategory->contain(array(
			'ForumTopic' => 'ForumPost.id'
		));
		$forumCategory = $this->ForumCategory->findById($this->request->params['forumCategory']);
		// debug($forumCategory); die;
		$forumCategories = $this->ForumCategory->getForumCategories();
		
		$title_for_layout = __('Forum Manager :: %s', $forumCategory['ForumCategory']['title']);
		$this->set(compact(array('title_for_layout', 'forumCategory', 'forumCategories')));
	}
	
	function admin_category_add() {
		if (!empty($this->request->data)) {
			if (empty($this->request->data['ForumCategory']['parent_forum_category_id'])) {
				unset($this->request->data['ForumCategory']['parent_forum_category_id']);
			}
			$this->request->data['ForumCategory']['ref'] = $this->ForumCategory->getRef();
			if ($this->ForumCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The forum category has been saved successfully.'), 'flash_success');
				$this->redirect(array('controller' => 'forums', 'action' => 'category_view', 'forumCategory' => $this->ForumCategory->id));
			} else {
				$this->Session->setFlash(__('The forum category could not be added, please try again.'), 'flash_failure');
			}
		}
		
		$forumCategories = $this->ForumCategory->getForumCategories();
		
		$title_for_layout = __('Forum Manager :: New Forum Category');
		$this->set(compact(array('title_for_layout', 'forumCategories')));
	}
	
	function admin_category_edit() {
		if (empty($this->request->params['forumCategory'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		if (!empty($this->request->data)) {
			if (empty($this->request->data['ForumCategory']['parent_forum_category_id'])) {
				unset($this->request->data['ForumCategory']['parent_forum_category_id']);
			}
			if ($this->ForumCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The forum category has been saved successfully.'), 'flash_success');
				$this->redirect(array('controller' => 'forums', 'action' => 'category_view', 'forumCategory' => $this->request->data['ForumCategory']['id']));
			} else {
				$this->Session->setFlash(__('The forum category could not be added, please try again.'), 'flash_failure');
			}
		}
		
		$this->ForumCategory->contain();
		$this->request->data = $forumCategory = $this->ForumCategory->findById($this->request->params['forumCategory']);
		
		$forumCategories = $this->ForumCategory->getForumCategories();
		
		$title_for_layout = __('Forum Manager :: Edit %s', $forumCategory['ForumCategory']['title']);
		$this->set(compact(array('title_for_layout', 'forumCategories')));
	}
	
	function admin_category_delete() {
		if (empty($this->request->params['forumCategory'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		} else {
			if ($this->ForumCategory->delete($this->request->params['forumCategory'])) {
				$this->Session->setFlash(__('Category has been deleted'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Category could not be deleted, please try again'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
	
	function admin_topic_view() {
	
	}
	
	function admin_topic_add() {
		if (!empty($this->request->data)) {
			$this->request->data['ForumTopic']['user_id'] = $this->Auth->user('id');
			$this->request->data['ForumTopic']['ref'] = $this->ForumCategory->ForumTopic->getRef();
			if ($this->ForumCategory->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('Forum Topic has been saved'), 'flash_success');
				$this->redirect(array('action' => 'category_view', 'forumCategory' => $this->request->data['ForumTopic']['forum_category_id']));
			} else {
				$this->Session->setFlash(__('Forum Topic could not be saved, please try again'), 'flash_failure');
			}
		}
		
		$forumCategories = $this->ForumCategory->getForumCategories();
		$title_for_layout = __('Forum Manager :: New Forum Topic');
		
		$this->set(compact(array('forumCategories', 'title_for_layout')));
	}
	
	function admin_topic_edit() {
	
	}
	
	function admin_topic_delete() {
	
	}
}
