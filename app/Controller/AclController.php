<?php
App::uses('Controller', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');
App::uses('DbAcl', 'Model');

class AclController extends AppController {

	var $name = 'Acl';
	var $components = array();
	var $uses = array('User', 'Group');
	
	public $Acl;
	public $args;
	public $dataSource = 'default';
	public $rootNode = 'controllers';
	public $_clean = false;

	public function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow();
	}
	
	public function startup() {
		// parent::startup();
		$collection = new ComponentCollection();
		$this->Acl = new AclComponent($collection);
		$controller = new Controller();
		$this->Acl->startup($controller);
		$this->Aco = $this->Acl->Aco;
	}
	
	function aco_aro_sync() {
		ini_set('max_execution_time', 300);
		$this->layout = false;
		$this->_clean = true;
		$this->startup();
		$this->aco_update();
		exit;
	}
	
	function aco_update() {
		$root = $this->_checkNode($this->rootNode, $this->rootNode, null);
		$controllers = $this->getControllerList();
		$this->_updateControllers($root, $controllers);

		$plugins = CakePlugin::loaded();
		foreach ($plugins as $plugin) {
			$controllers = $this->getControllerList($plugin);

			$path = $this->rootNode . '/' . $plugin;
			$pluginRoot = $this->_checkNode($path, $plugin, $root['Aco']['id']);
			$this->_updateControllers($pluginRoot, $controllers, $plugin);
		}
		echo '<br /><br /><strong>'.__('<success>Aco Update Complete</success>').'</strong><br /><br />';
		
		$this->init_group_permissions();
		
		return true;
	}
	
	function _updateControllers($root, $controllers, $plugin = null) {
		$dotPlugin = $pluginPath = $plugin;
		if ($plugin) {
			$dotPlugin .= '.';
			$pluginPath .= '/';
		}
		$appIndex = array_search($plugin . 'AppController', $controllers);
		if ($appIndex !== false) {
			App::uses($plugin . 'AppController', $dotPlugin . 'Controller');
			unset($controllers[$appIndex]);
		}
		// look at each controller
		foreach ($controllers as $controller) {
			App::uses($controller, $dotPlugin . 'Controller');
			$controllerName = preg_replace('/Controller$/', '', $controller);

			$path = $this->rootNode . '/' . $pluginPath . $controllerName;
			$controllerNode = $this->_checkNode($path, $controllerName, $root['Aco']['id']);
			$this->_checkMethods($controller, $controllerName, $controllerNode, $pluginPath);
		}
		if ($this->_clean) {
			if (!$plugin) {
				$controllers = array_merge($controllers, App::objects('plugin', null, false));
			}
			$controllerFlip = array_flip($controllers);

			$this->Aco->id = $root['Aco']['id'];
			$controllerNodes = $this->Aco->children(null, true);
			foreach ($controllerNodes as $ctrlNode) {
				$alias = $ctrlNode['Aco']['alias'];
				$name = $alias . 'Controller';
				if (!isset($controllerFlip[$name]) && !isset($controllerFlip[$alias])) {
					if ($this->Aco->delete($ctrlNode['Aco']['id'])) {
						echo '<br />'.sprintf(__('Deleted %s and all children'), $this->rootNode . '/' . $ctrlNode['Aco']['alias']).'<br />';
					}
				}
			}
		}
	}
	
	function getControllerList($plugin = null) {
		if (!$plugin) {
			$controllers = App::objects('Controller', null, false);
		} else {
			$controllers = App::objects($plugin . '.Controller', null, false);
		}
		return $controllers;
	}
	
	function _checkNode($path, $alias, $parentId = null) {
		$node = $this->Aco->node($path);
		if (!$node) {
			$this->Aco->create(array('parent_id' => $parentId, 'model' => null, 'alias' => $alias));
			$node = $this->Aco->save();
			$node['Aco']['id'] = $this->Aco->id;
			echo '<br />'.sprintf(__('Created Aco node: %s', true), $alias).'<br />';
		} else {
			$node = $node[0];
		}
		return $node;
	}
	
	function _checkMethods($className, $controllerName, $node, $pluginPath = false) {
		$baseMethods = get_class_methods('Controller');
		$actions = get_class_methods($className);
		$methods = array_diff($actions, $baseMethods);
		foreach ($methods as $action) {
			if (strpos($action, '_', 0) === 0) {
				continue;
			}
			$path = $this->rootNode . '/' . $pluginPath . $controllerName . '/' . $action;
			$this->_checkNode($path, $action, $node['Aco']['id']);
		}

		if ($this->_clean) {
			$actionNodes = $this->Aco->children($node['Aco']['id']);
			$methodFlip = array_flip($methods);
			foreach ($actionNodes as $action) {
				if (!isset($methodFlip[$action['Aco']['alias']])) {
					$this->Aco->id = $action['Aco']['id'];
					if ($this->Aco->delete()) {
						$path = $this->rootNode . '/' . $controllerName . '/' . $action['Aco']['alias'];
						echo '<br />'.sprintf(__('Deleted Aco node: %s', true), $path).'<br />';
					}
				}
			}
		}
		return true;
	}
	
	function verify() {
		$type = Inflector::camelize($this->args[0]);
		$return = $this->Acl->{$type}->verify();
		if ($return === true) {
			echo '<br />'.__('Tree is valid and strong').'<br />';
		} else {
			$this->err(print_r($return, true));
			return false;
		}
	}
	
	function recover() {
		$type = Inflector::camelize($this->args[0]);
		$return = $this->Acl->{$type}->recover();
		if ($return === true) {
			echo '<br />'.__('Tree has been recovered, or tree did not need recovery.').'<br />';
		} else {
			$this->err(__('<error>Tree recovery failed.</error>'));
			return false;
		}
	}
	
	public function init_group_permissions() {
		$group = $this->User->Group;
		
		// System Administrators
		$group->id = '52346d30-68f8-4e91-b19b-1368d96041f1';
		$this->Acl->allow($group, 'controllers');
		
		// System Administrators
		$group->id = '5234723b-bdbc-4e50-930c-1368d96041f1';
		$this->Acl->allow($group, 'controllers');
		
		
		//we add an exit to avoid an ugly "missing views" error message
		echo '<br /><br /><strong>'.__('<success>Group Roles Set</success>').'</strong><br /><br />';
		return true;
	}
}