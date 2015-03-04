<div class="modal-dialog">
	<?=$this->Form->create('Appointment', array('url' => Router::url(array('controller' => 'appointments', 'action' => 'edit', 'booking' => $appointment['Appointment']['id']))));?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addAppLabel">Edit Appointment</h4>
			</div>
			<div class="modal-body">
				<?=$this->Form->hidden('id');?>
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
				<?#=$this->Html->link(__('Send Email Reminder'), array('controller' => 'appointments', 'action' => 'send_reminder', 'type' => 'email', 'appointmentId' => $appointment['Appointment']['id']), array('class' => 'btn btn-success btn-block'));?>
				<?#=$this->Html->link(__('Send SMS Reminder'), array('controller' => 'appointments', 'action' => 'send_reminder', 'type' => 'sms', 'appointmentId' => $appointment['Appointment']['id']), array('class' => 'btn btn-success btn-block'));?>
				<br />
				<?=$this->Html->link(__('Delete Appointment'), array('controller' => 'appointments', 'action' => 'delete', 'appointmentId' => $appointment['Appointment']['id']), array('class' => 'btn btn-danger btn-block'));?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	<?=$this->Form->end();?>
</div>

<script type="text/javascript">
	$('.datetimepicker').datetimepicker({
		format: 'DD-MM-YYYY H:mm',
	});
</script>