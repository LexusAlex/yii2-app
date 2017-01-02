<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=sporthock_prod',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 172800,// Продолжительность кеширования схемы.
            'schemaCache' => 'cache',// Название компонента кеша, используемого для хранения информации о схеме
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
