<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'nameFood' => 'required',
            'priceFood' => 'required',
            'typeFood' => 'required',
            'forPerson' => 'required',
            'amountFood' => 'required',
            'imgFood' => 'nullable|image|mimes:jpg,png,jpeg|max:5120'
        ];
    }
    public function messages() : array
    {
        return [
            'nameFood.required' => 'Name can not empty!',
            'priceFood.required' => 'Price can not empty!',
            'typeFood.required' => 'Type food can not empty!',
            'forPerson.required'=> 'For person can not empty!',
            'amountFood.required'=> 'Amount can not empty!',
            'imgFood.image' => 'File upload must be a image!',
            'imgFood.mimes' => 'The support file format is .jpg / .jpeg / .png !',
            'imgFood.max' => 'Max size of file is 5MB!'
        ];
    }
}
