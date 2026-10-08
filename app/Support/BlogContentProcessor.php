<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogContentProcessor
{
    /**
     * Replace inline base64 images with stored file URLs and convert video links to embeds.
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

        if (str_contains($html, 'data:image')) {
            $html = preg_replace_callback(
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
            ) ?? $html;
        }

        return self::embedVideos($html);
    }

    /**
     * HTML ready for public blog display (storage URLs + video embeds).
     */
    public static function forDisplay(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        return self::embedVideos(normalize_storage_urls($html));
    }

    /**
     * Convert YouTube / Vimeo links (and plain URLs) into responsive iframe embeds.
     * Skips URLs that are already inside an iframe.
     */
    public static function embedVideos(?string $html): ?string
    {
        if ($html === null || $html === '' || ! self::contentLikelyHasVideoUrl($html)) {
            return $html;
        }

        // <p><a href="youtube...">...</a></p> or bare <a>
        $html = preg_replace_callback(
            '/<(p|div)(\b[^>]*)>\s*<a\b[^>]*href=(["\'])(https?:\/\/(?:www\.)?(?:youtube\.com|youtu\.be|vimeo\.com)[^"\']+)\3[^>]*>.*?<\/a>\s*<\/\1>/is',
            function (array $matches): string {
                $embed = self::videoEmbedHtml($matches[4]);

                return $embed ?? $matches[0];
            },
            $html
        ) ?? $html;

        // Standalone <a href="youtube...">text</a>
        $html = preg_replace_callback(
            '/<a\b[^>]*href=(["\'])(https?:\/\/(?:www\.)?(?:youtube\.com|youtu\.be|vimeo\.com)[^"\']+)\1[^>]*>.*?<\/a>/is',
            function (array $matches): string {
                if (self::isInsideIframeContext($matches[0])) {
                    return $matches[0];
                }

                $embed = self::videoEmbedHtml($matches[2]);

                return $embed ?? $matches[0];
            },
            $html
        ) ?? $html;

        // Bare URLs in text nodes (not already in href/src)
        $html = preg_replace_callback(
            '/(?<!["\'>=])(https?:\/\/(?:www\.)?(?:youtube\.com\/(?:watch\?[^\s<]+|embed\/[\w\-]+|shorts\/[\w\-]+)|youtu\.be\/[\w\-]+|vimeo\.com\/\d+)[^\s<]*)/i',
            function (array $matches): string {
                $url = rtrim($matches[1], '.,);]');
                $embed = self::videoEmbedHtml($url);

                return $embed ?? $matches[1];
            },
            $html
        ) ?? $html;

        // Ensure existing ql-video iframes are wrapped for responsive layout
        $html = preg_replace_callback(
            '/<(?:div[^>]*class=["\'][^"\']*ql-video[^"\']*["\'][^>]*>\s*)?<iframe\b([^>]*class=["\'][^"\']*ql-video[^"\']*["\'][^>]*)>.*?<\/iframe>(?:\s*<\/div>)?/is',
            function (array $matches): string {
                if (preg_match('/src=(["\'])([^"\']+)\1/i', $matches[0], $srcMatch)) {
                    $embed = self::videoEmbedHtml($srcMatch[2]);

                    return $embed ?? $matches[0];
                }

                return $matches[0];
            },
            $html
        ) ?? $html;

        return $html;
    }

    private static function contentLikelyHasVideoUrl(string $html): bool
    {
        return (bool) preg_match('/youtube\.com|youtu\.be|vimeo\.com|ql-video/i', $html);
    }

    private static function isInsideIframeContext(string $snippet): bool
    {
        return str_contains(strtolower($snippet), '<iframe');
    }

    private static function videoEmbedHtml(string $url): ?string
    {
        $src = self::toEmbedSrc($url);

        if ($src === null) {
            return null;
        }

        $safeSrc = e($src);

        return '<div class="blog-video">'
            .'<iframe src="'.$safeSrc.'" title="Embedded video" loading="lazy" '
            .'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
            .'allowfullscreen referrerpolicy="strict-origin-when-cross-origin"></iframe>'
            .'</div>';
    }

    private static function toEmbedSrc(string $url): ?string
    {
        $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5));

        if ($url === '') {
            return null;
        }

        // Already an embed URL
        if (preg_match('#(?:youtube\.com/embed/|player\.vimeo\.com/video/)([\w\-]+)#i', $url, $m)) {
            if (stripos($url, 'vimeo') !== false) {
                return 'https://player.vimeo.com/video/'.$m[1];
            }

            return 'https://www.youtube.com/embed/'.$m[1];
        }

        // youtu.be/ID
        if (preg_match('#youtu\.be/([\w\-]+)#i', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        // youtube.com/watch?v=ID / shorts / live
        if (preg_match('#youtube\.com/(?:watch\?.*?v=|shorts/|live/)([\w\-]+)#i', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        // vimeo.com/123456
        if (preg_match('#vimeo\.com/(?:video/)?(\d+)#i', $url, $m)) {
            return 'https://player.vimeo.com/video/'.$m[1];
        }

        return null;
    }
}
