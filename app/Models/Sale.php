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
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'created_at',
        'updated_at'
    ];

    public function product() 
    {
        return $this->belongsTo('App\Models\Product', 'id');
    }


}

