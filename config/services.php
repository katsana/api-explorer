<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'katsana' => [
        'environment' => env('KATSANA_ENV', 'production'),
        'client_id' => env('KATSANA_KEY'),
        'client_secret' => env('KATSANA_SECRET'),
        'redirect' => null,
    ],
];
