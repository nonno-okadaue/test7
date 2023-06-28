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
    <td>{{ $product->id }}</td>
  </tr>
</table>
 
<div style="text-align:right;">
<form action="{{ route('update', $product->id) }}" method="POST">
@csrf  
  <div class="row">
    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="商品名">
        @error('product_name')
        <span style="color:red;">商品名を20文字以内で入力してください</span>
        @enderror
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <select name="company_id" class="form-select">
          <option>メーカーを選択してください</option>
          @foreach ($companies as $company)
          <option value="{{ $company->id }}">{{ $company->company_name }}</option>
          @endforeach
        </select>
        @error('company')
        <span style="color:red;">分類を選択してください</span>
        @enderror
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="価格">
        @error('price')
        <span style="color:red;">価格を数値で入力してください</span>
        @enderror
      </div>
    </div>  

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="在庫数">
        @error('stock')
        <span style="color:red;">在庫数を数値で入力してください</span>
        @enderror
      </div>
    </div> 

    <div class="col-12 mb-2 mt-2">
      <div class="form-group"> 
        <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント">{{ $product->comment }}</textarea>
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <label for="image">{{ asset('/storage/' . $product->img_path) }}</label>
        <input type="file" name="img_path" value="{{ $product->img_path }}" class="form-control-file" >
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <button type="submit" class="btn btn-primary w-100">更新</button>
    </div>
  </div>
</form>
</div>
@endsection
