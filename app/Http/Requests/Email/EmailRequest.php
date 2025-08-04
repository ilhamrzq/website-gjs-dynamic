<?php

namespace App\Http\Requests\Email;

use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'min:8', 'max:20'],
            'message' => ['required', 'string', 'max:1000'],
            'g_recaptcha_response' => ['required', new Recaptcha]
        ];
    }
}
