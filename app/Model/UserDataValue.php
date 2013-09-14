<?php
App::uses('AppModel', 'Model');

class UserDataValue extends AppModel {
	var $name = 'UserDataValue';
	var $displayField = 'name';
	var $actsAs = array('Containable');
	var $order = 'created ASC';
	// Relations
	var $belongsTo = array('User', 'UserDataField');


}