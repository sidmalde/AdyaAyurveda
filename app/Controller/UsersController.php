<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
		$this->set('bodyClass', 'users');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function admin_index() {
		$this->User->Group->contain(array(
			'User' => array(
				'conditions' => array(
					'User.active' => 1,
				)
			),
		));
		$groups = $this->User->Group->find('all');
		
		$pageTitle = __('Users');
		$this->set(compact(array('pageTitle', 'groups')));
	}
	
	public function admin_view() {
		if (empty($this->params['user'])) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('index');
		}
		
		$users = $this->User->find('list');
		$options = array(
			'conditions' => array(
				'User.id' => $this->params['user']
			)
		);
		$this->User->contain(array(
			'Group',
			'UserNote',
		));
		$this->request->data = $user = $this->User->find('first', $options);
		
		if (empty($user)) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('index');
		}
		$groups = $this->User->Group->find('list');
		$pageTitle = sprintf(__('%ss &#187; %s'), $user['Group']['name'], $user['User']['fullnameNoTitle']);
		
		$this->loadModel('Country');
		$countries = $this->Country->getIsoNameList();
		$this->User->UserDataValue->UserDataField->contain();
		$options = array(
			'conditions' => array(
				'UserDataField.gender' => array(
					'Both',
					$user['User']['gender'],
				),
			),
			'order' => array(
				'UserDataField.gender' => 'DESC',
			),
		);
		$userDataFields = $this->User->UserDataValue->UserDataField->find('all', $options);
		
		foreach($userDataFields as $index => $userDataField) {
			if ($userDataField['UserDataField']['type'] == 'list') {
				$temparray = array();
				$explodedValues = explode(',', $userDataField['UserDataField']['values']);
				foreach ($explodedValues as $explodedValue) {
					$temparray[trim($explodedValue)] = trim($explodedValue);
				}
				$userDataFields[$index]['UserDataField']['options'] = $temparray;
			}
		}
		// debug($userDataFields);
		// die;
		$this->set(compact(array('countries', 'users', 'user', 'groups', 'pageTitle', 'userDataFields')));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->request->data['User']['active'] = true;
			$this->request->data['User']['deleted'] = false;
			
			
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_failure');
			}
		}
		$groups = $this->User->Group->find('list');
		$pageTitle = __('System Maintenance &#187; Users &#187; New');
		
		$this->set('userGenders', $this->userGenders);
		$this->set('userMaritalStatuses', $this->userMaritalStatuses);
		$this->set('userTitles', $this->userTitles);
		$this->set('patientTypes', $this->patientTypes);
		$this->set(compact(array('groups', 'pageTitle')));
	}

	public function admin_edit($id = null) {
		if (empty($this->params['user'])) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('dashboard');
		}
		
		$this->User->contain(array(
			'Group'
		));
		$options = array(
			'conditions' => array(
				'User.id' => $this->params['user'],
			)
		);
		
		$user = $this->User->find('first', $options);
		
		if (empty($user)) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('dashboard');
		}
		
		$allowedExtensions = array(
			'doc' => 'doc',
			'docx' => 'docx',
			'xls' => 'xls',
			'xlsx' => 'xlsx',
			'pdf' => 'pdf',
			'jpg' => 'jpg',
			'jpeg' => 'jpeg',
			'gif' => 'gif',
			'png' => 'png',
			'tiff' => 'tiff',
		);
		
		if (!empty($this->request->data)) {
			if (!empty($this->request->data['User']['profileSave'])) {
				$save = false;
				if ($user['User']['mobile'] != $this->request->data['User']['mobile']) {
					$user['User']['mobile'] = $this->request->data['User']['mobile'];
					$save = true;
				}
				
				if ($user['User']['phone'] != $this->request->data['User']['phone']) {
					$user['User']['phone'] = $this->request->data['User']['phone'];
					$save = true;
				}
				
				if (!empty($this->request->data['User']['current_password']) && AuthComponent::password($this->request->data['User']['current_password']) == $user['User']['password']) {
					if (!empty($this->request->data['User']['new_password']) && !empty($this->request->data['User']['confirm_password'])) {
						if ($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_password']) {
							$user['User']['password'] = $this->request->data['User']['new_password'];	
							$save = true;
						} else {
							$message = __('Please ensure passwords match.');
							$type = 'flash_failure';
						}
					} else {
						$message = __('Please ensure passwords are not empty and match.');
						$type = 'flash_failure';
					}
				}
				
				if ($save) {
					// echo ($this->request->data['User']['current_password']);
					// echo ($this->request->data['User']['new_password']);
					// echo ($this->request->data['User']['confirm_password']);
					// echo (AuthComponent::password($this->request->data['User']['current_password']));
					// echo ($user['User']['password']);
					// die;
					if ($this->User->save($user)) {
						$message = __('Your details have been updated.');
						$type = 'flash_success';
					} else {
						$message = __('There was a problem updating your details, please try again.');
						$type = 'flash_failure';
					}
				}
				
				if (empty($message)) {
					$message = __('No changes required');
					$type = 'flash_success';
				}
				$this->Session->setFlash($message, $type);
				
				$this->redirect($this->referer());
			} else {
				if (!empty($this->request->data['UserNote']['summary'])) {
					if (!empty($this->request->data['UserNote']['id'])) {
						$userNote['id'] = $this->request->data['UserNote']['id'];
					} else {
						$usernote = $this->User->UserNote->create();
					}
					$userNote['creator_id'] = $this->Auth->user('id');
					$userNote['user_id'] = $this->request->data['User']['id'];
					$userNote['summary'] = $this->request->data['UserNote']['summary'];
					$userNote['description'] = $this->request->data['UserNote']['description'];
					$this->User->UserNote->save($userNote);
				}
				
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'), 'flash_success');
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_failure');
				}
			}
		}
		
		$this->redirect(array('action' => 'view', 'user' => $user['User']['id']));
	}

	public function admin_delete($id = null) {
		if (empty($this->params['user'])) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
		}
		
		$this->User->contain();
		$user = $this->User->findById($this->params['user']);
		if (!empty($user)) {
			$user['User']['active'] = 0;
			$user['User']['deleted'] = 1;
			
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('User deleted'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('User was not deleted'), 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_dashboard() {
		if (!empty($this->params['tab'])) {
			$this->set('selectedTab', $this->params['tab']);
		} else {
			$this->set('selectedTab', 'logs');
		}
		
		$logStartDate = date("Y-m-d", strtotime(date("Y-m-d").' - 15 days'));
		$options = array(
			'conditions' => array(
				'Log.created >' => $logStartDate
			),
			'order' => array(
				'Log.created' => 'DESC'
			),
		);
		$systemLogs = $this->Log->find('all', $options);
		$this->request->data = $this->User->findById($this->Auth->user('id'));
		$pageTitle = __('Dashboard');
		$bodyClass = 'dashboard';
		$this->set(compact(array('pageTitle', 'bodyClass', 'systemLogs')));
	}
	
	public function admin_data_field_index() {
		$this->User->UserDataValue->UserDataField->contain();
		$userDataFields = $this->User->UserDataValue->UserDataField->find('all');
		
		$pageTitle = __('System Maintenance &#187; Data Fields');
		$this->set(compact(array('pageTitle', 'userDataFields')));
	}
	
	public function admin_data_field_add() {
		if (!empty($this->request->data)) {
			$this->request->data['UserDataField']['field_name'] = implode("_", explode(" ", strtolower($this->request->data['UserDataField']['field_name'])));
			$this->User->UserDataValue->UserDataField->create();
			if ($this->User->UserDataValue->UserDataField->save($this->request->data)) {
				$this->Session->setFlash(__('Data field saved Successfully'), 'flash_success');
				$this->redirect(array('action' => 'data_field_index'));
			} else {
				$this->Session->setFlash(__('Data field could not be saved, please try again'), 'flash_failure');
			}
		}
		
		$pageTitle = __('System Maintenance &#187; Data Field &#187; New');
		$userGenders = $this->userGenders;
		$userGenders['Both'] = __('Both');
		$this->set('userGenders', $userGenders);
		$this->set('userFieldTypes', $this->userFieldTypes);
		$this->set(compact(array('pageTitle')));
	}
	
	public function admin_data_field_edit() {
		if (empty($this->request->params['userDataField'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}
		
		if (!empty($this->request->data)) {
			$this->User->UserDataValue->UserDataField->create();
			if ($this->User->UserDataValue->UserDataField->save($this->request->data)) {
				$this->Session->setFlash(__('Data field saved Successfully'), 'flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('Data field could not be saved, please try again'), 'flash_failure');
			}
		}
		
		$pageTitle = __('System Maintenance &#187; Data Field &#187; Edit');
		$this->User->UserDataValue->UserDataField->contain();
		$userDataField = $this->User->UserDataValue->UserDataField->findById($this->request->params['userDataField']);
		$userGenders = $this->userGenders;
		$userGenders['Both'] = __('Both');
		$this->set('userGenders', $userGenders);
		$this->set('userFieldTypes', $this->userFieldTypes);
		$this->set(compact(array('pageTitle', 'userDataField')));
	}
	
	public function admin_data_field_delete() {
		if (empty($this->request->params['userDataField'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
		} else {
			if ($this->User->UserDataValue->UserDataField->delete($this->params['userDataField'])) {
				$this->Session->setFlash(__('User Data Field has been deleted'), 'flash_success');
			} else {
				$this->Session->setFlash(__('User Data Field could not be deleted'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
	
	public function login() {
		$this->layout = 'default';
		if ($this->Auth->user()) {
			if ($this->Auth->user('group_id') == '52346d30-68f8-4e91-b19b-1368d96041f1') {
				$this->redirect('/admin');
			} else {
				$this->redirect('/myportal');
			}
		} else {
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					if ($this->Auth->user('group_id') == '51488314-33c4-4394-8d02-0f0c46dad844') {
						$this->redirect('/admin');
					} else {
						$this->redirect('/myportal');
					}
				} else {
					$this->Session->setFlash(__('Your email or password was incorrect.'), 'flash_failure');
				}
			}
		}
	}

	public function logout() {
		$this->Session->setFlash(__('You have now been logged out'), 'flash_success');
		$this->redirect($this->Auth->logout());
	}
	
}
