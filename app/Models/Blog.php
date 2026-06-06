<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'blog_category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'published_at',
        'scheduled_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'canonical_url',
        'robots',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'scheduled_at' => 'datetime',
        ];
    }

    public static function isContentEmpty(?string $content): bool
    {
        if ($content === null || trim($content) === '') {
            return true;
        }

        $text = trim(strip_tags(html_entity_decode($content)));

        return $text === '';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function excerpt(int $limit = 160): string
    {
        return \Illuminate\Support\Str::limit(trim(strip_tags(html_entity_decode($this->content ?? ''))), $limit);
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
