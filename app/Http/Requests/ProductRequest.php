<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'nullable',
            'img_path' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'company_id.required' => 'メーカー名は必須です。',
            'price.required' => '価格は必須です。',
            'price.numeric' => '価格は数字で入力してください。',
            'stock.required' => '在庫数は必須です。',
            'stock.numeric' => '在庫数は数字で入力してください。',
        ];
    }
}
