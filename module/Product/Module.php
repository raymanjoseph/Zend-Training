<?php 

namespace Product;

use Product\Filter\ProductFilter;
use Product\Form\ProductForm;
use Product\Model\Product;
use Product\Model\ProductTable;

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
				'ProductTable' => function($sm) {
					$ProductTableGateway = $sm->get('ProductTableGateway');
					return new ProductTable($ProductTableGateway);
				},
				'ProductTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\db\Adapter\Adapter');
					$ResultSet = new ResultSet();
					$ResultSet->setArrayObjectPrototype(new Product());
					return new TableGateway('products', $dbAdapter, null, $ResultSet);
				},
				'ProductForm' => function() {
					return new ProductForm();
				},
				'ProductFilter' => function() {
					return new ProductFilter();
				},
			),
		);
	}
}