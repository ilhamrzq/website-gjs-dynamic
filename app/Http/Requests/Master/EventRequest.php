<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'venue_id' => ['required', 'exists:master_venues,id'],
            'event_title' => ['required', 'string', 'max:255'],
            'event_description' => ['required', 'string', 'max:500'],
            'event_content' => ['required', 'string'],
            'event_start_date' => ['required', 'date'],
            'event_end_date' => ['required', 'date'],
            'event_status' => ['required', 'string'],
        ];
    }
}
