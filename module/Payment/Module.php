<?php 

namespace Payment;

use Payment\Model\JobOrder;
use Payment\Model\JobOrderTable;
use Payment\Model\JobItem;
use Payment\Model\JobItemTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;
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
				'JobOrderTable' => function($sm) {
					$JobOrderTableGateway = $sm->get('JobOrderTableGateway');
					return new JobOrderTable($JobOrderTableGateway);
				},
				'JobOrderTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\db\Adapter\Adapter');
					$ResultSet = new ResultSet();
					$ResultSet->setArrayObjectPrototype(new JobOrder());
					return new TableGateway('job_orders', $dbAdapter, null, $ResultSet);
				},
				'JobItemTable' => function($sm) {
					$JobItemTableGateway = $sm->get('JobItemTableGateway');
					return new JobItemTable($JobItemTableGateway);
				},
				'JobItemTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\db\Adapter\Adapter');
					$ResultSet = new ResultSet();
					$ResultSet->setArrayObjectPrototype(new JobItem());
					return new TableGateway('job_items', $dbAdapter, null, $ResultSet);
				},
				'JobOrder' => function() {
					return new JobOrder();
				},
				'JobItem' => function() {
					return new JobItem();
				},
			),
		);
	}
}