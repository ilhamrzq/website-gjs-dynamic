<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class BilliardTableRequest extends FormRequest
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
            'table_category_id' => ['required', 'integer', 'exists:master_billiard_table_categories,id'],
            'table_name' => ['required', 'string', 'max:255'],
        ];
    }
}
