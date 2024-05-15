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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->id,
            // 'number' => 'required',
            // 'sale' => 'required',
            
        ];
    }

    public function messages(){
        return [
            // 'name.unique' => 'Tên tài khoản đã tồn tại',
            'name.required' => 'Tên tài khoản trống',
            'email.required' => 'email trống',
            'email.unique' => 'email đã tồn tại',

            // 'number.required' => 'số lượng sản phẩm trống',
            // 'sale.required' => 'giảm giá trống',
        ];
    }
}
