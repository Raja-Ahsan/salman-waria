<?php

declare(strict_types=1);

/**
 * Root-relative URLs so navigation works from any path (subfolder installs,
 * extensionless URLs, etc.). Uses SCRIPT_NAME from the running script.
 */
if (!function_exists('sw_base_path')) {
    function sw_base_path(): string
    {
        static $cached = null;
        if ($cached !== null) {
            return $cached;
        }
        $script = isset($_SERVER['SCRIPT_NAME']) ? (string) $_SERVER['SCRIPT_NAME'] : '';
        $script = str_replace('\\', '/', $script);
        $dir = dirname($script);
        if ($dir === '/' || $dir === '\\' || $dir === '.') {
            $cached = '';
        } else {
            $cached = rtrim($dir, '/');
        }
        return $cached;
    }
}

if (!function_exists('sw_href')) {
    /**
     * @param string $path Site path without leading slash, e.g. "about", "contact-us", "contact-submit.php"
     */
    function sw_href(string $path = ''): string
    {
        $base = sw_base_path();
        $path = trim($path);
        if ($path === '' || $path === '.' || $path === './') {
            return $base === '' ? '/' : $base . '/';
        }
        $path = ltrim($path, '/');
        $prefix = $base === '' ? '/' : $base . '/';

        return $prefix . $path;
    }
}
