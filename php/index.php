<?php
/**
 * Created by PhpStorm.
 * User: marcel
 * Date: 15.04.16
 * Time: 22:08
 */
require_once '../vendor/autoload.php';
require_once '../config.php';
use BeatHeat\MainRouter\MainRouter;
use BeatHeat\SessionHandler;
use BeatHeat\Template;

/*spl_autoload_register('defineAutoLoader');*/

/*function defineAutoLoader($class)
{
    require_once substr($class, strrpos($class, '\\') + 1) . ".php";
}*/

$sessionHandler = new SessionHandler();
$templateHandler = new Template('../html');

$actionCode = !empty($_GET['actionCode']) ? $_GET['actionCode'] : null;

$router = new MainRouter($actionCode, [], $templateHandler, $sessionHandler);
$router->route();
