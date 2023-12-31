<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'dateBill' => 'required',
            'timeBill' => 'required',
            'sumPrice' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'dateBill.required' => 'Date can not empty!',
            'timeBill.required' => 'Time can not empty!',
            'sumPrice.required' => 'SumPrice can not empty!'
        ];
    }
}
