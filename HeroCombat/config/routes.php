<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Vorien/HeroCombat',
    ['path' => '/herocombat'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
		$routes->connect('/', ['controller' => 'Herocombat', 'action' => 'index']);
    }
);
