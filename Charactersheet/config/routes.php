<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Vorien/Charactersheet',
    ['path' => '/vorien/charactersheet'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
