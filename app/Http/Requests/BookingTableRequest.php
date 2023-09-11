<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingTableRequest extends FormRequest
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
            'idUser' => 'required',
            'idTable' => 'required',
            'amountBT' => 'required',
            'dateBT' => 'required',
            'timeBT' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'idUser.required' => 'IdUser can not empty!',
            'idTable.required' => 'IdTable can not empty!',
            'amountBT.required' => 'Amount can not empty!',
            'dateBT.required' => 'Date can not empty!',
            'timeBT.required' => 'Time can not empty!',
        ];
    }
}
