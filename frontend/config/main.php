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
                'page-<page:\d+>' => 'front/index',
                '/' => 'front/index',
                'blog' => 'blog/index',

                'blog/<slug:[a-z0-9-]+>' => 'blog/view',
                'blog/category/<id:\d{1,4}>/page-<page:\d+>' => 'blog/category',
                'blog/category/<id:\d{1,4}>' => 'blog/category',
                'blog/tag/<name:[a-zа-я0-9-]+>/page-<page:\d+>' => 'blog/tag',
                'blog/tag/<name:[a-zа-я0-9-]+>' => 'blog/tag',
                /*[
                    'pattern' => 'blog/category/<id:\d{1,4}>/page-<page>',
                    'route' => 'blog/category',
                    'suffix' => '/',
                    'defaults' => ['page' => '',],
                ],*/

                'about' => 'front/about',
                [
                    'pattern' => 'sitemap',
                    'route' => 'front/sitemap',
                    'verb' => 'POST',
                    //'suffix' => '.xml',
                ],


            ],
        ],

        'assetManager' => [
            'linkAssets' => true, // разрешаем создавать символические ссылки на ресурсы, и ресурсы всегда будут свежими
            //'appendTimestamp' => true,
            'bundles' => [
                /*'nezhelskoy\highlight\HighlightAsset' => [
                    'selector' => 'pre',
                    'options' => [
                        'tabReplace'=> ' ',
                        //'classPrefix' => 'custom-',
                        'useBR' => false,
                    ],
                    'css' => ['dist/styles/github.css'],
                ],*/
                //'yii\bootstrap\BootstrapAsset' =>
            ],
        ],
    ],
    'params' => $params,
];
