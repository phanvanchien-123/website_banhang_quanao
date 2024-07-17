<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutOrderRequest extends FormRequest
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
            'home_address' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'applied_coupon_code' => 'nullable|string|max:50',
            'payment_type' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages()
    {
        return [
            'home_address.required' => 'Chưa cập nhật địa chỉ nhà cụ thể.',
            'address.required' => 'Chưa cập nhật đại chỉ.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'email.required' => 'Email thì cần thiết.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
           
        ];
    }
}
