<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCartRequest extends FormRequest
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
            'user_id' => ['required', 'uuid', Rule::exists('users', 'id')],
            'quantity' => ['required', 'integer'],
        ];
    }

    public function passedValidation()
    {
        $allowedKeys = ['user_id', 'quantity'];
        $requestKeys = array_keys($this->all());

        if (array_diff($requestKeys, $allowedKeys)) {
            throw new HttpResponseException(response()->json([
                'message' => 'Invalid fields in request body',
                'errors' => 'Only specified body are allowed'
            ], 422));
        }
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
