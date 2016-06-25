<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Vorien/Dashboard',
    ['path' => '/dashboard'],
    function (RouteBuilder $routes) {
		$routes->connect('/', ['controller' => 'Dashboard', 'action' => 'dashboard']);
//		$routes->connect('/users', ['plugin' => 'Vorien/Dashboard', 'controller' => 'Users']);
        $routes->fallbacks('DashedRoute');
    }
);
