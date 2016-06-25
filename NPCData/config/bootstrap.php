<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;

try {
    Configure::config('npcdata', new PhpConfig(Plugin::path('Vorien/NPCData') . 'config/'));
    Configure::load('app', 'npcdata');
	ConnectionManager::config(Configure::consume('Datasources'));
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

