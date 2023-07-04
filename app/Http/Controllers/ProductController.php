<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = new Company;

        $companies = $company->getLists();
        $keyword = $request->input('keyword');
        $companyId = $request->input('companyId'); 

        $products = Product::paginate(5);
        return view('index', compact('products', 'companies', 'keyword'))
        ->with('page_id',request()->page)
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $companies = Company::all();
        return view('create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $company = Company::find(1);
        $products = $company->products;
    
        $products = new Product();
        $products->product_name = $request->input("product_name");
        $products->company_id = $request->input("company_id");
        $products->price = $request->input("price");
        $products->stock = $request->input("stock");
        $products->comment = $request->input("comment");
        $products->save();

        $img_path = $request->file('img_path');
        if($request->hasFile('img_path')){
            $path = \Storage::put('/public', $img_path);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|regex:/^[!-~]+$/',
            'stock' => 'required|regex:/^[!-~]+$/',
            'comment' => 'regex:/^[!-~]+$/',
            ]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $products = Product::find($id);
        return view('edit', compact('products', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|regex:/^[!-~]+$/',
            'stock' => 'required|regex:/^[!-~]+$/',
            'comment' => 'regex:/^[!-~]+$/',
            ]); 

        $img_path = $request->file('img_path');
        if($request->hasFile('img_path')){
            $path = \Storage::put('/public', $img_path);
            $path = explode('/', $path);
        }else{
            $path = null;
        }
        $products = Product::find($id);
        $products->product_name = $request->input("product_name");
        $products->company_id = $request->input("company_id");
        $products->price = $request->input("price");
        $products->stock = $request->input("stock");
        $products->comment = $request->input("comment");
        $products->save();
        return redirect()->route('index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect()->route('index');
    }

    public function search(Request $request)
    {//dd($request);

        //入力される値nameの中身を定義する
        $keyword = $request->input('keyword'); //商品名の値
        $companyId = $request->input('companyId'); //カテゴリの値

        $query = Product::query();
        //商品名が入力された場合、productsテーブルから一致する商品を$queryに代入
        if (isset($keyword)) {
            $query->where('product_name', 'like', "%{$keyword}%");
        }
        //カテゴリが選択された場合、productsテーブルからcompany_idが一致する商品を$queryに代入
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }

        //$queryをcompany_idの昇順に並び替えて$productsに代入
        $products = $query->orderBy('company_id', 'asc')->paginate(5);

        //companiesテーブルからgetLists();関数でcompany_nameとidを取得する
        $company = new Company;
        $companies = $company->getLists();

        return view('index', [
            'products' => $products,
            'companies' => $companies,
            'keyword' => $keyword,
            'companyId' => $companyId
        ]);
    }
}

   
