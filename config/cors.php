<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', "/customer/register", "/customer/login", '/customer', "/customer/logout",],

    'allowed_methods' => ["GET", "POST"],

    'allowed_origins' => [env("FRONTEND_URL",)],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ["Content-Type", "X-XSRF-TOKEN"],

    'exposed_headers' => [],

    'max_age' => 600,

    'supports_credentials' => true,

];
