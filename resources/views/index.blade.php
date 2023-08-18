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
                <label class="col-sm-auto col-form-label">キーワード</label>
                  <div><input type="text" name="keyword" value="{{ $keyword }}"></div>
              </div>
            
              <div>
                <label class="col-sm-auto col-form-label">会社名</label>
                  <div>
                    <select name="companyId" data-toggle="select" class="form-control" value=""></div>
                    <option selected="selected" value="">指定なし</option>
                    @foreach ($companies as $id => $company_name)
                    <option value="{{ $id }}">{{ $company_name }}</option>
                    @endforeach
                    </select>
                  </div>
              </div>

              <div>
                <label for="price" class="col-sm-auto col-form-label">価格</label>

                <div class="jougen">
                <p>上限</p>
                <input type="number" name="jougenprice" id="jougenprice" >
                </div>

                <div class="kagen">
                <p>下限</p>
                <input type="number" name="kagenprice" id="kagenprice" >
                </div>

              </div>

              <div>
              <label for="stock" class="col-sm-auto col-form-label">在庫数</label>

                <div class="jougen">
                <p>上限</p>
                <input type="number" name="jougenstock" id="jougenstock" >
                </div>

                <div class="kagen">
                <p>下限</p>
                <input type="number" name="kagenstock" id="kagenstock" >
                </div>

              </div>
       
              <div class="col-sm-auto btn">
                <button type="submit" class="btn btn-primary" id="search">検索</button>
              </div>
            </div>
          </form>
        </div>
      </div>

        <table class="table table-bordered tablesorter-blue" id="myTable">
          <thead>
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
          </thead>

          <tbody>
          @foreach($products as $product)
          <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td><img src="{{asset('storage/' . $product->img_path)}}" style="text-align:left"></td>
            <td>{{ $product->product_name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->stock }}本</td>
            <td style="text-align:right">{{ $product->company->company_name}}</td>
            <td style="text-align:center"><a class="btn btn-primary" href="{{ route('show',['id'=>$product->id]) }}">詳細表示</a></td>
            <td style="text-align:center">
            <form action="{{ route('destroy',$product->id) }}" method="POST">
            @csrf 
            @method("DELETE")
            <button data-product_id="{{$product->id}}" type="button" class="btn btn-danger">削除</button>
            </form>               
          </tr>
          @endforeach
          </tbody>
        </table>
          
          {!! $products->links('pagination::bootstrap-5') !!}

                    

          @endsection