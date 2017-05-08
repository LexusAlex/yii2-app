<?php
return [
    'createRecord' => [
        'type' => 2,
    ],
    'updateRecord' => [
        'type' => 2,
    ],
    'deleteRecord' => [
        'type' => 2,
    ],
    'readRecord' => [
        'type' => 2,
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'readRecord',
        ],
    ],
    'writer' => [
        'type' => 1,
        'children' => [
            'createRecord',
            'updateRecord',
            'user',
        ],
    ],
    'WriterManager' => [
        'type' => 1,
        'children' => [
            'deleteRecord',
            'writer',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'WriterManager',
        ],
    ],
];
