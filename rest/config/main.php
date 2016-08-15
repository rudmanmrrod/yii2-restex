<?php

use yii\web\JsonParse;

$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/../../config/params.php')
);



$db     = require(__DIR__ . '/../../config/db.php');

return [
    'id' => 'basic',
    'basePath' => dirname(__DIR__).'/..',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'app\rest\modules\v1\Module',
            'controllerNamespace' => 'app\rest\modules\v1\controllers' 
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'app\models\User',
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
        'request' => [
			'enableCookieValidation' => false,
			'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],      
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => ['user','v1/site',
                    'v1/userprofile','v1/user']
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
