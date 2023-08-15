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

    public function storeSale($request)
    { 
        $img = $request->file('img_path');
        $path = $img->store('img','public');
        DB::table('products') ->insert([
         'product_name' =>$request->product_name, 
         'company_id' => $request->company_id,
         'price' => $request->price,
         'stock' => $request->stock,
         'comment' => $request->comment, 
         'img_path' => $path,
         
        ]); } 




}


