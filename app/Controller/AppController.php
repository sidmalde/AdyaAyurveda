<?php
App::uses('Controller', 'Controller');
App::uses('Sanitize', 'Utility');

class AppController extends Controller {
	public $components = array(
		'Security' => array(
			'setHash' => 'md5',
			'validatePost' => false,
			'csrfCheck' => false,
		),
		'Acl',
		'Auth' => array(
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers')
			),
			'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin' => null),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email'),
				),
			),
			'userScope' => array(
				'User.active' => true,
				'User.deleted' => false,
			),
			'autoRedirect' => false,
		),
		'Session',
		'Email',
		/* 'DebugKit.Toolbar', */
	);
	public $helpers = array('Html', 'Form', 'Session', 'Number', 'Time', 'Text');
	
	public $userGenders = array(
		'Male' => 'Male',
		'Female' => 'Female',
	);
	
	public $userMaritalStatuses = array(
		'Single' => 'Single',
		'Married' => 'Married',
		'Partnership' => 'Partnership',
		'Divorced' => 'Divorced',
		'Widowed' => 'Widowed'
	);
	
	public $userTitles = array(
		'Mr' => 'Mr',
		'Mrs' => 'Mrs',
		'Miss' => 'Miss',
		'Dr' => 'Dr',
	);
	
	public $userFieldTypes = array(
		'list' => 'List',
		'boolean' => 'True or False',
		'text' => 'Text',
	);
	
	public $patientTypes = array(
		'All' => 'All',
		'Child' => 'Child',
		'Male' => 'Male',
		'Female' => 'Female',
	);
	
	public $allowedUploadExtensions = array(
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
	
	function beforeFilter() {
		//Configure SecurityComponent
		// Security::setHash('md5');
		
		if ($this->Auth->user()) {
			$this->currentUser = $this->Auth->user();
			$this->set('currentUser', $this->currentUser);
		}
		
	}
}