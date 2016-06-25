<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;

try {
    Configure::config('dashboard', new PhpConfig(Plugin::path('Vorien/Dashboard') . 'config/'));
    Configure::load('app', 'dashboard');
	ConnectionManager::config(Configure::consume('Datasources'));
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

