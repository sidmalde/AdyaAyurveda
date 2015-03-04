<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
			<a href="/" class="navbar-brand hidden-lg hidden-md"><i class="fa fa-home fa-3"></i>&nbsp;</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li class=" hidden-xs hidden-sm"><a href="/" class="navbar-brand"><?=__('Adya Ayurveda');?></a></li>
				<!--<li><?=$this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index'));?></li>-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><?=__('Users');?> <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="User Management">
						<li><?=$this->Html->link(__('All Users'), array('controller' => 'users', 'action' => 'index'));?></li>
						<li><?=$this->Html->link(__('User Data Fields'), array('controller' => 'users', 'action' => 'data_field_index'));?></li>
					</ul>
				</li>
				<!--<li><a href="../help/">Help</a></li>
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
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><?=__('CMS');?> <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="User Management">
						<li><?=$this->Html->link(__('Pages'), array('controller' => 'pages', 'action' => 'index'));?></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><?=__('Knowledge Base');?> <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="User Management">
						<li><?=$this->Html->link(__('Diseases'), array('controller' => 'diseases', 'action' => 'index'));?></li>
						<li><?=$this->Html->link(__('Modalities'), array('controller' => 'modalities', 'action' => 'index'));?></li>
						<li><?=$this->Html->link(__('Articles'), array('controller' => 'knowledge_base_articles', 'action' => 'index'));?></li>
					</ul>
				</li>
				<li><?=$this->Html->link(__('Products'), array('controller' => 'products', 'action' => 'index'));?></li>
				<li><?=$this->Html->link(__('Orders'), array('controller' => 'orders', 'action' => 'index'));?></li>
				<li><?=$this->Html->link(__('Forums'), array('controller' => 'forums', 'action' => 'index'));?></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/logout"><?=__('Logout');?></a></li>
			</ul>
			<!--<ul class="nav navbar-nav navbar-right">
				<li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
				<li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
			</ul>-->
        </div>
	</div>
</div>