<?php

namespace App\Http\Requests\Admin;

class StoreBlogRequest extends BlogFormRequest
{
    public function rules(): array
    {
        return $this->sharedRules();
    }
}
