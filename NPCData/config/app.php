<?php

return [
    'Datasources' => [
        'npcdata' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'heroplugins',
            'password' => 'heroplugins',
            'database' => 'npcdata',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => true,
            'url' => env('DATABASE_URL', null),
        ],
    ],
];
