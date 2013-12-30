<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New KB Article'), array('action' => 'add'), array('class' => 'btn btn-success btn-xs'));?>
	</div>
</h2>
<div class="">
	<? if(!empty($kbArticles)): ?>
		
		<ul class="nav nav-tabs" id="myTab">
			<?php foreach ($kbArticles as $index => $modality): ?>
				<? $activeLinkClass=($index == 0) ? 'class="active"': '';?>
				<li <?=$activeLinkClass;?>>
					<a href="<?='#'.Sanitize::paranoid(strtolower($modality['Modality']['modality']));?>" data-toggle="tab">
						<span class="badge badge-info">(<?=count($modality['KnowledgeBaseArticle']);?>)</span>
						<?=$modality['Modality']['modality'];?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		
		<div id="myTabContent" class="tab-content">
			<?php foreach ($kbArticles as $index => $modality): ?>
				<? $tabClass=($index == 0) ? 'active in': 'fade'; ?>
				<div class="tab-pane <?=$tabClass;?>" id="<?=Sanitize::paranoid(strtolower($modality['Modality']['modality']));?>">
					<table class="table table-condensed table-striped table-bordered table-hover datatable">
						<thead>
							<tr>
								<th><?=__('Disease');?></th>
								<th><?=__('Title');?></th>
								<th><?=__('Created');?></th>
								<th><?=__('Modified');?></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<? foreach($modality['KnowledgeBaseArticle'] as $kbArticle): ?>
								<tr>
									<td><?=$kbArticle['Disease']['disease'];?></td>
									<td><?=$kbArticle['title'];?></td>
									<td><?=$this->Time->niceShort($kbArticle['created']);?></td>
									<td><?=$this->Time->niceShort($kbArticle['modified']);?></td>
									<td class="actions condensed">
										<div class="btn-group">
											<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><?=$this->Html->link('<i class="icon-eye"></i> '.__('View'), array('controller' => 'knowledge_base_articles', 'action' => 'view', 'kbArticle' => $kbArticle['id']), array('escape' => false, 'target' => '_blank'));?></li>
												<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'knowledge_base_articles', 'action' => 'edit', 'kbArticle' => $kbArticle['id']), array('escape' => false));?></li>
												<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'knowledge_base_articles', 'action' => 'delete', 'kbArticle' => $kbArticle['id']), array('escape' => false));?></li>
											</ul>
										</div>
									</td>
								</tr>
							<?endforeach; ?>
						</tbody>
					</table>
				</div>
			<? endforeach; ?>
		</div>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no KB Articles.');?></strong></p>
		</div>
	<? endif; ?>
</div>