<?php

/*return [
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
*/
return [
    'oracle' => [
        'driver'    => 'pdo',
        'tns'       => env('DB_TNS', ''),
                        'host'          => env('DB_HOST', '192.168.0.248'),
                        'port'          => env('DB_PORT', '1521'),
                        'database'      => env('DB_DATABASE', 'ERPNEW'),
                        'username'      => env('DB_USERNAME', 'PUNETESTING'),
                        'password'      => env('DB_PASSWORD', 'PUNETESTING'),
        'charset'   => 'WE8ISO8859P1',
        'prefix'    => '',
        'quoting'   => false,
    ],
];