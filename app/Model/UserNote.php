<?php
App::uses('AppModel', 'Model');

class UserNote extends AppModel {
	var $name = 'UserNote';
	var $displayField = 'summary';
	var $actsAs = array('Containable');
	var $order = 'UserNote.created ASC';
	// Relations
	var $belongsTo = array('User');
	
	/* var $validate = array(
		'summary' => array(
			'rule' => 'notEmpty',
			'message' => 'This is a required field and cannot be left empty.'
		),
	); */
}