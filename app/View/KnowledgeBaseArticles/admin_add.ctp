<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-danger btn-sm'));?>
	</div>
</h2>
<div class="well">
	<?=$this->Form->create('KnowledgeBaseArticle');?>
		<?=$this->Form->input('disease_id', array('empty' => __('Please choose an option:')));?>
		<?=$this->Form->input('modality_id', array('empty' => __('Please choose an option:')));?>
		<?=$this->Form->input('title');?>
		<?=$this->Form->input('content');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>