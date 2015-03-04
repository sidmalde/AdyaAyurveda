<div class="well">
	<?=$this->Form->create('Disease');?>
		<?=$this->Form->input('disease');?>
		<?=$this->Form->input('description');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>