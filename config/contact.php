<?php

declare(strict_types=1);

$rawAddresses = (string) env(
    'MAIL_CONTACT_TO_ADDRESS',
    env('MAIL_FROM_ADDRESS', 'hello@salmanwaria.com')
);

$addresses = array_values(array_unique(array_filter(array_map(
    static fn (string $email): string => strtolower(trim($email)),
    preg_split('/[,\s;]+/', $rawAddresses) ?: []
), static fn (string $email): bool => $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL))));

if ($addresses === []) {
    $addresses = ['hello@salmanwaria.com'];
}

return [
    'inbox' => [
        // First address kept for backward compatibility
        'address' => $addresses[0],
        'addresses' => $addresses,
        'name' => env('MAIL_CONTACT_TO_NAME', env('MAIL_FROM_NAME', 'Salman Waria')),
    ],
];
