<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableRequest extends FormRequest
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
            'typeTable' => ['required',
                Rule::unique('table', 'typeTable')->where(function ($query) {
                    $table = $this->input('idTable');
                    if (!$table) {
                        // Đang tạo bàn mới, không cần kiểm tra sự duy nhất của loại bàn với bàn hiện tại
                        return;
                    }
                    // Đang cập nhật thông tin bàn, kiểm tra sự duy nhất của loại bàn với các bàn khác
                    $query->where('idTable', '!=', $table);
                }),
                ],
            'amountTable' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'typeTable.required' => 'Type table can not empty!',
            'typeTable.unique' => 'Type table had existed!',
            'amountTable.required' => 'Amount can not empty!',
        ];
    }
}
