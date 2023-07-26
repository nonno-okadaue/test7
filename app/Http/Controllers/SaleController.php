<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //在庫を減算する
 
public function index(Request $request)
{
    try {
        $sale = Sale::first();
        $result = [
            'result'      => true,
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
    return response()->json(['message' => '在庫がありません'], 422, ['Content-Type' => 'application/json'], JSON_UNESCAPED_UNICODE);
}
}

