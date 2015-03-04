<?php
class ForumPost extends AppModel {
	var $name = 'ForumPost';
	var $actsAs =  array('Containable');
	var $displayField = 'title';
	
	var $hasMany = array(
		'ChildForumPost' => array(
			'className' => 'ForumPost',
			'foreignKey' => 'parent_forum_post_id'
		),
	);
	var $belongsTo = array(
		'ForumTopic',
		'ParentForumPost' => array(
			'className' => 'ForumPost',
			'foreignKey' => 'parent_forum_post_id'
		),
		'User',
		'SystemStatus',
	);
	
	function getRef(){
		$this->contain();
		$ref = $this->find('first', array('fields' => array('MAX(ForumPost.ref) as max')));
		$ref = (float) $ref[0]['max'];
		return $ref+1;
	}
	
	var $validate = array(
		'post' => array(
			'rule' => 'notEmpty',
			'message' => 'This is a required field and cannot be left empty'
		),
	);
}