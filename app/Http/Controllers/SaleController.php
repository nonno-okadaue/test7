<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    
    public function sale(Request $request)
     {
        
        $product_id = $request->input("product_id");
        $product = Product::find($product_id);

        if(is_null($product) || $product->isOutOfStock()){
            return response()->json(
                ["message"=>"在庫なし"]
            );
        }

        DB::transaction(function()use ($product){
            $product->reduceStock();
            $product->sales()->create();
        });
        
        return response()->json([
                "product_name"=>$product->product_name,
                "stock"=>$product->stock,
                "message"=>"成功"
            ]);
        
    }

}
