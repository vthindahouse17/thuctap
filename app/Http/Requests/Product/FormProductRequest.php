<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class FormProductRequest extends FormRequest
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
            'slug' => ['required', Rule::unique('products', 'slug')],
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:500000',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string|min:10',
            'status' => 'required|numeric',
            'amount' => 'required|numeric',
            'category' => 'required|numeric',
        ];
        if ($this->isMethod('PUT')) {
            $rules['slug'] = ['required', Rule::unique('products', 'slug')->ignore(decrypt($this->session()->get('product.id')))];
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
            'price.required' => 'Vui lòng nhập :attribute trên :min ký tự',
            'price.min' => 'Vui lòng nhập :attribute trên :min ký tự',
            'price.numeric' => 'Vui lòng nhập :attribute là số',
            'status.required' => 'Vui lòng nhập :attribute trên :min ký tự',
            'status.numeric' => 'Vui lòng nhập :attribute là số',
            'amount.required' => 'Vui lòng nhập :attribute trên :min ký tự',
            'amount.numeric' => 'Vui lòng nhập :attribute là số',
            'category.required' => 'Vui lòng nhập :attribute trên :min ký tự',
            'category.numeric' => 'Vui lòng nhập :attribute là số',
            'description.required' => 'Vui lòng nhập :attribute trên :min ký tự',
            'description.min' => 'Vui lòng nhập :attribute trên :min ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên danh mục',
            'slug' => 'đường dẫn',
            'image' => 'hình ảnh',
            'price' => 'giá',
            'status' => 'trạng thái',
            'amount' => 'số lượng',
            'category' => 'chuyên mục',
            'description' => 'nội dung',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $errors = $validator->errors();
                return redirect(route('admin.addProduct'))->withErrorMessage($errors);
            }
        });
    }
}
