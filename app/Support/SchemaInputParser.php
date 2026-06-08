<?php

namespace App\Support;

class SchemaInputParser
{
    /**
     * Strip script wrappers and normalize pasted schema input for validation/storage.
     */
    public static function clean(?string $input): ?string
    {
        if (! is_string($input)) {
            return null;
        }

        $input = trim($input);

        if ($input === '') {
            return null;
        }

        $input = preg_replace('/^\xEF\xBB\xBF/', '', $input) ?? $input;
        $input = self::normalizeWhitespace($input);

        if (preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $input, $matches)) {
            $input = trim($matches[1]);
        } else {
            $input = preg_replace('/<\/?script\b[^>]*>/i', '', $input) ?? $input;
            $input = trim($input);
        }

        $input = preg_replace('/<!--.*?-->/s', '', $input) ?? $input;

        return trim($input);
    }

    /**
     * @return array<string, mixed>|array<int, array<string, mixed>>|null
     */
    public static function decode(?string $input): ?array
    {
        $clean = self::clean($input);

        if ($clean === null) {
            return null;
        }

        $decoded = json_decode($clean, true);

        if (! is_array($decoded) || json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $decoded;
    }

    public static function isValid(?string $input): bool
    {
        return self::decode($input) !== null;
    }

    public static function normalize(?string $input): ?string
    {
        $decoded = self::decode($input);

        if ($decoded === null) {
            return null;
        }

        return json_encode(
            $decoded,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        );
    }

    private static function normalizeWhitespace(string $input): string
    {
        $input = str_replace(
            ["\xc2\xa0", "\xe2\x80\x89", "\xe2\x80\x8a", "\xe2\x80\xaf", "\xe2\x81\x9f", "\xe3\x80\x80"],
            ' ',
            $input
        );

        $input = str_replace(
            ["\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x98", "\xe2\x80\x99"],
            '"',
            $input
        );

        return preg_replace('/[\x{00A0}\x{1680}\x{2000}-\x{200B}\x{202F}\x{205F}\x{3000}]/u', ' ', $input) ?? $input;
    }
}
