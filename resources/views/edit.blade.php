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
        @error('product_name')
        <span style="color:red;">商品名を入力してください</span>
        @enderror
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <select name="company_id" class="form-select">
          <option>メーカーを選択してください</option>
          @foreach ($companies as $companies)
          <option value="{{ $companies->id }}">{{ $companies->company_name }}</option>
          @endforeach
        </select>
        @error('company_id')
        <span style="color:red;">メーカーを選択してください</span>
        @enderror
      </div>
    </div>

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="price" value="{{ $products->price }}" class="form-control" placeholder="価格">
        @error('price')
        <span style="color:red;">価格を数値で入力してください</span>
        @enderror
      </div>
    </div>  

    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="stock" value="{{ $products->stock }}" class="form-control" placeholder="在庫数">
        @error('stock')
        <span style="color:red;">在庫数を数値で入力してください</span>
        @enderror
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
