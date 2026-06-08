<?php

namespace App\Models;

use App\Support\SchemaMarkup;
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
        'custom_schema',
        'faqs',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'faqs' => 'array',
        ];
    }

    public function hasFaqs(): bool
    {
        return is_array($this->faqs) && count($this->faqs) > 0;
    }

    public function customSchemaMarkup(): ?string
    {
        if (! is_string($this->custom_schema) || trim($this->custom_schema) === '') {
            return null;
        }

        $decoded = json_decode($this->custom_schema, true);

        if (! is_array($decoded) || json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        $schemas = array_is_list($decoded) ? $decoded : [$decoded];

        return SchemaMarkup::scripts($schemas);
    }

    public function faqSchemaMarkup(): ?string
    {
        if (! $this->hasFaqs()) {
            return null;
        }

        $mainEntity = [];

        foreach ($this->faqs as $faq) {
            $question = trim((string) ($faq['question'] ?? ''));
            $answer = trim((string) ($faq['answer'] ?? ''));

            if ($question === '' || $answer === '') {
                continue;
            }

            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $answer,
                ],
            ];
        }

        if ($mainEntity === []) {
            return null;
        }

        return SchemaMarkup::script([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
        ]);
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
