<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {//dd($request);
        $img = $request->file('img_path');
        try {
			DB::beginTransaction();
            if (isset($img)) {
                $path = $img->store('img','public');
                Product::create([
                    "product_name" => $request->product_name, 
                    'company_id' => $request->company_id,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'comment' => $request->comment, 
                    'img_path' => $path,
                ]);
                }else{
                $product = new Product();
                $product->fill($request->all())->save();
            }
			DB::commit();
		} catch (Throwable $e) {
			DB::rollBack();
		}
        return redirect()->route('index');
        }


    public function search(Request $request)
    {//dd($request);
        $keyword = $request->input('keyword'); 
        $companyId = $request->input('companyId'); 

        $query = Product::query();
        $company = new Company;
        $companies = $company->getLists();

        if (isset($keyword)) {
            $query->where('product_name', 'like', "%{$keyword}%");
        }
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }
        $products = $query->orderBy('company_id', 'asc')->paginate(5);

        return view('index', [
            'products' => $products,
            'companies' => $companies,
            'keyword' => $keyword,
            'companyId' => $companyId
        ]);
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
    public function update(ProductRequest $request, $id)
        {//dd($request);
            $product = Product::find($id);
            $img_path = $request->file('img_path');
            try {
                DB::beginTransaction();
            if($request->hasFile('img_path')){
                $path = \Storage::put('/public', $img_path);
                $path = explode('/', $path);
            }else{
                $path = null;
                $product->fill($request->all())->save();
            }  
            DB::commit();
		} catch (Throwable $e) {
			DB::rollBack();
		}
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
        try {
			DB::beginTransaction();
			$products->delete();
			DB::commit();
		} catch (Throwable $e) {
			DB::rollBack();
		}
        return redirect()->route('index');
    }
    
}

   
