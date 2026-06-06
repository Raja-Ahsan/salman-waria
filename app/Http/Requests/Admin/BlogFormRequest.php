<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

abstract class BlogFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
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
        ];
    }
}
