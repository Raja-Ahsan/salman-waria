<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogContentProcessor
{
    /**
     * Replace inline base64 images with stored file URLs so content stays small in DB.
     */
    public static function process(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        // Remove Quill table-better editor-only nodes that break reload on edit
        $html = preg_replace('/<temporary\b[^>]*>.*?<\/temporary>/is', '', $html) ?? $html;
        $html = preg_replace('/\sclass="ql-cell-focused"/i', '', $html) ?? $html;
        $html = preg_replace("/\sclass='ql-cell-focused'/i", '', $html) ?? $html;

        if (! str_contains($html, 'data:image')) {
            return $html;
        }

        return preg_replace_callback(
            '/<img\b([^>]*?)src=(["\'])data:image\/([\w+.-]+);base64,([^"\']+)\2([^>]*)>/i',
            function (array $matches): string {
                $extension = strtolower(str_replace('svg+xml', 'svg', $matches[3]));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

                if (! in_array($extension, $allowed, true)) {
                    return $matches[0];
                }

                $binary = base64_decode($matches[4], true);

                if ($binary === false || strlen($binary) > 5 * 1024 * 1024) {
                    return $matches[0];
                }

                $ext = $extension === 'jpeg' ? 'jpg' : $extension;
                $path = 'blogs/content/'.Str::uuid().'.'.$ext;

                Storage::disk('public')->put($path, $binary);

                $url = storage_public_url($path);

                return '<img'.trim($matches[1]).' src="'.$url.'"'.trim($matches[5]).'>';
            },
            $html
        );
    }
}
