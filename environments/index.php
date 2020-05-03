<?php
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'frontend/runtime',
            'frontend/web/assets',
        ],
        'setExecutable' => [
            'yii'
        ],
        'setCookieValidationKey' => [
            'api/config/main-local.php',
            'backend/config/main-local.php',
            'frontend/config/main-local.php',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'frontend/runtime',
            'frontend/web/assets',
        ],
        'setExecutable' => [
            'yii'
        ],
        'setCookieValidationKey' => [
            'api/config/main.php',
            'backend/config/main.php',
            'frontend/config/main.php',
        ],
    ],
];
