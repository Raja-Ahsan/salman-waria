<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadBlogImageRequest extends FormRequest
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
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422)
        );
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'max:5120'],
        ];
    }
}
