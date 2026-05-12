<?php

/**
 * Application config loader.
 * Uses local PHP config file for secrets.
 */
$localConfigPath = __DIR__ . '/sw-config.local.php';
if (is_readable($localConfigPath)) {
    $local = require $localConfigPath;
    if (is_array($local)) {
        return $local;
    }
}

return [
    'mail' => [
        'to_email'   => '',
        'to_name'    => 'Salman Waria',
        'from_email' => '',
        'from_name'  => 'Salman Waria - Contact Form',
    ],
    'smtp' => [
        'host'       => 'smtp.gmail.com',
        'port'       => 587,
        'encryption' => 'tls',
        'username'   => '',
        'password'   => '',
    ],
];
