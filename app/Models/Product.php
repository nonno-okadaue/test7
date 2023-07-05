<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id', 
        'product_name', 
        'price', 
        'stock', 
        'comment', 
        'img_path'
    ];

    public function company() 
    {
        return $this->belongsTo('App\Models\Company');
    }
    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
        ]);
    }
    

    


}
