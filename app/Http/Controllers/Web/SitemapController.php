<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    private const SITE_URL = 'https://salmanwaria.com';

    public function index(): Response
    {
        $urls = [
            [
                'loc' => self::SITE_URL.'/',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '1.00',
            ],
            [
                'loc' => self::SITE_URL.'/about',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.80',
            ],
            [
                'loc' => self::SITE_URL.'/book',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.90',
            ],
            [
                'loc' => self::SITE_URL.'/book-details',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.80',
            ],
            [
                'loc' => self::SITE_URL.'/contact-us',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.70',
            ],
        ];

        Blog::query()
            ->published()
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at'])
            ->each(function (Blog $post) use (&$urls) {
                $urls[] = [
                    'loc' => self::SITE_URL.'/blog/'.$post->slug,
                    'lastmod' => $post->updated_at->format('Y-m-d\TH:i:s+00:00'),
                    'priority' => '0.80',
                ];
            });

        return response()
            ->view('screens.web.sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
