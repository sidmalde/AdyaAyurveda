<div class="row">
	<div class="span12 page-header">
		<div class="row">
			<div class="span8"><h3><?=@$pageTitle;?></h3></div>
			<div class="span3">
				<div class="btn-group pull-right">
					<?/* =$this->Html->link(__('New Model'), array('action' => 'model_add'), array('class' => 'btn btn-success'));?>
					<?=$this->Html->link(__('New Make'), array('action' => 'make_add'), array('class' => 'btn btn-primary')); */?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="well">
			<?=$this->Form->create('SystemModel');?>
				<?=$this->Form->hidden('id', array('value' => $systemModel['SystemModel']['id']));?>
				<?=$this->Form->input('name', array('value' => $systemModel['SystemModel']['name']));?>
				<?=$this->Form->input('description', array('value' => $systemModel['SystemModel']['description']));?>
			<?=$this->Form->end(__('Save'));?>
		</div>
	</div>
</div>
