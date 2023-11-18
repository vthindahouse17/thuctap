<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class LoginFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'username' => 'required|string|min:6|max:20|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|string',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập :attribute',
            'username.min' => 'Vui lòng nhập :attribute chứa ít nhất :min ký tự',
            'username.max' => 'Vui lòng nhập :attribute không quá :max ký tự',
            'username.regex' => 'Chỉ được phép nhập :attribute gồm chữ hoặc số',
            'password.required' => 'Vui lòng nhập :attribute',
            'password.string' => 'Mật khẩu phải là 1 chuỗi',
        ];
    }
    public function attributes()
    {
        return [
            'username' => 'tài khoản',
            'password' => 'mật khẩu',
        ];
    }

    //sau khi nhấn form
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $errors = $validator->errors();
                return redirect(route('login'))->withErrorMessage($errors);
            }
        });
    }
}
