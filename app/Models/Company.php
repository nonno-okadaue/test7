<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'company_name',
        'street_address', 
        'representative_name'
    ];

    //protected $table = 'products';
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function getLists()
    {
        $companies = Company::pluck('company_name', 'id');

        return $companies;
    }
}