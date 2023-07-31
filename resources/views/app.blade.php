<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
      body {
          font-family: "Helvetica Neue",
              Arial,
              "Hiragino Kaku Gothic ProN",
              "Hiragino Sans",
              Meiryo,
              sans-serif;
      }
    </style>
    <title>商品管理システム</title>
  </head>
  <body>
    <div class="container">
      <h1 style="font-size:1.25rem;">商品管理システム</h1>
        @yield('content')
    </div>

    <script>
         $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
        })      

            $(function() {
            $('.btn-danger').on('click', function() {
              var deleteConfirm = confirm('削除してよろしいでしょうか？');
              if(deleteConfirm == true) {
              var clickEle = $(this)
              // 削除ボタンにユーザーIDをカスタムデータとして埋め込んでます。
              var productID = clickEle.attr('data-product-id');

              $.ajax({
              type:"POST",
              url:'/products/{id}/destroy',
              data: {'id': productID,
               '_method': 'DELETE'} // DELETE リクエストだよ！と教えてあげる。
              })
              .done(function() {
              // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
              clickEle.parents('tr').remove();
              })

            .fail(function() {
                alert('エラー');
              });
            } else {
      (function(e) {
        e.preventDefault()
      });
    };
  });
}); 



          $(function() {
            $('#search').click(function(){
              $.ajax({
              type:"GET",
              url:"{{ route('index') }}",
              })
              .done(function(){
                alert('ajax成功');
              })
              .fail(function(){
                alert('ajax失敗');
              })
            });
          }); 

    </script>
  </body>
</html>


