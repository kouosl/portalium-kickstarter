<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/home',
    'modules' => [
        'site' => [
            'class' => 'kouosl\site\Module'   // here is our v1 modules
        ],
        'menu' => [
            'class' => 'kouosl\menu\Module',
        ],
        'user' => [
            'class' => 'kouosl\user\Module'   // here is our v1 modules
        ],
        'sample' => [
            'class' => 'kouosl\sample\Module'   // here is our v1 modules
        ],
    ],
    'components' => [
        'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Ws_5fvKwQV0EaWpFgpgU0x7aK5BsKfPY',
            'class' => 'kouosl\base\components\Request',
            'web'=> '/frontend/web',
            'csrfParam' => '_csrf-frontend',
        ],
		 'urlManager' => [
        	'enablePrettyUrl' => true,
        	'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'kouosl\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>['site/auth/login'],
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'view' => [
            'class' => 'kouosl\base\components\View',
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/kouosl/portal-theme',
                    '@app/modules' => '@vendor/kouosl/portal-theme/views/',
                ],
                'baseUrl' => '@vendor/kouosl/portal-theme',
            ],

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
            'errorAction' => 'site/auth/error',
        ],

       
    ],
    'layout' => 'frontend-main',
    'params' => $params,
];
