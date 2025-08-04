<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'video_title_id' => ['required', 'string', 'max:255'],
            'video_title_en' => ['required', 'string', 'max:255'],
            'video' => ['required', 'file', 'mimes:mp4,mov,avi,wmv', 'max:100000'],
        ];
    }
}
