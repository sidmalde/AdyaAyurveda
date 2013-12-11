<?php
class Modality extends AppModel {
	var $name = 'Modality';
	var $order = 'created';
	var $actsAs =  array('Containable');
	var $displayField = 'modality';
	
	var $hasMany = array(
		'KnowledgeBaseArticle'
	);
}
