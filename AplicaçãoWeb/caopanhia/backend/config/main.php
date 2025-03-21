<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => ['api' => ['class' => 'backend\modules\api\ModuleAPI',],],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,

            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/user',
                        'extraPatterns' => [
                            'GET contagem' => 'contagem',
                        ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/caes',
                    'extraPatterns' => [
                        'GET caespessoais/{idUser}' => 'caespessoais',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{idUser}' => '<idUser:\\w+>',],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/marcacoesveterinarias',
                    'extraPatterns' => [
                        'GET futurasconsultas/{idUser}' => 'futurasconsultas'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{idUser}' => '<idUser:\\w+>',],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/encomendas',
                    'extraPatterns' => [
                        'GET historico/{idUser}' => 'historico'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{idUser}' => '<idUser:\\w+>',],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/login', 'pluralize' => false, 'extraPatterns' => ['POST post' => 'post'],],
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
