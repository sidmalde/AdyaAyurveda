<?php
class ForumTopic extends AppModel {
	var $name = 'ForumTopic';
	var $actsAs =  array('Containable');
	var $displayField = 'title';
	
	var $belongsTo = array(
		'ForumCategory',
		'User',
	);
	
	var $hasMany = array(
		'ForumPost'
	);
	
	function getRef(){
		$this->contain();
		$ref = $this->find('first', array('fields' => array('MAX(ForumTopic.ref) as max')));
		$ref = (float) $ref[0]['max'];
		return $ref+1;
	}
}