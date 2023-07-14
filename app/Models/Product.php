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
        'img_path',
        'created_at',
        'updated_at'
    ];

    public function company() 
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function index() 
    {
        return $this->paginate(5);
    }

    public function storeCreate() 
    {
        return $this->paginate(5);

    }
    public function storeProducts($request)
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

    



