<?php
App::uses('AppController', 'Controller');

class AppointmentsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'appointments');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function admin_index() {
		$headerButtons[] = array(
			'title' => '<i class="fa fa-plus-square large"></i>',
			'url' => '#',
			'options' => array(
				'class' => 'btn btn-success',
				'escape' => false,
				'data-toggle' => 'modal',
				'data-target' => '#addApp',
			),
		);
		
		$title_for_layout = __('Appointments');
		
		$patients = $this->Appointment->User->getPatientList();

		$this->set(compact(array('headerButtons', 'title_for_layout', 'patients')));
	}
	
	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->request->data['Appointment']['start'] = date('Y-m-d H:i:s', strtotime($this->request->data['Appointment']['start']));
			$this->request->data['Appointment']['end'] = date('Y-m-d H:i:s', strtotime($this->request->data['Appointment']['end']));
			
			$this->Appointment->create();
			if ($this->Appointment->save($this->request->data)) {
				$this->Session->setFlash(__('Appointment has been created.'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Appointment could not be created, please try again.'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
	
	public function admin_quick_view() {
		$this->layout = false;
		// $this->autoRender = false;

		if (!empty($this->request->params['appointmentId'])) {
			$this->Appointment->contain(array(
				'User',
			));
			$appointment = $this->Appointment->findById($this->request->params['appointmentId']);
			$appointment['Appointment']['start'] = date('d-m-Y H:i', strtotime($appointment['Appointment']['start']));
			$appointment['Appointment']['end'] = date('d-m-Y H:i', strtotime($appointment['Appointment']['end']));
			$this->request->data = $appointment;

			$patients = $this->Appointment->User->getPatientList();

			$this->set(compact(array('appointment', 'patients')));
			$a =  $this->render('admin_quick_view');
			echo $a; exit;
		}
	}

	public function admin_edit() {
		$this->layout = false;
		$this->autoRender = false;
		
		if (!empty($this->request->data)) {
			$this->request->data['Appointment']['start'] = date('Y-m-d H:i:s', strtotime($this->request->data['Appointment']['start']));
			$this->request->data['Appointment']['end'] = date('Y-m-d H:i:s', strtotime($this->request->data['Appointment']['end']));
			
			if ($this->Appointment->save($this->request->data)) {
				$this->Session->setFlash(__('Appointment has been updated.'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Appointment could not be updated, please try again.'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}

	public function admin_delete() {
		$this->layout = false;
		$this->autoRender = false;
		
		if (!empty($this->request->params['appointmentId'])) {
			if ($this->Appointment->delete($this->request->params['appointmentId'])) {
				$this->Session->setFlash(__('Appointment has been deleted.'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Appointment could not be deleted, please try again.'), 'flash_failure');
			}
		}
		$this->redirect($this->referer());
	}
	
	public function send_reminder() {
		
	}
	
	public function admin_calendar_feed() {
		$this->layout = false;
		$this->autoRender = false;

		$start = $end = '';
		if ((!empty($this->request->params['start']) && !empty($this->request->params['end'])) || (!empty($this->request->data['start']) && !empty($this->request->data['end']))) {
			if (!empty($this->request->params['start'])) {
				$start = $this->request->params['start'];
			} else {
				$start = $this->request->data['start'];
			}

			if (!empty($this->request->params['end'])) {
				$end = $this->request->params['end'];
			} else {
				$end = $this->request->data['end'];
			}
		} else {
			//Begginning of Year to End
			$start = date('Y').'-01-01 00:00:00';
			$end = date('Y').'-12-31 23:59:59';
		}

		$this->Appointment->contain(array(
			'User.firstname',
			'User.lastname',
		));
		$options = array(
			'conditions' => array(
				'Appointment.start BETWEEN ? AND ?' => array($start, $end)
			),
		);
		$appointments = $this->Appointment->find('all', $options);
		// debug($appointments); Die;
		$appointmentEvents = array();
		foreach ($appointments as $appointment) {
			$start = strtotime($appointment['Appointment']['start']);
			$end = strtotime($appointment['Appointment']['end']);
			$dateDiff = $end - $start;
			$dateDiff = floor($dateDiff/(60*60));
			if ($dateDiff > 10) {
				$allDay = true;
			} else {
				$allDay = false;
			}
			
			if ($allDay) {
				$colour = '#A2E0A4';
				$textColour = '#000000';
			} elseif (!empty($jobItem['JobItem']['colour'])) {
				$colour = $jobItem['JobItem']['colour'];
				$textColour = '#000000';
			} else {
				// Use agent colours;
				$colour = '#9999FF';
				$textColour = '#0000FF';
			}
			
			$appointmentEvents[] = array(
				'id' => $appointment['Appointment']['id'],
				'title' => $appointment['User']['firstname'].' '.$appointment['User']['lastname'],
				'description' => $appointment['Appointment']['label'],
				'start' => $appointment['Appointment']['start'],
				'end' => $appointment['Appointment']['end'],
				'allDay' => $allDay,
				'color' => $colour,
				'textColor' => $textColour,
			);
			
		}
		$encoded = json_encode($appointmentEvents);
		echo $encoded;
	} 
}