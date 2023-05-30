<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $id = $this->route()->user;

        return [
            'name' => ['required', 'min:6', function ($attribute, $value, $fail) {
                if ($value!=mb_strtoupper($value, 'UTF-8')) {
                    $fail($this->attributes()[$attribute].' bắt buộc phải là chữ hoa');
                }
            }],
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phải từ :min ký tự',
            'email' => ':attribute không đúng định dạng'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email'
        ];
    }
}
