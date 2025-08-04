<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
        $encryptedId = $this->route('permission');
        $permissionId = null;

        if ($encryptedId) {
            $permissionId = Crypt::decrypt($encryptedId);
        }

        return [
            'name' => ['required', Rule::unique('permissions', 'name')->ignore($permissionId)],
            'guard_name' => ['required']
        ];
    }
}
