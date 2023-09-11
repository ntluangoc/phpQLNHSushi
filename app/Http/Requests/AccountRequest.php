<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountRequest extends FormRequest
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
            'idUser' => 'required',
            'username' => [
                'required',
                Rule::unique('account', 'username')
                    ->ignore($this->user()->idAccount, 'idAccount')
            ],
            'password' => 'required',
            'role' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'idUser.required' => 'IdUser can not empty!',
            'username.required' => 'Username can not empty!',
            'username.unique' => 'Username was existed!',
            'password.required' => 'Password can not empty!',
            'role.required' => 'Role can not empty!'
        ];
    }
}
