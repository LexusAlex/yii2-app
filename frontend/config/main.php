<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Sporthock blog',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'front/index',
    //'catchAll' => ['site/offline'],
    'layout'=> 'front',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            //'enablePrettyUrl' => true,
            //'showScriptName' => false,
            'enableStrictParsing' => true, // строгий разбор
            //'suffix' => '.html',
            'rules' => [
                'page/<page:\d+>' => 'front/index',
                '' => 'front/index',
                'blog/<slug:[a-z0-9-]+>' => 'blog/index',
                'blog' => 'blog/index',
                'blog/<action:(category|tag)>/<id:\d{1,4}>' => 'blog/<action>',

                'about' => 'front/about'

            ],
        ],

        'assetManager' => [
            'linkAssets' => true,
            'bundles' => [
                'nezhelskoy\highlight\HighlightAsset' => [
                    'selector' => 'pre',
                    'options' => [
                        'tabReplace'=> ' ',
                        //'classPrefix' => 'custom-',
                        'useBR' => false,
                    ],
                    'css' => ['dist/styles/github.css'],
                ],
                //'yii\bootstrap\BootstrapAsset' =>
            ],
        ],
    ],
    'params' => $params,
];
