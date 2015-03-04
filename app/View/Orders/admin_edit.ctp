<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-danger btn-xs'));?>
	</div>
</h2>
<div class="well">
	<?=$this->Form->create('Order');?>
		<?=$this->Form->input('id', array('value' => $order['Order']['id']));?>
		<?=$this->Form->input('patient_id', array('empty' => __('Please select a patient:'), 'options' => $patients, 'selected' => $order['Order']['patient_id']));?>
		<br />
		<? $i=0;foreach($order['OrderItem'] as $orderItem) :?>
			<?=$this->Form->input('OrderItem.'.$i.'.id', array('value' => $orderItem['id']));?>
			<?=$this->Form->input('OrderItem.'.$i.'.product_id', array('empty' => __('Please select a product:'), 'options' => $products, 'selected' => $orderItem['Product']['id']));?>
			<?=$this->Form->input('OrderItem.'.$i.'.notes', array('type' => 'textarea', 'value' => $orderItem['notes']));?>
			<?=$this->Form->input('OrderItem.'.$i.'.sub_total', array('value' => $orderItem['sub_total']));?>
		<? $i++;endforeach; ?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>