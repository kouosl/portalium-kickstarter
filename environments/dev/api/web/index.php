<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');

$portalium = new \portalium\Portalium();
$portalium->setBaseYiiFile(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
$portalium->setConfigFiles([
    __DIR__ . '/../../common/config/main.php',
    __DIR__ . '/../../common/config/main-local.php',
    __DIR__ . '/../config/main.php',
    __DIR__ . '/../config/main-local.php'
]);
$portalium->run();