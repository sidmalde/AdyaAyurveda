<div class="outer-5">
	<? if(!empty($blogArticles)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?=__('Title');?></th>
					<th><?=__('Created By');?></th>
					<th><?=__('Published');?></th>
					<th><?=__('Modified');?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($blogArticles as $blogArticle): ?>
					<tr>
						<td><?=$blogArticle['BlogArticle']['title'];?></td>
						<td><?=$blogArticle['User']['firstname'] . ' ' . $blogArticle['User']['lastname'];?></td>
						<td><?=$blogArticle['BlogArticle']['publish'];?></td>
						<td><?=$this->Time->niceShort($blogArticle['BlogArticle']['modified']);?></td>
						<td class="actions condensed">
							<div class="btn-group">
								<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'blog_articles', 'action' => 'edit', 'blogArticle' => $blogArticle['BlogArticle']['id']), array('escape' => false));?></li>
									<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'blog_articles', 'action' => 'delete', 'blogArticle' => $blogArticle['BlogArticle']['id']), array('escape' => false));?></li>
								</ul>
							</div>
						</td>
					</tr>
				<?endforeach; ?>
			</tbody>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no blog articles.');?></strong></p>
		</div>
	<? endif; ?>
</div>