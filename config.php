<?php
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;

$serviceContainer = Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration([
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'dsn' => 'mysql:host=127.0.0.1;dbname=animal',
    'user' => 'root',
    'password' => 'Deutschrock1',
    'attributes' =>
        [
            'ATTR_EMULATE_PREPARES' => false,
            'ATTR_ERRMODE' => PDO::ERRMODE_EXCEPTION
        ],
]);
$manager->setName('default');
$serviceContainer->setConnectionManager('default', $manager);
$serviceContainer->setDefaultDatasource('default');