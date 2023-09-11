<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartFoodRequest extends FormRequest
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
            'idCart' => 'required',
            'idFood' => 'required',
            'amountCF' => 'required',
            'priceCF' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'idCart.required' => 'IdCart can not empty!',
            'idFood.required' => 'IdFood can not empty!',
            'amountCF.required' => 'Amount can not empty!',
            'priceCF.required' => 'Price can not empty!'
        ];
    }
}
