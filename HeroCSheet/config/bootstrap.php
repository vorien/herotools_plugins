<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Cache\Cache;

try {
    Configure::config('herocsheet', new PhpConfig(Plugin::path('Vorien/HeroCSheet') . 'config/'));
    Configure::load('app', 'herocsheet');
	ConnectionManager::config(Configure::consume('Datasources'));
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}


if (extension_loaded('apc') && function_exists('apc_dec') && (php_sapi_name() !== 'cli' || ini_get('apc.enable_cli'))) {
    Cache::config('herocsheet', array(
        'engine' => 'Apc', //[required]
//        'duration'=> 3600, //[optional]
//        'probability'=> 100, //[optional]
//        'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
    ));
} else {
    Cache::config('herocsheet', array('engine' => 'File'));
}
