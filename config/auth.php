<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'user',
        'passwords' => 'user',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [

        // Login Admin & Petugas
        'user' => [
            'driver' => 'session',
            'provider' => 'user',
        ],

        // Login Pengadu
        'pengadu' => [
            'driver' => 'session',
            'provider' => 'pengadu',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        // Data Admin & Petugas
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\ModelUser::class,
        ],

        // Data Pengadu
        'pengadu' => [
            'driver' => 'eloquent',
            'model' => App\Models\ModelPengadu::class,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'user' => [
            'provider' => 'user',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'pengadu' => [
            'provider' => 'pengadu',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];