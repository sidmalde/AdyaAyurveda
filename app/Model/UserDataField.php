<?php
App::uses('AppModel', 'Model');

class UserDataField extends AppModel {
	var $name = 'UserDataField';
	var $displayField = 'name';
	var $actsAs = array('Containable');
	var $order = 'created ASC';
	// Relations
	var $hasMany = array('UserDataValue');


}