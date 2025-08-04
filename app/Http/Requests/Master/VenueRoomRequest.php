<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class VenueRoomRequest extends FormRequest
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
            'venue_id' => ['required'],
            'room_name' => ['required', 'string', 'max:255'],
            'room_description' => ['required', 'string', 'max:255'],
            'room_minimum_charge' => ['required', 'integer', 'min:0', 'max_digits:8'],
        ];
    }
}
