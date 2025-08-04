<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class PriceListRequest extends FormRequest
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
        $fields = ['price_normal', 'price_promo'];

        foreach ($fields as $field) {
            if ($this->has($field)) {
                // Remove dot and comma separators, then cast to int
                $cleaned = (int) str_replace(['.', ','], '', $this->input($field));
                $this->merge([
                    $field => $cleaned,
                ]);
            }
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
            'price_name' => ['required','string', 'max:255'],
            'price_normal' => ['required', 'integer', 'max_digits:8'],
            'price_promo' => ['nullable', 'integer', 'max_digits:8'],
        ];
    }
}
