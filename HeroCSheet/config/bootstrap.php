<?php
/**
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
//use Cake\Console\ConsoleErrorHandler;
use Cake\Core\App;
use Cake\Core\Configure;
//use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
//use Cake\Database\Type;
//use Cake\Datasource\ConnectionManager;
//use Cake\Error\ErrorHandler;
//use Cake\Log\Log;
//use Cake\Mailer\Email;
//use Cake\Network\Request;
//use Cake\Routing\DispatcherFactory;
//use Cake\Utility\Inflector;
//use Cake\Utility\Security;


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
