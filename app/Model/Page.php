<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'title';
	var $order = 'Page.position ASC';
	var $actsAs = array('Containable');
	
	var $validate = array(
		'url' => array(
			'rule' => array('notempty'),
			'message' => 'This is a required field and cannot be left empty'
		),
		/* 'label' => array(
			'rule' => array('notempty'),
			'message' => 'This is a required field and cannot be left empty'
		), */
		'title' => array(
			'rule' => array('notempty'),
			'message' => 'This is a required field and cannot be left empty'
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ParentPage' => array(
			'className' => 'Page',
			'foreignKey' => 'parent_page_id'
		)
	);
	var $hasMany = array(
		'ChildPage' => array(
			'className' => 'Page',
			'foreignKey' => 'parent_page_id',
			'order' => 'ChildPage.position ASC'
		),
	);
}
