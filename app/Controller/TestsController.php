<?php
App::uses('AppController', 'Controller');

class TestsController extends AppController {
	
	var $components = array('Sms');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'tests');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function index() {
		$this->layout = false;
		$this->autoRender = false;
		// debug('here'); die;
		$this->Sms->send('44545976559', 'This is a test message', true);
	}
}