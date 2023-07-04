@extends('app')

@section('content')

  <div class="row">
    <div class="col-lg-12">
      <div class="text-left">
        <h2 style="font-size:1rem;">商品情報一覧画面</h2> 
      </div>
      <div class="text-right col-12 mb-2 mt-2">
        <a class="btn btn-success text-right mb-2 mt-2" href="{{ route('create') }}">新規登録</a>
      </div>

      <!--検索フォーム-->
      <div class="search">
        <div class="col-sm">
          <form method="get" action="{{ route('search')}}">
        
            <!--入力-->
            <div class="form-group row">

              <div>
                <label for="" class="col-sm-auto col-form-label">キーワード
                  <div><input type="text" name="keyword" value="{{ $keyword }}"></div>
                </label>
              </div>

              <div>
                <label for="" class="col-sm-auto col-form-label">会社名
                  <div><select name="companyId" data-toggle="select" class="form-control" value=""></div>
                    @foreach ($companies as $id => $company_name)
                    <option value="{{ $id }}">{{ $company_name }}</option>
                    @endforeach
                      </select>
                  </div>
                </label>
              </div>
           
              <div class="col-sm-auto btn">
                <button type="submit" class="btn btn-primary ">検索</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-12 mt-2">
        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th></th>
            <th></th>
          </tr>

       
          @foreach($products as $product)
          <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td><img src="{{asset('/storage/' . $product->img_path)}}" style="text-align:left"></td>
            <td>{{ $product->product_name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->stock }}本</td>
            <td style="text-align:right">{{ $product->company->company_name}}</td>
            <td style="text-align:center"><a class="btn btn-primary" href="{{ route('show',['id'=>$product->id]) }}">詳細表示</a></td>
            <td style="text-align:center">
            <form action="{{ route('destroy',$product->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
            </form>
            </td>
            
          </tr>
          @endforeach
          </table>
          {!! $products->links('pagination::bootstrap-5') !!}
          
      
          @endsection