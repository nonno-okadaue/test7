<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
        // お金が足りているかのチェック
        $remain = function($attribute, $value, $fail) {
            $stock = $this->all();
            if ($stock['stock'] <= 0)
            {
                $fail('売り切れです。');
            }
        };
        return [
            'id'=>'required',
        ];
    }

}
