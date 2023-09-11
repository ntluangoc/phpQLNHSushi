<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftCodeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'nameGiftCode' => 'required',
            'discountGiftCode' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'nameGiftCode.required' => 'Name can not empty!',
            'discountGiftCode.required' => 'Discount can not empty!'
        ];
    }
}
