<?php

namespace App\Http\Requests\Admin;

class UpdateBlogRequest extends BlogFormRequest
{
    public function rules(): array
    {
        $blogId = $this->route('blog')?->id;

        return array_merge($this->sharedRules($blogId), [
            'remove_featured_image' => ['nullable', 'boolean'],
            'remove_og_image' => ['nullable', 'boolean'],
        ]);
    }
}
