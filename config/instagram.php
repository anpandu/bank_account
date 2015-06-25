<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Instagram Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => env('IG_APP_ID', 'f7f6b5607bc34991871776a1a3a8eef7'),
            'client_secret' => env('IG_APP_SECRET', '027b269a685447eb9f7ba1ce9120e901'),
            'callback_url' => env('IG_CALLBACK', 'http://bankaccount.dev/auth_instagram/mirror'),
        ],

        'alternative' => [
            'client_id' => 'your-client-id',
            'client_secret' => null,
            'callback_url' => null,
        ],

    ],

];
