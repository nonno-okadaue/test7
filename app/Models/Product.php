<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'product_name', 'price', 'stock', 'comment', 'img_path'];

    public function company() 
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function getCompanyNameAttribute()
    {
        return config('product.'.$this->company_id);
    }

        /**
     * 更新処理
     */
    public function updateProduct($request, $product)
    {
        $result = $product->fill($request->all())->save();
        return $result;
    }
}
