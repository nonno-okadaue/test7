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
    public function index(Request $request, Product $product)
    {
        $company = new Company;

        $companies = $company->getLists();
        $keyword = $request->input('keyword');
        $companyId = $request->input('companyId'); 
        $keyword = $request->input('keyword');
        $search = $request->input('search');
        $jougenprice = $request->input('jougenprice');
        $kagenprice = $request->input('kagenprice');
        $jougenstock = $request->input('jougenstock');
        $kagenstock = $request->input('kagenstock');
        
        $products = $product->index();
        return view('index', compact(
            'products',
            'companies', 
            'keyword',
            'jougenprice',
            'kagenprice',
            'jougenstock',
            'kagenstock'))
        ->with('page_id',request()->page)
        ->with('i', (request()->input('page', 1) - 1) * 5);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Company $Company)
    {
        $company = new Company;
        $companies = $company->createCompany();
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

                $model = new Product(); 
                $model -> storeProducts($request); 

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
            $jougenprice = $request->input('jougenprice'); 
            $kagenprice = $request->input('kagenprice'); 
            $jougenstock = $request->input('jougenstock'); 
            $kagenstock = $request->input('kagenstock'); 
    
            $query = Product::query();
            $company = new Company;
            $companies = $company->getLists();
    
            if (isset($keyword)) {
                $query->where('product_name', 'like', "%{$keyword}%");
            }
            if ($companyId) {
                $query->where('company_id', $companyId);
            }
            if($jougenprice){
                $query->where('price','<=',$jougenprice);
            }
            if($kagenprice){
                $query->where('price','>=',$kagenprice);
            }
            if($jougenstock){
                $query->where('stock','<=',$jougenstock);
            }
            if($kagenstock){
                $query->where('stock','>=',$kagenstock);
            }
    

            $products = $query->orderBy('company_id', 'asc')
            ->orderBy('price', 'asc')
            ->orderBy('stock', 'asc')
            ->paginate(5);
            return view('index', [
                'products' => $products,
                'companies' => $companies,
                'keyword' => $keyword,
                'companyId' => $companyId,
                'jougenprice' => $jougenprice,
                'kagenprice' => $kagenprice,
                'jougenstock' => $jougenstock,
                'kagenstock' => $kagenstock
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
            try {
                DB::beginTransaction();
                if($request->hasFile('img_path')){
                    $original = request()->file('img_path')->getClientOriginalName();
                    $name = date('Ymd_His').'_'.$original;
                    request()->file('img_path')->move('storage',$name);
                    $product->img_path = $name;
                $product->save();                
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
