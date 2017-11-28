<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module'   // here is our v1 modules
        ],
        'sample' => [
            'class' => 'kouosl\sample\Module'   // here is our v1 modules
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'kouosl\user\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Ws_5fvKwQV0EaWpFgpgU0x7aK5BsKfPY',
            'class' => 'kouosl\base\components\Request',
            'web'=> '/api/web',
            'aliasUrl' => '/api'
        ],
        'urlManager' => [
            'class' => 'kouosl\base\components\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,

        ],
        'errorHandler' => [
            'errorAction' => 'site/default/error',
        ],
    ],
    'params' => $params,
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    //  $config['bootstrap'][] = 'debug';
    // $config['modules']['debug'] = 'yii\debug\Module';
}

return $config;
