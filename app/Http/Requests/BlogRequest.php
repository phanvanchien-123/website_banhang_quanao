<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required',
            'subtitle' => 'required',
            // 'image' => 'required',
            'content' => 'required',
            // 'title' => 'required'
            
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'subtitle.required' => ' Phụ đề không được để trống',
            // 'image.required' => ' Hình ảnh không được để trống',
            'content.required' => ' Nội dung không được để trống',

        ];
    }
}
