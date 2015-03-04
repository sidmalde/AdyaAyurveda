<div class="well">
	<h1>
		<?=$title_for_layout;?>
	</h1>
	<br />
	<? if (!empty($blogArticles)) :?>
		<? foreach ($blogArticles as $blogArticle) : ?>
			<div class="blog-article-container">
				<div class="blog-article-title">
					<?=$this->Html->link($blogArticle['BlogArticle']['title'], array('action' => 'view', 'ref' => $blogArticle['BlogArticle']['ref'], 'title' => Inflector::slug($blogArticle['BlogArticle']['title'], '-')));?>
				</div>
				<div class="blog-article-content text-justify">
					<?=$blogArticle['BlogArticle']['summary'] . '...';?>
				</div>
				<div class="blog-article-extra">
					<div class="blog-article-more pull-left">
						<?=$this->Html->link(__('Read More'), array('action' => 'view', 'ref' => $blogArticle['BlogArticle']['ref'], 'title' => Inflector::slug($blogArticle['BlogArticle']['title'], '-')), array('class' => 'btn btn-success btn-md'));?>
					</div>
					<div class="blog-article-share pull-right">
						<?//add this?>
					</div>
					<div class="clr"></div>
				</div>

			</div>
		<? endforeach; ?>
	<? else: ?>
		<div class="alert alert-info">
			<p><?=__('There are currently no blog posts, check back soon to get the latest updates');?></p>
		</div>
	<? endif; ?>
</div>