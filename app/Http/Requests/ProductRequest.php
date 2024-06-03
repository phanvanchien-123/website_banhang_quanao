<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'featured' => 'required',
            'brand_id' => 'required',
            'product_category_id' => 'required',
            // 'title' => 'required'
            
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'price.required' => 'Giá không được để trống',
            'qty.required' => ' Số lượng không được để trống',
            'featured.required' => 'Nổi bật không được để trống',
            'brand_id.required' => 'Thương hiệu không được để trống',
            'product_category_id.required' => 'Danh mục không được để trống',

        ];
    }
}
