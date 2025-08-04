<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'socmed_name' => ['required', 'string', 'max:255'],
            'socmed_icon' => ['required', 'string', 'max:255'],
            'socmed_url' => ['required', 'url', 'max:255'],
            'socmed_username' => ['nullable', 'string', 'max:255'],
        ];
    }
}
