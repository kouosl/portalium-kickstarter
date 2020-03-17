<?php
return [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'site' => [
            'class' => 'portalium\site\Module'
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'portalium\user\models\User',
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
            'cookieValidationKey' => 'Ws_5fvKwQV0EaWpFgpgU0x7aK5BsKfPY',
            'class' => 'portalium\web\Request',
            'web'=> '/api/web',
            'aliasUrl' => '/api'
        ],
        'urlManager' => [
            'class' => 'kouosl\components\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,

        ],
        'errorHandler' => [
            'errorAction' => 'site/default/error',
        ],
    ]
];