<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Users;

class SignupFormRequest extends FormRequest
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
        $ip_address = request()->getClientIp();
        $rules = [
            'username' => 'required|string|min:6|max:20|regex:/^[a-zA-Z0-9]+$/|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|min:6|max:40',
            'phone' => 'required|numeric',
            'email' => 'required|string',
        ];
        return $rules;
    }

    public function messages()
    {
        $username = $this->input('username');
        return [
            'username.required' => 'Vui lòng nhập :attribute',
            'username.min' => 'Vui lòng nhập :attribute chứa ít nhất :min ký tự',
            'username.max' => 'Vui lòng nhập :attribute không quá :max ký tự',
            'username.regex' => 'Chỉ được phép nhập :attribute gồm chữ hoặc số',
            'username.unique' => 'Đã tồn tại :attribute ' . $username . '.',
            'password.required' => 'Vui lòng nhập :attribute',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự',
            'password.confirmed' => 'Mật khẩu phải giống nhau',
            'name.required' => 'Vui lòng nhập :attribute',
            'name.min' => 'Vui lòng nhập :attribute chứa ít nhất :min ký tự',
            'name.max' => 'Vui lòng nhập :attribute không quá :max ký tự',
            'phone.required' => 'Vui lòng nhập :attribute',
            'phone.numeric' => 'Vui lòng nhập đúng :attribute',
            'email.required' => 'Vui lòng nhập :attribute',
        ];
    }
    public function attributes()
    {
        return [
            'username' => 'tài khoản',
            'password' => 'mật khẩu',
            'phone' => 'số điện thoại',
            'name' => 'họ và tên',
            'email' => 'email'
        ];
    }

    //sau khi nhấn form
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $errors = $validator->errors();
                return redirect(route('signup'))->withErrorMessage($errors);
            }
        });
    }
}
