<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|regex:/^[!-~]+$/',
            'stock' => 'required|regex:/^[!-~]+$/',
            'comment' => 'regex:/^[!-~]+$/',
            ];
    }
    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_id' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
        ];
    }
    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'company_id.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'price.regex' => ':attributeは:半角・数字で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.regex' => ':attributeは:半角・数字で入力してください。',
            'comment.regex' => ':attributeは:半角・数字で入力してください。',
        ];
    }

}
