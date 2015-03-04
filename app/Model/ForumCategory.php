<?php
class ForumCategory extends AppModel {
	var $name = 'ForumCategory';
	var $actsAs =  array('Containable');
	var $displayField = 'title';
	
	/* var $belongsTo = array(
		'ParentForumCategory' => array(
			'className' => 'ForumCategory',
			'foreignKey' => 'parent_forum_category_id'
		)
	); */
	
	var $hasMany = array(
		/* 'ChildForumCategory' => array(
			'className' => 'ForumCategory',
			'foreignKey' => 'parent_forum_category_id'
		), */
		'ForumTopic'
	);
	
	function getForumCategories() {
		$options = array(
			'conditions' => array(
				'ForumCategory.parent_forum_category_id' => null,
				'ForumCategory.publish' => true,
			),
		);
		return ($this->find('list', $options));
	}
	
	function getRef(){
		$this->contain();
		$ref = $this->find('first', array('fields' => array('MAX(ForumCategory.ref) as max')));
		$ref = (float) $ref[0]['max'];
		return $ref+1;
	}
}