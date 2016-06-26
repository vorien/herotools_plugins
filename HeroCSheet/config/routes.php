<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Vorien/HeroCSheet',
    ['path' => '/vorien/hero-c-sheet'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
