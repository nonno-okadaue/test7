@extends('app')
 
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 style="font-size:1rem;">商品情報詳細画面</h2>
    </div>
    <div class="pull-right col-12 mb-2 mt-2">
      <a class="btn btn-success" href="{{ url('/products')  }}">戻る</a>
    </div>
  </div>
</div>
 
<table class="table table-bordered">
          <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>メーカー</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>コメント</th>
        </tr>
<div style="text-align:right;">
<form action="{{ route('update', $product->id) }}" method="PUT">
  @csrf
  <tr>
      <td>{{ $product->id }}</td>
      <td><img src="{{ asset('/storage/' . $product->img_path) }}"></td>
      <td>{{ $product->product_name }}</td>
      <td>{{ $product->company->company_name }}</td>
      <td>{{ $product->price }}円</td>
      <td>{{ $product->stock }}本</td>
      <td>{{ $product->comment }}</td>
  </tr>
  </table>
    <div class="col-12 mb-2 mt-2">
      <a class="btn btn-primary" href="{{ route('edit', $product->id) }}">編集</a>
    </div>
  </div>
</form>
</div>
@endsection
