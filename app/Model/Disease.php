<?php
class Disease extends AppModel {
	var $name = 'Disease';
	var $order = 'created';
	var $actsAs =  array('Containable');
	var $displayField = 'disease';
	
	var $hasMany = array(
		'KnowledgeBaseArticle'
	);
}