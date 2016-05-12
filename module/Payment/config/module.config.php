<?php 

return array(
	'controllers' => array(
		'invokables' => array(
			'Payment\Controller\Payment' => 'Payment\Controller\PaymentController',
		),
	),
	'router' => array(
        'routes' => array(
            'payment' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/payment[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Payment\Controller\Payment',
        	            'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
	'view_manager' => array(
		'template_path_stack' => array(
			'payment' => __DIR__ . '/../view',

		),
	),
); 