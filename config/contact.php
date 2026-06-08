<?php

declare(strict_types=1);

return [
    'inbox' => [
        'address' => env('MAIL_CONTACT_TO_ADDRESS', env('MAIL_FROM_ADDRESS', 'hello@salmanwaria.com')),
        'name' => env('MAIL_CONTACT_TO_NAME', env('MAIL_FROM_NAME', 'Salman Waria')),
    ],
];
