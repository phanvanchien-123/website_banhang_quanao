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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postcode_zip' => 'required|string|max:10', 
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
            'first_name.required' => 'Tên đầu tiên là bắt buộc.',
            'last_name.required' => 'Họ là bắt buộc.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'email.required' => 'Email thì cần thiết.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'street_address.required' => 'Địa chỉ đường phố là bắt buộc.',
            'town_city.required' => 'Thị trấn hoặc thành phố là bắt buộc.',
            'country.required' => 'Quốc gia là bắt buộc.',
            'postcode_zip.required' => 'Mã bưu điện hoặc ZIP là bắt buộc.',
        ];
    }
}
