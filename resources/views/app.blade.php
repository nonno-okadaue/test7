<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js" integrity="sha512-qzgd5cYSZcosqpzpn7zF2ZId8f/8CHmFKZ8j7mU4OUXTNRd5g+ZHBPsgKEwoqxCtdQvExE5LprwwPAgoicguNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.blue.min.css" integrity="sha512-jJ9r3lTLaH5XXa9ZOsCQU8kLvxdAVzyTWO/pnzdZrshJQfnw1oevJFpoyCDr7K1lqt1hUgqoxA5e2PctVtlSTg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
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

          $(function() {
          $('.btn-danger').on('click', function() {
              var deleteConfirm = confirm("削除してよろしいでしょうか？");

              if(deleteConfirm == true) {
              var clickEle = $(this)
              var productID = clickEle.attr('data-product_id');

              $.ajax({
              type:'POST',
              url:'http://localhost:8888/test7/public/products/'+productID+'/destroy',
              data: {'id':productID,
                     '_method':'DELETE'} 
              })
              .done(function() {
                clickEle.parents('tr').remove();
              })

              .fail(function() {
                  alert('ajax失敗');
                })

              } else {
                (function(e) {
                  e.preventDefault()
                });
              };
            });
          });

    </script>
  </body>
</html>


