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
    

}

    



