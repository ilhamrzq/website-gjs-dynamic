<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfileRequest extends FormRequest
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
            'company_email' => ['required', 'email', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'company_iframe_maps_url' => ['required', 'url:https'],
            'company_phone_number' => ['required', 'string', 'min:8', 'max:15'],
        ];
    }
}
