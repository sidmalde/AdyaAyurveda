<?php
class Appointment extends AppModel {
	var $name = 'Appointment';
	var $order = 'Appointment.created';
	var $actsAs =  array('Containable');
	var $displayField = 'label';
	
	var $belongsTo = array(
		'User'
	);
}