<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'ok' => false,
                'error' => $validator->errors()->first(),
                'csrf_token' => csrf_token(),
            ], 422)
        );
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'string', 'email:rfc', 'max:254'],
            'company' => ['nullable', 'string', 'max:200'],
            'subject' => ['nullable', 'string', 'max:300'],
            'message' => ['required', 'string', 'max:10000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a valid name.',
            'name.max' => 'Please enter a valid name.',
            'email.required' => 'Please enter a valid email address.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please enter a message (max 10000 characters).',
            'message.max' => 'Please enter a message (max 10000 characters).',
        ];
    }
}
