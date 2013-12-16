<?php
class Upload extends AppModel {
	var $name = 'Upload';
	var $displayField = 'label';
	var $actsAs = array('Containable');
	
	var $belongsTo = array('User');
}
