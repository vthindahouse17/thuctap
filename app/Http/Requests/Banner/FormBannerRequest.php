<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class FormBannerRequest extends FormRequest
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
        $rules =  [
            'title' => 'min:2|required',
            'status' => 'required|numeric',
            'description' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập :attribute',
            'title.min' => 'Vui lòng nhập :attribute chứa ít nhất :min ký tự',
            'status.required' => 'Vui lòng nhập :attribute',
            'status.numeric' => 'Vui lòng nhập :attribute là số',
            'image.required' => 'Vui lòng nhập :attribute',
            'description.required' => 'Vui lòng nhập :attribute',
            'button_text.required' => 'Vui lòng nhập :attribute',
            'button_link.required' => 'Vui lòng nhập :attribute',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'tiêu đề',
            'status' => 'trạng thái',
            'description' => 'mô tả',
            'button_text' => 'nội dung nút',
            'button_link' => 'đường dẫn nút',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $errors = $validator->errors();
                return redirect(back())->withErrorMessage($errors);
            }
        });
    }
}
