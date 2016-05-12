<?php 

return array(
	'controllers' => array(
		'invokables' => array(
            'Cart\Controller\Cart'    => 'Cart\Controller\CartController',
            'Cart\Controller\Shipping'    => 'Cart\Controller\ShippingController',
            'Cart\Controller\Test'    => 'Cart\Controller\TestController',
		),
	),
	'router' => array(
        'routes' => array(
            'cart' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/cart[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Cart\Controller\Cart',
                        'action'     => 'index',
                    ),
                ),
            ),
            'shipping' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/shipping[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Cart\Controller\Shipping',
                        'action'     => 'index',
                    ),
                ),
            ),
            'shipping_test' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/test[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Cart\Controller\Test',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
	'view_manager' => array(
		'template_path_stack' => array(
			'cart' => __DIR__ . '/../view',

		),
	),
); 