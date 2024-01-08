<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => sprintf('mysql:host=%s;dbname=%s',getenv('DB_HOST'),getenv('DB_DATABASE')),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => getenv('DB_CHARSET'),
];
