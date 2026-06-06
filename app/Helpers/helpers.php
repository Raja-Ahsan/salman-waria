<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('checkUser')) {
    function checkUser()
    {
        return Auth::user();
    }
}

if (! function_exists('formatRole')) {
    function formatRole($roleName)
    {
        return \Illuminate\Support\Str::of($roleName ?? 'Not Set')->replace('_', ' ')->title();
    }
}

if (! function_exists('isRole')) {
    function isRole($role)
    {
        $user = Auth::user();
        if (!$user) return false;

        $userRole = $user->roles->first();

        if (!$userRole) return false;

        // If role passed is numeric → check id
        if (is_numeric($role)) {
            return $userRole->id == $role;
        }

        // If string → check role name
        return $userRole->name === $role;
    }
}

function generateRandomPassword($length = 10)
{
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*'), 0, $length);
}


if (!function_exists('userRoleId')) {
    function userRoleId()
    {
        return auth()->check() ? auth()->user()->roles->first()->id : null;
    }
}

if (!function_exists('userHasRole')) {
    function userHasRole($roleName)
    {
        return auth()->check() && auth()->user()->hasRole($roleName);
    }
}

if (!function_exists('current_user')) {
    function current_user() {
        return \Illuminate\Support\Facades\Auth::user();
    }
}

if (! function_exists('storage_public_url')) {
    /**
     * Public URL for a file on the "public" disk (works on any host/port).
     */
    function storage_public_url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return '/storage/'.ltrim(str_replace('\\', '/', $path), '/');
    }
}

if (! function_exists('normalize_storage_urls')) {
    /**
     * Fix absolute storage URLs in HTML so images load on the current app origin.
     */
    function normalize_storage_urls(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        return preg_replace('#https?://[^/]+/storage/#', '/storage/', $html) ?? $html;
    }
}
