<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if ($this->has('venue_price')) {
            $cleaned = (int) str_replace(['.', ','], '', $this->input('venue_price'));
            $this->merge([
                'venue_price' => $cleaned,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'venue_name' => ['required', 'string', 'max:255'],
            'venue_address' => ['required', 'string', 'max:255'],
            'venue_price' => ['required', 'integer', 'min:0', 'max_digits:8'],
            'venue_url' => ['required', 'url:https'],
            'venue_opening_time' => ['required'],
            'venue_closing_time' => ['required'],
        ];
    }
}
