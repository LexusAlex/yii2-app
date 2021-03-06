<?php
return [
    'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            //'timeZone' => 'Europe/Moscow',
            //'timeZone' => 'GMT+3',
            //'dateFormat' => 'd MMMM yyyy',
            //'datetimeFormat' => 'd-M-Y H:i:s',
            //'timeFormat' => 'H:i:s',
        ],
        'i18n' => [ // переводы сообщений
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        /*'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@console/rbac/items.php',
            'assignmentFile' => '@console/rbac/assignments.php',
            'ruleFile' => '@console/rbac/rules.php'
        ],*/
    ],
];
