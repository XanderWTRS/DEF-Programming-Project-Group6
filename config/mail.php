<?php

return [

    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],

        'gmail' => [
            'transport' => 'smtp',
            'host' => env('MAIL_GMAIL_HOST', 'smtp.gmail.com'),
            'port' => env('MAIL_GMAIL_PORT', 587),
            'encryption' => env('MAIL_GMAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_GMAIL_USERNAME'),
            'password' => env('MAIL_GMAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],

        'outlook' => [
            'transport' => 'smtp',
            'host' => env('MAIL_OUTLOOK_HOST', 'smtp.office365.com'),
            'port' => env('MAIL_OUTLOOK_PORT', 587),
            'encryption' => env('MAIL_OUTLOOK_ENCRYPTION', 'tls'),
            'username' => env('MAIL_OUTLOOK_USERNAME'),
            'password' => env('MAIL_OUTLOOK_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'your_gmail_username@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Your Name or Project Name'),
    ],

];
