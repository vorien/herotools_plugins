<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Vorien/HeroCSheet',
    ['path' => '/charactersheet'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
		$routes->connect('/', ['controller' => 'Charactersheets', 'action' => 'index']);
    }
);
