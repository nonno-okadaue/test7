<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    
    
    public function sale(Request $request)
     {
        $sale = new Sale();
        $result = $sale->dec();
        return $result;
    }
    
}
