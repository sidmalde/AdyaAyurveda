<?php

	Router::connect('/', array('controller' => 'users', 'action' => 'login'));
	
	// Groups
	Router::connect('/system-management/groups', array('controller' => 'groups', 'action' => 'index', 'admin' => true));
	Router::connect('/system-management/groups/new', array('controller' => 'groups', 'action' => 'add', 'admin' => true));
	Router::connect('/system-management/groups/:group', array('controller' => 'groups', 'action' => 'view', 'admin' => true));
	Router::connect('/system-management/groups/:group/edit', array('controller' => 'groups', 'action' => 'edit', 'admin' => true));
	Router::connect('/system-management/groups/:group/delete', array('controller' => 'groups', 'action' => 'delete', 'admin' => true));
	
	// Users
	Router::connect('/system-management/users', array('controller' => 'users', 'action' => 'index', 'admin' => true));
	Router::connect('/system-management/users/new', array('controller' => 'users', 'action' => 'add', 'admin' => true));
	Router::connect('/system-management/users/:user', array('controller' => 'users', 'action' => 'view', 'admin' => true));
	Router::connect('/system-management/users/:user/edit', array('controller' => 'users', 'action' => 'edit', 'admin' => true));
	Router::connect('/system-management/users/:user/delete', array('controller' => 'users', 'action' => 'delete', 'admin' => true));
	
	// User Data Fields
	Router::connect('/system-management/user-data-fields', array('controller' => 'users', 'action' => 'data_field_index', 'admin' => true));
	Router::connect('/system-management/user-data-fields/new', array('controller' => 'users', 'action' => 'data_field_add', 'admin' => true));
	Router::connect('/system-management/user-data-fields/:userDataField/edit', array('controller' => 'users', 'action' => 'data_field_edit', 'admin' => true));
	Router::connect('/system-management/user-data-fields/:userDataField/delete', array('controller' => 'users', 'action' => 'data_field_delete', 'admin' => true));
	
	
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
