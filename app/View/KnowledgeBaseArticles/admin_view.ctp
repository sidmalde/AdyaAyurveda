<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-danger btn-sm'));?>
	</div>
</h2>
<div class="well">
	<table class="table table-condensed table-striped table-bordered table-hover datatable">
		<tr>
			<th><?=__('Modality');?></th>
			<th><?=$kbArticle['Modality']['modality'];?></th>
		</tr>
		<tr>
			<th><?=__('Disease');?></th>
			<th><?=$kbArticle['Disease']['disease'];?></th>
		</tr>
	</table>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$kbArticle['KnowledgeBaseArticle']['title']?></h3>
		</div>
		<div class="panel-body">
			<?=$kbArticle['KnowledgeBaseArticle']['content']?>
		</div>
	</div>
</div>