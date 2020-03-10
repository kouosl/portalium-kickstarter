<?php
return [
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/home',
    'modules' => [
        'site' => [
            'class' => 'portalium\site\Module'
        ],
        'user' => [
            'class' => 'portalium\user\Module'
        ],
        'theme' => [
            'class' => 'portalium\theme\Module'
        ],
    ],
    'components' => [
        'request' => [
            'class' => 'portalium\components\Request',
            'cookieValidationKey' => 'Ws_5fvKwQV0EaWpFgpgU0x7aK5BsKfPY',
            'csrfParam' => '_csrf-frontend',
            'web'=> '/frontend/web',
            'aliasUrl' => '/'
        ],
		 'urlManager' => [
        	'enablePrettyUrl' => true,
        	'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'portalium\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>['site/auth/login'],
            'identityCookie' => [
                'name' => '_identity-frontend',
                'httpOnly' => true
            ],
        ],
        'session' => [
            'name' => 'portalium-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/home/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/portalium/portalium-theme',
                    '@app/modules' => '@vendor/portalium/portalium-theme/views/',
                ],
                'baseUrl' => '@vendor/portalium/portalium-theme',
            ],

        ],
    ],
    'layout' => 'frontend-main',
];