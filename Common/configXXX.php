<?php

namespace Common;

$serverName = $_SERVER['SERVER_NAME'];

if ($serverName == 'localhost') {
    return [
        'db' => [
            'host' => 'localhost',
            'username' => 'xxx',
            'password' => 'xxx',
            'name' => 'xxx'
        ]
    ];
} else {
    return [
        'db' => [
            'host' => 'xxx',
            'username' => 'xxx',
            'password' => 'xxx',
            'name' => 'xxx'
        ]
    ];
}


