<div class="navbar navbar-default">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="/" class="navbar-brand"><i class="fa fa-home fa-3"></i></a>
	</div>
	<div class="navbar-collapse collapse navbar-responsive-collapse">
		<ul class="nav navbar-nav">
			<? if (!empty($pagesInNav)) : ?>
				<? foreach($pagesInNav as $pageInNav): ?>
					<li><a href="<?=$pageInNav['Page']['url'];?>"><?=$pageInNav['Page']['label'];?></a></li>
				<? endforeach; ?>
			<? endif; ?>
			<!--<li class="active"><a href="#">Active</a></li>
			<li><a href="#">Link</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li class="dropdown-header">Dropdown header</li>
				<li><a href="#">Separated link</a></li>
				<li><a href="#">One more separated link</a></li>
				</ul>
			</li>-->
		</ul>
	</div><!-- /.nav-collapse -->
</div>

<?/*
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
			<a href="/" class="navbar-brand"><?=__('Adya Ayurveda');?></a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<!--<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li><a tabindex="-1" href="../default/">Default</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="../amelia/">Amelia</a></li>
						<li><a tabindex="-1" href="../cerulean/">Cerulean</a></li>
						<li><a tabindex="-1" href="../cosmo/">Cosmo</a></li>
					</ul>
				</li>
				<li><a href="../help/">Help</a></li>
				<li><a href="http://news.bootswatch.com">Blog</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="download">
						<li><a tabindex="-1" href="./bootstrap.min.css">bootstrap.min.css</a></li>
						<li><a tabindex="-1" href="./bootstrap.css">bootstrap.css</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="./variables.less">variables.less</a></li>
						<li><a tabindex="-1" href="./bootswatch.less">bootswatch.less</a></li>
					</ul>
				</li>-->
			</ul>

			<!--<ul class="nav navbar-nav navbar-right">
				<li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
				<li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
			</ul>-->
        </div>
	</div>
</div>*/?>