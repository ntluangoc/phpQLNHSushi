<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'nameUser' => 'required',
            'birthday' => 'required',
            'phone' => [
                'required',
                Rule::unique('user', 'phone')->where(function ($query) {
                    $user = $this->input('idUser');
                    if (!$user) {
                        // Đang tạo người dùng mới, không cần kiểm tra sự duy nhất của số điện thoại với người dùng hiện tại
                        return;
                    }
                    // Đang cập nhật thông tin người dùng, kiểm tra sự duy nhất của số điện thoại với các người dùng khác
                    $query->where('idUser', '!=', $user);
                }),
            ],
            'address' => 'required',
            'email' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
        ];
    }
    public function messages(): array
    {
        return [
            'nameUser.required' => 'Name can not empty!',
            'birthday.required' => 'Birthday can not empty!',
            'phone.required' => 'Phone can not empty!',
            'address.required' => 'Address can not empty!',
            'email.required' => 'Email can not empty!',
            'phone.unique' => 'Phone was existed!',
            'avatar.image' => 'File upload must be a image!',
            'avatar.mimes' => 'The support file format is .jpg / .jpeg / .png !',
            'avatar.max' => 'Max size of file is 5MB!'
        ];
    }
}
