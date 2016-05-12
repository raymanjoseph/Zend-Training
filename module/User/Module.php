<?php 

namespace User;

use User\Filter\LoginFilter;
use User\Filter\SignupFilter;
use User\Form\LoginForm;
use User\Form\SignupForm;

use User\Model\User;
use User\Model\UserTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Session\Container;

class Module
{
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'UserTable' => function($sm) {
					$UserTableGateway = $sm->get('UserTableGateway');
					return new UserTable($UserTableGateway);
				},
				'UserTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$ResultSet = new ResultSet();
					$ResultSet->setArrayObjectPrototype(new User());
					return new TableGateway('customers', $dbAdapter, null, $ResultSet);
				},
				'Session' => function() {
					return new Container();
				},
				'User' => function() {
					return new User();
				}, 
				'LoginForm' => function() {
					return new LoginForm();
				},
				'SignupForm' => function() {
					return new SignupForm();
				},
				'SignupFilter' => function() {
					return new SignupFilter();
				},
				'LoginFilter' => function() {
					return new LoginFilter();
				},
			),
		);
	}
}