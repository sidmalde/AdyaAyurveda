<div class="well">
	<h1>
		<?=$title_for_layout;?>
	</h1>
	<br />
	<? if (!empty($blogArticle)) :?>
		<div class="blog-article-container">
			<div class="blog-article-content">
				<?=$blogArticle['BlogArticle']['summary'];?>
				<br />
				<?=$blogArticle['BlogArticle']['post'];?>
			</div>
		</div>
		<div class="social-media"></div>
	<? else: ?>
		<div class="alert alert-info">
			<p><?=__('Blog article could not be found.');?></p>
		</div>
	<? endif; ?>
</div>