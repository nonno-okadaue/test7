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
        $products = Product::all();
        $companies = Company::all();

        $keyword = $request->input('keyword');
        $company = $request->input('company');
        $query = Product::query();
        //テーブル結合
        $query->join('companies', function ($query) use ($request) {
            $query->on('products.company_id', '=', 'companies.id');
            });

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        if(!empty($company)) {
            $query->where('company', 'LIKE', $company);
        }


        $products = product::paginate(5);
        return view('index', compact('products', 'keyword', 'company', 'companies'))
        ->with('page_id',request()->page)
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
 


    public function search(Request $request)
    {
        //dd($request);
        $searchWord = $_GET['searchWord'];
        $companyId = $_GET['companyId'];
        $products = Product::where('product_name', 'like', "%{$searchWord}%")->get();
        $companies = Company::where('company_name', $companyId)->get();

        $companies = Company::all()->first();

        if(isset($_GET["companyId"])) {
            // セレクトボックスで選択された値を受け取る
            $companyId = $_GET["companyId"];
        }
        
        return view('index', compact('searchWord', 'companyId', 'products', 'companies'));
        
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
        $request->validate([
            'product_name' => 'required',
            'company' => 'required',
            'price' => 'required|regex:/^[!-~]+$/',
            'stock' => 'required|regex:/^[!-~]+$/',
            'comment' => 'regex:/^[!-~]+$/',
            ]);
            
        $products = new Product();
        $products->fill($request->all())->save();
   

        // name属性が'img_path'のinputタグをファイル形式に、画像をpublic/avatarに保存
        $image_path = $request->file('img_path')->store('public');

        // 上記処理にて保存した画像に名前を付け、userテーブルのthumbnailカラムに、格納
        $products->img_path = basename($img_path);

        $products->save();

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
        //->with('page_id',request()->page_id);
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
        $product = Product::find($id);
        return view('edit', compact('product', 'companies'));
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
            'test_company' => 'required',
            'price' => 'required|regex:/^[!-~]+$/',
            'stock' => 'required|regex:/^[!-~]+$/',
            'comment' => 'regex:/^[!-~]+$/',
            ]);   

        $product = Product::find($id);
        $products->fill($request->all())->save();
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
}
