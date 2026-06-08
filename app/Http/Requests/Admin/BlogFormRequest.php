<?php

namespace App\Http\Requests\Admin;

use App\Support\SchemaInputParser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

abstract class BlogFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation(): void
    {
        $slug = $this->input('slug');

        $this->merge([
            'blog_category_id' => $this->filled('blog_category_id') ? $this->input('blog_category_id') : null,
            'canonical_url' => $this->filled('canonical_url') ? $this->input('canonical_url') : null,
            'scheduled_at' => $this->filled('scheduled_at') ? $this->input('scheduled_at') : null,
            'custom_schema' => SchemaInputParser::clean($this->input('custom_schema')),
            'slug' => is_string($slug) && trim($slug) !== '' ? Str::slug($slug) : $slug,
        ]);
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()->first() ?? 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }

    protected function isDraftSave(): bool
    {
        return $this->input('save_as') === 'draft';
    }

    /**
     * @return array<string, mixed>
     */
    protected function sharedRules(?int $blogId = null): array
    {
        $slugRule = ['nullable', 'string', 'max:255'];

        if ($blogId) {
            $slugRule[] = Rule::unique('blogs', 'slug')->ignore($blogId);
        } else {
            $slugRule[] = Rule::unique('blogs', 'slug');
        }

        return [
            'save_as' => ['nullable', 'in:draft,publish'],
            'title' => [$this->isDraftSave() ? 'nullable' : 'required', 'string', 'max:255'],
            'slug' => $slugRule,
            'content' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'status' => ['required', 'in:draft,published,scheduled'],
            'scheduled_at' => [
                Rule::requiredIf(fn () => ! $this->isDraftSave() && $this->input('status') === 'scheduled'),
                'nullable',
                'date',
            ],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'max:5120'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'robots' => ['nullable', 'string', 'max:100'],
            'blog_category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'custom_schema' => ['nullable', 'string', 'max:50000'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['nullable', 'string', 'max:500'],
            'faqs.*.answer' => ['nullable', 'string', 'max:10000'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $schema = $this->input('custom_schema');

            if (! is_string($schema) || trim($schema) === '') {
                return;
            }

            if (! SchemaInputParser::isValid($schema)) {
                $validator->errors()->add(
                    'custom_schema',
                    'Custom schema must be valid JSON or JSON-LD (with or without <script> tags).'
                );
            }
        });
    }
}
