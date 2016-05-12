<?php 

namespace Cart;

use Cart\Model\Cart;
use Cart\Model\CartTable;
use Cart\Model\CartItem;
use Cart\Model\CartItemTable;

use Cart\Model\Shipping;
use Cart\Form\ShippingForm;
use Cart\Filter\ShippingFilter;

use User\Model\User;
use User\Model\UserTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
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
				'CartTable' => function($sm) {
					$CartTableGateway = $sm->get('CartTableGateway');
					return new CartTable($CartTableGateway);
				},
				'CartTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\db\Adapter\Adapter');
					$ResultSet = new ResultSet();
					$ResultSet->setArrayObjectPrototype(new Cart());
					return new TableGateway('carts', $dbAdapter, null, $ResultSet);
				},
				'CartItemTable' => function($sm) {
					$CartItemTableGateway = $sm->get('CartItemTableGateway');
					return new CartItemTable($CartItemTableGateway);
				},
				'CartItemTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\db\Adapter\Adapter');
					$ResultSet = new ResultSet();
					$ResultSet->setArrayObjectPrototype(new CartItem());
					return new TableGateway('cart_items', $dbAdapter, null, $ResultSet);
				},
				'CartItem' => function() {
					return new CartItem();
				},
				'Cart' => function() {
					return new Cart();
				},
				'ShippingForm' => function() {
					return new ShippingForm();
				},
				'ShippingFIlter' => function() {
					return new ShippingFIlter();
				},
			),
		);
	}
}

