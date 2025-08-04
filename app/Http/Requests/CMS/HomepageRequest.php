<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class HomepageRequest extends FormRequest
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
            'lang_id' => ['required', 'exists:master_languages,id'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string', 'max:1000'],
            'feature_left_title' => ['required', 'string', 'max:255'],
            'feature_left_description' => ['required', 'string', 'max:1000'],
            'feature_center_title' => ['required', 'string', 'max:255'],
            'feature_center_description' => ['required', 'string', 'max:1000'],
            'feature_right_title' => ['required', 'string', 'max:255'],
            'feature_right_description' => ['required', 'string', 'max:1000'],
            'video' => ['required', 'file', 'mimes:mp4,mov,avi,wmv', 'max:100000'],
        ];
    }
}
