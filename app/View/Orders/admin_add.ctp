<div class="well">
	<?=$this->Form->create('Order');?>
		<?=$this->Form->input('patient_id', array('empty' => __('Please select a patient:'), 'options' => $patients));?>
		<br />
		<? $max=6; for($i=0; $i<$max; $i++) :?>
			<?=$this->Form->input('OrderItem.'.$i.'.product_id', array('empty' => __('Please select a product:'), 'options' => $products));?>
			<?=$this->Form->input('OrderItem.'.$i.'.notes', array('type' => 'textarea'));?>
		<? endfor; ?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>