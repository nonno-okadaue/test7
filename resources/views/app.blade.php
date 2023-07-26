<!doctype html>
<html lang="ja">
  <head>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
  </body>
</html>


