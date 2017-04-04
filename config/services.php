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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '219926621821646',
        'client_secret' => '60fd2ac55bbd3d6c15d440db46e6c2c0',
        'redirect' => 'http://localhost/practice/social-login/public/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '250852905861-b3fos9ivqr4664m2k4ldgj85s52v3b14.apps.googleusercontent.com',
        'client_secret' => '1VXXzJLZWaTH9XpoanZPgHDS',
        'redirect' => 'http://localhost/practice/social-login/public/auth/google/callback',
    ],

];
