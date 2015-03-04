<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html">Adya Adyurveda</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<!-- /.dropdown -->
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
				<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
				<li class="divider"></li>
				<li><a href="<?=Router::url(array('controller' => 'users', 'action' => 'logout', 'admin' => false));?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<?/*<li>
					<a href="<?=Router::url(array('controller' => 'pages', 'action' => 'dashboard'));?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>*/?>
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'users') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'groups', 'action' => 'view', 'group' => 'patients'));?>"><i class="fa fa-user fa-fw"></i> <?=__('Patients');?></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-table fa-fw"></i> CMS<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?=(!empty($bodyClass) && ($bodyClass == 'pages' || $bodyClass == 'knowledge_base_articles' || $bodyClass == 'modalities' || $bodyClass == 'diseases' || $bodyClass == 'products')) ? 'in' : '';?>">
						<li>
							<a <?=(!empty($bodyClass) && $bodyClass == 'pages') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'pages', 'action' => 'index'));?>">Pages</a>
						</li>
						<li>
							<a <?=(!empty($bodyClass) && $bodyClass == 'knowledge_base_articles') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'knowledge_base_articles', 'action' => 'index'));?>">Knowledge Base</a>
						</li>
						<li>
							<a <?=(!empty($bodyClass) && $bodyClass == 'modalities') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'modalities', 'action' => 'index'));?>">Modalities</a>
						</li>
						<li>
							<a <?=(!empty($bodyClass) && $bodyClass == 'diseases') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'diseases', 'action' => 'index'));?>">Diseases</a>
						</li>
						<li>
							<a <?=(!empty($bodyClass) && $bodyClass == 'products') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'products', 'action' => 'index'));?>">Products</a>
						</li>
					</ul>
				</li>
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'orders') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'orders', 'action' => 'index'));?>"><i class="fa fa-user fa-fw"></i> Orders</a>
				</li>
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'appointments') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'appointments', 'action' => 'index'));?>"><i class="fa fa-calendar fa-fw"></i> Appointments</a>
				</li>
				<li>
					<a <?=(!empty($bodyClass) && $bodyClass == 'blog_articles') ? 'class="active"' : '';?>href="<?=Router::url(array('controller' => 'blog_articles', 'action' => 'index'));?>"><i class="fa fa-book fa-fw"></i> Blog Articles</a>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>