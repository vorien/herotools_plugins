<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

//Router::plugin(
//    'Vorien/NPCData',
//    ['path' => '/n_p_c_data'],
//    function (RouteBuilder $routes) {
//        $routes->fallbacks('DashedRoute');
//    }
//);

Router::plugin(
    'Vorien/NPCData',
    ['path' => '/npcdata'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);

//Router::plugin('DebugKit', ['path' => '/debugger'], function ($routes) {
//    // Routes connected here are prefixed with '/debugger' and
//    // have the plugin route element set to 'DebugKit'.
//    $routes->connect('/:controller');
//});
