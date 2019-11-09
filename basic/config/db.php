<?php
// $path = ;
// var_dump($path); die;
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . realpath(__DIR__ . '/../../db/sqlite.db'),
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
