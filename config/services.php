<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

   // 'google' => [
   //      'client_id' => '672035414784-6e7e6ab575s07nnock6n0l1mqlln9j1n.apps.googleusercontent.com',
   //      'client_secret' => 'TkhJexYmrBcC9NDcuRUOEf70',
   //      'redirect' => 'http://dinhhuy.com/auth/google/callback'
   //  ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT'),
    ],

    // 'facebook' => [
    //     'client_id' => '1068703186894115',  //client face của bạn
    //     'client_secret' => 'eee28c317f4276f9ab396432374f0961',  //client app service face của bạn
    //     'redirect' => 'http://dinhhuy.com/admin/login/callback' //callback trả về
    // ],
    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
        ],

];
