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

    public function create($request) {
        // 登録処理

        $img_path = $request->file('img_path');
        $img_name = $img_path ->getClientOriginalName();
        if($request->hasFile('img_path')){
            $path = \Storage::put('/public', $img_path);
            $path = explode('/', $path);
        }else{
            $path = null;
        }
        DB::table('products')->insert([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
        ]);

    }

    


}
