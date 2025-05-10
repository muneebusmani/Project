<?php

// Linux
// $config=
// [
// 'db_host' => 'localhost',
// 'db_username' => 'muneeb',
// 'db_password' => 'muneeb8355',
// 'db_name' => 'JusticiaLaw'
// ];

// Windows
$config =
[
    'db_host' => $_ENV['DB_HOST'],
    'db_username' => $_ENV['DB_USER'],
    'db_password' => $_ENV['DB_PASSWORD'],
    'db_name' => $_ENV['DB_DATABASE'],
];
