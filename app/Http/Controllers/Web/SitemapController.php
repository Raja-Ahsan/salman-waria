<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            [
                'loc' => 'https://salmanwaria.com/',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '1.00',
            ],
            [
                'loc' => 'https://salmanwaria.com/about',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.80',
            ],
            [
                'loc' => 'https://salmanwaria.com/blog',
                'lastmod' => now()->toAtomString(),
                'priority' => '0.85',
            ],
            [
                'loc' => 'https://salmanwaria.com/book',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.90',
            ],
            [
                'loc' => 'https://salmanwaria.com/book-details',
                'lastmod' => '2026-06-04T00:00:00+00:00',
                'priority' => '0.80',
            ],
            [
                'loc' => 'https://salmanwaria.com/contact-us',
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
                    'loc' => route('blog.show', $post->slug),
                    'lastmod' => $post->updated_at->toAtomString(),
                    'priority' => '0.75',
                ];
            });

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
