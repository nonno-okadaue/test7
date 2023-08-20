<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'company_id',
        'company_name',
        'street_address', 
        'representative_name',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function getLists()
    {
        $companies = Company::pluck('company_name', 'id');
        return $companies;
    }
    /**
     * companiesテーブルのデータを全件取得
     * 
     * @return コレクション配列
     */
    public function findAllCompany()
    {
        return $this->all();
    }

    public function createCompany()
    {
        return $this->all();
    }
    
}