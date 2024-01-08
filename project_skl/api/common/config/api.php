<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/../../../config/db.php';
$routesV1 = require __DIR__ . '/routes_v1.php';

$config = [
    'id' => 'api',
    'name' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\v1\controllers',
    'bootstrap' => [
        'log',
        function () {
            $arr = [];

            foreach (Yii::$app->urlManager->rules as $rule) {
                $arr['OPTIONS ' . $rule->name] = $rule->route;
            }

            Yii::$app->urlManager->addRules($arr);
        }
    ],
    'aliases' => [
        '@api' => dirname(dirname(__DIR__)) . '/api',
    ],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module'
        ],
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => $routesV1,
        ],
        'currencyUpdater' => [
            'class' => 'app\components\currency\CurrencyUpdater',
        ],
        'currencyService' => [
            'class' => 'app\services\currency\CurrencyService',
            'currencyUpdater' => [
                'class' => 'app\components\currency\CurrencyUpdater',
            ],
        ],
        'db' => $db,
    ],

    'params' => $params,
];


return $config;
