<?php

return [
    'oracle' => [
        'driver'    => 'pdo',
        'tns'       => env('DB_TNS', ''),
                        'host'          => env('DB_HOST', '192.168.0.212'),
                        'port'          => env('DB_PORT', '1521'),
                        'database'      => env('DB_DATABASE', 'MWERP'),
                        'username'      => env('DB_USERNAME', 'mwerp'),
                        'password'      => env('DB_PASSWORD', 'oraCLE123$'),
        'charset'   => 'WE8ISO8859P1',
        'prefix'    => '',
        'quoting'   => false,
    ],
];
