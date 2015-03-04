<div class="row">
	<div class="col-md-12 col-lg-8">
		<div id="bookingsCalendar">
			
		</div>
	</div>
</div>

<div class="modal" id="addApp" tabindex="-1" role="dialog" aria-labelledby="addAppLabel" aria-hidden="true">
	<div class="modal-dialog">
		<?=$this->Form->create('Appointment', array('url' => array('controller' => 'appointments', 'action' => 'add')));?>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addAppLabel">Add Appointment</h4>
				</div>
				<div class="modal-body">
					<?=$this->Form->input('user_id', array('label' => __('Patient'), 'empty' => 'Select a patient', 'options' => $patients));?>
					<?=$this->Form->input('label');?>
					<div class="row">
						<div class="col-sm-6">
							<?=$this->Form->input('start', array('type' => 'text', 'class' => 'form-control datetimepicker'));?>
						</div>
						<div class="col-sm-6">
							<?=$this->Form->input('end', array('type' => 'text', 'class' => 'form-control datetimepicker'));?>
						</div>
					</div>
					<?=$this->Form->input('send_email_reminder');?>
					<?=$this->Form->input('send_sms_reminder');?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		<?=$this->Form->end();?>
	</div>
</div>

<div class="modal" id="viewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAppointmentModal" aria-hidden="true">
	
</div>