<?php
class BlogArticle extends AppModel {
	var $name = 'BlogArticle';
	var $order = 'BlogArticle.created';
	var $actsAs =  array('Containable');
	var $displayField = 'title';
	
	var $belongsTo  = array(
		'User',
	);

	function getBlogArticleRef(){
		$this->contain();
		$blogArticleRef = $this->find('first', array('fields' => array('MAX(BlogArticle.ref) as max')));
		$blogArticleRef = $blogArticleRef[0]['max'];
		if ($blogArticleRef == 0) {
			$blogArticleRef = 2397;
		}
		return $blogArticleRef+1;
	}
}