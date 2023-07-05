@extends('app')
 
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 style="font-size:1rem;">商品情報編集画面</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
    </div>
  </div>
</div>
</br>
<table class="table table-bordered">
  <tr>
    <th>商品情報ID</th>
    <td>{{ $products->id }}</td>
  </tr>
</table>
 
<div style="text-align:right;">
<form action="{{ route('update', $products->id) }}" method="POST">
@csrf  
@method('PUT')
  <div class="row">
  <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" value="{{ $products->product_name }}" name="product_name" class="form-control" placeholder="商品名">
        @if($errors->has('product_name'))
        <p style="color:red;">{{ $errors->first('product_name') }}</p>
        @endif
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <select name="company_id" class="form-select">
          @foreach ($companies as $company)
          <option value="{{ $products->company_id }}">{{ $company->company_name }}</option>
          @endforeach
        </select>
        @if($errors->has('company_id'))
        <p style="color:red;">{{ $errors->first('company_id') }}</p>
        @endif
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="price" value="{{ $products->price }}" class="form-control" placeholder="価格">
        @if($errors->has('price'))
        <p style="color:red;">{{ $errors->first('price') }}</p>
        @endif
      </div>
    </div>  

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="stock" value="{{ $products->stock }}" class="form-control" placeholder="在庫数">
        @if($errors->has('stock'))
        <p style="color:red;">{{ $errors->first('stock') }}</p>
        @endif
      </div>
    </div> 

    <div class="col-12 mb-2 mt-2">
      <div class="form-group"> 
        <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント" value="{{ $products->comment }}">{{ $products->comment }}</textarea>
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <label for="image">{{ asset('/storage/' . $products->img_path) }}</label>
        <input type="file" name="img_path" value="{{ $products->img_path }}" class="form-control-file" >
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <button type="submit" class="btn btn-primary w-100">更新</button>
    </div>
  </div>
</form>
</div>
@endsection
