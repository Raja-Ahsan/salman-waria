<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogContentProcessor
{
    /**
     * Replace inline base64 images with stored file URLs and convert video links to YouTube cards.
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
     * HTML ready for public blog display (storage URLs + YouTube thumbnail cards).
     */
    public static function forDisplay(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        return self::embedVideos(normalize_storage_urls($html));
    }

    /**
     * Convert YouTube / Vimeo links and iframes into clickable thumbnail cards
     * that open the video on YouTube/Vimeo (no on-page iframe playback).
     */
    public static function embedVideos(?string $html): ?string
    {
        if ($html === null || $html === '' || ! self::contentLikelyHasVideoUrl($html)) {
            return $html;
        }

        // Existing responsive/iframe embeds → thumbnail link cards
        $html = preg_replace_callback(
            '/<div[^>]*class=["\'][^"\']*blog-video[^"\']*["\'][^>]*>\s*<iframe\b[^>]*src=(["\'])([^"\']+)\1[^>]*>\s*<\/iframe>\s*<\/div>/is',
            function (array $matches): string {
                return self::videoEmbedHtml($matches[2]) ?? $matches[0];
            },
            $html
        ) ?? $html;

        $html = preg_replace_callback(
            '/<iframe\b[^>]*(?:class=["\'][^"\']*ql-video[^"\']*["\'][^>]*)?src=(["\'])(https?:\/\/(?:www\.)?(?:youtube\.com|youtu\.be|player\.vimeo\.com)[^"\']+)\1[^>]*>\s*<\/iframe>/is',
            function (array $matches): string {
                return self::videoEmbedHtml($matches[2]) ?? $matches[0];
            },
            $html
        ) ?? $html;

        // <p><a href="youtube...">...</a></p> (skip our thumbnail cards)
        $html = preg_replace_callback(
            '/<(p|div)(\b[^>]*)>\s*<a\b(?![^>]*blog-video-link)[^>]*href=(["\'])(https?:\/\/(?:www\.)?(?:youtube\.com|youtu\.be|vimeo\.com)[^"\']+)\3[^>]*>.*?<\/a>\s*<\/\1>/is',
            function (array $matches): string {
                return self::videoEmbedHtml($matches[4]) ?? $matches[0];
            },
            $html
        ) ?? $html;

        // Standalone video links (not already our card)
        $html = preg_replace_callback(
            '/<a\b(?![^>]*blog-video-link)[^>]*href=(["\'])(https?:\/\/(?:www\.)?(?:youtube\.com|youtu\.be|vimeo\.com)[^"\']+)\1[^>]*>.*?<\/a>/is',
            function (array $matches): string {
                return self::videoEmbedHtml($matches[2]) ?? $matches[0];
            },
            $html
        ) ?? $html;

        // Bare URLs in text (not inside href/src)
        $html = preg_replace_callback(
            '/(?<!["\'>=])(https?:\/\/(?:www\.)?(?:youtube\.com\/(?:watch\?[^\s<]+|embed\/[\w\-]+|shorts\/[\w\-]+)|youtu\.be\/[\w\-]+|vimeo\.com\/\d+)[^\s<]*)/i',
            function (array $matches): string {
                $url = rtrim($matches[1], '.,);]');

                return self::videoEmbedHtml($url) ?? $matches[1];
            },
            $html
        ) ?? $html;

        return $html;
    }

    private static function contentLikelyHasVideoUrl(string $html): bool
    {
        return (bool) preg_match('/youtube\.com|youtu\.be|vimeo\.com|ql-video|blog-video/i', $html);
    }

    /**
     * Clickable thumbnail that opens the video on YouTube/Vimeo in a new tab.
     */
    private static function videoEmbedHtml(string $url): ?string
    {
        $video = self::parseVideo($url);

        if ($video === null) {
            return null;
        }

        $watchUrl = e($video['watch_url']);
        $thumbUrl = e($video['thumb_url']);
        $label = e($video['label']);

        return '<div class="blog-video">'
            .'<a class="blog-video-link" href="'.$watchUrl.'" target="_blank" rel="noopener noreferrer" aria-label="Watch on '.$label.'">'
            .'<img src="'.$thumbUrl.'" alt="Watch on '.$label.'" loading="lazy" decoding="async" />'
            .'<span class="blog-video-play" aria-hidden="true"></span>'
            .'<span class="blog-video-badge">Watch on '.$label.'</span>'
            .'</a>'
            .'</div>';
    }

    /**
     * @return array{id: string, watch_url: string, thumb_url: string, label: string}|null
     */
    private static function parseVideo(string $url): ?array
    {
        $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5));

        if ($url === '') {
            return null;
        }

        // YouTube embed / nocookie
        if (preg_match('#(?:youtube(?:-nocookie)?\.com/embed/|youtu\.be/)([\w\-]+)#i', $url, $m)) {
            $id = $m[1];

            return [
                'id' => $id,
                'watch_url' => 'https://www.youtube.com/watch?v='.$id,
                'thumb_url' => 'https://i.ytimg.com/vi/'.$id.'/hqdefault.jpg',
                'label' => 'YouTube',
            ];
        }

        // youtube.com/watch?v= / shorts / live
        if (preg_match('#youtube\.com/(?:watch\?.*?v=|shorts/|live/)([\w\-]+)#i', $url, $m)) {
            $id = $m[1];

            return [
                'id' => $id,
                'watch_url' => 'https://www.youtube.com/watch?v='.$id,
                'thumb_url' => 'https://i.ytimg.com/vi/'.$id.'/hqdefault.jpg',
                'label' => 'YouTube',
            ];
        }

        // Vimeo
        if (preg_match('#(?:player\.)?vimeo\.com/(?:video/)?(\d+)#i', $url, $m)) {
            $id = $m[1];

            return [
                'id' => $id,
                'watch_url' => 'https://vimeo.com/'.$id,
                'thumb_url' => 'https://vumbnail.com/'.$id.'.jpg',
                'label' => 'Vimeo',
            ];
        }

        return null;
    }
}
