<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Web\BlogController as WebBlogController;
use App\Http\Controllers\Web\ContactFormController;
use App\Http\Controllers\Web\SitemapController;
use App\Support\SchemaMarkup;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




// web routes
$swHomeSectionPaths = [
    'ai-ventures', 'impact', 'companies', 'presence', 'finest-tech',
    'vision', 'hero', 'contact', 'featured-book', 'main-content',
];

$renderHome = function (?string $sectionPath = null) use ($swHomeSectionPaths) {
    $sw_scroll_to_id = null;

    if (is_string($sectionPath) && $sectionPath !== '') {
        $sw_sec = preg_replace('/[^a-z0-9-]+/', '', strtolower($sectionPath));
        if (in_array($sw_sec, $swHomeSectionPaths, true)) {
            $sw_scroll_to_id = $sw_sec === 'featured-book' ? 'book' : $sw_sec;
        }
    }

    $legacySection = request()->query('scroll') ?? request()->query('sw_section');
    if ($sw_scroll_to_id === null && is_string($legacySection) && $legacySection !== '') {
        $sw_sec = preg_replace('/[^a-z0-9-]+/', '', strtolower($legacySection));
        if (in_array($sw_sec, $swHomeSectionPaths, true)) {
            return redirect('/'.$sw_sec, 301);
        }
    }

    view()->share('sw_scroll_to_id', $sw_scroll_to_id);

    $organization_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Salman Waria',
        'alternateName' => 'Salman Waria',
        'url' => 'https://salmanwaria.com/',
        'logo' => 'https://salmanwaria.com/images/salmanwaria.jpg',
        'sameAs' => [
            'https://www.facebook.com/salmanwariaofficial',
            'https://ae.linkedin.com/in/salman-waria-tech-entrepreneur',
            'https://www.instagram.com/salman.waria/',
        ],
    ]);

    $custom_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org/',
        '@type' => 'WebSite',
        'name' => 'Salman Waria',
        'url' => 'https://salmanwaria.com/',
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => 'https://salmanwaria.com/{search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ]);

    return view('screens.web.home.index', compact('sw_scroll_to_id', 'organization_schema', 'custom_schema'));
};

Route::redirect('/ai-products', '/ai-ventures', 301);

Route::get('/', fn () => $renderHome())->name('home');

foreach ($swHomeSectionPaths as $section) {
    Route::get('/'.$section, function () use ($renderHome, $section) {
        return $renderHome($section);
    })->name('home.section.'.str_replace('-', '_', $section));
}

Route::get('/about', function () {
    $custom_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'Salman Waria',
        'alternateName' => 'Salman Waria',
        'description' => 'Global Entrepreneur, AI Architect, and Technology Innovator. Author of World In 2050. Founder of 12+ ventures spanning digital marketing, AI product development, media production, and technology consulting across 40+ countries.',
        'url' => 'https://salmanwaria.com/',
        'image' => 'https://salmanwaria.com/images/salaman-waria-about-image.png',
        'jobTitle' => 'Global Entrepreneur & AI Architect',
        'knowsAbout' => [
            'Artificial Intelligence',
            'AI Product Development',
            'Digital Marketing',
            'Digital Agency Operations',
            'Brand Growth',
            'Cross-Border Market Expansion',
            'Media Production',
            'Technology-Led Storytelling',
            'Tech-Driven Business Strategy',
            'Technology Consulting',
            'Nanotechnology',
            'Digital Infrastructure',
        ],
        'worksFor' => [
            '@type' => 'Organization',
            'name' => 'Salman Waria Ventures',
        ],
        'alumniOf' => [
            [
                '@type' => 'EducationalOrganization',
                'name' => 'Dubai Digital Venture (self-founded at age 19)',
            ],
        ],
        'nationality' => 'Pakistani',
        'sameAs' => [
            'https://www.facebook.com/salmanwariaofficial',
            'https://www.instagram.com/salman.waria/',
            'https://ae.linkedin.com/in/salman-waria-tech-entrepreneur',
        ],
        'hasOccupation' => [
            '@type' => 'Occupation',
            'name' => 'Entrepreneur',
            'occupationLocation' => [
                '@type' => 'City',
                'name' => 'Dubai',
            ],
        ],
        'knowsLanguage' => ['English'],
        'author' => [
            '@type' => 'Person',
            'name' => 'Salman Waria',
            'description' => 'Author of World In 2050',
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => 'https://salmanwaria.com/about',
        ],
    ]);

    return view('screens.web.about.index', compact('custom_schema'));
})->name('about');

Route::get('/book', function () {
    $product_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org/',
        '@type' => 'Product',
        'name' => 'World in 2050',
        'image' => 'https://salmanwaria.com/book',
        'brand' => [
            '@type' => 'Brand',
            'name' => 'Salman Waria',
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '441',
        ],
    ]);

    $custom_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org/',
        '@type' => 'WebSite',
        'name' => 'World in 2050',
        'url' => 'https://salmanwaria.com/book',
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => 'https://salmanwaria.com/book{search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ]);

    $faq_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'What Will Happen in the World in 2050?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'By 2050, AI, quantum computing, and genetic engineering are expected to reshape economies, governments, and daily life. World in 2050 explores how these technologies could redefine civilisation.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Will AI Rule the World by 2050?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'AI may not rule the world, but it will reshape power, decision-making, and global influence. The most advanced AI systems will likely determine which nations and organisations lead the future.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'What Is World In 2050 by Salman Waria About?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'World In 2050 examines the convergence of AI, quantum computing, genetic engineering, and geopolitical change, and how these forces may transform human civilisation by 2050.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Is World In 2050 a Future Technology Book?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Yes, but it also explores geopolitics, economics, and the societal impact of emerging technologies shaping the future.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Who Should Read World In 2050?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Entrepreneurs, investors, technologists, policymakers, and anyone interested in understanding where technology and society are heading.',
                ],
            ],
        ],
    ]);

    $book_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org',
        '@type' => 'Book',
        'name' => 'World In 2050',
        'author' => [
            '@type' => 'Person',
            'name' => 'Salman Waria',
            'url' => 'https://salmanwaria.com/',
        ],
        'description' => 'A book exploring the systems, breakthroughs, and power shifts defining the next era of humanity — from artificial superintelligence and quantum computing to genetic engineering and the multipolar power order.',
        'url' => 'https://salmanwaria.com/book',
        'image' => 'https://salmanwaria.com/images/book-cover.webp',
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '12400',
        ],
        'offers' => [
            '@type' => 'Offer',
            'availability' => 'https://schema.org/InStock',
            'seller' => [
                '@type' => 'Organization',
                'name' => 'Amazon',
            ],
        ],
        'award' => '#1 Nanotechnology — Amazon Top Seller',
        'inLanguage' => 'en',
        'about' => [
            'Artificial Superintelligence',
            'Quantum Computing',
            'Genetic Engineering',
            'Multipolar Power Order',
        ],
    ]);

    return view('screens.web.book.index', compact('product_schema', 'custom_schema', 'faq_schema', 'book_schema'));
})->name('book');

Route::get('/book-details', function () {
    $product_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org',
        '@type' => 'Book',
        'name' => 'World in 2050',
        'author' => [
            '@type' => 'Person',
            'name' => 'Salman Waria',
        ],
        'url' => route('book-details'),
        'description' => 'Free preview of World in 2050 — then get the full book on Amazon.',
    ]);

    return view('screens.web.book-detail.index', compact('product_schema'));
})->name('book-details');

Route::get('/contact-us', function () {
    $custom_schema = SchemaMarkup::script([
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        'name' => 'Contact — Salman Waria',
        'url' => route('contact-us'),
        'description' => 'Get in touch with Salman Waria for partnerships, speaking, media, and AI ventures.',
    ]);

    return view('screens.web.contact-us.index', compact('custom_schema'));
})->name('contact-us');

Route::post('/contact-submit', [ContactFormController::class, 'store'])->name('contact.submit');

Route::post('/newsletter-submit', [ContactFormController::class, 'newsletter'])->name('newsletter.submit');

Route::redirect('/blogs', '/blog', 301);
Route::redirect('/blogs/{slug}', '/blog/{slug}', 301);

Route::get('/blog', [WebBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [WebBlogController::class, 'show'])->name('blog.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::fallback(function () {
    return redirect()->route('home');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dashboard routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/blogs/upload-image', [AdminBlogController::class, 'uploadImage'])->name('blogs.upload-image');
    Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
    Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
    Route::get('/admin/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/admin/blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::delete('/admin/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');

    Route::get('/admin/blog-categories', [BlogCategoryController::class, 'index'])->name('blog-categories.index');
    Route::get('/admin/blog-categories/create', [BlogCategoryController::class, 'create'])->name('blog-categories.create');
    Route::post('/admin/blog-categories', [BlogCategoryController::class, 'store'])->name('blog-categories.store');
    Route::get('/admin/blog-categories/{blogCategory}/edit', [BlogCategoryController::class, 'edit'])->name('blog-categories.edit');
    Route::put('/admin/blog-categories/{blogCategory}', [BlogCategoryController::class, 'update'])->name('blog-categories.update');
    Route::delete('/admin/blog-categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('blog-categories.destroy');
});

require __DIR__.'/auth.php';
