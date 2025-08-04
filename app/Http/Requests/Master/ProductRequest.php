<?php

namespace App\Http\Requests\Master;

use App\Models\Master\ProductDiscountType;
use App\Models\Master\ProductPriceType;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        // Handle price_data
        $priceTypes = ProductPriceType::active();
        $priceData = $this->input('price_data', []);

        foreach ($priceTypes as $priceType) {
            $key = $priceType->id . '_' . str_replace(' ', '_', $priceType->price_type_name);

            if (isset($priceData[$key])) {
                $cleaned = (int) str_replace(['.', ','], '', $priceData[$key]);
                $priceData[$key] = $cleaned;
            }
        }

        // Handle discount_data
        $discountTypes = ProductDiscountType::active();
        $discountData = $this->input('discount_data', []);

        foreach ($discountTypes as $discountType) {
            $key = $discountType->id . '_' . str_replace(' ', '_', $discountType->discount_type_name);

            if (isset($discountData[$key])) {
                $cleaned = (int) str_replace(['.', ','], '', $discountData[$key]);
                $discountData[$key] = $cleaned;
            }
        }

        $this->merge([
            'price_data' => $priceData,
            'discount_data' => $discountData,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'product_category_id' => ['required'],
            'product_name' => ['required', 'string'],
            'product_description' => ['required', 'string'],
            'product_stock' => ['required', 'integer', 'max_digits:4'],
        ];

        $priceTypes = ProductPriceType::active();
        foreach ($priceTypes as $priceType) {
            $fieldName = 'price_data.' . $priceType->id . '_' . str_replace(' ', '_', $priceType->price_type_name);
            $rules[$fieldName] = ['required', 'integer', 'min:0', 'max_digits:8'];
        }

        $discountTypes = ProductDiscountType::active();
        foreach ($discountTypes as $discountType) {
            $fieldName = 'discount_data.' . $discountType->id . '_' . str_replace(' ', '_', $discountType->discount_type_name);
            $rules[$fieldName] = ['required', 'integer', 'between:0,100'];
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [];
        
        $priceTypes = ProductPriceType::active();
        foreach ($priceTypes as $priceType) {
            $fieldName = 'price_data.' . $priceType->id . '_' . str_replace(' ', '_', $priceType->price_type_name);
            $messages["$fieldName.required"] = "The {$priceType->price_type_name} field is required.";
            $messages["$fieldName.integer"] = "The {$priceType->price_type_name} field must be a number.";
            $messages["$fieldName.max_digits"] = "The {$priceType->price_type_name} field must not exceed 8 digits.";
        }
        
        $discountTypes = ProductDiscountType::active();
        foreach ($discountTypes as $discountType) {
            $fieldName = 'discount_data.' . $discountType->id . '_' . str_replace(' ', '_', $discountType->discount_type_name);
            $messages["$fieldName.required"] = "The {$discountType->discount_type_name} field is required.";
            $messages["$fieldName.integer"] = "The {$discountType->discount_type_name} field must be a number.";
            $messages["$fieldName.max_digits"] = "The {$discountType->discount_type_name} field must be between 0 and 100.";
        }

        return $messages;
    }
}
