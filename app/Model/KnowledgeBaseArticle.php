<?php
class KnowledgeBaseArticle extends AppModel {
	var $name = 'KnowledgeBaseArticle';
	var $actsAs =  array('Containable');
	var $displayField = 'title';
	
	var $belongsTo = array(
		'Disease',
		'Modality',
	);
	
	var $validate = array(
		'disease_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Diesease is a required field.',
			'required' => true,
			'allowEmpty' => false,
		),
		'modality_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Modality is a required field.',
			'required' => true,
			'allowEmpty' => false,
		),
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'Title is a required field.',
			'required' => true,
			'allowEmpty' => false,
		),
		'content' => array(
			'rule' => 'notEmpty',
			'message' => 'Content is a required field.',
			'required' => true,
			'allowEmpty' => false,
		),
	);
}