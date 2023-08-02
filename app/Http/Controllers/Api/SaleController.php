<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //在庫を減算する

    public function index(Request $request)
    {
        try {
        $sale = Sales::where('id', $request->id)->first();
        $result = [
            'result'      => true,
            'product_id'     => $product_id->product_id,
        ];
    } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
    }
    return $this->resConversionJson($result);
}

private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }

 
public function sale(SaleRequest $request)
{
    //productsテーブルの在庫を減らす
    Products::where('id', $request->id)->decrement('stock', 1);
    return redirect()->route('index');

}
}

