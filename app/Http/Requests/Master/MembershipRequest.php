<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
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
        if ($this->has('membership_price')) {
            $cleaned = (int) str_replace(['.', ','], '', $this->input('membership_price'));
            $this->merge([
                'membership_price' => $cleaned,
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
            'membership_name' => ['required', 'string', 'max:255'],
            'membership_price' => ['required', 'integer', 'min:0', 'max_digits:8'],
            'membership_description' => ['required', 'string', 'max:255'],
            'membership_color' => ['required', 'string'],
        ];
    }
}
