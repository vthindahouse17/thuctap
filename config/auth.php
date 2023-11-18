<?php

return [

    'defaults' => [
        'guard' => 'web',
        'password' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users::class,
        ],
    ],
];
