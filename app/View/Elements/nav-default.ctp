<div class="navbar navbar-default">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="/" class="navbar-brand hidden-lg hidden-md"><i class="fa fa-home fa-3"></i>&nbsp;</a>
	</div>
	<div class="navbar-collapse collapse navbar-responsive-collapse">
		<ul class="nav navbar-nav">
			<li class=" hidden-xs hidden-sm"><a href="/" class="navbar-brand"><i class="fa fa-home fa-3"></i>&nbsp;</a></li>
			<? if (!empty($pagesInNav)) : ?>
				<? foreach($pagesInNav as $pageInNav): ?>
					<li><a href="<?=$pageInNav['Page']['url'];?>"><?=$pageInNav['Page']['label'];?></a></li>
				<? endforeach; ?>
			<? endif; ?>
		</ul>
	</div><!-- /.nav-collapse -->
</div>