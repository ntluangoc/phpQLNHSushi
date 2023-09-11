<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'salary' => 'required',
            'position' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'idUser.required' => 'IdUser can not empty!',
            'salary.required' => 'Salary can not empty!',
            'position.required' => 'Position can not empty!'
        ];
    }
}
