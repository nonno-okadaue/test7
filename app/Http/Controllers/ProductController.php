<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $company;
    
    public function __construct()
    {
        $this->company = new Company();
    }

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
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
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
    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $model = Product();
            $model->updateProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
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
        $products->delete();
        return redirect()->route('index');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword'); 
        $companyId = $request->input('companyId'); 

        $query = Product::query();

        if (isset($keyword)) {
            $query->where('product_name', 'like', "%{$keyword}%");
        }
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }
        $products = $query->orderBy('company_id', 'asc')->paginate(5);

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

   
