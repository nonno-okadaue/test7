<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function sale(Request $request) {
       //dd($request);
        $sale = new Sale();
        Sale::where('id', $request->id)->first();
        $result = [
            'result'=> true,
            'product_id' => $request->product_id,
        ];
        return response()->json($result);
    }
}
