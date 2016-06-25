<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;

try {
    Configure::config('herocombat', new PhpConfig(Plugin::path('Vorien/HeroCombat') . 'config/'));
    Configure::load('app', 'herocombat');
	ConnectionManager::config(Configure::consume('Datasources'));
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

