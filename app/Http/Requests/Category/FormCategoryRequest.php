<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class FormCategoryRequest extends FormRequest
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
            'name' => 'min:5|required',
            'slug' => ['required', Rule::unique('category', 'slug')],
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:500000',
        ];
        if ($this->isMethod('PUT')) {
            $rules['slug'] = ['required', Rule::unique('category', 'slug')->ignore(decrypt($this->session()->get('category.id')))];
            $rules['image'] = ['mimes:jpeg,png,jpg,gif','max:500000'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập :attribute trên :min ký tự',
            'name.min' => 'Vui lòng nhập :attribute trên :min ký tự',
            'slug.unique' => 'Đã tồn tại :attribute',
            'slug.required' => 'Vui lòng nhập :attribute',
            'image.required' => 'Vui lòng upload :attribute',
            'image.mimes' => 'Chỉ được phép upload :attribute',
            'image.max' => 'Chỉ được phép upload :attribute dưới 5MB',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên danh mục',
            'slug' => 'đường dẫn',
            'image' => 'hình ảnh',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $errors = $validator->errors();
                return redirect(route('admin.addCategory'))->withErrorMessage($errors);
            }
        });
    }
}
