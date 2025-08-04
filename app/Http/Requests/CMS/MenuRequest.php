<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'lang_id' => ['required', 'integer', 'exists:master_languages,id'],
            'menu_name' => ['required', 'string', 'max:255'],
            'menu_path' => ['required', 'string', 'max:255'],
            'is_menu' => ['sometimes', 'boolean']
        ];
    }
}
