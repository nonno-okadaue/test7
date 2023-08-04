<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    public function product() 
    {
        return $this->belongsTo('App\Models\Product', 'id');
    }

    public function dec()
    {
    
    // 在庫を減らす処理

    $sales = DB::table('sales')
    ->where('product_id')
    ->join('products', 'sales.product_id', '=', 'products.id')
    ->decrement('stock', 1);

    return $sales;
}

}

