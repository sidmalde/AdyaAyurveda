<?php
App::uses('AppController', 'Controller');

class GroupsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'groups');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function admin_index() {
		$this->Group->contain(array(
			'User' => array(
				'conditions' => array(
					'User.active' => 1,
					'User.deleted' => 0,
				)
			),
		));
		$groups = $this->Group->find('all');
		$title_for_layout = __('Groups');
		$this->set(compact(array('title_for_layout', 'groups')));
	}
	
	public function admin_view() {
		if (!empty($this->params['group'])) {
			$this->Group->contain(array(
				'User'
			));
			$options = array(
				'conditions' => array(
					'Group.name' => $this->params['group'],
				),
			);
			$group = $this->Group->find('first', $options);
			
			$this->set('bodyClass', strtolower($group['Group']['name']).'s');
			if (!empty($group)) {
				$users['User'] = $group['User'];
			} else {
				$this->Session->setFlash('Inavlid Group');
				$this->redirect('index');
			}

			
			$title_for_layout = $group['Group']['name'];
			$this->set(compact(array('title_for_layout', 'group', 'users')));
		} else {
			$users = $this->User->find('all');
			$title_for_layout = __('Users');
			$this->set(compact(array('title_for_layout', 'users')));
		}

		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => array('controller' => 'users', 'action' => 'add'),
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
			),
		);

		$this->set(compact(array('headerButtons')));
	}
	
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'flash_failure');
			}
		}
		$title_for_layout = __('System Maintenance &#187; Groups &#187; New');
		$this->set(compact(array('title_for_layout')));
	}
	
	public function admin_edit($id = null) {
		if (empty($this->params['group'])) {
			$this->Session->setFlash(__('Invalid Group Id'), 'flash_failure');
			$this->redirect($this->referer);
		}
		
		$this->Group->contain();
		$options = array(
			'conditions' => array(
				'Group.id' => $this->params['group'],
			)
		);
		$group = $this->Group->find('first', $options);
		
		if (empty($group)) {
			$this->Session->setFlash(__('Invalid Group Id'), 'flash_failure');
			$this->redirect($this->referer());
		}
		$title_for_layout = sprintf(__('Groups &#187; Edit &#187; %s'), $group['Group']['name']);
		$this->set(compact(array('group', 'title_for_layout')));
		
		if (!empty($this->request->data)) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'), 'flash_success');
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'flash_failure');
			}
		} else {
			$this->request->data = $group;
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (empty($this->params['group'])) {
			$this->session->setFlash(__('Invalid Group'), 'flash_failure');
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}
		
		if ($this->Group->delete($this->params['group'])) {
			$this->Session->setFlash(__('Group deleted'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group was not deleted'), 'flash_failure');
		$this->redirect(array('controller' => 'users', 'action' => 'index'));
	}
}
